const nomeEmpresa = document.getElementById('nome-empresa');
const cnpj = document.getElementById('cnpj');
const telefone = document.getElementById('telefone');
const email = document.getElementById('email');
const senha = document.getElementById('senha');
const confirmarSenha = document.getElementById('confirmar_senha');
const cep = document.getElementById('cep');
const tpLogradouro = document.getElementById('tp_logradouro');
const logradouro = document.getElementById('logradouro');
const numero = document.getElementById('numero');
const uf = document.getElementById('uf');
const cidade = document.getElementById('cidade');
const bairro = document.getElementById('bairro');
const complemento = document.getElementById('complemento');
const formGeral = document.getElementById('form_infos_geral');
const btnContinuar1 = document.getElementById("btn-continuar1");
const btnContinuar2 = document.getElementById("btn-continuar2");

const cadastros = [];

let isValid = true;

cep.addEventListener("input", e => {
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
});

async function validaCNPJ(cnpjConsulta) {
    try {
        const response = await fetch(`https://brasilapi.com.br/api/cnpj/v1/${cnpjConsulta}`);
        
        if (!response.ok) {
            throw new Error(`Erro de status: ${response.status}`);
        }

        const dados = await response.json();

         return true;
        
    } catch (err) {
       
        return false;
    }
}


/*
cnpj.addEventListener("input", async (e) => {
    //remove caracteres não numéricos
    const result = cnpj.value.replace(/\D/g, "");
    
    if(result.length === 14){
        cnpj.value = result.substring(0, 2) + "." + result.substring(2, 5) + "." + result.substring(5, 8) + "/" + result.substring(8, 12) + "-" + result.substring(12, 14);
    }

    if(result.length !== 14){
        isValid = false;
        cnpj.setCustomValidity("CNPJ inválido!!");
        cnpj.reportValidity();
    }else{
        isValid = true;
        cnpj.setCustomValidity("");
        const res = await validaCNPJ(result);
        if(res){
            cnpj.setCustomValidity("");
        }else{
            cnpj.setCustomValidity("CNPJ inválido!!");
            cnpj.reportValidity();
            isValid = false;
        }
    }
});
*/
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

formGeral.addEventListener("submit", e =>{
    e.preventDefault();
    const novoCadstro = {
        nomeEmpresa: nomeEmpresa.value,
        cnpj: cnpj.value,
        telefone: telefone.value,
        email: email.value,
        senha: senha.value,
        cep: cep.value,
        tpLogradouro: tpLogradouro.value,
        numero: numero.value,
        uf: uf.value,
        cidade: cidade.value,
        bairro: bairro.value,
        complemento: complemento.value
    }
    const novoCadstroSerializado = JSON.stringify(novoCadstro);
    localStorage.setItem(nomeEmpresa.value, novoCadstroSerializado);

    window.location.href = './../telas/paginaInicialUser.php';
});

btnContinuar1.addEventListener("click", async (e) =>{
    e.preventDefault();
    /*
    if(nomeEmpresa.value === "" || nomeEmpresa.value.length < 3){
        isValid = false;
        nomeEmpresa.setCustomValidity("É necessário informar um nome!!");
        nomeEmpresa.reportValidity();
        console.log('nome')
    }else{
        nomeEmpresa.setCustomValidity("");
    }
    */

    /*
    const validCNPJ = await validaCNPJ(cnpj);
    if(!(validCNPJ)){
        cnpj.setCustomValidity("CNPJ inválido!!");
        cnpj.reportValidity();
    }

    if(!(cnpj.checkValidity())){
        isValid = false;
        
    }

    if(!(telefone.checkValidity())){
        isValid = false;
        telefone.setCustomValidity('telefone');
        console.log("erro")   
    }else{
        telefone.setCustomValidity('');
        console.log("acertouu")
    }

    telefone.reportValidity();

    if(!(email.checkValidity())){
        isValid = false;
        console.log('email')
    }


    if(!(senha.checkValidity())){
        isValid = false;
        
        senha.setCustomValidity("senha incorreta");
        senha.reportValidity();
        console.log(senha.value)
    }else{
        console.log("conserteiii")
        senha.setCustomValidity("");
        isValid = true;
    }

    if(senha.value !== confirmarSenha.value){
        isValid = false;
        console.log('senhas iguais')
    }
    */
    console.log(isValid)
    if(isValid){
        document.getElementById("div-cad-1").classList.add("hide");
        document.getElementById("div-cad-2").classList.add("show");
    }
    
})

btnContinuar2.addEventListener("click", e =>{
    e.preventDefault();
    let isValid = true;

    if(!(cep.checkValidity())){
        isValid = false;
    }

    if(!(cep.checkValidity())){
        isValid = false;
    }
    if(isValid){
        document.getElementById("div-cad-2").classList.remove("show");
        document.getElementById("div-cad-3").classList.add("show");
    }
    
})

/*
mostrarSenha.addEventListener('click', () => {
    if(inputSenha.getAttribute('type') === 'password'){
        inputSenha.setAttribute('type', 'text');
    }else{
        inputSenha.setAttribute('type', 'password');
    }
});*/
