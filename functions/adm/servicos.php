<?php

include("../../config/conexao.php");
session_start();

$nome = $_POST['nome'] ?? '';
$duracao = $_POST['duracao'] ?? '';
$valor = $_POST['valor'] ?? '';
$foto = $_FILES['foto'] ?? null;
$fotoCaminho = 'uploads/servicos/';
$acao = $_POST['acao'] ?? '';

if($acao == 'cadastro'){
  
}

?>