<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<nav id="menu-padrao" class="menu-lateral-desktop">
        <div class="logo">
            <a href="horarios.php"><img src="../../assets/img/LOGO.png" alt=""></a>
        </div>

        <ul>
            <li class="item-menu">
                <a href="../../public/adm/horarios.php"><img src="../../assets/img/iconeRelogio.png" alt=""><span class="txt-link">Horários</span></a>
            </li>
            <li class="item-menu">
                <a href="../../public/adm/perfil.php"><img src="../../assets/img/icon-home.png" alt=""><span class="txt-link">Perfil</span></a>
            </li>
            <li class="item-menu">
                <a href="../../public/adm/servicos.php"><img src="../../assets/img/icon-produtos.png" alt=""><span class="txt-link">Serviços</span></a>
            </li>
            <li class="item-menu">
                <a href="../../public/adm/informacoes.php"><img src="../../assets/img/icon-informacoes.png" alt=""><span class="txt-link">Informações</span></a>
            </li>
            <li class="item-menu">
                <a href="../../public/adm/relatorios.php"><img src="../../assets/img/graficoIcone.png" alt=""><span class="txt-link">Relatórios</span></a>
            </li>
        </ul>

        <div class="itens">
            <button id="btn-sair" class="btn-sair"><img src="../../assets/img/icon-sair.png" alt="">SAIR</button>
            <a href="" ><button id="btn-setting"><span class="material-symbols-outlined">settings</span></button></a>
        </div>
    </nav>
    <dialog close id="modal-sair" >
        <div class="modal-sair">
            <p>realmente deseja sair?</p>
            <div class="btns-modal">
                <a href="../../functions/logout.php">
                    <button class="btn-sair">Sair</button>
                </a>
                <button id="cancelar-sair">Voltar</button>
            </div>
        </div>
    </dialog>

    <nav id="menu-settings" class="menu-lateral-settings-desktop  hide">
        <div class="logo">
            <img src="../../assets/img/LOGO.png" alt="">
        </div>
        <h2>configurações</h2>
        <ul>
            <li class="item-menu">
                <a href="horaios.php">
                    <span class="txt-link">Informações</span>
                    <span class="material-symbols-outlined">arrow_forward_ios</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="perfil.html">
                    <span class="txt-link">Dias e Horaios</span>
                    <span class="material-symbols-outlined">arrow_forward_ios</span>
                </a>
            </li>
        </ul>
        <a href=""><button id="btn-voltar-config">Voltar</button></a>
    </nav>
        
    <nav id="menu-padrao-mobile" class="menu-mobile">
        <div class="logo-mobile">
        <a href="./horarios.html"><img src="../../assets/img/LOGO.png" alt=""></a>
        </div>
        <input type="checkbox" name="" id="abrir-mobile">
        <label for="abrir-mobile" class="menu-linhas">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <ul class="menu-itens">
            <li class="item-menu-mobile">
                <a href="../../public/adm/horarios.php">
                <img src="../../assets/img/iconeRelogio.png" alt="">
                    <span class="txt-link">Horarios</span>
                </a>
            </li>
            <li class="item-menu-mobile">
                <a href="../../public/adm/perfil.php">
                <img src="../../assets/img/icon-perfil.png" alt="">
                <span class="txt-link">Perfil</span>
                </a>
            </li>
            <li class="item-menu-mobile">
                <a href="../../public/adm/servicos.php">
                <img src="../../assets/img/icon-produtos.png" alt="">
                <span class="txt-link">Serviços</span>
                </a>
            </li>
            <li class="item-menu-mobile">
                <a href="../../public/adm/relatorios.php">
                <img src="../../assets/img/graficoIcone.png" alt="">
                <span class="txt-link">Relatórios</span>
                </a>
            </li>
            
            <div class="div-btn">
                <button id="btn-sair-mobile" class="btn-sair">
                    <img src="../../assets/img/icon-sair.png" alt="">
                    <span>SAIR</span>
                </button>
                <a href="" ><button id="btn-setting-mobile"><span class="material-symbols-outlined">settings</span></button></a>
            </div>
        </ul>
    </nav>

    <nav id="menu-settings-mobile" class="menu-settings-mobile hide">
        
        <div class="logo-mobile">
            <a href="./horarios.html"><img src="../../assets/img/LOGO.png" alt=""></a>
            </div>
        <h2>configurações</h2>
        <ul>
            <li class="item-menu">
                <a href="horaios.php">
                    <span class="txt-link">Informações</span>
                    <span class="material-symbols-outlined">arrow_forward_ios</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="perfil.html">
                    <span class="txt-link">Dias e Horaios</span>
                    <span class="material-symbols-outlined">arrow_forward_ios</span>
                </a>
            </li>
        </ul>
        <a href=""><button id="btn-voltar-config-mobile">Voltar</button></a>
    </nav>

    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/modal-cancelar-horario.js"></script>
    <script src="../../assets/js/ativar-config.js"></script>
</html>