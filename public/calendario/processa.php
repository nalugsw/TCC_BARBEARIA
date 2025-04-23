<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'agendamentos';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados']));
}

// Receber dados do formulário
$data = $_POST['selected_date'] ?? '';
$time = $_POST['selected_time'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

// Validar dados
if (empty($data) || empty($time) || empty($name) || empty($email)) {
    die(json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios']));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(['success' => false, 'message' => 'E-mail inválido']));
}

// Verificar se o horário ainda está disponível (para evitar conflitos)
$stmt = $pdo->prepare("SELECT id FROM agendamentos WHERE data_agendamento = ? AND hora_agendamento = ? AND status = 'reservado'");
$stmt->execute([$data, $time]);

if ($stmt->fetch()) {
    die(json_encode(['success' => false, 'message' => 'Este horário já foi reservado por outra pessoa']));
}

// Inserir agendamento
try {
    $stmt = $pdo->prepare("INSERT INTO agendamentos (data_agendamento, hora_agendamento, cliente_nome, cliente_email, status) VALUES (?, ?, ?, ?, 'reservado')");
    $stmt->execute([$data, $time, $name, $email]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Agendamento realizado com sucesso',
        'time' => $time
    ]);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Erro ao salvar agendamento: ' . $e->getMessage()]));
}
?>