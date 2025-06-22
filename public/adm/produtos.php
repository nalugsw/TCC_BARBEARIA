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
                <div class="item-produto <?php echo ($produto['status_produto'] == 'inativo') ? 'item-ativo' : ''; ?>" data-id="<?php echo $produto['id_produto']; ?>" data-titulo="<?php echo $produto['nome']; ?>" data-preco="<?php echo $produto['preco']; ?>" data-descricao="<?php echo $produto['descricao']; ?>" value="<?php echo $produto['status_produto']; ?>">
                    <div class="estoque" >
                        <button class="btn-ativo">
                            <img src="../../assets/img/icone-add.png" alt="ativo">
                        </button>
                        <button class="btn-inativo">
                            <img src="../../assets/img/icone-remove.png" alt="inativo">
                        </button>
                    </div>
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
                    <form action="../../functions/adm/produtos.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                        <input type="hidden" name="acao" value="editarProduto">
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
                            <div class="input-btn">
                                <button type="submit" class="btn-atualizar">Atualizar</button>
                                <button type="submit" name="acao" value="excluirProduto" class="btn-excluir">Excluir</button>
                            </div>
                        </div>
                    </form>
                </dialog>
            <?php endforeach; ?>
        </div>
        <dialog  id="modal-create" class="modal">
            <form action="../../functions/adm/produtos.php" method="POST" enctype="multipart/form-data">
                <button id="cancelar-edit" type="button" class="btn-fechar-modal">
                    <img src="../../assets/img/iconeClose.png" alt="Fechar modal">
                </button>
                
                <div id="img-container">
                    <p>*Foto do produto</p>  
                    <div class="input-campo">
                        <img id="preview" class="preview" src="" >
                        <input type="file" id="arquivo" class="input-file" name="foto" accept="image/*" onchange="loadFile(event)">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                    </div>
                </div>
                
                <div class="input-campo">
                    <p>*Nome do produto</p>  
                    <input type="text" name="nome" required>
                </div>
                
                <div class="input-campo">
                    <p>*Descrição</p>
                    <textarea name="descricao" cols="30" rows="10" required></textarea> 
                </div>
                
                <div class="input-campo">
                    <p>*Preço do item</p>
                    <input type="number" step="0.01" min="0" name="valor" placeholder="R$00,00" required>
                </div>

                <input type="hidden" name="acao" value="adicionarProduto">
                
                <button type="submit" id="btn-cadastrar">Cadastrar</button> 
                
            </form>
        </dialog>

    
            <button id="btn-abrir-modal" class="btn-addProduto">
                <img src="../../assets/img/icone-add.png" alt="Adicionar produto">
            </button>

    </section>
</main>
<script>
// Funções para o modal de criação
document.addEventListener('DOMContentLoaded', function() {
    // Modal de criação
    const modalCreate = document.getElementById('modal-create');
    const btnAbrirModal = document.getElementById('btn-abrir-modal');
    const btnFecharModal = document.getElementById('cancelar-edit');
    
    // Abrir modal de criação
    if(btnAbrirModal && modalCreate) {
        btnAbrirModal.addEventListener('click', () => {
            console.log('Abrindo modal de criação'); // Debug
            modalCreate.showModal();
        });
    }
    
    // Fechar modal de criação
    if(btnFecharModal) {
        btnFecharModal.addEventListener('click', () => {
            modalCreate.close();
        });
    }
    
    // Fechar ao clicar fora (para todos os modais)
    document.querySelectorAll('dialog').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if(e.target === modal) {
                modal.close();
            }
        });
    });
});

// Função para edição (já existente)
function abrirModalEdicao(modalId, nome, descricao, preco, foto) {
    const modal = document.getElementById(modalId);
    
    modal.querySelector('input[name="nome"]').value = nome;
    modal.querySelector('textarea[name="descricao"]').value = descricao;
    modal.querySelector('input[name="valor"]').value = preco;
    
    // Atualiza a pré-visualização da imagem
    const previewId = 'preview-' + modalId.split('-').pop();
    const preview = document.getElementById(previewId);
    if(preview) preview.src = foto;
    
    modal.showModal();
}

// Função para pré-visualização de imagem (atualizada)
function loadFile(event, previewId = 'preview') {
    const output = document.getElementById(previewId);
    if(output && event.target.files[0]) {
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    }
}
    document.querySelectorAll('.item-produto').forEach(function(produto) {
    const btnAtivo = produto.querySelector('.btn-ativo');
    const btnInativo = produto.querySelector('.btn-inativo');
    const idProduto = produto.getAttribute('data-id'); // você precisa adicionar esse atributo no HTML

    btnAtivo.addEventListener('click', function() {
        atualizarStatus(idProduto, 'ativo', produto);
    });

    btnInativo.addEventListener('click', function() {
        atualizarStatus(idProduto, 'inativo', produto);
    });
});

function atualizarStatus(id, novoStatus, elemento) {
    fetch('../../functions/adm/produtos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `acao=atualizarStatus&id_produto=${id}&status=${novoStatus}`
    })
    .then(res => res.text())
    .then(data => {
        if (novoStatus === 'ativo') {
            elemento.classList.remove('inativo');
            elemento.classList.add('ativo');
        } else {
            elemento.classList.remove('ativo');
            elemento.classList.add('inativo');
        }
    })
    .catch(err => console.error('Erro:', err));
}
</script>

    
</body>
</html>