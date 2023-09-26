<?php 
    $css = '<link rel="stylesheet" href="../css/login.css"> <script src="../script/login.js" defer></script>';
    include './componentes/header.php';
?>
<?php
    $erros = array();

    if(isset($_POST["btn-login"])){
        $email = $_POST["input-email"];
        $senha = $_POST["input-senha"];
        
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);// TODO: Não está funcionando
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
            $erros[] = "Email inválido";
        }

        $format = array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"));
        if(! filter_var($senha, FILTER_VALIDATE_REGEXP, $format)){
            $erros[] = "Senha inválida";
        }

        if(empty($erros)){
            header('Location: ./../index.php');
        }

    }
?>
<section class="body_content">
    <div class="container pt-5 todo">
        <div class="container d-flex justify-content-center flex-wrap">
            <div class="container-fluid m-0 p-0 div-img-login">
                <img class="img-fluid img-login" src="./../imgs/login_desktop.png"/>
            </div>
            <div class="col-lg-4 div-form">
                <div class="container card px-5 py-3 form1">
                    <div class="d-flex justify-content-center">
                        <a href="../index.php">
                            <img src="./../imgs/logo_recicla_mais2.svg"/>
                        </a>
                    </div>
                    <form id="form-login" action="login.php" method="post"  class="d-flex flex-column">
                        <label for="input-email" class="mb-2">Digite seu email:</label>
                        <input class="mb-3" type="email"  name="input-email" id="input-email" placeholder="Digite seu Email" required
                        >
                        
                        <label for="input-senha" class="mb-2">Digite sua senha:</label>
                        <input class="mb-2" type="password" name="input-senha" id="input-senha" placeholder="Digite sua senha"
                        required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$">
                        
                        <a class="mb-4" href="./esqueciSenha.php">Esqueci minha senha</a>
                        <!-- <span class="lnr lnr-eye"></span>  olinho -->
                        <button name="btn-login" click="submit" class="btn border-0 container bg_verde preto">Login</button>
                        <div id="opcoes" class="azul mt-3 text-center justify-content-around gap-2">
                            <p class="azul">Ainda não possui cadastro?</p>
                            <a class="d-flex justify-content-center" href="./cadastro.php">
                                <div class="btn-cadastre">
                                    <p>Cadastre-se</p>
                                </div>
                            </a>
                        </div>
                    </form>
                    <div class="d-flex mt-3 div-error">
                        <?php 
                            if(!empty($erros)){
                                foreach($erros as $erro){
                                    echo "<li> $erro </li>";
                                }
                            }
                        ?>
                    </div>
                </div>
                
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-email">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">EMAIL NÃO CADASTRADO NO SISTEMA</p>
                </div>
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-password">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">SENHA INCORRETA</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?>    