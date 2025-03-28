<?php

session_start();
include("../config/conexao.php");
require("helpers.php");

$id_usuario = $_SESSION['id_usuario'];
$cliente = dadosCliente($id_usuario);

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;

$caminho_foto = $cliente['foto'];

if ($foto && $foto['error'] == 0) {

    $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

    $formatos_permitidos = array('jpg', 'jpeg', 'png');

    if (!in_array($extensao, $formatos_permitidos)) {
        $_SESSION['erro'] = "Formato de imagem não permitido";
        header("location: ../public/user/perfil.php");
        exit();
    }

    $nome_foto = $id_usuario . "." . $extensao;
    $caminho_foto = "../uploads/fotos/" . $nome_foto;  

    $origem = $foto['tmp_name'];
    $destino = __DIR__ . "/../uploads/fotos/" . $nome_foto;

    if (!is_writable(dirname($destino))) {
        die("Erro: O diretório de destino não tem permissão de escrita.");
    }

    if (!move_uploaded_file($origem, $destino)) {
        die("Erro ao mover o arquivo.");
    }
}

$pdo->beginTransaction();


$sql = "UPDATE cliente SET nome = :nome, foto = :foto, numero_telefone = :numero_telefone WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":foto", $caminho_foto);  
$stmt->bindParam(":numero_telefone", $telefone);
$stmt->bindParam(":id_usuario", $id_usuario);


if ($stmt->execute()) {
    $_SESSION['realizado'] = "Perfil atualizado com sucesso";
    $pdo->commit();
    header("location: ../public/user/perfil.php");
    exit();
} else {
    $_SESSION['erro'] = "Erro ao tentar atualizar o perfil";
    $pdo->rollback();
    header("location: ../public/user/perfil.php");
    exit();
}

$stmt = null;
$conn = null;

?>
