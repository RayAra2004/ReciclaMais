<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/perfilEmpresa.css"><script src="/ReciclaMais/script/perfilEmpresa.js" defer></script>';
    include './../../componentes/header.php';
    include './../../../sql/entidades/usuario/Usuario.php';
    include './../../../sql/entidades/usuario/Pessoa_Juridica.php';
    include './../../../sql/entidades/endereco/Endereco.php';
    include './../../../sql/entidades/pontoColeta/PontoColeta.php';

    $email = $_SESSION['email'];

    $usuario = Usuario::findByLogin($email);

    if(!empty($_POST)){

        $user = new Pessoa_Juridica();
        if($user->delete($usuario['id'])){
            header('Location: /ReciclaMais/index.php');
        }else{
            //erro ao deletar um usuário
        }
    }
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
            <div class="option" onclick="mostrarConfirmacao()">
                <span class="material-symbols-outlined">
                    person_remove
                </span>
                <p>Excluir perfil</p>
            </div>
        </div>
    </div>

    <div id="myModal" class="my-modal">
        <div class="my-modal-content">
            <span class="close">&times;</span>
            <p>Qual informação você deseja alterar?</p>
            <ul>
                <li><a href="./mudarDadosEmpresariais.php" id="option1"><button>Informações Empresariais</button></a></li>
                <li><a href="./mudarEnderecoEmpresarial.php" id="option2"><button>Endereço</button></a></li>
                <li><a href="#" id="option3"><button>Materiais Reciclados</button></a></li>
            </ul>
        </div>
    </div>
    <form action="./perfilEmpresa.php" method="post">
        <div id="confirmacao" class="my-modal">
            <div class="my-modal-content">
                <span class="fechar" onclick="fecharConfirmacao()">&times;</span>
                <p class="texto-modal">Tem certeza de que deseja prosseguir?</p>
                <button name = "excluir" type="submit" onclick="acaoConfirmada()">Sim</button>
                <button onclick="fecharConfirmacao()">Não</button>
            </div>
        </div>
    </form>
    
</section>
<?php
    include './../../componentes/footer.php'
?> 