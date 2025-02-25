<?php

include('config/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsividade.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                <div class="form">
                    <form action="functions/autenticacao.php">
                        <div class="input-container">
                            <label for="email">Email/Telefone</label>
                            <input type="text" id="email" name="email" placeholder="Digite seu email ou telefone" required>
                        </div>

                        <div class="input-container">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                        </div>
                    </form>
                </div>
                <div class="esqueceusenha">
                    <a href="#"><p>ESQUECEU SUA SENHA?</p></a>
                </div>
                <div class="btn-login">
                    <a href="#"><button>LOGIN</button></a>
                </div>
                <div class="esqueceusenha">
                    <a href="public/cadastro.php"><p>CADASTRAR CONTA</p></a>
                </div>
                <div class="termos">
                    <a href="#">TERMOS DE USO | POLÍTICA DE PRIVACIDADE</a>
                </div>
            </div>
                        
            <div class="img-login">
                <img src="assets/img/Group 132.png" alt="">
            </div>
        </section>
    </main>
</body>
</html>