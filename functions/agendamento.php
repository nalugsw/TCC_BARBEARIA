<?php

require_once("helpers.php");

function mostrarAgendamentos($id_usuario, $pdo){
    $sql = "SELECT 
    CLIENTE.nome AS nome,
    SERVICO.nome AS servico,
    AGENDA.data AS data,
    AGENDA.horario AS horario,
    FUNCIONARIO.nome AS funcionario
    FROM 
        AGENDA
    JOIN 
        CLIENTE_SERVICO ON AGENDA.id_cliente_servico = CLIENTE_SERVICO.id_cliente_servico
    JOIN 
        CLIENTE ON CLIENTE_SERVICO.id_cliente = CLIENTE.id_cliente
    JOIN 
        SERVICO ON CLIENTE_SERVICO.id_servico = SERVICO.id_servico
    JOIN 
        FUNCIONARIO ON AGENDA.id_funcionario = FUNCIONARIO.id_funcionario
    JOIN 
        USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
    WHERE 
        USUARIO.id_usuario = :id_usuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obterConfiguracaoHorarios($conexao, $idFuncionario = null) {
    $sql = "SELECT * FROM CONFIGURACAO_HORARIO";
    if ($idFuncionario) {
        $sql .= " WHERE id_funcionario = ? OR id_funcionario IS NULL";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $idFuncionario);
    } else {
        $stmt = $conexao->prepare($sql);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $configuracoes = [];
    while ($row = $result->fetch_assoc()) {
        $configuracoes[$row['dia_semana']] = $row;
    }
    
    return $configuracoes;
}

function verificarDiaFechado($conexao, $data) {
    $sql = "SELECT * FROM DIAS_FECHADOS WHERE data = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $data);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

function gerarProximosDiasUteis($conexao, $dias = 6, $idFuncionario = null) {
    $configHorarios = obterConfiguracaoHorarios($conexao, $idFuncionario);
    $diasUteis = [];
    $contador = 0;
    $dataAtual = new DateTime();
    
    while (count($diasUteis) < $dias) {
        $dataAtual->modify('+1 day');
        $dataFormatada = $dataAtual->format('Y-m-d');
        $diaSemana = strtolower($dataAtual->format('l'));
    }

        // Ajusta para nomes em português
        $diaSemanaPt = DiaDaSemana($diaSemana); 
        
        // Verifica se está aberto e não é dia fechado
        if (isset($configHorarios[$diaSemanaPt]) && 
            $configHorarios[$diaSemanaPt]['aberto'] && 
            !verificarDiaFechado($conexao, $dataFormatada)) {
            
            $diasUteis[] = [
                'data' => $dataAtual->format('d/m'),
                'dia_semana' => $diaSemanaPt,
                'data_completa' => $dataFormatada,
                'hora_abertura' => $configHorarios[$diaSemanaPt]['hora_abertura'],
                'hora_fechamento' => $configHorarios[$diaSemanaPt]['hora_fechamento'],
                'intervalo' => $configHorarios[$diaSemanaPt]['intervalo_minutos']
            ];
        }
    
    
    return $diasUteis;
    }

function gerarHorariosDisponiveis($horaAbertura, $horaFechamento, $intervalo) {
    $horarios = [];
    $horaAtual = strtotime($horaAbertura);
    $horaFim = strtotime($horaFechamento);
    
    while ($horaAtual < $horaFim) {
        $horarios[] = date('H:i:s', $horaAtual);
        $horaAtual = strtotime("+$intervalo minutes", $horaAtual);
    }
    
    return $horarios;
}

function verificarHorariosDisponiveis($conexao, $data, $idFuncionario = 1) {
    // 1. Obter configuração do dia
    $diaSemana = date('l', strtotime($data));
    $diaSemanaPt = traduzirDiaSemana($diaSemana);
    $configDia = obterConfiguracaoHorarios($conexao, $idFuncionario)[$diaSemanaPt];
    
    if (!$configDia || !$configDia['aberto']) {
        return [];
    }
    
    // 2. Gerar todos horários possíveis
    $horariosPossiveis = gerarHorariosDisponiveis(
        $configDia['hora_abertura'],
        $configDia['hora_fechamento'],
        $configDia['intervalo_minutos']
    );
    
    // 3. Consultar horários já agendados
    $sql = "SELECT TIME(horario) as horario FROM AGENDA 
            WHERE data = ? AND id_funcionario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $data, $idFuncionario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $horariosAgendados = [];
    while ($row = $result->fetch_assoc()) {
        $horariosAgendados[] = $row['horario'];
    }
    
    // 4. Filtrar horários disponíveis
    $horariosDisponiveis = array_diff($horariosPossiveis, $horariosAgendados);
    
    // 5. Formatar para exibição
    $horariosFormatados = [];
    foreach ($horariosDisponiveis as $horario) {
        $hora = date('H:i', strtotime($horario));
        $periodo = (date('H', strtotime($horario)) < 12) ? 'AM' : 'PM';
        $horariosFormatados[] = [
            'hora' => $hora,
            'periodo' => $periodo,
            'horario_completo' => $horario
        ];
    }
    
    return $horariosFormatados;
}

function mostrarDiasHorariosDisponiveis($conexao, $idFuncionario = 1) {
    $dias = gerarProximosDiasUteis($conexao, 6, $idFuncionario);
    $diasComHorarios = [];
    
    foreach ($dias as $dia) {
        $horarios = verificarHorariosDisponiveis($conexao, $dia['data_completa'], $idFuncionario);
        $diasComHorarios[] = [
            'data' => $dia['data'],
            'dia_semana' => $dia['dia_semana'],
            'horarios' => $horarios,
            'data_completa' => $dia['data_completa']
        ];
    }
    
    return $diasComHorarios;
}

?>