const nomeEmpresa = document.getElementById('nome_empresa');
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


const cadastros = [];
/*
cep.addEventListener("change", e => {
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
})
*/
btnContinuar1.addEventListener("click", e =>{
    e.preventDefault();
    console.log("oiiii");
})

/*
mostrarSenha.addEventListener('click', () => {
    if(inputSenha.getAttribute('type') === 'password'){
        inputSenha.setAttribute('type', 'text');
    }else{
        inputSenha.setAttribute('type', 'password');
    }
});*/
