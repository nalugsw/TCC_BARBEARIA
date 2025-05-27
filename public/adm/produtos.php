<?php

include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("administrador");
require("../../functions/produtos.php");
$produtos = mostrarProdutos();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/produtos.css">
    <link rel="stylesheet" href="../../assets/css/adm/produtos-reponsividade.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php include("../../views/nav-padrao-adm.php"); ?>
    
    <!-- Fim do menu Desktop e inicio da sessão perfil -->
    <section class="produtos">
        <div class="titulo-produtos">
            <h1>PRODUTOS</h1>
        </div>

        <div class="grid-catalogo-produtos">
            <?php foreach($produtos as $produto): ?>
                <div class="item-produto" data-titulo="<?php echo $produto['nome']; ?>" data-preco="<?php echo $produto['preco']; ?>" data-descricao="<?php echo $produto['descricao']; ?>">
                    <div class="img-produto">
                        <img src="../../assets/img/produto-teste.webp" alt="Kit Barba Balm">
                    </div>
                    <div class="txt-produto">
                        <h2><?php echo $produto['nome']; ?></h2>
                        <p>R$<?php echo $produto['preco']; ?></p>
                    </div>
                    
                    <div class="btn-edit">
                            <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <dialog closed id="modal-edit" >
            <form action="" method="POST" enctype="multipart/form-data">
                <button id="cancelar-edit" type="button"><img src="../../assets/img/iconeClose.png" alt=""></button>
                <div id="img-container">
                    <p>*Foto do perfil</p>
                    <div class="input-campo">
                        <img id="preview" src="" >
                        <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                    </div>
                </div>
                <div class="input-campo">
                    <p>*Nome do prodto</p>
                    <input type="text" value="" name="nome">
                </div>
                <div class="input-campo">
                    <p>*descrição</p>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="input-campo">
                    <p>*preço item</p>
                    <input type="number" step="0.01" min="0" id="preco-servico" name="valor" placeholder="R$00,00">
                    <button type="submit" id="btn-atualizar">Atualizar</button>
                </div>
                </div>
            </form>
        </dialog>
        
        <dialog closed id="modal-create" class="modal">
            <form action="" method="POST" enctype="multipart/form-data">
                <button id="cancelar-edit" type="button"><img src="../../assets/img/iconeClose.png" alt=""></button>
                <div id="img-container">
                    <p>*Foto do perfil</p>
                    <div class="input-campo">
                        <img id="preview" src="" >
                        <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                    </div>
                </div>
                <div class="input-campo">
                    <p>*Nome do prodto</p>
                    <input type="text" value="" name="nome">
                </div>
                <div class="input-campo">
                    <p>*descrição</p>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="input-campo">
                    <p>*preço item</p>
                    <input type="number" step="0.01" min="0" id="preco-servico" name="valor" placeholder="R$00,00">
                    <button type="submit" id="btn-atualizar">Atualizar</button>
                </div>
                </div>
            </form>
        </dialog>
        <div class="btn-addProduto">
            <button><img src="../../assets/img/icone-add.png" alt=""></button>
        </div>
    </section>
        
        <script src="../../assets/js/modal-deslogar.js"></script>
        
        <script src="../../assets/js/modal-perfilEdit.js"></script>
        <script src="../../assets/js/preview-img.js"></script>
</body>
</html>