<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="../assets/css/perfil-responsividade.css">
</head>
<body>
    <!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
    <nav class="menu-lateral-desktop">
        <div class="logo">
            <img src="../assets/img/LOGO.png" alt="">
        </div>

        <ul>
            <li class="item-menu">
                <a href="#">
                    <img src="../assets/img/icon-perfil.png" alt="">
                    <span class="txt-link">Perfil</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
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

    <section class="perfil">
        <div class="container-perfil">
            <div class="foto-perfil">
                <div class="profile-pic"></div>
                <div class="btn-alterar-foto">
                    <img src="../assets/img/icon-alterar-imagem.png" alt="">
                </div>
            </div>
            <div class="form-perfil">
                <div class="form">
                    <form action="">
                        <p>*Nome do perfil</p>
                        <div class="input-campo">
                        <input type="text" placeholder="Albertin da Vila" name="nome" disabled>
                        <img src="../assets/img/icon-lapis-alterar-campo.png" alt="">
                        </div>
                        <p>*Numero do perfil</p>
                        <div class="input-campo">
                        <input type="text" placeholder="11 99999-9999" name="telefone" disabled>
                        <img src="../assets/img/icon-lapis-alterar-campo.png" alt="">
                        </div>
                    </form>
                </div>
            </div>
            <div class="horarios-marcados">
                <p>Horarios marcados</p>
                <div class="caixa-horarios">
                    <!-- <div class="txt-sem-horarios"><p>SEM HORARIO MARCADO</p></div> -->
                    <div class="horario-caixa">
                        <div class="nome-barbeiro"><p>Luis Pereira</p></div>
                        <p>-</p>
                        <div class="data-barbeiro"><p>13/09</p></div>
                        <p>|</p>
                        <div class="dia-barbeiro"><p>Sabádo</p></div>
                        <div class="horario-barbeiro"><p>10:00</p></div>
                    </div>
                    <div class="horario-caixa">
                        <div class="nome-barbeiro"><p>Luis Pereira</p></div>
                        <p>-</p>
                        <div class="data-barbeiro"><p>22/09</p></div>
                        <p>|</p>
                        <div class="dia-barbeiro"><p>Sexta-feira</p></div>
                        <div class="horario-barbeiro"><p>12:00</p></div>
                    </div>
                    <div class="horario-caixa">
                        <div class="nome-barbeiro"><p>Luis Pereira</p></div>
                        <p>-</p>
                        <div class="data-barbeiro"><p>12/10</p></div>
                        <p>|</p>
                        <div class="dia-barbeiro"><p>Segunda-feira</p></div>
                        <div class="horario-barbeiro"><p>15:00</p></div>
                    </div>
                    <div class="horario-caixa">
                        <div class="nome-barbeiro"><p>Luis Pereira</p></div>
                        <p>-</p>
                        <div class="data-barbeiro"><p>25/10</p></div>
                        <p>|</p>
                        <div class="dia-barbeiro"><p>quarta-feira</p></div>
                        <div class="horario-barbeiro"><p>18:00</p></div>
                    </div>
                </div>
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

</body>
</html>