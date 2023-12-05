const nomeEmpresa = document.getElementById('nome-empresa');
const telefone = document.getElementById('telefone');
const senha = document.getElementById('senha');
const confirmarSenha = document.getElementById('confirmar_senha');
const btnEditar1 = document.getElementById("btn-editar-dados1");

const cep = document.getElementById('cep');
const tpLogradouro = document.getElementById('tp-logradouro');
const logradouro = document.getElementById('logradouro');
const numero = document.getElementById('numero');
const uf = document.getElementById('uf');
const cidade = document.getElementById('cidade');
const bairro = document.getElementById('bairro');
const complemento = document.getElementById('complemento');
const btnEditar2 = document.getElementById("btn-editar-dados2");

const inputMateriaisSelecionados = document.getElementById("materiaisInput");
const inputnewMateriaisSelecionados = document.getElementById("newMateriaisInput");

let selecionados = 0;

document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const form = document.querySelector('.form-data');
    form.addEventListener('submit', function () {
        const divTrashElements = document.querySelectorAll('.div-trash img');

        divTrashElements.forEach(element => {
            const material = element.alt;
           
            console.log(element.classList)
            
            inputnewMateriaisSelecionados.value += material + ';';

        });
    });
});


function selecionar(e, material){
    e.classList.toggle('ativo');
    if(e.classList.contains('ativo')){
        e.src = e.src.replace('.svg', '_ativo.svg');
        selecionados++;
    }else{
        e.src = e.src.replace('_ativo.svg', '.svg');
        selecionados--;
    }
}


const materiaisDaEmpresa = inputMateriaisSelecionados.value.split(';');


function selecionarMateriaisIniciais() {
    const divTrashElements = document.querySelectorAll('.div-trash img');

    divTrashElements.forEach(element => {
        const material = element.alt;
        if (materiaisDaEmpresa.includes(material)) {
            element.classList.add('ativo');
            element.src = element.src.replace('.svg', '_ativo.svg');
            selecionados++;
            inputMateriaisSelecionados.value += material + ';';
        }
    });
}

selecionarMateriaisIniciais();


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

btnEditar1.addEventListener("click", async (e) =>{
    
    if(nomeEmpresa.value === "" || nomeEmpresa.value.length < 3){
        isValid = false;
        nomeEmpresa.setCustomValidity("É necessário informar um nome!!");
        nomeEmpresa.reportValidity();
    }else{
        isValid = true;
        nomeEmpresa.setCustomValidity("");
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
    
    console.log(isValid);    
});

btnEditar2.addEventListener("click", e =>{

    if(cep.value < 0 || cep.value.length !== 8){
        isValid = false;
        cep.setCustomValidity('CEP inválido!!');
        cep.reportValidity();
    }else{
        cep.setCustomValidity('');
        isValid = true;
    }
    
});