<?php

function mostrarProdutos(){
    global $pdo;
    $sql = "SELECT * FROM produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>