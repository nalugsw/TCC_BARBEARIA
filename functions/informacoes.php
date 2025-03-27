<?php

function buscarInformacoes(){
    global $pdo;
    $sql = "SELECT * FROM informacoes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>