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
    <link rel="stylesheet" href="../../assets/css/adm/servicosAdm.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">

    <link rel="stylesheet" href="../../assets/css/adm/relatorios.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            <li class="item-menu"><a href="#"><img src="../../assets/img/monitoring_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt=""><span class="txt-link">Relatórios</span></a></li>
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
        <div class="relatorio-container">
            <h1>Relatórios de Atendimentos</h1>
            
            <!-- Filtros -->
            <div class="filtros">
              <label for="filtroPeriodo">Período:</label>
              <select id="filtroPeriodo" onchange="atualizarRelatorio()">
                <option value="ultimaSemana">Última Semana</option>
                <option value="ultimoMes">Último Mês</option>
                <option value="ultimoSemestre">Último Semestre</option>
                <option value="ultimoAno">Último Ano</option>
              </select>
            </div>
          
            <!-- Tabela de Relatório -->
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
                  <!-- Dados serão preenchidos dinamicamente com JS -->
                </tbody>
              </table>
            </div>
        </div>
        <script src="../../assets/js/relatorios.js"></script>
        
    </main>