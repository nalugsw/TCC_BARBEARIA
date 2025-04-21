<?php
session_start();
include("../../config/conexao.php");

// Verificação inicial dos campos
if(!isset($_POST['email']) || !isset($_POST['senha'])) {
    $_SESSION['erro'] = "Requisição inválida. O formulário não foi submetido corretamente.";
    header("Location: ../../index.php");
    exit();
}

$email = trim($_POST['email']);
$senha = $_POST['senha'];

// Validações específicas
if(empty($email) && empty($senha)) {
    $_SESSION['erro'] = "Por favor, preencha todos os campos.";
} elseif(empty($email)) {
    $_SESSION['erro'] = "O campo email é obrigatório.";
} elseif(empty($senha)) {
    $_SESSION['erro'] = "O campo senha é obrigatório.";
}

// Se houve erro nas validações básicas, redireciona
if(isset($_SESSION['erro'])) {
    header("Location: ../../index.php");
    exit();
}

// Validação do formato do email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Por favor, informe um email válido.";
    header("Location: ../../index.php");
    exit();
}

// Consulta ao banco de dados (apenas por email)
$query = "SELECT * FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$usuario) {
    $_SESSION['erro'] = "Email não cadastrado. Verifique ou crie uma conta.";
    header("Location: ../../index.php");
    exit();
}

// Verificação de conta ativa (se aplicável)
if(isset($usuario['ativo']) && $usuario['ativo'] == 0) {
    $_SESSION['erro'] = "Sua conta está inativa. Por favor, contate o suporte.";
    header("Location: ../../index.php");
    exit();
}

// Verificação de senha
if(!password_verify($senha, $usuario['senha'])) {
    $_SESSION['erro'] = "Senha incorreta. Tente novamente.";
    
    // Controle de tentativas (opcional)
    if(!isset($_SESSION['tentativas_login'])) {
        $_SESSION['tentativas_login'] = 1;
    } else {
        $_SESSION['tentativas_login']++;
    }
    
    header("Location: ../../index.php");
    exit();
}

// Login bem-sucedido
unset($_SESSION['tentativas_login']); // Reseta tentativas
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
header("Location: ../../public/user/perfil.php");
exit();
?>