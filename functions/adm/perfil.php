<?php

include("../../config/conexao.php");

$sql = "SELECT * FROM portfolio";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultadoPortfolio = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($resultadoPortolio == ""){
    
}

$extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

?>