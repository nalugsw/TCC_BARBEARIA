<?php

session_start();
include("../../config/conexao.php");

if(!isset($_POST['email']) || !isset($_POST['senha'])){
    $_SESSION['erro'] = "Preencha todos os campos";
    header("location: ../../index.php");
    exit();
}

$email = trim($_POST['email']);
$senha = $_POST['senha'];

$query = "SELECT * from usuario where email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res){
        $senha_hash = $res['senha'];

        if(password_verify($senha, $senha_hash)){
            $_SESSION['id_usuario'] = $res['id_usuario'];
            $_SESSION['tipo_usuario'] = $res['tipo_usuario'];
            header("location: ../../public/user/perfil.php");
            exit();
        }else{
            $_SESSION['erro'] = "Email ou senha incorretos.";
            header("Location: ../../index.php");
            exit();
        }
}else{
    $_SESSION['erro'] = "Email ou senha incorretos.";
    header("Location: ../../index.php");
    exit();
    }


?>