const nomeEmpresa = document.getElementById('nome-empresa');
const telefone = document.getElementById('telefone');
const senha = document.getElementById('senha');
const confirmarSenha = document.getElementById('confirmar_senha');
const btnEditar1 = document.getElementById("btn-editar-dados1");

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