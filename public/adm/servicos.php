
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
    <link rel="stylesheet" href="../../assets/css/adm/servicosAdm-responsividade.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">


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
        <div class="perfil-container">
            <div class="info">
                <div class="dados-perfil">
                    <div class="upload">
                        <p>Coloque a imagem do serviço</p>
                        <div class="upload-container">
                            <label for="selecao-arquivo" class="custom-file-upload">
                                <i class="bi bi-file-earmark-image"></i>
                                <span>Selecionar Arquivo</span>
                            </label>
                            <div id="nome-arquivo" class="nome-arquivo"></div>
                        </div>
                        <input id="selecao-arquivo" type="file" class="input-file">
                    </div>
                </div>
                <div class="dados-perfil">
                    <div class="info-dados-perfil">
                        <p>Nome do serviço</p>
                        <input type="text">
                    </div>
                    <div class="info-dados-perfil">
                        <p>Tempo do serviço</p>
                        <input type="time">
                    </div>
                </div>
                <div class="dados-perfil">
                    <div class="info-dados-perfil">
                        <p>Preço do serviço</p>
                        <input type="number" placeholder="R$00,00">
                    </div>
                    <p>Coloque a imagem do serviço</p>
                    <div class="upload-container">
                        <label for="selecao-arquivo" class="custom-file-upload">
                            <i class="bi bi-file-earmark-image"></i>
                            <span>Selecionar Arquivo</span>
                        </label>
                        <div id="nome-arquivo" class="nome-arquivo"></div>
                    </div>
                    <input id="selecao-arquivo" type="file" class="input-file">
                </div>
                <div class="dados-perfil">
                    <p>Nome do serviço</p>
                    <input type="text">
                    <p>Tempo do serviço</p>
                    <input type="time">
                </div>
                <div class="dados-perfil">
                    <p>Preço do serviço</p>
                    <input type="number" placeholder="R$00,00">
                    <button>Cadastrar</button>
                </div>
            </div>
            
        </div>
        
        <div class="grids-container">
            <div class="grid" id="grid2">
                <!-- Exemplo de itens do grid (substitua pelo seu PHP real) -->
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/img/servicos-2.png" alt="Serviço 1">
                    <div class="txt-teste">
                        <h1>Corte de Cabelo</h1>
                        <div class="preco">
                            <p>R$ 50,00</p>
                            <div class="duracao">30 min</div>
                        </div>
                    </div>
                    <div class="icone-editar">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
               
            </div>
        </div>
        
       
    </main>
</body>

<script src="../../assets/js/input-file-admservicos.js"></script>