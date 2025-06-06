<?php

//FUNÇÃO DE BUSCAR IMAGEM NO DATABASE
function buscaImagemUsuario($id_usuario){
    global $pdo;

    $sql = "SELECT foto FROM CLIENTE WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($imagem['foto']) && file_exists("../../" . $imagem['foto'])) {
        return $imagem['foto'];
    }

    $sql = "SELECT foto FROM FUNCIONARIO WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($imagem['foto']) && file_exists("../../" . $imagem['foto'])) {
        return $imagem['foto'];
    }

    return "uploads/fotos/avatar-padrao.jpg";
}


?>