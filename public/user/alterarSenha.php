<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Redefinição de Senha</title>
  <link rel="stylesheet" href="../../assets/css/user/redefinicaoSenha.css" />
</head>
<body>
  <div class="container">
    <img src="../../assets/img/LOGO.png" alt="Logo BarberTech" class="logo" />
    <div class="card">
      <h2> Alteração de senha</h2>
      <p>Sua senha deve ter pelo menos 8 caracteres.</p>
      <form action="../../functions/recuperacao_senha/trocaSenha.php" method="POST">
        <input type="password" placeholder="Senha" class="input" name="senha" />
        <input type="password" placeholder="Digite novamente" class="input" name="mesmaSenha"/>
        <button class="btn" type="submit">ALTERAR</button>
      </form>
      <p class="login-link">Já possui cadastro? <a href="../../index.php">FAÇA SEU LOGIN</a></p>
    </div>
  </div>
</body>
</html>
