<?php
session_start();
include("../config/conexao.php");

if(!isset($_POST['email']) || !isset($_POST['senha'])) {
    $_SESSION['erro'] = "Requisição inválida. O formulário não foi submetido corretamente.";
    header("Location: ../index.php");
    exit();
}

$email = trim($_POST['email']);

$senha = $_POST['senha'];

if(empty($email) && empty($senha)) {
    $_SESSION['erro'] = "Por favor, preencha todos os campos.";
} elseif(empty($email)) {
    $_SESSION['erro'] = "O campo email é obrigatório.";
} elseif(empty($senha)) {
    $_SESSION['erro'] = "O campo senha é obrigatório.";
}

if(isset($_SESSION['erro'])) {
    header("Location: ../index.php");
    exit();
}


if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Por favor, informe um email válido.";
    header("Location: ../index.php");
    exit();
}

$query = "SELECT * FROM usuario WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$usuario) {
    $_SESSION['erro'] = "Email não cadastrado. Verifique ou crie uma conta.";
    header("Location: ../index.php");
    exit();
}

if(isset($usuario['ativo']) && $usuario['ativo'] == 0) {
    $_SESSION['erro'] = "Sua conta está inativa. Por favor, contate o suporte.";
    header("Location: ../index.php");
    exit();
}

if(!password_verify($senha, $usuario['senha'])) {
    $_SESSION['erro'] = "Email ou senha estão incorretos. Tente novamente.";
    
    // Controle de tentativas (opcional)
    // if(!isset($_SESSION['tentativas_login'])) {
    //     $_SESSION['tentativas_de_login'] = 1;
    // } else {
    //     $_SESSION['tentativas_de_login']++;
    // }
    
    header("Location: ../index.php");
    exit();
}

// ARMAZENA DADOS NA SESSAO PARA O USUARIO ACESSAR AS TELAS
unset($_SESSION['tentativas_login']); 
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
if($_SESSION['tipo_usuario'] == 'cliente'){
    header("Location: ../public/user/perfil.php");
    exit();
}else if($_SESSION['tipo_usuario'] == 'funcionario'){
    header("Location: ../public/funcionario/horarios.php");
    exit();
}else if($_SESSION['tipo_usuario'] == 'administrador'){
    header("Location: ../public/adm/horarios.php");
    exit();
}else{
    $_SESSION['erro'] = "Tipo de usuário inválido.";
    header("Location: ../index.php");
    exit();
}
?>