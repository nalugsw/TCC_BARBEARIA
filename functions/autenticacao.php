<?php
@session_start();
require_once("conexao.php");


$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->query("SELECT * from usuario where email = '$email' and senha = '$senha'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);