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
    <link rel="stylesheet" href="../../assets/css/informacoes.css">
    <link rel="stylesheet" href="../../assets/css/informacoes-reponsividade.css">
    <link rel="stylesheet" href="../../assets/css/perfil.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/home-responsividade.css">
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>
    
    <main>
        <h1>Informações</h1>
        <div class="info-barbeiro">
            <h2>Barbeiro</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique officia, sunt facere quibusdam illo aut amet accusamus voluptatibus quia blanditiis expedita ducimus consequatur? Cum illo quis sed facere. Fugit, fuga.</p>
        </div>
        <div class="info-barbearia">
            <h2>Barbearia</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti dolorum iste reprehenderit earum molestiae provident harum porro. Aperiam, neque animi.</p>
            <h2>Localizção</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116875.88510407697!2d-47.00702360662611!3d-23.734131425821666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cfad63bcaa3ec5%3A0xcb5cbf33fd10fd27!2sItapecerica%20da%20Serra%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1742305249167!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="info-projeto">
            <h2>Projeto Berbertech</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem deserunt, vitae eveniet eaque cumque consequatur non harum. Ducimus quia quam excepturi eaque placeat possimus laboriosam incidunt, temporibus dicta id cumque?</p>
        </div>
    </main>

    <script src="../../assets/js/modal.js"></script>
    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/submenu-funcao.js"></script>
</body>
</html>