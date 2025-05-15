<?php
// Conexão com o banco de dados
$banco = 'barbertech';
$usuario = 'root';
$senha = '';
$servidor = 'localhost';

date_default_timezone_set('America/Sao_Paulo');

try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Não conectado ao Banco de Dados! Erro: ' . $e->getMessage());
}

// Início da sessão e verificação
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

// Processar o período selecionado
$periodo = $_GET['periodo'] ?? 'semana'; // Padrão: semana

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
    // Consulta para atendimentos
    $sqlAtendimentos = "
        SELECT a.data, s.nome AS servico, s.valor, c.nome AS cliente
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        JOIN CLIENTE c ON cs.id_cliente = c.id_cliente
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
        ORDER BY a.data DESC
    ";
    $stmtAtendimentos = $pdo->query($sqlAtendimentos);
    $atendimentos = $stmtAtendimentos->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para estatísticas
    $sqlEstatisticas = "
        SELECT 
            COUNT(*) AS total_atendimentos,
            (SELECT s.nome FROM SERVICO s 
             JOIN CLIENTE_SERVICO cs ON s.id_servico = cs.id_servico
             JOIN AGENDA a ON cs.id_cliente_servico = a.id_cliente_servico
             WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
             GROUP BY s.nome ORDER BY COUNT(*) DESC LIMIT 1) AS servico_mais_popular,
            COALESCE(SUM(s.valor), 0) AS lucro_total
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
    ";
    $stmtEstatisticas = $pdo->query($sqlEstatisticas);
    $stats = $stmtEstatisticas->fetch(PDO::FETCH_ASSOC);

    // Consulta para gráfico de valores
    $sqlGraficoValores = "
        SELECT 
            DATE(a.data) AS data,
            SUM(s.valor) AS total_dia
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
        GROUP BY DATE(a.data)
        ORDER BY DATE(a.data)
    ";
    $stmtGraficoValores = $pdo->query($sqlGraficoValores);
    $dadosGraficoValores = $stmtGraficoValores->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para gráfico de serviços
    $sqlGraficoServicos = "
        SELECT 
            s.nome AS servico,
            COUNT(*) AS quantidade
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE DATEDIFF(CURRENT_DATE(), a.data) <= $dias
        GROUP BY s.nome
        ORDER BY COUNT(*) DESC
        LIMIT 5
    ";
    $stmtGraficoServicos = $pdo->query($sqlGraficoServicos);
    $dadosGraficoServicos = $stmtGraficoServicos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de erro, as variáveis já estão inicializadas com valores padrão
    error_log("Erro nas consultas: " . $e->getMessage());
}

// Converter dados para JSON garantindo que todas as variáveis existam
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Atendimentos</title>
    <link rel="stylesheet" href="../../assets/css/adm/servicosAdm.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
    <link rel="stylesheet" href="../../assets/css/adm/relatorios.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include("../../views/nav-padrao-adm.php"); ?>

    <main>
        <div class="relatorio-container">
            <h1>Relatórios de Atendimentos</h1>
            
            <div class="filtros">
                <form method="get" action="">
                    <label for="filtroPeriodo">Período:</label>
                    <select id="filtroPeriodo" name="periodo">
                        <option value="semana" <?= $periodo == 'semana' ? 'selected' : '' ?>>Última Semana</option>
                        <option value="mes" <?= $periodo == 'mes' ? 'selected' : '' ?>>Último Mês</option>
                        <option value="semestre" <?= $periodo == 'semestre' ? 'selected' : '' ?>>Último Semestre</option>
                        <option value="ano" <?= $periodo == 'ano' ? 'selected' : '' ?>>Último Ano</option>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>
                
                <div class="estatisticas">
                    <p>Período: <strong><?= $label ?></strong></p>
                    <p>Total de Atendimentos: <strong><?= $stats['total_atendimentos'] ?? 0 ?></strong></p>
                    <p>Serviço Mais Popular: <strong><?= $stats['servico_mais_popular'] ?? 'Nenhum' ?></strong></p>
                    <p>Lucro Total: <strong>R$ <?= number_format($stats['lucro_total'] ?? 0, 2, ',', '.') ?></strong></p>
                </div>
            </div>
            
            <div class="graficos-container">
                <div class="grafico-wrapper">
                    <canvas id="graficoValores"></canvas>
                </div>
                <div class="grafico-wrapper">
                    <canvas id="graficoServicos"></canvas>
                </div>
            </div>
            
            <div class="relatorio-resultados">
                <table id="tabelaRelatorio">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Serviço</th>
                            <th>Valor</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($atendimentos)): ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">Nenhum atendimento encontrado neste período</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($atendimentos as $atendimento): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($atendimento['data'])) ?></td>
                                <td><?= htmlspecialchars($atendimento['servico']) ?></td>
                                <td>R$ <?= number_format($atendimento['valor'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($atendimento['cliente']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Passando dados do PHP para JavaScript
        const dadosGraficos = <?= json_encode($dadosGraficos) ?>;
        const periodoSelecionado = '<?= $periodo ?>';
        
        // Função para formatar valores monetários
        function formatarMoeda(valor) {
            return 'R$ ' + valor.toFixed(2).replace('.', ',');
        }
        
        // Inicializar gráficos quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Gráfico de Valores Diários
            const ctxValores = document.getElementById('graficoValores');
            if (ctxValores && dadosGraficos.valores) {
                const labels = dadosGraficos.valores.map(item => {
                    const date = new Date(item.data);
                    return date.toLocaleDateString('pt-BR');
                });
                
                const data = dadosGraficos.valores.map(item => parseFloat(item.total_dia));
                
                new Chart(ctxValores, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Faturamento Diário',
                            data: data,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Faturamento por Período',
                                font: { size: 16 }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return formatarMoeda(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatarMoeda(value);
                                    }
                                }
                            }
                        }
                    }
                });
            }
            
            // 2. Gráfico de Serviços Mais Populares
            const ctxServicos = document.getElementById('graficoServicos');
            if (ctxServicos && dadosGraficos.servicos) {
                const labels = dadosGraficos.servicos.map(item => item.servico);
                const data = dadosGraficos.servicos.map(item => parseInt(item.quantidade));
                
                new Chart(ctxServicos, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Quantidade de Atendimentos',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Serviços Mais Populares',
                                font: { size: 16 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
