<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("cliente");
require_once("../../functions/agendamento.php");
require_once("../../functions/user/perfil.php");

$mensagemSucesso = isset($_SESSION['sucesso']) ? $_SESSION['sucesso']: "";
$mensagemErro = isset($_SESSION['erro']) ? $_SESSION['erro']: "";
unset($_SESSION['sucesso']);
unset($_SESSION['erro']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/user/perfil.css">
    <link rel="stylesheet" href="../../assets/css/user/perfil-responsividade.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importando pacote de icones do Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    <script src="../../assets/js/formatar-telefone.js"></script>
</head>
<body>
    <?php include("../../views/nav-padrao.php"); ?>

    <section class="perfil">
        <div class="container-perfil">
            <div class="foto-perfil">
            <div class="profile-pic"><img src="<?php echo buscaImagemUsuario($_SESSION['id_usuario']); ?>" alt=""></div>
                <div class="btn-alterar-foto">
                    <span class="material-symbols-outlined btn-edit" id="btn-edit-foto">edit</span>
                </div>
            </div>
            <div class="form-perfil">
                <div class="form">
                    <form action="">
                        <p>*Nome do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['nome']; ?>" name="nome" readonly>
                            <a href="" class="btn-edit"><span class="material-symbols-outlined ">edit</span></a>
                        </div>
                        <p>*Numero do perfil</p>
                        <div class="input-campo">
                            <input type="text" placeholder="<?php $dados = dadosCliente($_SESSION['id_usuario']); echo $dados['numero_telefone']; ?>" name="telefone" id="telefone" readonly>
                            <a href="" class="btn-edit"><span class="material-symbols-outlined ">edit</span></a>
                        </div>
                    </form>
                </div>
            </div>
            
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

            <dialog closed id="cancelar-horario">
                <form action="">
                    <h2>
                        realmente deseja cancelar esse horaio?
                    </h2>
                    <div class="btn-cancel-horario">
                        <button type="submit" id="btn-cancelar">Desamarcar
                        </button>
                        <button id="btn-voltar" type="button">Voltar</button>
                    </div>
                </form>
            </dialog>
            <div class="horarios-marcados">
                <p>Horarios marcados</p>
                <div class="caixa-horarios">
                    <?php
                    
                    $dados = mostrarAgendamentos($_SESSION['id_usuario'], $pdo);
                    if (empty($dados)) {
                        echo '<div class="txt-sem-horarios"><p>SEM HORÁRIO MARCADO</p></div>';
                    } else {
                        
                        foreach($dados as $agenda): ?>
                            <div class="horario-caixa">
                                <div class="desmarcar hide">
                                    <button class="btn-cancelar-horario"><img src="../../assets/img/delete.png" alt=""></button>
                                </div>
                                <div class="nome-barbeiro"><p><?php echo $agenda['servico']; ?> </p></div>
                                <p> - </p>
                                <div class="data-barbeiro"><p>
                                    <?php   $dataNova = new DateTime($agenda['data']);
                                            echo $dataNova->format('d/m');?> 
                                </p></div>
                                <p> | </p>
                                <div class="dia-barbeiro"><p><?php echo diaDaSemana($agenda['data']); ?> </p></div>
                                <div class="horario-barbeiro">
                                    <p>
                                        <?php 
                                        $data_hora_atual = new DateTime($agenda['horario']);
                                        $hora_formatada = $data_hora_atual->format('H:i');
                                        echo $hora_formatada;
                                        ?>
                                    </p>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    }
                    ?>
                    

                </div>
            </div>
            
        </div>
    </section>

        <script src="../../assets/js/modal-perfilEdit.js"></script>
        <script src="../../assets/js/preview-img.js"></script>
        <script src="../../assets/js/modal-cancelar-horario.js"></script>
    </body>
</html>