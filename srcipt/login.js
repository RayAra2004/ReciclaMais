const formLogin = document.getElementById('form-login');
const inputEmail = document.getElementById('input-email');
const inputSenha = document.querySelector('input[type=password]');


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

    window.location.href = './../telas/paginaInicialUser.html'
})