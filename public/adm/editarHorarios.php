<?php
include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

// Processar o formulário de intervalo, se enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['intervalo'])) {
    $intervalo = (int)$_POST['intervalo'];
    $_SESSION['intervalo_horarios'] = $intervalo;
} else {
    // Usar intervalo padrão de 30 minutos se não estiver definido
    $intervalo = $_SESSION['intervalo_horarios'] ?? 30;
}

// Busca horários atuais no banco
$stmt = $pdo->query("SELECT TIME_FORMAT(horario, '%H:%i') as horario FROM horarios_disponiveis");
$horariosAtuais = $stmt->fetchAll(PDO::FETCH_COLUMN);
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
            
            <!-- Formulário para selecionar horários disponíveis -->
            <form id="formHorarios" method="POST" action="../../functions/adm/salvarHorarios.php">
                <h3>Escolha os horários disponíveis:</h3>
                <div class="grade-horaria">
                    <?php
                    // Gerar grade horária dinâmica com base no intervalo
                    $horaInicial = strtotime('07:00');
                    $horaFinal = strtotime('22:00');
                    
                    while ($horaInicial <= $horaFinal) {
                        $horaFormatada = date('H:i', $horaInicial);
                        echo '<label class="horario-option">';
                        echo '<input type="checkbox" name="horarios[]" value="' . $horaFormatada . '"';
                        echo in_array($horaFormatada, $horariosAtuais) ? ' checked' : '';
                        echo '>';
                        echo '<span>' . $horaFormatada . '</span>';
                        echo '</label>';
                        
                        // Adicionar intervalo
                        $horaInicial = strtotime("+$intervalo minutes", $horaInicial);
                    }
                    ?>
                </div>
                <br>
                <button type="submit">Salvar Horários</button>
            </form>
        <!--<form action="" class="form-dias">
                <h3>Grade Dias</h3>
                <button type="submit" id="enviar">Salvar Configuração</button>
                <div class="">
                    <div class="intervaloDia">
                        <h4>Segunda-feira</h4>
                        <hr>
                        <div class="checks">
                            <div>
                                <label for="fechadoSegunda">fechado</label>
                                <input type="checkbox" name="fechado" id="fechadoSegunda">
                            </div>
                            <div>
                                <label for="emergenciaSegunda">emergência</label>
                                <input type="checkbox" name="emergencia" id="emergenciaSegunda">
                            </div>
                        </div>
                    </div>
                    <div class="horariosDias">
                        <div class="horario">
                            <h5>Primeiro horario</h5>
                            <div class="hora">
                                <label for="priHoraIniSeg">Abrir</label>
                                <input type="time" name="priHoraIniSeg" id="priHoraIniSeg">
                                <label for="priHoraFechSeg">Fechar</label>
                                <input type="time" name="priHoraFechSeg" id="priHoraFechSeg">
                            </div>
                        </div>
                        <div class="horario">
                            <h5>Segundo horario</h5>
                            <div class="hora">
                                <label for="SegHoraIniSeg">Abrir</label>
                                <input type="time" name="SegHoraIniSeg" id="SegHoraIniSeg">
                                <label for="SegHoraFechSeg">Fechar</label>
                                <input type="time" name="SegHoraFechSeg" id="SegHoraFechSeg">
                            </div>
                        </div>
                    </div>
                </div>
            </form> -->
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