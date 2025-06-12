<?php
include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!$pdo->inTransaction()) {
            $pdo->beginTransaction();
        }

        // Limpa as tabelas antes de inserir
        $truncateDias = $pdo->prepare("TRUNCATE TABLE dias_inativos");
        $truncateDias->execute();

        $truncateHorarios = $pdo->prepare("TRUNCATE TABLE horarios_disponiveis");
        $truncateHorarios->execute();

        // Inserir dias inativos
        $diasRecebidos = $_POST['dias'] ?? [];
        $diasSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
        $insertStmt = $pdo->prepare("INSERT INTO dias_inativos (data_inativa, motivo) VALUES (?, ?)");

        foreach ($diasSemana as $dia) {
            if (!isset($diasRecebidos[$dia]['fechado'])) continue;

            $emergencia = isset($diasRecebidos[$dia]['emergencia']);
            $motivo = $emergencia ? 'Emergência' : 'Fechado normalmente';

            $dataAtual = new DateTime();
            $dataFim = (new DateTime())->add(new DateInterval('P1Y'));

            $diaEsperado = match($dia) {
                'domingo' => 'sunday',
                'sabado' => 'saturday',
                'segunda' => 'monday',
                'terca' => 'tuesday',
                'quarta' => 'wednesday',
                'quinta' => 'thursday',
                'sexta' => 'friday',
            };

            while ($dataAtual <= $dataFim) {
                $diaSemana = strtolower($dataAtual->format('l'));

                if ($diaSemana === $diaEsperado) {
                    $insertStmt->execute([
                        $dataAtual->format('Y-m-d'),
                        $motivo
                    ]);
                }

                $dataAtual->add(new DateInterval('P1D'));
            }
        }
        $intervalo = (int) ($_SESSION['intervalo_horarios'] ?? 30);
        if ($intervalo < 1) {
            $intervalo = 30;
        }
        
        $primeiroInicio = $_POST['priHoraIni'] ?? '08:00';
        $primeiroFim = $_POST['priHoraFech'] ?? '12:00';
        $segundoInicio = $_POST['segHoraIni'] ?? '14:00';
        $segundoFim = $_POST['segHoraFech'] ?? '20:00';

        $horariosGerados = gerarHorariosDisponiveis($intervalo, $primeiroInicio, $primeiroFim, $segundoInicio, $segundoFim);
        $stmt = $pdo->prepare("INSERT INTO horarios_disponiveis (horario) VALUES (?)");

        foreach ($horariosGerados as $hora) {
            $stmt->execute([$hora]);
        }

        $pdo->commit();

        $_SESSION['msg_sucesso'] = "Configurações atualizadas com sucesso!";
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['msg_erro'] = "Erro no banco de dados: " . $e->getMessage();
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['msg_erro'] = "Erro: " . $e->getMessage();
    }

    header("Location: ../../public/adm/editarHorarios.php");
    exit();
}

?>