<?php
// // Conexão com o banco de dados
// $banco = 'barbertech';
// $usuario = 'root';
// $senha = '';
// $servidor = 'localhost';

// date_default_timezone_set('America/Sao_Paulo');

// try {
//     $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die('Não conectado ao Banco de Dados! Erro: ' . $e->getMessage());
// }


include("../../config/conexao.php");
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

    // Consulta para estatísticass
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

    // Consulta para gráfico de valores
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

    // Consulta para gráfico de serviços
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


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Atendimentos</title>
    <link rel="stylesheet" href="../../assets/css/adm/relatorios.css">
    <link rel="stylesheet" href="../../assets/css/adm/relatorios-responsivo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <?php include("../../views/nav-padrao-adm.php"); ?>
    <main>
        <div class="relatorio-container">
            <div class="botoes-download">
            <button onclick="gerarPDF()" class="btn-download">
                <i class="bi bi-file-earmark-pdf"></i> Baixar PDF
            </button>
            <button onclick="gerarExcel()" class="btn-download">
                <i class="bi bi-file-earmark-excel"></i> Baixar Excel
            </button>
        </div>
            <h1>Relatórios de Atendimentos</h1>
                <div class="estatisticas">
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

                    <div class="estatistica-item">
                        <span>Período:</span>
                        <strong><?= $label ?></strong>
                    </div>
                    <div class="estatistica-item">
                        <span>Total de Atendimentos:</span>
                        <strong><?= $stats['total_atendimentos'] ?? 0 ?></strong>
                    </div>
                    <div class="estatistica-item">
                        <span>Serviço Mais Popular:</span>
                        <strong><?= $stats['servico_mais_popular'] ?? 'Nenhum' ?></strong>
                    </div>
                    <div class="estatistica-item">
                        <span>Lucro Total:</span>
                        <strong>R$ <?= number_format($stats['lucro_total'] ?? 0, 2, ',', '.') ?></strong>
                    </div>
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
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="relatorio_atendimento">
        <?php if(!empty($atendimentos)): ?>
            <?php foreach($atendimentos as $atendimento): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($atendimento['data'] . ' ' . $atendimento['horario'])) ?></td>
                <td><?= htmlspecialchars($atendimento['servico']) ?></td>
                <td>R$ <?= number_format($atendimento['valor'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($atendimento['cliente']) ?></td>
                <td>
                    <?php 
                    $status = strtolower($atendimento['status']);
                    if(strpos($status, 'pendente') !== false) {
                        echo '<span class="status-pendente">Pendente</span>';
                    } elseif(strpos($status, 'finalizado') !== false) {
                        echo '<span class="status-finalizado">Finalizado</span>';
                    } elseif(strpos($status, 'cancelado') !== false) {
                        echo '<span class="status-cancelado">Cancelado</span>';
                    } else {
                        echo htmlspecialchars($atendimento['status']);
                    }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="sem-registros">Nenhum atendimento encontrado neste período</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<div id="paginacao" class="paginacao-container"></div>
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
        document.addEventListener("DOMContentLoaded", function () {
    const linhasPorPagina = 15;
    const tabela = document.getElementById("tabelaRelatorio").getElementsByTagName("tbody")[0];
    const linhas = Array.from(tabela.getElementsByTagName("tr"));
    const totalPaginas = Math.ceil(linhas.length / linhasPorPagina);
    const paginacaoContainer = document.getElementById("paginacao");

    function mostrarPagina(pagina) {
        const inicio = (pagina - 1) * linhasPorPagina;
        const fim = inicio + linhasPorPagina;

        linhas.forEach((linha, index) => {
            linha.style.display = (index >= inicio && index < fim) ? "" : "none";
        });

        atualizarControles(pagina);
    }

    function atualizarControles(paginaAtual) {
        paginacaoContainer.innerHTML = "";

        for (let i = 1; i <= totalPaginas; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.className = (i === paginaAtual) ? "ativo" : "";
            btn.onclick = () => mostrarPagina(i);
            paginacaoContainer.appendChild(btn);
        }
    }

    if (linhas.length > 0) {
        mostrarPagina(1);
    }
});
    </script>
</body>
</html>
            <!-- Filtros -->
            <!-- <div class="filtros">
              <label for="filtroPeriodo">Período:</label>
              <select id="filtroPeriodo" onchange="atualizarRelatorio()">
                <option value="ultimaSemana">Última Semana</option>
                <option value="ultimoMes">Último Mês</option>
                <option value="ultimoSemestre">Último Semestre</option>
                <option value="ultimoAno">Último Ano</option>
              </select>
            </div> -->
          
            <!-- Tabela de Relatório -->
            <!-- <div class="relatorio-resultados">
              <table id="tabelaRelatorio">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Serviço</th>
                    <th>Valor</th>
                    <th>Cliente</th>
                  </tr>
                </thead>
                <tbody> -->
                  <!-- Dados serão preenchidos dinamicamente com JS -->
                <!-- </tbody>
              </table>
            </div>
        </div> -->
        <script src="../../assets/js/relatorios.js"></script>
        <script src="../../assets/js/gerar_pdf_script.js"></script>
        
    </main>