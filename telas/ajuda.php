<?php
    session_start();
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/ajuda.css"> <script src="../script/ajuda.js" defer></script>';
    include './componentes/header.php';
?>

<section class="body_content">
    <div class="accordion mx-5 conteudo" id="accordionExample">
        <div class="accordion-item text-center ReciclaStyle">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button ReciclaStyle d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            O que é esse app de reciclagem?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body text-white">
              Resposta: O app de reciclagem é uma ferramenta tecnológica que ajuda os usuários a reciclar de forma mais fácil e eficiente.
            </div>
          </div>
        </div>
        <div class="accordion-item text-center ReciclaStyle">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed ReciclaStyle d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Posso usar o app de reciclagem em qualquer lugar?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body text-white">
              Resposta: Isso depende do app que você está usando. Alguns apps de reciclagem são projetados para funcionar em uma região ou país específico.
            </div>
          </div>
        </div>
        <div class="accordion-item text-center ReciclaStyle">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed ReciclaStyle d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            O app de reciclagem é gratuito?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body text-white">
              Resposta: A maioria dos apps de reciclagem são gratuitos para baixar e usar.
            </div>
          </div>
        </div>
        <div class="accordion-item text-center ReciclaStyle">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed ReciclaStyle d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Posso usar o app de reciclagem em qualquer lugar?
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body text-white">
            Resposta: Usando o app de reciclagem, você pode reciclar de forma mais eficiente e reduzir a quantidade de lixo que vai para os aterros sanitários.
          </div>
        </div>
      </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?>    
