<?php 
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/comoReciclar.css">';
    include './../../componentes/header.php';
?>
<section class="body_content">
    <div class="container-fluid d-flex justify-content-center pt-4">
        <p class="text-center">QUAL DOS ITENS ABAIXO DESEJA APRENDER A RECICLAR?</p>
    </div>
    <div class="container-fluid row justify-content-center botoes teste">
        <div class="col-sm-3 d-flex flex-column flex-wrap align-content-center justify-content-center">
            <a href="./descarteVidro.php"><button>VIDROS</button></a>
            <a href="./descartePlastico.php"><button>PLÁSTICO</button></a>
            <a href="./descarteMadeira.php"><button>MADEIRAS</button></a>
            <a href="./descarteEletronico.php"><button>LIXO ELETRÔNICO</button></a>
        </div>
        <div class="col-sm-3 d-flex flex-column flex-wrap align-content-center justify-content-center">
            <a href="./descarteMetal.php"><button>METAIS</button></a>
            <a href="./descartePapel.php"><button>PAPEL</button></a>
            <a href="./descarteOrganico.php"><button>LIXO ORGÂNICO</button></a>
            <a href="./descarteHospitalar.php"><button>LIXO HOSPITALAR</button></a>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?>