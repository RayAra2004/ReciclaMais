const inputEmail = document.getElementById('input-email');
const formLogin = document.getElementById('form-login');

formLogin.addEventListener('submit', e => {
    e.preventDefault();
    window.location.href = './../telas/paginaInicialUser.html'
})