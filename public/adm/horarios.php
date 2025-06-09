
<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
require_once("../../functions/agendamento.php");
verificaSession("administrador");
$id_funcionario = dadosFuncionario("id_funcionario");
$agendamento = buscarAgendamentosPorFuncionario($id_funcionario, $pdo);

// Agrupar agendamentos por data
$agendamentosPorData = [];
foreach ($agendamento as $agenda) {
    $data = $agenda['data'];
    if (!isset($agendamentosPorData[$data])) {
        $agendamentosPorData[$data] = [];
    }
    $agendamentosPorData[$data][] = $agenda;
}

// Função para converter data em nome do dia da semana
function getDiaSemana($data) {
    $dias = [
        'Sunday' => 'Domingo',
        'Monday' => 'Segunda-Feira',
        'Tuesday' => 'Terça-Feira',
        'Wednesday' => 'Quarta-Feira',
        'Thursday' => 'Quinta-Feira',
        'Friday' => 'Sexta-Feira',
        'Saturday' => 'Sábado'
    ];
    $timestamp = strtotime($data);
    $diaSemana = date('l', $timestamp);
    return $dias[$diaSemana];
}
// Ordenar agendamentos por data (do mais próximo para o mais distante)
uksort($agendamentosPorData, function($a, $b) {
    return strtotime($a) - strtotime($b);
});
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/horarios.css">
    <link rel="stylesheet" href="../../assets/css/adm/horarios-responsivo.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
<!-- Importando pacote de icones do Google Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <!-- Estrutura do Menu Para Desktop(computadores e laptops) -->

    <?php include("../../views/nav-padrao-adm.php"); ?>
    <main>
        <div class="perfil-adm">
            <div class="foto-adm">
                <img src="../../assets/img/homem-sorrindo-teste.avif" alt="foto barbeiro">
            </div>
            <div class="informacoes-home">
                <h1>Luis Pereira</h1>
            </div>
        </div>
        <section>
    <div class="horaios-marcados">
        <?php if (empty($agendamentosPorData)): ?>
            <div class="sem-horarios">
                <p>Sem horários marcados</p>
            </div>
        <?php else: ?>
            <?php foreach ($agendamentosPorData as $data => $agendamentosDoDia): ?>
                <div class="cliente-hora">
                    <div class="dia-servicos">
                        <h2><?php echo getDiaSemana($data) . ' - ' . date('d/m/Y', strtotime($data)); ?></h2>
                    </div>
                    
                    <?php foreach($agendamentosDoDia as $agenda): ?>
                        <div class="servico-marcado">
                            <div class="foto-cliente">
                                <img src="../../<?php echo $agenda['foto_cliente']; ?>" alt="foto cliente">
                                <button type="button" class="btn-finalizar-horario" onclick="document.getElementById('finalizar-horario-<?php echo $agenda['id_agenda']; ?>').showModal();">
                                    Finalizar
                                </button>
                            </div>

                            <dialog id="finalizar-horario-<?php echo $agenda['id_agenda']; ?>" class="horariofinalizar">
                                <form action="../../functions/validaAgendamento.php" method="POST" >
                                    <h2>Finalizou o serviço?</h2>
                                    <input type="hidden" name="id" value="<?php echo $agenda['id_agenda']; ?>">
                                    <input type="hidden" name="acao" value="finalizado">
                                    <div class="btn-cancel-horario">
                                        <button type="submit" id="btn-finalizar" class="btn-finalizar-horario">Finalizar</button>
                                        <button type="button" onclick="this.closest('dialog').close();" id="voltar">Voltar</button>
                                    </div>
                                </form>
                            </dialog>


                            <div class="nome-cliente">
                                <h3>Nome</h3>
                                <input type="text" disabled placeholder="<?php echo $agenda['nome_cliente']; ?>">
                            </div>

                            <div class="numero-cliente">
                                <h3>Telefone</h3>
                                <input type="text" value="<?php echo $agenda['numero_telefone']; ?>" class="numero-telefone" readonly>
                                <button class="copyButton"><img src="../../assets/img/icone-copy.png" alt="Copiar"></button>
                                <button class="whatsBtn"><img src="../../assets/img/icone-whatsapp.png" alt="WhatsApp"></button>
                            </div>

                            <div class="servico-cliente">
                                <h3>Serviço</h3>
                                <input type="text" disabled placeholder="<?php echo $agenda['servico']; ?>">
                            </div>

                            <div class="horario-cliente">
                                <h3>Horário</h3>
                                <input type="text" disabled placeholder="<?php echo date('H:i', strtotime($agenda['horario'])); ?>">
                                <button type="button" class="btn-cancelar-horario" onclick="this.nextElementSibling.showModal();">
                                    <p>Desmarcar Horario</p>
                                    <span class="material-symbols-outlined">delete</span>
                                </button>

                                <dialog id="cancelar-horario">
                                    <form action="../../functions/validaAgendamento.php" method="POST" >
                                        <h2>Realmente deseja cancelar esse horário?</h2>
                                        <input type="hidden" name="id" value="<?php echo $agenda['id_agenda']; ?>">
                                        <input type="hidden" name="acao" value="cancelado">
                                        <div class="btn-cancel-horario">
                                            <button type="submit" id="btn-cancelar">Desmarcar</button>
                                            <button type="button" onclick="this.closest('dialog').close();" id="voltar">Voltar</button>
                                        </div>
                                    </form>
                                </dialog>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
    </main>
    <script src="../../assets/js/modal-finalizar-horario.js"></script>
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