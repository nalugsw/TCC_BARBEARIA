<?php

include("../../config/conexao.php");
session_start();

if (!isset($_POST['acao'])) {
    die("Ação inválida.");
}

$acao = $_POST['acao'];

?>