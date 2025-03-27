<?php
include("../config/conexao.php");
session_start();
require_once("helpers.php");
verificaSession("cliente");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Validações básicas
if (empty($data['data']) || empty($data['horario']) || empty($data['id_servico'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

// Verificar se o horário ainda está disponível
$sql = "SELECT id_agenda FROM AGENDA 
        WHERE data = ? AND horario = ? AND id_funcionario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssi", $data['data'], $data['horario'], $_SESSION['id_funcionario']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Horário já ocupado']);
    exit;
}

// Inserir na tabela CLIENTE_SERVICO primeiro
$sql = "INSERT INTO CLIENTE_SERVICO (id_cliente, id_servico) VALUES (?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $_SESSION['id_cliente'], $data['id_servico']);
$stmt->execute();
$id_cliente_servico = $stmt->insert_id;

// Inserir na tabela AGENDA
$sql = "INSERT INTO AGENDA (data, horario, id_funcionario, id_cliente_servico) 
        VALUES (?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssii", $data['data'], $data['horario'], $_SESSION['id_funcionario'], $id_cliente_servico);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Agendamento realizado com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao agendar']);
}
?>