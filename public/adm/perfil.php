
<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");
$funcionario = dadosFuncionario();
require("../../functions/informacoes.php");
$informacoes = buscarInformacoes();
require("../../functions/user/home.php");
$portfolio = mostrarImagemPortfolio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/PerfilAdm.css">
    <link rel="stylesheet" href="../../assets/css/adm/nav.css">
    <link rel="stylesheet" href="../../assets/css/adm/PerfilAdm-responsivo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
</head>
<body>
    
    <?php include("../../views/nav-padrao-adm.php"); ?>

    <main>
        <div class="perfil-container">
            <div class="info">
                <div class="foto-perfil">
                    <!-- <img src="../../assets/img/foto-barbeiro-tela-home.png" alt="foto de perfil adm"> -->
                    <img src="../../<?php echo $funcionario['foto']; ?>" alt="foto de perfil adm">
                    <a href="" class="btn-edit"><span class="material-symbols-outlined editar-icon">edit</span> </a>
                </div>
                <div class="dados-perfil">
                    <h1><?php echo $funcionario['nome']; ?></h1>
                    <p><?php echo $informacoes['endereco']; ?></p>
                </div>
            </div>
        </div>

        <dialog closed id="modal-edit" >
            <form action="../../functions/adm/perfil.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="atualizarPerfil">
                
                <div id="img-container">
                    <p>*Foto do perfil</p>
                    <img id="preview" src="../../<?php echo $funcionario['foto']; ?>" >
                    <div class="input-campo-edit">
                        <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                    </div>
                </div>
                <div class="input-campo-edit">
                    <p>*Nome do perfil</p>
                    <input type="text" value="<?php echo $funcionario['nome']; ?>" name="nome">
                </div>
                <div class="input-campo-edit">
                    <p>*Endereço do perfil</p>
                    <input type="text" value="<?php echo $informacoes['endereco']; ?>" name="telefone" id="telefone" >
                </div>
                <div class="btns-edit">
                    <button type="submit">Atualizar</button>
                    <button id="cancelar-edit" type="button">Voltar</button>
                </div>
            </form>
        </dialog>
    
        <div class="Desq-container">
            <form action="../../functions/adm/perfil.php" enctype="multipart/form-data" method="POST">
                <div class="addDesataque">
                    <div class="img-container-desq">
                        <img id="cadDestaque" src="" >
                        <div class="input-campo-cad">
                            <input type="hidden" name="acao" value="adicionarImagem">
                            <input type="file" id="arquivoDestaque" class="input-file" name="foto" accept="image/*" onchange="loadFileDestaque(event)" required>
                            <label for="arquivoDestaque" class="custom-desq-button">Escolha a foto</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id-servico" name="acao">
                <button type="submit">Adicionar foto de destaque</button>
            </form>
        </div>
    
        <div class="galeria">
            <?php foreach($portfolio as $imagem): ?>
                <div class="imagem-item">
                    <img src="../../<?php echo $imagem['imagem']; ?>" alt="<?php echo 'imagem' . ' ' . $imagem['id_portfolio']; ?>">
                    <form action="../../functions/adm/perfil.php" method="post">
                        <input type="hidden" name="acao" value="deletarPortfolio">
                        <button type="submit" class="btn-excluir" data-src="../../uploads/portfolio/fotocabelo.jpg" onclick="abrirModalExcluir(this)" data-id="">
                    </form>  
                    <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        <dialog id="modal-excluir">
            <form action="../../functions/adm/perfil.php" method="post">
                <input type="hidden" name="acao" value="deletarPortfolio">
                <input type="hidden" name="id" value="<?php echo $imagem['id_portfolio']; ?>">
                <button type="submit" class="btn-excluir">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </form>
        </dialog>
    </main>
    
    
    <script>
        var loadFileDestaque = function(event) {
        var file = event.target.files[0];
        if (!file) return;

        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('cadDestaque');
            output.style.display = 'block';
            output.src = reader.result;
        };
        reader.readAsDataURL(file);
        };

        function abrirModalExcluir(botao) {
            const modal = document.getElementById("modal-excluir");
            const imagem = document.getElementById("imagem-modal-excluir");
            const inputId = document.getElementById("input-id-foto");

            const src = botao.getAttribute("data-src");
            const id = botao.getAttribute("data-id");

            imagem.src = src;
            inputId.value = id;

            modal.showModal();
        }

        function fecharModalExcluir() {
            const modal = document.getElementById("modal-excluir");
            modal.close();
        }
    </script>
        <script src="../../assets/js/modal-perfilEdit.js"></script>
        <script src="../../assets/js/preview-img.js"></script>
</body>