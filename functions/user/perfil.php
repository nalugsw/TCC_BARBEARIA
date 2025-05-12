<?php

//FUNÇÃO DE BUSCAR IMAGEM NO DATABASE

function buscaImagemUsuario($id_usuario){
    global $pdo;
    $sql = "SELECT foto FROM CLIENTE WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($imagem && !empty($imagem['foto'])) {
        return $imagem['foto'];
    }

    $sql = "SELECT foto FROM FUNCIONARIO WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($imagem && !empty($imagem['foto'])) {
        return $imagem['foto']; 
    }
    return "../../assets/img/avatar-padrao.jpg"; // Retorna a imagem padrão se não tiver nenhuma de nenhum cliente ou funcionario
}

?>