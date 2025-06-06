<?php

session_start();
include("../../config/conexao.php");



$nome = $_POST['nome'];
$numero_telefone = $_POST['numero_telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$tipo_usuario = "cliente";

$verifica_email = $pdo->prepare("SELECT * FROM usuario where email = :email");
$verifica_email->bindParam(":email", $email);
$verifica_email->execute();
$res = $verifica_email->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
    $_SESSION['erro'] = "Email já cadastrado.";
    header("Location: ../../public/user/cadastro.php");
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

    if(!$id_usuario){
        $pdo->rollBack();
        $_SESSION['erro'] = "Erro ao cadastrar usuário";
        header("location: ../../public/user/cadastro.php");
        exit();
    }
    
    $sql = "INSERT INTO cliente(nome, foto, numero_telefone, id_usuario) values(:nome, :foto, :numero_telefone, :id_usuario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindValue(":foto", "assets/img/avatar-padrao.jpg"); 
    $stmt->bindParam(":numero_telefone", $numero_telefone);
    $stmt->bindParam(":id_usuario", $id_usuario);
    $cadastro = $stmt->execute();

    if($cadastro){
        $pdo->commit();
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso.";
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['tipo_usuario'] = $tipo_usuario;
        header("location: ../../public/user/perfil.php");
        exit();
    }else{
        $pdo->rollBack();
        $_SESSION['erro'] = "Erro ao cadastrar o usuário. Tente novamente";
        header("location: ../../public/user/cadastro.php");
        exit();
    }

}


?>