<?php

session_start();

include("../../config/conexao.php");
require("../helpers.php");

$codigoRecuperacao = rand(10000, 99999);
if(!isset($_POST['email'])){
    $_SESSION['erro'] = "Por favor preencha todos os campos corretamente.";
    header("location: ../../public/user/redefinicaoSenha.html");
    exit();
}
$email = $_POST['email'];
$assunto = "Código de recuperação";
$mensagem = "Seu código de recuperação é: $codigoRecuperacao";
$cabecalho = "From: no-reply@barbertech.com";


$sql = "SELECT email FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->execute();
$resultadoEmail = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resultadoEmail) {
    $_SESSION['erro'] = "E-mail informado não cadastrado.";
    echo "erro de email";
    header("location: ../../public/user/redefinicaoSenha.html");
    exit();
}

$pdo->beginTransaction();

$sql = "UPDATE usuario SET token = :token WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":token", $codigoRecuperacao);
$stmt->bindParam(":email", $email);
$stmt->execute();

if (!enviarEmail($email, $assunto, $mensagem, $cabecalho)) {
    $_SESSION['erro'] = "Erro ao enviar o e-mail. Tente novamente.";
    $pdo->rollBack();
    echo "envio de email";
    header("location: ../../public/user/redefinicaoSenha.html");
    exit();
}

$pdo->commit();

echo "Email enviado";
header("location: ../../public/user/recuperacaoSenha.php");
exit();
?>