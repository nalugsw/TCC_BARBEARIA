<?php
include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['intervalo'])) {
    $intervalo = (int)$_POST['intervalo'];
    $_SESSION['intervalo_horarios'] = $intervalo;
} else {
    $intervalo = $_SESSION['intervalo_horarios'] ?? 30;
}

$stmt = $pdo->query("SELECT TIME_FORMAT(horario, '%H:%i') as horario FROM horarios_disponiveis");
$horariosAtuais = $stmt->fetchAll(PDO::FETCH_COLUMN);

$diasInativos = [];
$stmt = $pdo->query("SELECT 
    DAYOFWEEK(data_inativa) as dia_semana, 
    motivo 
    FROM dias_inativos 
    GROUP BY dia_semana, motivo");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $diasMap = [1 => 'domingo', 2 => 'segunda', 3 => 'terca', 4 => 'quarta', 5 => 'quinta', 6 => 'sexta', 7 => 'sabado'];
    $diaId = $diasMap[$row['dia_semana']];
    $diasInativos[$diaId] = [
        'fechado' => true,
        'emergencia' => ($row['motivo'] == 'Emergência')
    ];
}

if (isset($_SESSION['msg_sucesso'])) {
    echo '<div class="alert alert-success">' . $_SESSION['msg_sucesso'] . '</div>';
    unset($_SESSION['msg_sucesso']);
}

if (isset($_SESSION['msg_erro'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['msg_erro'] . '</div>';
    unset($_SESSION['msg_erro']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de Horários</title>
    <link rel="stylesheet" href="../../assets/css/adm/editarHorarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <?php include("../../views/nav-padrao-adm.php"); ?>

    <main>
            <h1>Dias e Horários</h1>
        <div class="container-horarios">
            <!-- Formulário para definir o intervalo -->
            <form method="POST" class="form-intervalo">
                <h3>Grade Horária</h3>
                <p>Definir intervalos de marcação de cada serviço -</p>
                <div>
                    <label for="intervalo">Grade:</label>
                    <select name="intervalo" id="intervalo">
                        <option value="30" <?= $intervalo == 30 ? 'selected' : '' ?>>30 minutos</option>
                        <option value="40" <?= $intervalo == 40 ? 'selected' : '' ?>>40 minutos</option>
                        <option value="50" <?= $intervalo == 50 ? 'selected' : '' ?>>50 minutos</option>
                        <option value="60" <?= $intervalo == 60 ? 'selected' : '' ?>>60 minutos</option>
                    </select>
                    <button type="submit">Aplicar</button>
                </div>
             </form>
            <form action="../../functions/adm/diasInativos.php" method="POST" class="form-dias">
                <h3>Grade Dias</h3>
                <button type="submit" id="enviar">Salvar Configuração</button>
                <div class="horariosDias">
                        <div class="horario">
                            <h5>Primeiro Horario</h5>
                            <div class="hora">
                                <div class="input">
                                    <label for="priHoraIni">Abrir:</label>
                                    <input type="time"  id="priHoraIni" value="08:00">
                                </div>
                                <div class="input">
                                    <label for="priHoraFech">Fechar:</label>
                                    <input type="time"  id="priHoraFech" value="12:00">
                                </div>
                            </div>
                        </div>
                        <div class="horario">
                            <h5>Segundo Horario</h5>
                            <div class="hora">
                                <div class="input">
                                    <label for="segHoraIni">Abrir:</label>
                                    <input type="time" id="segHoraIni" value="14:00">
                                </div>
                                <div class="input">
                                    <label for="segHoraFech">Fechar:</label>
                                    <input type="time" id="segHoraFech" value="20:00">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                $diasSemana = [
                    'Segunda-feira' => 'segunda',
                    'Terça-feira' => 'terca',
                    'Quarta-feira' => 'quarta',
                    'Quinta-feira' => 'quinta',
                    'Sexta-feira' => 'sexta',
                    'Sábado' => 'sabado',
                    'Domingo' => 'domingo'
                ];
                
                foreach ($diasSemana as $diaNome => $diaId): 
                    $diaConfig = $diasInativos[$diaId] ?? [];
                ?>
                <div class="dia">
                    <div class="intervaloDia">
                        <h4><?= $diaNome ?></h4>
                        <hr>
                        <div class="checks">
                            <div>
                                <input type="checkbox" name="dias[<?= $diaId ?>][fechado]" id="fechado<?= ucfirst($diaId) ?>" 
                                    <?= isset($diaConfig['fechado']) ? 'checked' : '' ?>>
                                <label for="fechado<?= ucfirst($diaId) ?>">fechado</label>
                            </div>
                            <div>
                                <input type="checkbox" name="dias[<?= $diaId ?>][emergencia]" id="emergencia<?= ucfirst($diaId) ?>"
                                    <?= isset($diaConfig['emergencia']) && $diaConfig['emergencia'] ? 'checked' : '' ?>>
                                <label for="emergencia<?= ucfirst($diaId) ?>">emergência</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php endforeach; ?>
            </form>
        </div>
    </main>

    <script src="../../assets/js/modal-cancelar-horario.js"></script>
    <script src="../../assets/js/msg-whatsap.js"></script>
    <script>
        // Script para copiar (substitua o existente)
        document.querySelectorAll('.copyButton').forEach(button => {
            button.addEventListener('click', async function() {
                try {
                    const numeroInput = this.closest('.numero-cliente').querySelector('.numero-telefone');
                    const phoneNumber = numeroInput.value;
                    
                    await navigator.clipboard.writeText(phoneNumber);
                    
                    // Feedback visual
                    numeroInput.style.color = '#4065AB';
                    setTimeout(() => {
                        numeroInput.style.color = '#f4f4f4';
                    }, 300);
                } catch (err) {
                    console.error('Falha ao copiar: ', err);
                }
            });
        });
        
    </script>
    
</body>
</html>