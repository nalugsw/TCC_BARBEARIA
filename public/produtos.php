<?php

include("../config/conexao.php");
session_start();
require("../functions/helpers.php");
verificaSession("cliente");
require("../functions/produtos.php");

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../assets/css/produtos.css">
    <link rel="stylesheet" href="../assets/css/produtos-reponsividade.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/home-responsividade.css">
</head>
<body>
    <!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
    <nav class="menu-lateral-desktop">
        <div class="logo">
            <img src="../assets/img/LOGO.png" alt="">
        </div>

        <ul>
            <li class="item-menu">
                <a href="perfil.php">
                    <img src="../assets/img/icon-perfil.png" alt="">
                    <span class="txt-link">Perfil</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="home.html">
                    <img src="../assets/img/icon-home.png" alt="">
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <img src="../assets/img/icon-produtos.png" alt="">
                    <span class="txt-link">Produtos</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <img src="../assets/img/icon-informacoes.png" alt="">
                    <span class="txt-link">Informações</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <img src="../assets/img/icon-agendar.png" alt="">
                    <span class="txt-link">Agendar</span>
                </a>
            </li>
        </ul>
        <div class="btn-sair">
            <a href="../functions/logout.php"><button>
                <img src="../assets/img/icon-sair.png" alt="">SAIR</button></a>
        </div>
    </nav>

    
    <!-- Fim do menu Desktop e inicio da sessão perfil -->

    <section class="produtos">
        <div class="titulo-produtos">
            <h1>PRODUTOS</h1>
        </div>


        <div class="grid-catalogo-produtos">
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste-2.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste-2.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste-2.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>
            <div class="item-produto" data-titulo="Kit Barba Balm" data-preco="R$20,00" data-descricao="Kit para cuidar da barba com balm hidratante.">
                <div class="img-produto">
                    <img src="../assets/img/produto-teste-2.webp" alt="Kit Barba Balm">
                </div>
                <div class="txt-produto">
                    <h2>Kit Barba Balm</h2>
                    <p>R$20,00</p>
                </div>
            </div>

           

        </div>

        <div id="popup" class="popup">
            <div class="popup-container">
                <span class="btn-fechar"><i class="bi bi-x-circle-fill"></i></span>
                <img id="popup-img" src="" alt="Imagem do Produto">
                <h2 id="popup-titulo"></h2>
                <p id="popup-preco"></p>
                <br>
                <p>Descrição</p>
                <br>
                <p id="popup-descricao"></p>
            </div>
        </div>
    </section>

    <!-- Menu Mobile para dispositivos de telas pequenas -->

    
        <nav class="menu-inferior-mobile">

            <ul>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-perfil.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-home.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-produtos.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-informacoes.png" alt="">
                 
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-agendar.png" alt="">
                      
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-sair.png" alt="">
                      
                    </a>
                </li>
            </ul>
          
        </nav>

   

    
        <script src="../assets/js/submenu-funcao.js"></script>
        <script src="../assets/js/agendar-funcao.js"></script>
        <script src="../assets/js/popup-produtos.js"></script>
</body>
</html>