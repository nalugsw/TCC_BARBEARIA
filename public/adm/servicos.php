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

    <main>
    <div class="perfil-container" id="container-cadastro">
        <form action="../../functions/adm/servicos.php" method="post" enctype="multipart/form-data">
            <div class="info">
                <div class="dados-perfil">
                    <p>Coloque a imagem do serviço</p>
                    <div class="input-campo">
                       
                        <input type="file" id="arquivo" class="input-file" name="foto" accept="image/*" onchange="loadFile(event)">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                        <img id="preview" src="">
                    </div>
                    <input type="hidden" name="acao" value="cadastro" >
                </div>
                <div class="dados-perfil">
                    <div>
                        <p>Nome do serviço</p>
                        <input type="text" name="nome">
                    </div>
                    <div>
                        <p>Tempo do serviço</p>
                        <input type="time" name="duracao">
                    </div>
                </div>
                <div class="dados-perfil">
                    <div>
                        <p>Preço do serviço</p>
                        <input type="number" step="0.01" min="0" name="valor" placeholder="R$00,00">
                    </div>
                    <button type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="perfil-container" id="container-edicao" style="display: none;">
        <form action="../../functions/adm/servicos.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="servico-id" name="id">
            <div class="info">
                <div class="dados-perfil">
                    <p>Coloque a imagem do serviço</p>
                    
                    <input type="hidden" id="id-servico" name="id" value="<?php echo $servicos['id_servico'];  ?>" >
                    
                    <div class="input-campo">
                        <input type="file" id="arquivo-edicao" class="input-file" name="foto" accept="image/*" onchange="loadFileEdicao(event)">
                        <label for="arquivo-edicao" class="custom-file-button">Escolha a foto</label>
                        <img id="preview-edicao" src="">
                    </div>
                </div>
                <div class="dados-perfil">
                    <div>
                        <p>Nome do serviço</p>
                        <input type="text" id="nome-servico" name="nome">
                    </div>
                    <div>
                        <p>Tempo do serviço</p>
                        <input type="time" id="tempo-servico" name="duracao">
                    </div>
                </div>
                <div class="dados-perfil">
                    <div>
                        <p>Preço do serviço</p>
                        <input type="number" step="0.01" min="0" id="preco-servico" name="valor" placeholder="R$00,00">
                    </div>
                    <div class="botoes-edicao">
                        <button type="submit">Atualizar</button>
                        <button type="button" id="cancelar-edicao">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
        <div class="grids-container">
            <div class="grid" id="grid2">
                <!-- Exemplo de itens do grid (substitua pelo seu PHP real) -->
                 <?php foreach($servicos as $servico): ?>
                    <div class="item" >
                        <img src="../../<?php echo $servico['foto']; ?>" alt="Serviço 1">
                        <div class="txt-teste">
                            <h1><?php echo $servico['nome']; ?></h1>
                            <div class="preco">
                                <p>R$<?php echo $servico['valor']; ?></p>
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

<script src="../../assets/js/atualizar-servico.js"></script>