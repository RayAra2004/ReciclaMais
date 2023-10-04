<?php
    session_start();
    session_destroy(); //destroi a sessão
    header('Location: /ReciclaMais/index.php');
    exit();
?>