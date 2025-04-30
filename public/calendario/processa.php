<?php

session_start();

include("../../functions/helpers.php");
$dadosCliente = dadosCliente($id_usuario);

header('Content-Type: application/json');

// Configurações do banco de dados
include("../../config/conexao.php");

// Receber dados do formulário
$data = $_POST['selected_date'] ?? '';
$time = $_POST['selected_time'] ?? '';

// Validar dados
if (empty($data) || empty($time)) {
    die(json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios']));
}

// Verificar se o horário ainda está disponível (para evitar conflitos)
$stmt = $pdo->prepare("SELECT id_agenda FROM agenda WHERE data = ? AND horario = ?");
$stmt->execute([$data, $time]);

if ($stmt->fetch()) {
    die(json_encode(['success' => false, 'message' => 'Este horário já foi reservado por outra pessoa']));
}

// Inserir agendamento
try {
    $stmt = $pdo->prepare("INSERT INTO agenda (data, horario, id_cliente_servico) VALUES (?, ?, ?)");
    $stmt->execute([$data, $time]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Agendamento realizado com sucesso',
        'time' => $time
    ]);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Erro ao salvar agendamento: ' . $e->getMessage()]));
}
?>