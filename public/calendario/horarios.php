<?php
header('Content-Type: application/json');
include("../../config/conexao.php");

$date = $_GET['date'] ?? '';

if (empty($date)) {
    die(json_encode(['error' => 'Data não fornecida']));
}

try {
    $dateObj = new DateTime($date);
    $date = $dateObj->format('Y-m-d');
} catch (Exception $e) {
    die(json_encode(['error' => 'Data inválida: ' . $e->getMessage()]));
}

$availableHours = ['08:00','08:30', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];

$stmt = $pdo->prepare("SELECT TIME_FORMAT(horario, '%H:%i') as hora FROM agenda WHERE data = ?");
$stmt->execute([$date]);
$bookedHours = $stmt->fetchAll(PDO::FETCH_COLUMN);

$response = [];

foreach ($availableHours as $hour) {
    $isToday = $date === date('Y-m-d');
    $horaAtual = date('H:i');

    if ($isToday && $hour < $horaAtual) {
        continue; // pula horários que já passaram se for hoje
    }

    $response[] = [
        'hora' => $hour,
        'status' => in_array($hour, $bookedHours) ? 'reservado' : 'disponivel'
    ];
}

echo json_encode($response);
?>
