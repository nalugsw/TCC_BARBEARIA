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
     
    <?php include("../../views/nav-padrao-funcionario.php"); ?>

    <main>
        <div class="perfil-adm">
            <div class="foto-adm">
                <img src="../../assets/img/homem-sorrindo-teste.avif" alt="foto barbeiro">
            </div>
            <div class="informacoes-home">
                
                <h1>Luis Pereira</h1>
                
                <div class="endereco-info">
                        <p>Rua naoseioque, n°171 - Jardim setadoido</p>
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
</body>
</html>