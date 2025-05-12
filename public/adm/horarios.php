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
    <link rel="stylesheet" href="../../assets/css/adm/horarios.css">
    <link rel="stylesheet" href="../../assets/css/adm/horarios-responsivo.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
<!-- Importando pacote de icones do Google Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
    <nav id="menu-padrao" class="menu-lateral-desktop">
        <div class="logo">
            <img src="../../assets/img/LOGO.png" alt="">
        </div>

        <ul>
            <li class="item-menu"><a href="horarios.html"><img src="../../assets/img/iconeRelogio.png" alt=""><span class="txt-link">Horários</span></a></li>
            <li class="item-menu"><a href="perfil.html"><img src="../../assets/img/icon-home.png" alt=""><span class="txt-link">Perfil</span></a></li>
            <li class="item-menu"><a href="servicos.html"><img src="../../assets/img/icon-produtos.png" alt=""><span class="txt-link">Serviços</span></a></li>
            <li class="item-menu"><a href="#"><img src="../../assets/img/icon-informacoes.png" alt=""><span class="txt-link">Informações</span></a></li>
            <li class="item-menu"><a href="relatorios.html"><img src="../../assets/img/monitoring_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt=""><span class="txt-link">Relatórios</span></a></li>
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


    <main>
        <div class="perfil-adm">
            <div class="foto-adm">
                <img src="../../assets/img/homem-sorrindo-teste.avif" alt="foto barbeiro">
                <a href="" class="btn-edit">
                    <span class="material-symbols-outlined">edit</span>
                </a>
            </div>
            <div class="informacoes-home">
                
                <h1>Luis Pereira<a href="" class="btn-edit">
                    <span class="material-symbols-outlined">edit</span>
                </a></h1>
                
                <div class="endereco-info">
                    
                        <p>Rua naoseioque, n°171 -
                            Jardim setadoido
                    <a href="" class="btn-edit">
                        <span class="material-symbols-outlined ">
                                edit
                        </span></p>
                    </a>
                </div>
            </div>
        </div>
        
        <dialog closed id="modal-edit" >
            <form action="" method="POST" enctype="multipart/form-data">
                    <div id="img-container">
                        <p>*Foto do perfil</p>
                        <img id="preview" src="">
                        <div class="input-campo">
                            <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                            <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                        </div>
                    </div>
                    <div class="input-campo">
                        <p>*Nome do perfil</p>
                        <input type="text" value="" name="nome">
                    </div>
                    <div class="input-campo">
                        <p>*Endereço</p>
                        <input type="text" value="" name="telefone" id="telefone" >
                    </div>
                    <div class="btns-edit">
                        <button type="submit">Atualizar</button>
                        <button id="cancelar-edit" type="button">Voltar</button>
                    </div>
            </form>
        </dialog>

        <dialog closed id="cancelar-horario">
            <form action="">
                <h2>
                    realmente deseja cancelar esse horaio?
                </h2>
                <div class="btn-cancel-horario">
                    <button type="submit" id="btn-cancelar">Desamarcar
                    </button>
                    <button id="btn-voltar" type="button">Voltar</button>
                </div>
            </form>
        </dialog>
        <section>
            <div class="horaios-marcados">
                <div class="cliente-hora">
                    <div class="dia-servicos">
                        <h2>Segunda-Feira</h2>
                    </div>
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - AM">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - AM">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - AM">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - PM">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    <div class="dia-servicos">
                        <h2>Segunda-Feira</h2>
                    </div>
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - Manhã">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - Manhã">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - Manhã">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                    
                    <div class="servico-marcado">
                        <div class="foto-cliente">
                            <img src="../../assets/img/avatar-padrao.jpg" alt="foto cliente">
                            <button>finalizar <span class="material-symbols-outlined">
                                check
                                </span></button>
                        </div>
                        <div class="nome-cliente">
                            <h3>Nome</h3>
                            <input type="text" disabled placeholder="kaique dasilva">
                        </div>
                        
                        <div class="numero-cliente">
                            <h3>Numero</h3>
                            <input type="text" disabled placeholder="11 999999999">
                        </div>
                        
                        <div class="servico-cliente">
                            <h3>serviço</h3>
                            <input type="text" disabled placeholder="degrade">
                        </div>
                        
                        <div class="horario-cliente">
                            <h3>Horario</h3>
                            <input type="text" disabled placeholder="10:00 - Manhã">
                            <button class="btn-cancelar-horario"><p>Desmarcar Horario</p> <span class="material-symbols-outlined">
                                delete
                                </span></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../../assets/js/modal-perfilEdit.js"></script>
    <script src="../../assets/js/preview-img.js"></script>
    <script src="../../assets/js/modal-deslogar.js"></script>
    <script src="../../assets/js/modal-cancelar-horario.js"></script>
    <script src="../../assets/js/ativar-config.js"></script>
</body>
</html>