
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

    <?php include("../../views/nav-padrao-adm.php"); ?>

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
            </div>
            <div class="informacoes-home">
                <h1>Luis Pereira</h1>
            </div>
        </div>
        
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
                            <input type="text" value="11 0550099999" class="numero-telefone" readonly>
                            <button class="copyButton"><img src="../../assets/img/icone-copy.png" alt="Copiar"></button>
                            <button class="whatsBtn"><img src="../../assets/img/icone-whatsapp.png" alt="WhatsApp"></button>
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
                            <input type="text" value="11 0000099999" class="numero-telefone" readonly>
                            <button class="copyButton"><img src="../../assets/img/icone-copy.png" alt="Copiar"></button>
                            <button class="whatsBtn"><img src="../../assets/img/icone-whatsapp.png" alt="WhatsApp"></button>
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
                    

                </div>
            </div>
        </section>
    </main>
    <script src="../../assets/js/modal-cancelar-horario.js"></script>
    <script src="../../assets/js/msg-whatsap.js"></script>
    <script>
   // Script para copiar (substitua o existente)
document.querySelectorAll('.copyButton').forEach(button => {
    button.addEventListener('click', async function() {
        try {
            const numeroInput = this.closest('.numero-cliente').querySelector('.numero-telefone');
            const phoneNumber = numeroInput.value;
            
            await navigator.clipboard.writeText(phoneNumber);
            
            // Feedback visual
            numeroInput.style.color = '#4065AB';
            setTimeout(() => {
                numeroInput.style.color = '#f4f4f4';
            }, 300);
        } catch (err) {
            console.error('Falha ao copiar: ', err);
        }
    });
});
</script>
</body>
</html>