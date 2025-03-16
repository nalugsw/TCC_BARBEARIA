<?php

function mostrarServicos(){
    global $pdo;
    $sql = "SELECT * FROM servico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function mostrarImagemPortfolio(){
    global $pdo;
    $sql = "SELECT portfolio FROM funcionario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

?>