<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/perfil.css">
    <link rel="stylesheet" href="../../assets/css/perfil-responsividade.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>

<!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
<nav class="menu-lateral-desktop">
    <div class="logo">
        <img src="<?php echo BASE_URL; ?>assets/img/LOGO.png" alt="">
    </div>

    <ul>
        <li class="item-menu">
            <a href="<?php echo BASE_URL ?>public/user/perfil.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-perfil.png" alt="">
                <span class="txt-link">Perfil</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/home.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-home.png" alt="">
                <span class="txt-link">Home</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/produtos.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-produtos.png" alt="">
                <span class="txt-link">Produtos</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/informacoes.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-informacoes.png" alt="">
                <span class="txt-link">Informações</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="<?php echo BASE_URL; ?>public/user/agenda.php">
                <img src="<?php echo BASE_URL; ?>assets/img/icon-agendar.png" alt="">
                <span class="txt-link">Agendar</span>
            </a>
        </li>
    </ul>

    <button id="btn-sair" class="btn-sair"><img src="<?php echo BASE_URL; ?>assets/img/icon-sair.png" alt="">SAIR</button>

</nav>


<dialog close id="modal-sair" >
    <div class="modal-sair">
        <p>realmente deseja sair?</p>
        <div class="btns-modal">
            <a href="<?php echo BASE_URL; ?>functions/logout.php">
                <button class="btn-sair">Sair</button>
            </a>
            <button id="cancelar-sair">Voltar</button>
        </div>
    </div>
</dialog>

</html>