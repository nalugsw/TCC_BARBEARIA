<?php

function mostrarServicos(){
    global $pdo;
    $sql = "SELECT * FROM servico";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//var_dump(mostrarServicos());
//$servicos = mostrarServicos();
//var_dump($servicos);


function mostrarImagemPortfolio(){
    global $pdo;
    $sql = "SELECT * FROM portfolio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

?>