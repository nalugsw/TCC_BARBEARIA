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
    
    <main>
    <section class="produtos">
        <div class="titulo-produtos">
            <h1>PRODUTOS</h1>
        </div>
        <div class="grid-catalogo-produtos">
            <?php foreach($produtos as $produto): ?>
                <div class="item-produto" data-titulo="<?php echo $produto['nome']; ?>" data-preco="<?php echo $produto['preco']; ?>" data-descricao="<?php echo $produto['descricao']; ?>">
                    <div class="img-produto">
                        <img src="<?php echo "../../" . $produto['foto']; ?>" alt="produto">
                    </div>
                    <div class="txt-produto">
                        <h2><?php echo $produto['nome']; ?></h2>
                        <p>R$<?php echo $produto['preco']; ?></p>
                    </div>
                    
                    <div class="btn-edit">
                        <button onclick="abrirModalEdicao('editar-produto-<?php echo $produto['id_produto']; ?>', '<?php echo $produto['nome']; ?>', '<?php echo $produto['descricao']; ?>', '<?php echo $produto['preco']; ?>', '<?php echo "../../" . $produto['foto']; ?>')">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </div>
                </div>
                
                <dialog id="editar-produto-<?php echo $produto['id_produto']; ?>" class="modal-edicao">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                        <button type="button" class="cancelar-edit" onclick="this.closest('dialog').close();">
                            <img src="../../assets/img/iconeClose.png" alt="Fechar">
                        </button>
                        <div id="img-container">
                            <p>*Foto do produto</p>
                            <div class="input-campo">
                                <img id="preview-<?php echo $produto['id_produto']; ?>" src="<?php echo "../../" . $produto['foto']; ?>" class="preview">
                                <input type="file" id="arquivo-<?php echo $produto['id_produto']; ?>" class="input-file" name="foto" accept="image/*" onchange="loadFile(event, 'preview-<?php echo $produto['id_produto']; ?>')">
                                <label for="arquivo-<?php echo $produto['id_produto']; ?>" class="custom-file-button">Escolha a foto</label>
                            </div>
                        </div>
                        <div class="input-campo">
                            <p>*Nome do produto</p>
                            <input type="text" name="nome" value="<?php echo $produto['nome']; ?>">
                        </div>
                        <div class="input-campo">
                            <p>*Descrição</p>
                            <textarea name="descricao" cols="30" rows="10"><?php echo $produto['descricao']; ?></textarea>
                        </div>
                        <div class="input-campo">
                            <p>*Preço do item</p>
                            <input type="number" step="0.01" min="0" name="valor" value="<?php echo $produto['preco']; ?>" placeholder="R$00,00">
                            <button type="submit" class="btn-atualizar">Atualizar</button>
                        </div>
                    </form>
                </dialog>
            <?php endforeach; ?>
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
        <div class="btn-addProduto btn-edit">
            <button><img src="../../assets/img/icone-add.png" alt=""></button>
        </div>
    </section>
</main>
    <script>
    function abrirModalEdicao(modalId, nome, descricao, preco, foto) {
        const modal = document.getElementById(modalId);
        
        // Preenche os campos do modal
        modal.querySelector('input[name="nome"]').value = nome;
        modal.querySelector('textarea[name="descricao"]').value = descricao;
        modal.querySelector('input[name="valor"]').value = preco;
        modal.querySelector('img[id^="preview-"]').src = foto;
        
        // Abre o modal
        modal.showModal();
    }

    function loadFile(event, previewId) {
        const output = document.getElementById(previewId);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    }
    </script>
    
    <script src="../../assets/js/popup-produtos.js"></script>
    <script src="../../assets/js/modal-perfilEdit.js"></script>
    <script src="../../assets/js/preview-img.js"></script>
</body>
</html>