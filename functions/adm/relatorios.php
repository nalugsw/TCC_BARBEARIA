<?php

$periodo = $_GET['periodo'] ?? 'semana';

switch($periodo) {
    case 'semana': 
        $dias = 7;
        $label = 'Última Semana';
        break;
    case 'mes': 
        $dias = 30;
        $label = 'Último Mês';
        break;
    case 'semestre': 
        $dias = 180;
        $label = 'Último Semestre';
        break;
    case 'ano': 
        $dias = 365;
        $label = 'Último Ano';
        break;
    default: 
        $dias = 7;
        $label = 'Última Semana';
}

$atendimentos = [];
$stats = [
    'total_atendimentos' => 0,
    'servico_mais_popular' => 'Nenhum',
    'lucro_total' => 0
];
$dadosGraficoValores = [];
$dadosGraficoServicos = [];

try {
    $sqlAtendimentos = "
    SELECT 
        a.data,
        a.horario,
        s.nome AS servico, 
        s.valor, 
        c.nome AS cliente,
        a.status_agenda AS status
    FROM AGENDA a
    JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
    JOIN SERVICO s ON cs.id_servico = s.id_servico
    JOIN CLIENTE c ON cs.id_cliente = c.id_cliente
    WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
    AND (LOWER(a.status_agenda) LIKE 'pendente%'
    OR LOWER(a.status_agenda) LIKE 'finalizado%'
    OR LOWER(a.status_agenda) LIKE 'cancelado%')
    ORDER BY a.data ASC, a.horario ASC
";
    $stmtAtendimentos = $pdo->query($sqlAtendimentos);
    $atendimentos = $stmtAtendimentos->fetchAll(PDO::FETCH_ASSOC);

    $sqlEstatisticas = "
    SELECT 
        COUNT(*) AS total_atendimentos,
        (SELECT s.nome 
            FROM SERVICO s 
         JOIN CLIENTE_SERVICO cs ON s.id_servico = cs.id_servico
         JOIN AGENDA a ON cs.id_cliente_servico = a.id_cliente_servico
         WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
         AND LOWER(a.status_agenda) LIKE 'finalizado%'  -- ADICIONEI ESTA CONDIÇÃO
         GROUP BY s.nome 
         ORDER BY COUNT(*) DESC LIMIT 1) AS servico_mais_popular,
        COALESCE(SUM(s.valor), 0) AS lucro_total
    FROM AGENDA a
    JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
    JOIN SERVICO s ON cs.id_servico = s.id_servico
    WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
    AND LOWER(a.status_agenda) LIKE 'finalizado%'
";
    $stmtEstatisticas = $pdo->query($sqlEstatisticas);
    $stats = $stmtEstatisticas->fetch(PDO::FETCH_ASSOC);

    $sqlGraficoValores = "
        SELECT 
            DATE(a.data) AS data,
            SUM(s.valor) AS total_dia
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
        AND LOWER(a.status_agenda) LIKE 'finalizado%'
        GROUP BY DATE(a.data)
        ORDER BY DATE(a.data)
    ";
    $stmtGraficoValores = $pdo->query($sqlGraficoValores);
    $dadosGraficoValores = $stmtGraficoValores->fetchAll(PDO::FETCH_ASSOC);

    $sqlGraficoServicos = "
        SELECT 
            s.nome AS servico,
            COUNT(*) AS quantidade
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
        AND LOWER(a.status_agenda) LIKE 'finalizado%'
        GROUP BY s.nome
        ORDER BY COUNT(*) DESC
        LIMIT 5
    ";
    $stmtGraficoServicos = $pdo->query($sqlGraficoServicos);
    $dadosGraficoServicos = $stmtGraficoServicos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Erro nas consultas: " . $e->getMessage());
}

$dadosGraficos = [
    'valores' => $dadosGraficoValores ?: [],
    'servicos' => $dadosGraficoServicos ?: [],
    'estatisticas' => $stats ?: [
        'total_atendimentos' => 0,
        'servico_mais_popular' => 'Nenhum',
        'lucro_total' => 0
    ]
];

?>