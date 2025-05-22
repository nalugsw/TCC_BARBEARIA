<?php
include('../../config/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $horarios = $_POST['horarios'] ?? [];

    try {
        // Limpa a tabela
        $pdo->exec("TRUNCATE TABLE horarios_disponiveis");

        // Insere novos horários
        $stmt = $pdo->prepare("INSERT INTO horarios_disponiveis (horario) VALUES (?)");
        foreach ($horarios as $hora) {
            $stmt->execute([$hora]);
        }
        header("location: ../../public/adm/editarHorarios.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao atualizar horários: " . $e->getMessage();
    }
} else {
    echo "Método inválido.";
}