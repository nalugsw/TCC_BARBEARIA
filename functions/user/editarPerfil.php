<?php

session_start();

include("../../config/conexao.php");

require("perfil.php");

require("../helpers.php");

$id_usuario = $_SESSION['id_usuario'];
$cliente = dadosCliente($id_usuario);

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$caminho_atual_foto = buscaImagemUsuario($id_usuario);
$caminho_foto = $caminho_atual_foto;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    
    $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

    $formatos_permitidos = array('jpg', 'jpeg', 'png');

    if (!in_array($extensao, $formatos_permitidos)) {
        $_SESSION['erro'] = "Formato de imagem não permitido"; //UM ERRO DOS BRABO AI
        header("location: ../../public/user/perfil.php");
        exit();
    }

    $nome_foto = $id_usuario . "." . $extensao;
    $novo_caminho_foto = "../../uploads/fotos/" . $nome_foto;
    
    if (file_exists($caminho_atual_foto) && 
        $caminho_atual_foto != $novo_caminho_foto &&
        strpos($caminho_atual_foto, 'avatar-padrao.jpg') === false) {
        unlink($caminho_atual_foto);
    }

    $origem = $foto['tmp_name'];
    $destino = __DIR__ . "/../../uploads/fotos/" . $nome_foto;

    if (!is_writable(dirname($destino))) {
        die("Erro: O diretório de destino não tem permissão de escrita.");
    }
    if (move_uploaded_file($origem, $destino)) {
        $caminho_foto = $novo_caminho_foto;
    } else {
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
    $_SESSION['sucesso'] = "Perfil atualizado com sucesso"; //MENSAGEM QUE EXIBE UNS ERRINHO AI
    $pdo->commit();
    header("location: ../../public/user/perfil.php");
    exit();
} else {
    $_SESSION['erro'] = "Erro ao tentar atualizar o perfil"; //OUTRA MENSAGEM QUE EXIBE UNS ERRINHOS AI
    $pdo->rollback();
    header("location: ../../public/user/perfil.php");
    exit();

}


$stmt = null;
$conn = null;


?>