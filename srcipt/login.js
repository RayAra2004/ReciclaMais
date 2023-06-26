const formLogin = document.getElementById('form-login');
const inputEmail = document.getElementById('input-email');
const inputSenha = document.getElementById('input-senha');
const mostrarSenha = document.querySelector('.lnr-eye');

mostrarSenha.addEventListener('click', () => {
    if(inputSenha.getAttribute('type') === 'password'){
        inputSenha.setAttribute('type', 'text');
    }else{
        inputSenha.setAttribute('type', 'password');
    }
});

inputSenha.oninvalid = inputSenha.onfocus = inputSenha.focusout = function(){
    // remove mensagens de erro antigas
    this.setCustomValidity("");

    // reexecuta validação
    if (!this.validity.valid) {

        // se inválido, coloca mensagem de erro
        this.setCustomValidity("Sua senha deve conter ao menos 8 caracteres com letras maiúsculas, minúsculas, números e caracteres especiais");
    }
}

formLogin.addEventListener('submit', e => {
    e.preventDefault();

    const keys = Object.keys(localStorage)
    const cadastros = [];

    for (const key of keys){
        const cadastro = JSON.parse(localStorage.getItem(key));
        cadastros.push(cadastro);
    }
    console.log(cadastros)
    const login = cadastros.find(cad => cad.email === inputEmail.value);
    if(login){
        if(login.senha === inputSenha.value){
            window.location.href = './../telas/paginaInicialUser.html'
        }else{
            document.getElementById('invalid-password').classList.add('show');
        setTimeout(() =>{
            document.getElementById('invalid-password').classList.remove('show');
        }, 1500)
        }
    }else{
        document.getElementById('invalid-email').classList.add('show');
        setTimeout(() =>{
            document.getElementById('invalid-email').classList.remove('show');
        }, 1500)
    }

})