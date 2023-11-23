document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('btn_mudar_dados');
    const modal = document.getElementById('myModal');
    const closeModal = document.getElementsByClassName('close')[0];
    const option1 = document.getElementById('option1');
    const option2 = document.getElementById('option2');
    const option3 = document.getElementById('option3');
  
    openModalBtn.addEventListener('click', function () {
      modal.style.display = 'block';
    });
  
    closeModal.addEventListener('click', function () {
      modal.style.display = 'none';
    });
  
    option1.addEventListener('click', function () {
      // Ação para a opção 1
      console.log('Opção 1 selecionada');
      // Adicione sua lógica aqui
    });
  
    option2.addEventListener('click', function () {
      // Ação para a opção 2
      console.log('Opção 2 selecionada');
      // Adicione sua lógica aqui
    });
  
    option3.addEventListener('click', function () {
      // Ação para a opção 3
      console.log('Opção 3 selecionada');
      // Adicione sua lógica aqui
    });
});

function mostrarConfirmacao() {
  document.getElementById("confirmacao").style.display = "block";
}

function fecharConfirmacao() {
  document.getElementById("confirmacao").style.display = "none";
}

function acaoConfirmada() {
  fecharConfirmacao();
}
  