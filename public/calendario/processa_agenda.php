<?php

include("../../config/conexao.php");
require("../../functions/helpers.php");

session_start();
$id_usuario = $_SESSION['id_usuario']; 
$dadosUsuario = dadosCliente($id_usuario);
$id_cliente = $dadosUsuario['id_cliente'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['dataAgendamento'] ?? '';
    $hora = $_POST['horaAgendamento'] ?? '';
    $servico = $_POST['servico'] ?? '';
    
    try {
        // Verifica se o horário ainda está disponível
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM agenda 
                              WHERE data = ? AND horario = ?");
        $stmt->execute([$data, $hora]);
        $existe = $stmt->fetchColumn();
        
        if ($existe > 0) {
            throw new Exception("Este horário já foi reservado por outra pessoa.");
        }

        // Insere o agendamento
        $stmt = $pdo->prepare("INSERT INTO cliente_servico (id_cliente, id_servico) VALUES (?, ?)");
        $stmt->execute([$id_cliente, $servico]);

        $id_cliente_servico = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO agenda (data, horario, id_cliente_servico, status_agenda) VALUES(?, ?, ?, ?)");
        $stmt->execute([$data, $hora, $id_cliente_servico, "pendente"]);

        header('Location: ../user/agenda.php?sucesso=1');
        exit();
    } catch (Exception $e) {
        header('Location: ../user/agenda.php?erro=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>
