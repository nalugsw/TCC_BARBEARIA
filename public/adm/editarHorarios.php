<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");
$agenda

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

<?php

// Busca os horários padrão
$horariosPadrao = [
    '07:00', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
    '11:00', '11:30','12:00','12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
    '16:00', '16:30', '17:00', '17:30', '18:00'
];

// Busca horários atuais no banco
$stmt = $pdo->query("SELECT TIME_FORMAT(horario, '%H:%i') as horario FROM horarios_disponiveis");
$horariosAtuais = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<form id="formHorarios" method="POST" action="../../functions/adm/salvarHorarios.php">
    <h3>Escolha os horários disponíveis:</h3>
    <?php foreach ($horariosPadrao as $hora): ?>
        <label>
            <input type="checkbox" name="horarios[]" value="<?= $hora ?>"
                <?= in_array($hora, $horariosAtuais) ? 'checked' : '' ?>>
            <?= $hora ?>
        </label><br>
    <?php endforeach; ?>
    <br>
    <button type="submit">Salvar</button>
</form>


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