<?php

include("../config/conexao.php");

//RECUPERA O NOME DO USUARIO

function nomeCliente($id_usuario){
    global $pdo;
    $sql = "SELECT CLIENTE.nome
    FROM CLIENTE
    JOIN USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
    WHERE USUARIO.id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    $nome = $stmt->fetch(PDO::FETCH_ASSOC);

    return $nome['nome'];
}

//RECUPERA O NÚMERO DE TELEFONE

function numeroCliente($id_usuario){
    global $pdo;
    $sql = "SELECT CLIENTE.numero_telefone
    FROM CLIENTE
    JOIN USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
    WHERE USUARIO.id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    $numero_telefone = $stmt->fetch(PDO::FETCH_ASSOC);

    return $numero_telefone['numero_telefone'];
}

?>