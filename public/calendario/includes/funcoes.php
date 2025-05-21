<?php
include('../../../config/conexao.php');

header('Content-Type: application/json');

$acao = $_GET['acao'] ?? '';

try {
    switch ($acao) {
        case 'carregaCalendario':
            $ano = $_GET['ano'];
            $mes = $_GET['mes'];
            
            // Busca dias inativos
            $stmt = $pdo->prepare("SELECT data_inativa FROM dias_inativos 
                                  WHERE YEAR(data_inativa) = ? AND MONTH(data_inativa) = ?");
            $stmt->execute([$ano, $mes]);
            $inativos = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Busca agendamentos
            $stmt = $pdo->prepare("SELECT DATE(data) as data, TIME(horario) as hora 
                                   FROM agenda 
                                   WHERE YEAR(data) = ? AND MONTH(data) = ?");
            $stmt->execute([$ano, $mes]);
            $agendamentos = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $agendamentos[$row['data']][] = $row['hora'];
            }
            
            // Busca o total de horários disponíveis por dia
            $stmt = $pdo->prepare("SELECT TIME_FORMAT(horario, '%H:%i') as horario FROM horarios_disponiveis");
            $stmt->execute();
            $todosHorarios = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $totalHorariosPorDia = [];
            
            // Cria um array com o mesmo formato dos agendamentos, mas com o total de horários
            $ultimoDia = date('t', strtotime("$ano-$mes-01"));
            
            for ($dia = 1; $dia <= $ultimoDia; $dia++) {
                $dataStr = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);
                $dataObj = new DateTime($dataStr);
                
                // Verifica se é domingo
                if ($dataObj->format('w') == 0) {
                    $totalHorariosPorDia[$dataStr] = 0;
                    continue;
                }
                
                // Verifica se é um dia inativo
                if (in_array($dataStr, $inativos)) {
                    $totalHorariosPorDia[$dataStr] = 0;
                    continue;
                }
                
                // Se for hoje, calcula quantos horários ainda estão disponíveis
                if ($dataStr == date('Y-m-d')) {
                    $horaAtual = date('H:i');
                    $horariosValidos = array_filter($todosHorarios, function($hora) use ($horaAtual) {
                        return $hora > $horaAtual;
                    });
                    $totalHorariosPorDia[$dataStr] = count($horariosValidos);
                } else {
                    $totalHorariosPorDia[$dataStr] = count($todosHorarios);
                }
            }
            
            echo json_encode([
                'inativos' => $inativos,
                'agendamentos' => $agendamentos,
                'totalHorariosPorDia' => $totalHorariosPorDia
            ]);
            break;
            
        case 'buscaHorarios':
            $data = $_GET['data'] ?? '';

            try {
                $dataObj = new DateTime($data);
                $data = $dataObj->format('Y-m-d');
            } catch (Exception $e) {
                echo json_encode(['erro' => 'Data inválida']);
                exit;
            }

            // Busca horários disponíveis no banco
            $stmt = $pdo->prepare("SELECT TIME_FORMAT(horario, '%H:%i') as horario FROM horarios_disponiveis");
            $stmt->execute();
            $horariosDisponiveis = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Se for hoje, remove os horários passados
            if ($data === date('Y-m-d')) {
                $horaAtual = date('H:i');
                $horariosDisponiveis = array_filter($horariosDisponiveis, function ($hora) use ($horaAtual) {
                    $agora = DateTime::createFromFormat('H:i', $horaAtual);
                    $horaDisponivel = DateTime::createFromFormat('H:i', $hora);
                    return $horaDisponivel > $agora;
                });
            }

            // Remove horários já agendados
            $stmt = $pdo->prepare("SELECT DATE_FORMAT(horario, '%H:%i') as horario FROM agenda WHERE data = ?");
            $stmt->execute([$data]);
            $horariosOcupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosOcupados);

            echo json_encode(array_values($horariosDisponiveis));
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
?>