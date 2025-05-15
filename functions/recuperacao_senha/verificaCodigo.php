<?php

session_start();
include("../../config/conexao.php");

$email = $_SESSION['email'];

$letra1 = $_POST['letra1'];
$letra2 = $_POST['letra2'];
$letra3 = $_POST['letra3'];
$letra4 = $_POST['letra4'];
$letra5 = $_POST['letra5'];

if(!isset($letra1) || !isset($letra2) || !isset($letra3) || !isset($letra4) || !isset($letra5)){
    $_SESSION['erro'] = "Preencha todos os campos";
    header("location: ../../public/user/recuperacaoSenha.php");
    exit;
}

$tokenDigitado = $letra1 . $letra2 . $letra3 . $letra4 . $letra5;
$dataAtual = date("Y-m-d H:i:s");

$sql = "SELECT token, validade_token FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->execute();
$tokenUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

if($tokenUsuario['validade_token'] < $dataAtual){
    $_SESSION['erro'] = "Token expirado. Solicite um novo.";
    header("location: ../../public/user/recuperacaoSenha.php");
    exit;
}

if($tokenDigitado != $tokenUsuario['token']){
    $_SESSION['erro'] = "Código incorreto.";
    header("location: ../../public/user/recuperacaoSenha.php");
    exit;
}

header("location: ../../public/user/alterarSenha.php");
exit;

?>