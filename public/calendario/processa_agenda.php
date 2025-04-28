<?php

session_start();

require("../../config/conexao.php");
require("../../functions/helpers.php");

$dadosUsuario = dadosCliente($id_usuario);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $data = $_POST['dataAgendamento'] ?? '';
    $hora = $_POST['horaAgendamento'] ?? '';
    
    try {
        // Verifica se o horário ainda está disponível
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM agenda 
                              WHERE data = ? AND hora = ?");
        $stmt->execute([$data, $hora]);
        $existe = $stmt->fetchColumn();
        
        if ($existe > 0) {
            throw new Exception("Este horário já foi reservado por outra pessoa.");
        }
        
        // Insere o agendamento
        $stmt = $pdo->prepare("INSERT INTO agendamentos 
                              (nome_cliente, email_cliente, telefone_cliente, data_agendamento, hora_agendamento) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $data, $hora]);
        
        header('Location: index.php?sucesso=1');
        exit();
    } catch (Exception $e) {
        header('Location: index.php?erro=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>