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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <link rel="stylesheet" href="../../assets/css/perfil-responsividade.css">
</head>
<body>
    <!-- Estrutura do Menu Para Desktop(computadores e laptops) -->
    <nav class="menu-lateral-desktop">
        <div class="logo">
            <img src="../../assets/img/LOGO.png" alt="">
        </div>

        <ul>
            <li class="item-menu">
                <a href="perfil.php">
                    <img src="../../assets/img/icon-perfil.png" alt="">
                    <span class="txt-link">Perfil</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="home.php">
                    <img src="../../assets/img/icon-home.png" alt="">
                    <span class="txt-link">Home</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="produtos.php">
                    <img src="../../assets/img/icon-produtos.png" alt="">
                    <span class="txt-link">Produtos</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <img src="../../assets/img/icon-informacoes.png" alt="">
                    <span class="txt-link">Informações</span>
                </a>
            </li>
            <li class="item-menu">
                <a href="#">
                    <img src="../../assets/img/icon-agendar.png" alt="">
                    <span class="txt-link">Agendar</span>
                </a>
            </li>
        </ul>

        <button id="btn-sair" class="btn-sair"><img src="../../assets/img/icon-sair.png" alt="">SAIR</button>

    </nav>
    
    
    <dialog close id="modal-sair" >
        <div class="modal-sair">
            <p>realmente deseja sair?</p>
            <div class="btns-modal">
                <a href="../../functions/logout.php">
                    <button class="btn-sair">Sair</button>
                </a>
                <button id="cancelar-sair">Voltar</button>
            </div>
        </div>
    </dialog>
    <!-- Fim do menu Desktop e inicio da sessão perfil -->

    <section class="perfil">
        <div class="container-perfil">
            <div class="foto-perfil">
            <div class="profile-pic"><img src="<?php echo "../../" . buscaImagemUsuario($_SESSION['id_usuario']); ?>" alt=""></div>
                <div class="btn-alterar-foto">
                    <a href="" class="btn-edit"><span class="material-symbols-outlined">edit</span></a>
                </div>
            </div>
            <div class="form-perfil">
                <div class="form">
                    <form action="">
                        <p>*Nome do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['nome']; ?>" name="nome" readonly>
                            <a href="" class="btn-edit"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                        <p>*Numero do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['numero_telefone']; ?>" name="telefone" id="telefone" >
                            <a href="" class="btn-edit"><span class="material-symbols-outlined">edit</span></a>
                        </div>
                    </form>
                </div>
            </div>
            
            <dialog close id="modal-edit" >
                <form action="">
                    <p>*Foto do perfil</p>
                    <div class="input-campo">
                        <input type="file" id="arquivo" class="input-file">
                        <label for="arquivo" class="custom-file-button">Escolha a foto</label>
                    </div>
                    <p>*Nome do perfil</p>
                    <div class="input-campo">
                        <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['nome']; ?>" name="nome">
                    </div>
                    <p>*Numero do perfil</p>
                    <div class="input-campo">
                        <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['numero_telefone']; ?>" name="telefone" id="telefone" >
                    </div>
                    <div class="btns-edit">
                        <button type="submit">Atualizar</button>
                        <button id="cancelar-edit">Voltar</button>
                    </div>
                </form>
            </dialog>

            <div class="horarios-marcados">
                <p>Horarios marcados</p>
                <div class="caixa-horarios">
                    <!-- <div class="txt-sem-horarios"><p>SEM HORARIO MARCADO</p></div> -->
                        <div class="horario-caixa">
                            <?php $dados = mostrarAgendamentos($_SESSION['id_usuario'], $pdo); 
                                foreach($dados as $agenda): ?>
                                <div class="nome-barbeiro"><p><?php echo $agenda['funcionario']; ?> </p></div>
                                <p> - </p>
                                <div class="data-barbeiro"><p><?php echo $agenda['data']; ?> </p></div>
                                <p> | </p>
                                <div class="dia-barbeiro"><p><?php echo diaDaSemana($agenda['data']); ?> </p></div>
                                <div class="horario-barbeiro"><p><?php echo $agenda['horario']; ?></p> </div>
                                <?php endforeach; ?>
                        </div>
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
        <script src="../../assets/js/formatar-telefone.js"></script>
        <script src="../../assets/js/modal-deslogar.js"></script>
        <script src="../../assets/js/modal-perfilEdit.js"></script>
</body>
</html>