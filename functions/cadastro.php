<?php

@session_start();
require_once("../config/conexao.php");

$nome = $_SESSION['nome'];
$numero_telefone = $_SESSION['numero_telefone'];
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$tipo_usuario = "cliente";

$verifica_email = $pdo->prepare("SELECT * FROM usuario where email = :email");
$verifica_email->bindParam(":email", $email);
$verifica_email->execute();
$res = $verifica_email->fetch(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
    $_SESSION['erro'] = "Este Email já está cadastrado.";
    header("Location: ../public/cadastro.php");
    exit();
}else{

    $pdo->beginTransaction();

    $sql = "INSERT INTO usuario(email, senha, tipo_usuario) values(:email, :senha, :tipo_usuario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha_hash);
    $stmt->bindParam(":tipo_usuario", $tipo_usuario);
    $stmt->execute();
    
    $id_usuario = $pdo->lastInsertId();
    if (!$id_usuario) {
        $pdo->rollBack();
        $_SESSION['erro'] = "Erro ao cadastrar usuário.";
        header("Location: ../public/cadastro.php");
        exit();
    }
    
    $sql = "INSERT INTO cliente(nome, numero_telefone, id_usuario) values(:nome, :numero_telefone, :id_usuario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":numero_telefone", $numero_telefone);
    $stmt->bindParam(":id_usuario", $id_usuario);
    $cadastro = $stmt->execute();
    if($cadastro){
        $pdo->commit();
        $_SESSION['cadastro_realizado'] = "Cadastro realizado com sucesso.";
        header("location: ../index.php");
        exit();
    }else{
        $pdo->rollBack();
        $_SESSION['erro'] = "Erro ao cadastrar o cliente. Tente novamente";
        header("location: ../public/cadastro.php");
        exit();
    }
}


?>