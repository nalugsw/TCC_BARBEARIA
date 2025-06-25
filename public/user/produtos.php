<?php

include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("cliente");
require("../../functions/produtos.php");
$produtos = mostrarProdutosAtivos();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/user/produtos.css">
    <link rel="stylesheet" href="../../assets/css/user/produtos-reponsividade.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php include("../../views/nav-padrao.php"); ?>
    

    <section class="produtos">
        <div class="titulo-produtos">
            <h1>PRODUTOS</h1>
        </div>

        <div class="grid-catalogo-produtos">
            <?php foreach($produtos as $produto): ?>
                <div class="item-produto" data-titulo="<?php echo $produto['nome']; ?>" data-preco="<?php echo $produto['preco']; ?>" data-descricao="<?php echo $produto['descricao']; ?>">
                    <div class="img-produto">
                        <img src="../../<?php echo $produto['foto']; ?>" alt="Kit Barba Balm">
                    </div>
                    <div class="txt-produto">
                        <h2><?php echo $produto['nome']; ?></h2>
                        <p>R$<?php echo $produto['preco']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="popup" class="popup">
            <div class="popup-container">
                <span class="btn-fechar"><i class="bi bi-x-circle-fill"></i></span>
                <img id="popup-img" src="" alt="Imagem do Produto">
                <h2 id="popup-titulo"></h2>
                <div class="pDiv">
                    <p>R$</p><p id="popup-preco"></p>
                </div>
                <br>
                <p>Descrição</p>
                <br>
                <p id="popup-descricao"></p>
            </div>
        </div>
    </section>
        
        <script src="../../assets/js/modal.js"></script>
        <script src="../../assets/js/modal-deslogar.js"></script>
        <script src="../../assets/js/submenu-funcao.js"></script>
        <script src="../../assets/js/popup-produtos.js"></script>
</body>
</html>