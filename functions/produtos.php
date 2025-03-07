<?php

function mostrarProdutos(){
    $sql = "SELECT * FROM produto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>