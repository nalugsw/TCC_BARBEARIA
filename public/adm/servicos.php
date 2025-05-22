<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");
require("../../functions/user/home.php");
$servicos = mostrarServicos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/servicosAdm.css">
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
            <form action="">
                <div class="info">
                        <div class="dados-perfil">
                            <p>Coloque a imagem do serviço</p>
                                <img id="preview" src="" >
                                <div class="input-campo">
                                    <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                                    <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                                </div>
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
                            <button type="submit">Cadastrar</button>
                        </div>
                </div>
            </form>
        </div>
        
        <div class="grids-container">
            <div class="grid" id="grid2">
                <!-- Exemplo de itens do grid (substitua pelo seu PHP real) -->
                 <?php foreach($servicos as $servico): ?>
                    <div class="item">
                        <img src="../../<?php echo $servico['foto']; ?>" alt="Serviço 1">
                        <div class="txt-teste">
                            <h1><?php echo $servico['nome']; ?></h1>
                            <div class="preco">
                                <p><?php echo $servico['valor']; ?></p>
                                <div class="duracao"><?php $duracaoEmMinutos = (int)date('i', strtotime($servico['duracao'])) . " min";
                                echo $duracaoEmMinutos; ?></div>
                            </div>
                        </div>
                        <div class="icone-editar">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
       
    </main>
</body>

<script src="../../assets/js/preview-img.js"></script>
<script src="../../assets/js/input-file-admservicos.js"></script>