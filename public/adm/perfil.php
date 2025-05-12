<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("funcionario");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/PerfilAdm.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
    <link rel="stylesheet" href="../../assets/css/adm/PerfilAdm-responsivo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
</head>
<body>
    <nav class="menu-lateral-desktop">
        <div class="logo">
            <img src="../../assets/img/LOGO.png" alt="Logo">
        </div>
        <ul>
            <li class="item-menu"><a href="horarios.html"><img src="../../assets/img/icon-perfil.png" alt=""><span class="txt-link">Horários</span></a></li>
            <li class="item-menu"><a href="perfil.html"><img src="../../assets/img/icon-home.png" alt=""><span class="txt-link">Home</span></a></li>
            <li class="item-menu"><a href="servicos.html"><img src="../../assets/img/icon-produtos.png" alt=""><span class="txt-link">Serviços</span></a></li>
            <li class="item-menu"><a href="#"><img src="../../assets/img/icon-informacoes.png" alt=""><span class="txt-link">Informações</span></a></li>
            <li class="item-menu"><a href="relatorios.html"><img src="../../assets/img/monitoring_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt=""><span class="txt-link">Relatórios</span></a></li>
        </ul>
        <button id="btn-sair" class="btn-sair"><img src="../../assets/img/icon-sair.png" alt="">SAIR</button>
    </nav>

    <dialog close id="modal-sair">
        <div class="modal-sair">
            <p>Realmente deseja sair?</p>
            <div class="btns-modal">
                <a href="../../functions/logout.php"><button class="btn-sair">Sair</button></a>
                <button id="cancelar">Voltar</button>
            </div>
        </div>
    </dialog>

    <main>
        <div class="perfil-container">
            <div class="info">
                <div class="foto-perfil">
                    <img src="../../assets/img/foto-barbeiro-tela-home.png" alt="foto de perfil adm">
                    <span class="material-symbols-outlined editar-icon">edit</span> 

                </div>
                <div class="dados-perfil">
                    <h1>Luis Pereira <span class="material-symbols-outlined editar-icon">edit</span></h1> 
                    <p>Rua Naoseioque, n°171 - Jardim Setadoido <!-- <span class="material-symbols-outlined editar-icon">edit</span>--></p> 
                </div>
            </div>
        </div>
        
        <div class="galeria">
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid5.png" alt="Imagem 4">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid5.png" alt="Imagem 4">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
        </div>
    </main>
</body>