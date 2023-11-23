<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/perfilEmpresa.css"><script src="/ReciclaMais/script/perfilEmpresa.js" defer></script>';
    include './../../componentes/header.php';
?>
<section class="body_content">
    <div class="conteudo">
        <div class="opcoes">
                <div class="option" id="btn_mudar_dados">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                    <p>Mudar Dados</p>
                </div>
                <div class="option">
                    <span class="material-symbols-outlined">
                        photo_camera
                    </span>
                    <p>Materiais Postados</p>
                </div>
                <div class="option">
                    <span class="material-symbols-outlined">
                        shopping_cart_checkout
                    </span>
                    <p>Suas negociações</p>
                </div>
        </div>
    </div>

    <div id="myModal" class="my-modal">
        <div class="my-modal-content">
            <span class="close">&times;</span>
            <p>Qual informação você deseja alterar?</p>
            <ul>
            <li><button><a href="./mudarDadosEmpresariais.php" id="option1">Informações Empresariais</a></button></li>
            <li><button><a href="#" id="option2">Endereço</a></button></li>
            <li><button><a href="#" id="option3">Materiais Reciclados</a></button></li>
            </ul>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?> 