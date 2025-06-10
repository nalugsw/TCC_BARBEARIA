<?php
include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

// Consulta para contar o total de clientes
$stmt = $pdo->query("SELECT COUNT(*) as total FROM CLIENTE");
$total_clientes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_paginas = ceil($total_clientes / 15);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/adm/editarUsers.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <title>Clientes Cadastrados</title>
</head>
<body>
  
<?php include("../../views/nav-padrao-adm.php"); ?>
    <div class="container">
        <h1>Clientes Cadastrados</h1>
        
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Pesquisar cliente por nome...">
            <button id="search-button">Buscar</button>
        </div>
        
        <div id="clientes-container">
            <div class="loading">Carregando clientes...</div>
        </div>
        
        <div class="paginacao" id="paginacao">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let paginaAtual = 1;
            const clientesContainer = document.getElementById('clientes-container');
            const paginacaoContainer = document.getElementById('paginacao');
            const searchInput = document.getElementById('search-input');
            const searchButton = document.getElementById('search-button');
            
            // Total de páginas calculado pelo PHP
            const totalPaginas = <?php echo $total_paginas; ?>;
            
            // Carrega os clientes da página especificada
            function carregarClientes(pagina, termoBusca = '') {
                clientesContainer.innerHTML = '<div class="loading">Carregando clientes...</div>';
                
                const url = termoBusca 
                    ? `../../functions/adm/buscarUsers.php?page=${pagina}&search=${encodeURIComponent(termoBusca)}` 
                    : `../../functions/adm/buscarUsers.php?page=${pagina}`;
                
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição');
                        }
                        return response.json();
                    })
                    .then(data => {
                        exibirClientes(data.clientes);
                        atualizarPaginacao(pagina, data.totalPaginas);
                    })
                    .catch(error => {
                        console.error('Erro ao carregar clientes:', error);
                        clientesContainer.innerHTML = '<div class="loading">Erro ao carregar clientes.</div>';
                    });
            }
            
            // Exibe os clientes no container
            function exibirClientes(clientes) {
                if (clientes.length === 0) {
                    clientesContainer.innerHTML = '<div class="loading">Nenhum cliente encontrado.</div>';
                    return;
                }
                
                let html = '';
                clientes.forEach(cliente => {
                  const foto = cliente.foto ? `../../${cliente.foto}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(cliente.nome)}&background=random&size=60`;
                    html += `
                        <div class="cliente-card">
                            <img src="${foto}" alt="${cliente.nome}" class="cliente-foto" onerror="this.src='https://via.placeholder.com/60'">
                            <div class="cliente-info">
                            <div class="cliente-nome">${cliente.nome}</div>
                              <div class="cliente-telefone">${formatarTelefone(cliente.numero_telefone)}</div>
                              <div class="cliente-email">${cliente.email}</div>
                            </div>
                        </div>
                    `;
                });
                
                clientesContainer.innerHTML = html;
            }
            
            // Formata o número de telefone
            function formatarTelefone(telefone) {
                // Remove todos os caracteres não numéricos
                const numeros = telefone.replace(/\D/g, '');
                
                // Formatação para telefone brasileiro
                if (numeros.length === 11) {
                    return `(${numeros.substring(0, 2)}) ${numeros.substring(2, 7)}-${numeros.substring(7)}`;
                } else if (numeros.length === 10) {
                    return `(${numeros.substring(0, 2)}) ${numeros.substring(2, 6)}-${numeros.substring(6)}`;
                }
                
                // Retorna o original se não for possível formatar
                return telefone;
            }
            
            // Atualiza a navegação de páginas
            function atualizarPaginacao(paginaAtual, totalPaginas) {
                let html = '';
                const maxBotoes = 5; // Máximo de botões de página visíveis
                
                // Botão anterior
                if (paginaAtual > 1) {
                    html += `<button onclick="mudarPagina(${paginaAtual - 1})">&laquo; Anterior</button>`;
                }
                
                // Calcula o intervalo de páginas para mostrar
                let inicio = Math.max(1, paginaAtual - Math.floor(maxBotoes / 2));
                let fim = Math.min(totalPaginas, inicio + maxBotoes - 1);
                
                // Ajusta se estiver no final
                if (fim - inicio + 1 < maxBotoes) {
                    inicio = Math.max(1, fim - maxBotoes + 1);
                }
                
                // Botões numéricos
                for (let i = inicio; i <= fim; i++) {
                    html += `<button ${i === paginaAtual ? 'class="active"' : ''} onclick="mudarPagina(${i})">${i}</button>`;
                }
                
                // Botão próximo
                if (paginaAtual < totalPaginas) {
                    html += `<button onclick="mudarPagina(${paginaAtual + 1})">Próximo &raquo;</button>`;
                }
                
                paginacaoContainer.innerHTML = html;
            }
            
            // Função global para mudar de página
            window.mudarPagina = function(novaPagina) {
                paginaAtual = novaPagina;
                const termoBusca = searchInput.value.trim();
                carregarClientes(paginaAtual, termoBusca);
            };
            
            // Evento de busca
            searchButton.addEventListener('click', function() {
                paginaAtual = 1;
                const termoBusca = searchInput.value.trim();
                carregarClientes(paginaAtual, termoBusca);
            });
            
            // Permite buscar pressionando Enter
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    paginaAtual = 1;
                    const termoBusca = searchInput.value.trim();
                    carregarClientes(paginaAtual, termoBusca);
                }
            });
            
            // Carrega a primeira página ao iniciar
            carregarClientes(paginaAtual);
        });
    </script>
</body>
</html>