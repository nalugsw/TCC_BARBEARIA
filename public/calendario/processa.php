<?php

session_start();

include("../../config/conexao.php");
include("../../functions/helpers.php");
$dadosCliente = dadosCliente($id_usuario);
$funcionario = $_POST['id_funcionario'] ?? '';

header('Content-Type: application/json');

// Configurações do banco de dados

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

// Insere o serviço do cliente
        $stmt = $pdo->prepare("INSERT INTO cliente_servico (id_cliente, id_servico) VALUES (?, ?)");
        $stmt->execute([$id_cliente, $servico]);

        $id_cliente_servico = $pdo->lastInsertId();

// Inserir agendamento
try {

    // Insere o serviço do cliente
    $stmt = $pdo->prepare("INSERT INTO cliente_servico (id_cliente, id_servico) VALUES (?, ?)");
    $stmt->execute([$id_cliente, $servico]);

    $stmt = $pdo->prepare("INSERT INTO agenda (data, horario, id_cliente_servico, id_funcionario) VALUES (?, ?, ?)");
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