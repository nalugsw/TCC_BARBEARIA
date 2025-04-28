            <?php
require_once '../../../config/conexao.php';

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
            
            echo json_encode([
                'inativos' => $inativos,
                'agendamentos' => $agendamentos
            ]);
            break;
            
        case 'buscaHorarios':
            $data = $_GET['data'];
            
            // Horários disponíveis (exemplo: das 8h às 18h, de hora em hora)
            $horariosDisponiveis = [];
            for ($hora = 8; $hora < 18; $hora++) {
                $horariosDisponiveis[] = sprintf("%02d:00:00", $hora);
            }
            
            // Remove horários já agendados
            $stmt = $pdo->prepare("SELECT horario FROM agenda
                                  WHERE data = ?");
            $stmt->execute([$data]);
            $horariosOcupados = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosOcupados);
            
            echo json_encode(array_values($horariosDisponiveis));
            break;
            
        default:
            echo json_encode(['erro' => 'Ação não reconhecida']);
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
?>