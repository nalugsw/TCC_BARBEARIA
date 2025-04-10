<?php

session_start();

include("../config/conexao.php");
require("../helpers.php");

$email = $_SESSION['email'];
$assunto = "Código de recuperação";
$mensagem = "Seu código de recuperação é: $codigoRecuperacao";
$cabecalho = "From: no-reply@barbertech.com";
$codigoRecuperacao = rand(100000, 999999);

if(!isset($email)){
    $_SESSION['erro'] = "Por favor preencha todos os campos corretamente.";
    header("location: ../public/user/");
}

$sql = "SELECT email FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->execute();
$resultadoEmail = $stmt->fetch(PDO::FETCH_ASSOC);

if($email != $resultadoEmail['erro']){
    $_SESSION['erro'] = "E-mail informado não cadastrado. Por favor informar um E-mail válido.";
    header("location: ../public/user/");
}

$sql = "UPDATE usuario SET token = :token WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":token", $codigoRecuperacao);
$stmt->bindParam(":email", $email);

enviarEmail($email, $assunto, $mensagem, $cabecalho);
?>