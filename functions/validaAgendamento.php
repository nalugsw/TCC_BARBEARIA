<?php
include('../config/conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? null;
    $id = $_POST['id'] ?? null;

    if ($acao && $id) {
        $status = ($acao === 'finalizado' || $acao === 'cancelado') ? $acao : 'pendente';

        $sql = "UPDATE agenda SET status_agenda = :status WHERE id_agenda = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../public/adm/horarios.php");
        exit();
    } else {
        // redireciona ou mostra erro
    }
}
?>
