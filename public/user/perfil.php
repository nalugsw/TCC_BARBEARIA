<?php

include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("cliente");
require("../../functions/agendamento.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/perfil.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="../../assets/css/perfil-responsividade.css">
</head>
<body>

<?php include("../../views/nav-padrao.php"); ?>

    <section class="perfil">
        <div class="container-perfil">
            <div class="foto-perfil">
            <div class="profile-pic"><img src="<?php echo "../../" . buscaImagemUsuario($_SESSION['id_usuario']); ?>" alt=""></div>
                <div class="btn-alterar-foto">
                    <a href=""><img src="../../assets/img/icon-lapis-alterar-campo.png" alt="Foto perfil"></a>
                </div>
            </div>
            <div class="form-perfil">
                <div class="form">
                    <form action="">
                        <p>*Nome do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['nome']; ?>" name="nome" disabled>
                            <img src="../../assets/img/icon-lapis-alterar-campo.png" alt="">
                        </div>
                        <p>*Numero do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['numero_telefone']; ?>" name="telefone" disabled>
                            <img src="../../assets/img/icon-lapis-alterar-campo.png" alt="">
                        </div>
                    </form>
                </div>
            </div>
            <div class="horarios-marcados">
                <p>Horarios marcados</p>
                <div class="caixa-horarios">
                    <!-- <div class="txt-sem-horarios"><p>SEM HORARIO MARCADO</p></div> -->
                    <?php $dados = mostrarAgendamentos($_SESSION['id_usuario'], $pdo); 
                                foreach($dados as $agenda): ?>
                            <div class="horario-caixa">
                                <div class="nome-barbeiro"><p><?php echo $agenda['funcionario']; ?> </p></div>
                                <p> - </p>
                                <div class="data-barbeiro"><p><?php echo $agenda['data']; ?> </p></div>
                                <p> | </p>
                                <div class="dia-barbeiro"><p><?php echo diaDaSemana($agenda['data']); ?> </p></div>
                                <div class="horario-barbeiro"><p><?php echo $agenda['horario']; ?></p> </div>
                            </div>
                                <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Menu Mobile para dispositivos de telas pequenas -->

<!--
        <nav class="menu-inferior-mobile">

            <ul>
                <li class="item-menu">
                    <a href="perfil.html">
                        <img src="../assets/img/mobile-icon-perfil.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="home.html">
                        <img src="../assets/img/mobile-icon-home.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-produtos.png" alt="">
                        
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-informacoes.png" alt="">
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-agendar.png" alt="">
                    </a>
                </li>
                <li class="item-menu">
                    <a href="#">
                        <img src="../assets/img/mobile-icon-sair.png" alt="">
                    </a>
                </li>
            </ul>
        </nav> -->
        <script src="../../assets/js/modal.js"></script>
</body>
</html>