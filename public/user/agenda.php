<?php
include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("cliente");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/agenda-nav.css">
    <link rel="stylesheet" href="../../assets/css/agenda-nav-reponsividade.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>
    
    <main>
        <div class="agenda">
            <div class="dia">
                <div class="selecao-horaio">
                    <span><p>12/09 - segunda</p></span>
                    <button class="horarios-btn" onclick="toggleHorarios(this)">HORÁRIOS  <i class="bi bi-caret-down-fill"></i></button>
                </div>
                <div class="horarios" style="display: none;">
                <p>HORÁRIOS DISPONÍVEIS</p>
                <div class="horario-div">
                    <p><span>11:00</span><span> AM</span></p>
                    <button class="selecionar">Selecionar</button>
                </div>
            </div>
        </div>
    </main>

    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/submenu-funcao.js"></script>
    <script src="../../assets/js/agendar-funcao.js"></script>
</body>
</html>