const nomeEmpresa = document.getElementById('nome-empresa');
const cnpj = document.getElementById('cnpj');
const telefone = document.getElementById('telefone');
const email = document.getElementById('email');
const senha = document.getElementById('senha');
const confirmarSenha = document.getElementById('confirmar_senha');
const cep = document.getElementById('cep');
const tpLogradouro = document.getElementById('tp-logradouro');
const logradouro = document.getElementById('logradouro');
const numero = document.getElementById('numero');
const uf = document.getElementById('uf');
const cidade = document.getElementById('cidade');
const bairro = document.getElementById('bairro');
const complemento = document.getElementById('complemento');
const formGeral = document.getElementById('form_infos_geral');
const btnContinuar1 = document.getElementById("btn-continuar1");
const btnContinuar2 = document.getElementById("btn-continuar2");
const btnVoltar1 = document.getElementById("btn-voltar1");

const inputMateriaisSelecionados = document.getElementById("materiaisInput");

const cadastros = [];


let isValid = true;
let selecionados = 0;

function selecionar(e, material){
    e.classList.toggle('ativo');
    if(e.classList.contains('ativo')){
        e.src = e.src.replace('.svg', '_ativo.svg');
        selecionados++;
        inputMateriaisSelecionados.value += material + ';';
    }else{
        e.src = e.src.replace('_ativo.svg', '.svg');
        selecionados--;
        const materiais = inputMateriaisSelecionados.value;
        inputMateriaisSelecionados.value = materiais.replace(material + ';', '');
    }
}

cep.addEventListener("input", e => {
    if(e.target.value.length === 8){
        fetch(`https://brasilapi.com.br/api/cep/v2/${e.target.value}`)
        .then(res => res.json())
        .then(dados => {
            cidade.value = dados.city;
            bairro.value = dados.neighborhood;
            uf.value = dados.state;
            logradouro.value = dados.street.split(' ').slice(1).join(' ');
            const tp_lograduro = dados.street.split(" ");
            tpLogradouro.value = (tp_lograduro[0]).toLowerCase();
	});
    }
	
});

async function validaCNPJ(cnpjConsulta) {
    const result = cnpjConsulta.replace(/\D/g, "");

    if(result.length !== 14) return false;

    try {
        const response = await fetch(`https://brasilapi.com.br/api/cnpj/v1/${result}`);
        
        if (!response.ok) {
            throw new Error(`Erro de status: ${response.status}`);
        }

        const dados = await response.json();
         return true;
    } catch (err) {
        return false;
    }
};


cnpj.addEventListener("input", async (e) => {
    //remove caracteres não numéricos
    const result = cnpj.value.replace(/\D/g, "");
    
    if(result.length === 14){
        cnpj.value = result.substring(0, 2) + "." + result.substring(2, 5) + "." + result.substring(5, 8) + "/" + result.substring(8, 12) + "-" + result.substring(12, 14);
    }
});

telefone.addEventListener("input", e => {
    //remove caracteres não numéricos
    const result = telefone.value.replace(/\D/g, "");
    if (result.length === 11) {
        // Formate o telefone com parênteses e traço
        telefone.value = "(" + result.substring(0, 2) + ")" + result.substring(2, 7) + "-" + result.substring(7, 11);
    }else if(result.length === 10){
        telefone.value = "(" + result.substring(0, 2) + ")" + result.substring(2, 6) + "-" + result.substring(6, 10);
    }
});

btnContinuar1.addEventListener("click", async (e) =>{
    e.preventDefault();
    
    if(nomeEmpresa.value === "" || nomeEmpresa.value.length < 3){
        isValid = false;
        nomeEmpresa.setCustomValidity("É necessário informar um nome!!");
        nomeEmpresa.reportValidity();
    }else{
        isValid = true;
        nomeEmpresa.setCustomValidity("");
    }

    const validCNPJ = await validaCNPJ(cnpj.value);
    if(!(validCNPJ)){
        isValid = false;
        cnpj.setCustomValidity("CNPJ inválido!!");
        cnpj.reportValidity();
    }else{
        isValid = true;
        cnpj.setCustomValidity("");
    }
    
    const regexTelefone = /^\(\d{2}\)\d{4,5}-\d{4}$/;
    if (!regexTelefone.test(telefone.value)) {
        isValid = false;
        telefone.setCustomValidity('Telefone incorreto!!');
        telefone.reportValidity();  
    } else {
        isValid = true;
        telefone.setCustomValidity('');
    }

    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
    if(!regexEmail.test(email.value)){
        isValid = false;
        email.setCustomValidity('Email inváilido!!');
        email.reportValidity();
    }else{
        isValid = true;
        email.setCustomValidity('');
    }
    const regexSenha = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/
    if(!regexSenha.test(senha.value)){
        isValid = false;
        senha.setCustomValidity("A senha deve ter 8+ caracteres, incluindo maiúsculas, minúsculas, números e caracteres especiais!!");
        senha.reportValidity();
    }else{
        senha.setCustomValidity("");
        isValid = true;
    }

    if(senha.value !== confirmarSenha.value){
        isValid = false;
        confirmarSenha.setCustomValidity('As senhas devem ser iguais!');
        confirmarSenha.reportValidity();
    }else{
        confirmarSenha.setCustomValidity('');
        isValid = true;
    }
    
    console.log(isValid)
    if(isValid){
        document.getElementById("div-cad-1").classList.add("hide");
        document.getElementById("div-cad-2").classList.add("show");
    }
    
})

btnContinuar2.addEventListener("click", e =>{
    e.preventDefault();

    if(cep.value < 0 || cep.value.length !== 8){
        isValid = false;
        cep.setCustomValidity('CEP inválido!!');
        cep.reportValidity();
    }else{
        cep.setCustomValidity('');
        isValid = true;
    }

    if(isValid){
        document.getElementById("div-cad-2").classList.remove("show");
        document.getElementById("div-cad-3").classList.add("show");
    }
    
});

btnVoltar1.addEventListener("click", e =>{
    document.getElementById("div-cad-2").classList.remove("show");
    document.getElementById("div-cad-1").classList.remove("hide");
    
});


/*
mostrarSenha.addEventListener('click', () => {
    if(inputSenha.getAttribute('type') === 'password'){
        inputSenha.setAttribute('type', 'text');
    }else{
        inputSenha.setAttribute('type', 'password');
    }
});*/
