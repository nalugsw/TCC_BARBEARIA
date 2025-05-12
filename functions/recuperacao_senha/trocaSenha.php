<?php

session_start();
include("../../config/conexao.php");

$email = $_SESSION['email'];
$senha = $_POST['senha'];
$mesmaSenha = $_POST['mesmaSenha'];

if(!isset($senha) || !isset($mesmaSenha)){
    $_SESSION['erro'] = "Preencha todos os campos";
    header("location: ../../public/user/alterarSenha.php");
    exit;
}

if($senha != $mesmaSenha){
    $_SESSION['erro'] = "As senhas digitadas devem ser iguais";
    header("location: ../../public/user/alterarSenha.php");
    exit;
}

if (strlen($senha) < 8) {
    $_SESSION['erro'] = "A senha deve ter pelo menos 8 caracteres.";
    header("location: ../../public/user/alterarSenha.php");
    exit;
}

$novaSenhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET senha = :senha WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":senha", $novaSenhaHash);
$stmt->bindParam(":email", $email);
$stmt->execute();

header("location: ../../index.php");
exit;

?>