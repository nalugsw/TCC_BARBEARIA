<?php

include("../config/conexao.php");

function mostrarServicos(){
    $sql = "SELECT * FROM servico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>