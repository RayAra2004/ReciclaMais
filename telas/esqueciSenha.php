<?php 
    $css = '<link rel="stylesheet" href="../css/esqueciSenha.css">';
    include './componentes/header.php';
?>

<section class="body_content">
    <div class="container pt-5 todo">
        <div class="container d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card px-5 py-3" id="form1">
                    <form id="form-login" action=""  class="d-flex flex-column">
                        <label for="input-email" class="mb-2 text-white">Digite o email que deseja recuperar:</label>
                        <input class="mb-3" type="text" name="input-email" id="input-email" placeholder="Digite seu Email" required>
                        <div class="invalid-email vermelho">Email inválido!</div>

                        <a href="./esqueciSenha2.php"><div class="btn border-0 btn-dark container preto">Enviar codigo de verificação</div></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?>    