<?php

session_start();
include("../config/conexao.php");

$id_usuario = $_SESSION['id_usuario'];

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$foto = $_FILES['foto'];

$extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
$extensao = strtolower($extensao);

$formatos_permitidos = array('jpg', 'jpeg', 'png');

if(!in_array($extensao, $formatos_permitidos)){
    $_SESSION['erro'] = "Formato de imagem não permitido";
    header("location: ../public/user/perfil.php");
    exit();
}

$nome_foto = $_SESSION['id_usuario'] . "." . $extensao;
$caminho_foto = "uploads/fotos/" . $nome_foto;

if(!move_uploaded_file($foto['tmp_name'], $caminho_foto)){
    $_SESSION['erro'] = "Erro ao enviar a imagem";
    header("location: location: ../public/user/perfil.php");
    exit();
}

$pdo->beginTransaction();

$sql = "UPDATE cliente SET nome = :nome, foto = :foto, numero_telefone = :numero_telefone WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":foto", $caminho_foto);
$stmt->bindParam(":numero_telefone", $telefone);

if($stmt->execute()){
    $_SESSION['realizado'] = "Perfil atualizado com sucesso";
    $pdo->commit();
    header("location: ../public/user/perfil.php");
    exit();
}else{
    $_SESSION['erro'] = "Erro ao tentar atualizar o perfil";
    $pdo->rollback();
    header("location: ../public/user/perfil.php");
    }

    $stmt->close();

$conn->close();

?>