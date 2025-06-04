<?php
include('../config/conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? null;
    $id = $_POST['id'] ?? null;

    if ($acao && $id) {
        if($acao === 'finalizado' || $acao === 'cancelado'){
            $status = ($acao === 'finalizado' || $acao === 'cancelado') ? $acao : 'pendente';

            $sql = "UPDATE agenda SET status_agenda = :status WHERE id_agenda = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        }elseif($acao === 'cancelado_cliente'){
            $sql = "DELETE FROM AGENDA where id_agenda = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        }
    }
}

if($_SESSION['tipo_usuario'] == 'cliente'){
    header("location: ../public/user/perfil.php");
    exit();
}elseif($_SESSION['tipo_usuario'] == 'administrador');
    header("location: ../public/adm/horarios.php");
    exit();
?>