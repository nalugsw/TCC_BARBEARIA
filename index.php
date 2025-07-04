<?php

session_start();
include('config/conexao.php');
// oii, 

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
    <title>Tela de login</title>
    <link rel="stylesheet" href="assets/css/user/style.css">
    <link rel="stylesheet" href="assets/css/user/responsividade.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="titulo-externo">
            <h1>Login</h1>
        </div>
            <section class="login">
                <div class="container">
                    <div class="img-login-mobile">
                        <img src="assets/img/img-login-mobile.png" alt="">
                    </div>
                    <div class="titulo">
                        <h1>Seja bem vindo!</h1>
                    </div>
                    <?php if (!empty($mensagemErro)): ?>
                    <div class="error-box">
                        <div class="icon">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <div class="txt-error">
                        
                            <p><?php 
                            echo htmlspecialchars($mensagemErro);
                            unset($mensagemErro);
                            ?></p>
        
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="correct-box">
                        <div class="icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="txt-correct">
                            <p>Usuário cadastrado com sucesso! Parabéns!</p>
                        </div>
                    </div>
                    <div class="form">
                        <form action="functions/autenticacao.php" method="POST">
                            <div class="input-container">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required placeholder="Digite seu email ou telefone" >
                            </div>

                            <div class="input-container">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" name="senha" required  placeholder="Digite sua senha" >
                            </div>
                            <div class="esqueceusenha">
                                <a href="public/user/redefinicaoSenha.html"><p>ESQUECEU SUA SENHA?</p></a>
                            </div>
                            <div class="btn-login">
                                <button type="submit">LOGIN</button>
                            </div>
                            <div class="esqueceusenha">
                                    <a href="public/user/cadastro.php"><p>CADASTRAR CONTA</p></a>
                            </div>
                            <div class="termos">
                                    <a href="./public/user/politicasPrivacidade.html">TERMOS DE USO | POLÍTICA DE PRIVACIDADE</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="img-login">
                    <img src="assets/img/Group 132.png" alt="">
                </div>
            </section>
    </main>
    <script src="assets/js/caixa-erros.js"></script>
</body>

</html>