
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
                <div class="foto-perfil">
                    <img src="../../assets/img/foto-barbeiro-tela-home.png" alt="foto de perfil adm">
                    <a href="" class="btn-edit"><span class="material-symbols-outlined editar-icon">edit</span> </a>
                </div>
                <div class="dados-perfil">
                    <h1>Luis Pereira</h1>
                    <p>Rua Naoseioque, n°171 - Jardim Setadoido</p>
                </div>
            </div>
        </div>
        

        <div class="galeria">
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid5.png" alt="Imagem 4">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid2.png" alt="Imagem 1">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid3.png" alt="Imagem 2">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid1.png" alt="Imagem 3">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
            <div class="imagem-item">
                <img src="../../assets/img/foto-grid5.png" alt="Imagem 4">
                <span class="material-symbols-outlined">more_vert</span>
            </div>
        </div>
    </main>
    
    <dialog closed id="modal-edit" >
            <form action="../../functions/user/editarPerfil.php" method="POST" enctype="multipart/form-data">
                    
                    <div id="img-container">
                        <p>*Foto do perfil</p>
                        <img id="preview" src="<?php echo "../" . buscaImagemUsuario($_SESSION['id_usuario']); ?>" >
                        <div class="input-campo">
                            <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                            <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                        </div>
                    </div>
                    <?php $dados = dadosCliente($_SESSION['id_usuario']);?>
                    <div class="input-campo">
                        <p>*Nome do perfil</p>
                        <input type="text" value="<?php echo $dados['nome']; ?>" name="nome">
                    </div>
                    <div class="input-campo">
                        <p>*Numero do perfil</p>
                        <input type="text" value="<?php echo $dados['numero_telefone']; ?>" name="telefone" id="telefone" >
                    </div>
                    <div class="btns-edit">
                        <button type="submit">Atualizar</button>
                        <button id="cancelar-edit" type="button">Voltar</button>
                    </div>
                </form>
            </dialog>
    
        <script src="../../assets/js/modal-perfilEdit.js"></script>
        <script src="../../assets/js/preview-img.js"></script>
</body>