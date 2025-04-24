<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'agendamentos';
$username = 'root';
$password = '';

$date = $_GET['date'] ?? '';

// Verificação mais robusta da data
try {
    $dateObj = new DateTime($date);
    $date = $dateObj->format('Y-m-d');
} catch (Exception $e) {
    die(json_encode(['error' => 'Data inválida: ' . $e->getMessage()]));
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Erro na conexão com o banco de dados: ' . $e->getMessage()]));
}

// Receber a data selecionada
$date = $_GET['date'] ?? '';

if (empty($date)) {
    die(json_encode(['error' => 'Data não fornecida']));
}

// Verificar se a data é válida
if (!DateTime::createFromFormat('Y-m-d', $date)) {
    die(json_encode(['error' => 'Data inválida']));
}

// Definir horários disponíveis (pode ser personalizado)
$availableHours = ['08:00','08:30', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];

// Consultar horários já reservados
$stmt = $pdo->prepare("SELECT TIME_FORMAT(hora_agendamento, '%H:%i') as hora FROM agendamentos WHERE data_agendamento = ? AND status = 'reservado'");
$stmt->execute([$date]);
$bookedHours = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Preparar resposta
$response = [];

foreach ($availableHours as $hour) {
    $response[] = [
        'hora' => $hour,
        'status' => in_array($hour, $bookedHours) ? 'reservado' : 'disponivel'
    ];
}

echo json_encode($response);
?>