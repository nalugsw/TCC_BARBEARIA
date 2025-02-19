<?php

// Conecta com o banco de dados

$banco = 'barbearia';
$usuario = 'root';
$senha = '';
$servidor = 'localhost';

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' . $e;
}

?>