<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

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
    <?php include("../../views/nav-padrao-adm.php"); ?>

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