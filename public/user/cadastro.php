<?php

session_start();
include("../../config/conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="../../assets/css/cadastro.css">
    <link rel="stylesheet" href="../../assets/css/cadastro-responsividade.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="titulo-externo">
            <h1>Cadastrar</h1>
        </div>
        <section class="login">
            <div class="container">
                <div class="img-login-mobile">
                    <img src="../../assets/img/img-login-mobile.png" alt="">
                </div>
                <div class="titulo">
                    <h1>Cadastre-se</h1>
                </div>
                <div class="form">
                    <form action="../../functions/cadastro.php" method="POST">
                        <label for="nome">Nome</label>
                        <input type="text" placeholder="NOME" id="nome" name="nome" required>

                        <label for="numero_telefone">Número de telefone</label>
                        <input type="" placeholder="NUMERO DE TELEFONE" id="numero_telefone" name="numero_telefone" maxlength="11" required>

                        <label for="email">Email</label>
                        <input type="text" placeholder="EMAIL" id="email" name="email" required>
                            
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="SENHA" id="senha" name="senha" minlength="8" required>
                    
                        </div>
                        <div class="termos">
                            <a href="#">POLITICAS DE PRIVACIDADE</a>
                        </div>
                        <div class="btn-login">
                            <a ><button type="submit">CADASTRAR</button></a>
                        </div>
                        <div class="esqueceusenha">
                            <a href="../../index.php"><p>JÁ TEM UMA CONTA? FAÇA SEU LOGIN AQUI!</p></a>
                        </div>
                        <div class="voltar">
                            <a href="../../index.php"><p>VOLTAR</p></a>
                        </div>
                    </form>
            <!-- TESTE       -->
            </div>
            <div class="img-login">
                <img src="../../assets/img/Group 132.png" alt="">
            </div>
        </section>
    </main>
</body>
</html>

<!-- teste branch DevNalu -->
 <!-- teste branch DevMarcus -->
  <!-- teste branch DevMurilo  -->
   <!-- aaaaaaaaaaaa vai pf
    quero pegar o murilo bigode 
    Carlinhos ta mamando 333 cavalos-->
    <!-- devDudu chegou tropinha -->
     