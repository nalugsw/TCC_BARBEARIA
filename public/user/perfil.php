<?php

include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("cliente");
$id_funcionario = dadosFuncionario("id_funcionario");
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
            <div class="profile-pic"><img src="../../<?php echo buscaImagemUsuario($_SESSION['id_usuario']); ?>" alt=""></div>
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
                        <img id="preview" src="<?php echo "../../" . buscaImagemUsuario($_SESSION['id_usuario']); ?>" >
                        <div class="btn_foto">
                            <input type="file" id="arquivo" class="input-file" name="foto"accept="image/*" onchange="loadFile(event)">
                            <label for="arquivo" class="custom-file-button"><span class="material-symbols-outlined ">edit</span></label>
                            <button type="submit" name="apagar_foto" id="apagar-foto" value="1"><img src="../../assets/img/delete.png" alt=""></button>
                        </div>
                    </div>
                    <?php $dados = dadosCliente($_SESSION['id_usuario']);?>
                    <div class="input-campo-edit">
                        <p>*Nome do perfil</p>
                        <input type="text" value="<?php echo $dados['nome']; ?>" name="nome">
                    </div>
                    <div class="input-campo-edit">
                        <p>*Numero do perfil</p>
                        <input type="text" value="<?php echo $dados['numero_telefone']; ?>" name="telefone" id="telefone" minlength="11" maxlength="11">
                    </div>
                    
                    <div class="btns-edit">
                        <button id="salvar-edit" type="submit">Atualizar</button>
                        <button id="cancelar-edit" type="button">Voltar</button>
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
                            <div class="horario-caixa"  title="Esta é uma informação adicional">
                                <div class="desmarcar hide">
                                    <button class="btn-cancelar-horario" onclick="document.getElementById('cancelar-horario-<?php echo $agenda['id_agenda']; ?>').showModal();">
                                        <img src="../../assets/img/delete.png" alt="">
                                    </button>
                                </div>
                                <div class="nome-barbeiro"><p><?php echo $agenda['servico']; ?></p></div>
                                <p>|</p>
                                <div class="data-barbeiro"><p>
                                    <?php $dataNova = new DateTime($agenda['data']);
                                    echo $dataNova->format('d/m'); ?> 
                                </p></div>
                                <p>|</p>
                                <div class="dia-barbeiro"><p><?php echo diaDaSemana($agenda['data']); ?></p></div>
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
                            <dialog id="cancelar-horario-<?php echo $agenda['id_agenda']; ?>" class="desmarcar-div">
                                <form action="../../functions/validaAgendamento.php" method="POST">
                                    <h2>Realmente deseja cancelar esse horário?</h2>
                                    <input type="hidden" name="id" value="<?php echo $agenda['id_agenda']; ?>">
                                    <input type="hidden" name="acao" value="cancelado_cliente">
                                    <div class="btn-cancel-horario">
                                        <button type="submit" id="btn-cancelar">Desmarcar</button>
                                        <button type="button" onclick="this.closest('dialog').close();" id="voltar">Voltar</button>
                                    </div>
                                </form>
                            </dialog>
                        <?php endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script>
document.getElementById("arquivo").addEventListener("change", async function(event) {
    const file = event.target.files[0];
    if (!file || !file.type.startsWith("image/")) return;

    const img = new Image();
    const reader = new FileReader();

    reader.onload = function(e) {
        img.src = e.target.result;
    };

    img.onload = function() {
        const canvas = document.createElement("canvas");

        const maxWidth = 800;
        const scale = maxWidth / img.width;
        canvas.width = maxWidth;
        canvas.height = img.height * scale;

        const ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        canvas.toBlob(function(blob) {
            const compressedFile = new File([blob], file.name, {
                type: "image/jpeg",
                lastModified: Date.now()
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            event.target.files = dataTransfer.files;

         
            document.getElementById("preview").src = URL.createObjectURL(compressedFile);
        }, "image/jpeg", 0.7);
    };

    reader.readAsDataURL(file);
});
</script>

    
        <script src="../../assets/js/modal-perfilEdit.js"></script>
        <script src="../../assets/js/preview-img.js"></script>
        <script src="../../assets/js/modal-cancelar-horario.js"></script>
    </body>
</html>