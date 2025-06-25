<?php

include("../../config/conexao.php");
session_start();
require("../../functions/helpers.php");
verificaSession("administrador");
require("../../functions/informacoes.php");
$informacoes = buscarInformacoes();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Perfil</title>
    <link rel="stylesheet" href="../../assets/css/adm/informacoes.css">
    <link rel="stylesheet" href="../../assets/css/adm/informacoes-responsivo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    
    <?php include("../../views/nav-padrao-adm.php"); ?>
    <main>
        <h1>Informações</h1>
        <div class="info-barbeiro">
            <h2>Barbeiro</h2>
            <p><?php echo $informacoes['informacoes_barbeiro']; ?></p>
            
        </div>
        <div class="info-barbearia">
            <h2>Barbearia</h2>
            <p><?php echo $informacoes['informacoes_barbearia']; ?></p>
            <h2>Localização</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116875.88510407697!2d-47.00702360662611!3d-23.734131425821666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cfad63bcaa3ec5%3A0xcb5cbf33fd10fd27!2sItapecerica%20da%20Serra%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1742305249167!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="info-projeto">
            <h2>Projeto Berbertech</h2>
            <p>O Barbertech é um sistema de agendamento inteligente desenvolvido para modernizar e otimizar a gestão de barbearias. Com uma plataforma intuitiva, o software permite que clientes agendem horários online, enquanto os barbeiros administram sua agenda de forma eficiente. O projeto visa reduzir filas, evitar sobrecargas e melhorar a experiência do usuário, integrando funcionalidades como lembretes automáticos e histórico de serviços. Desenvolvido com tecnologias web robustas, o Barbertech busca unir praticidade e inovação, tornando-se uma solução acessível para empreendedores do setor. Este TCC demonstra como a tecnologia pode transformar negócios tradicionais, elevando a qualidade e a organização do atendimento.</p>
        </div>
            
    </main>
    <a href="" class="btn-edit"><svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#f4f4f4"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg></a>
    <dialog closed id="modal-edit" >
        <form action="../../functions/adm/modificarInformacoes.php" method="POST" enctype="multipart/form-data">
            <div class="input-campo">
                <p>*Informações Barbeiro</p>
                <textarea name="informacoes_barbeiro" id="" cols="30" rows="10" value="" ><?php echo $informacoes['informacoes_barbeiro']; ?></textarea>
            </div>
            <div class="input-campo">
                <p>*Informações Barbearia</p>
                <textarea name="informacoes_barbearia" id="" cols="30" rows="10" value="" ><?php echo $informacoes['informacoes_barbearia']; ?></textarea>
            </div>
            
            <div class="btns-edit">
                <button type="submit">Atualizar</button>
                <button id="cancelar-edit" type="button">Voltar</button>
            </div>
        </form>
    </dialog>
    
    <script src="../../assets/js/modal-perfilEdit.js"></script>
</body>
</html>
                