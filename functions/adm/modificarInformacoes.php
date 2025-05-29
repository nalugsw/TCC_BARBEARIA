<?php

include("../../config/conexao.php");

$informacoes_barbeiro = $_POST['informacoes_barbeiro'];
$informacoes_barbearia = $_POST['informacoes_barbearia'];

$sql = "UPDATE informacoes SET informacoes_barbeiro = :informacoes_barbeiro, informacoes_barbearia = :informacoes_barbearia WHERE id_informacoes = 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":informacoes_barbeiro", $informacoes_barbeiro);
$stmt->bindParam(":informacoes_barbearia", $informacoes_barbearia);
if ($stmt->execute()) {
    header("Location: ../../public/adm/informacoes.php");
} else {
    header("Location: ../../public/adm/informacoes.php");
}

?>