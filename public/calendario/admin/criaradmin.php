<?php


$usuario = 'quati'; // Substitua pelo nome de usuário desejado
$senha_plana = '123'; // Substitua pela senha desejada

// Gera o hash da senha
$senha_hash = password_hash($senha_plana, PASSWORD_BCRYPT);

// Mostra o SQL para inserção
echo "INSERT INTO administradores (usuario, senha) VALUES ('$usuario', '$senha_hash');";

// Ou execute diretamente no banco (descomente as linhas abaixo)
/*
require_once 'includes/config.php';
$stmt = $pdo->prepare("INSERT INTO administradores (usuario, senha) VALUES (?, ?)");
$stmt->execute([$usuario, $senha_hash]);
echo "Administrador criado com sucesso!";
*/
?>