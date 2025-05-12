<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recuperação de Senha</title>
  <link rel="stylesheet" href="../../assets/css/user/recuperacaoSenha.css" />
</head>
<body>

  <div class="container">
    <img src="../../assets/img/LOGO.png" alt="Logo" class="logo" />
    <div class="card">
      <h2>Recuperação de senha</h2>
      <p>Agora, insira o código que te enviamos por e-mail para criar uma nova senha.</p>

      <form action="../../functions/recuperacao_senha/verificaCodigo.php" method="POST">

        <div class="code-inputs">
          <input type="text" maxlength="1" name="letra1"/>
          <input type="text" maxlength="1" name="letra2"/>
          <input type="text" maxlength="1" name="letra3"/>
          <input type="text" maxlength="1" name="letra4"/>
          <input type="text" maxlength="1" name="letra5"/>
        </div>

        <button type="submit">Continuar</button>

      </form>

      <p class="login-link">Já possui cadastro? <a href="../../index.php">FAÇA SEU LOGIN</a></p> 
    </div>
  </div>

  <script src="../../assets/js/recuperacaoSenha.js"></script>
</body>
</html>
