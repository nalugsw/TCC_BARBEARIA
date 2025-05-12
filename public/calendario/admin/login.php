<?php
session_start();
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM administradores WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($senha, $admin['senha'])) {
            $_SESSION['admin_logado'] = true;
            header('Location: painel.php');
            exit();
        } else {
            $erro = "Usuário ou senha incorretos!";
        }
    } catch (PDOException $e) {
        $erro = "Erro ao verificar credenciais: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Login Administrativo</h1>
        
        <?php if (isset($erro)): ?>
            <div class="mensagem erro"><?= $erro ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>