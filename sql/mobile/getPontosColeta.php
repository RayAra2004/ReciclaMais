<?php
    require_once './../entidades/pontoColeta/PontoColeta.php';

    if (isset($_GET['limit']) && isset($_GET['offset']) && isset($_GET['lat']) && isset($_GET['lon'])) {

        $pontosColeta = PontoColeta::findAllPontosColeta();
    }
?>