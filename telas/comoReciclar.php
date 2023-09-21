<?php 
    $css = '<link rel="stylesheet" href="../css/comoReciclar.css">';
    include './componentes/header.php';
?>
<section class="body_content">
    <div class="container-fluid d-flex justify-content-center pt-4">
        <p class="text-center">QUAL DOS ITENS ABAIXO DESEJA APRENDER A RECICLAR?</p>
    </div>
    <div class="container-fluid row justify-content-center botoes teste">
        <div class="col-sm-3 d-flex flex-column flex-wrap align-content-center justify-content-center">
            <a href="./descricaoDescarte.php"><button>VIDROS</button></a>
            <a href="./descricaoDescarte.php"><button>PLÁSTICO</button></a>
            <a href="./descricaoDescarte.php"><button>MADEIRAS</button></a>
            <a href="./descricaoDescarte.php"><button>PILHAS E BATERIAS</button></a>
        </div>
        <div class="col-sm-3 d-flex flex-column flex-wrap align-content-center justify-content-center">
            <a href="./descricaoDescarte.php"><button>METAIS</button></a>
            <a href="./descricaoDescarte.php"><button>PAPÉIS E PAPELÕES</button></a>
            <a href="./descricaoDescarte.php"><button>LIXO ORGÂNICO</button></a>
            <a href="./descricaoDescarte.php"><button>LIXO HOSPITALAR</button></a>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?>