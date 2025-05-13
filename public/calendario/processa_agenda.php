<?php

session_start();

require("../../config/conexao.php");
require("../../functions/helpers.php");

$dadosUsuario = dadosCliente($id_usuario);
$id_cliente = $dadosUsuario['id_cliente'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['dataAgendamento'] ?? '';
    $hora = $_POST['horaAgendamento'] ?? '';
    $servico = $_POST['servico'] ?? '';
    
    try {
        // Verifica se o horário ainda está disponível
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM agenda
                            WHERE data = ? AND hora = ?");
        $stmt->execute([$data, $hora]);
        $existe = $stmt->fetchColumn();
        
        if ($existe > 0) {
            throw new Exception("Este horário já foi reservado por outra pessoa.");
        }

        $sql = ("INSERT INTO cliente_servico (id_cliente, id_servico) VALUES($id_cliente, $servico");
        $stmt = $pdo->prepare($sql);

        
        // Insere o agendamento
        $stmt = $pdo->prepare("INSERT INTO cliente_servico (id_cliente, id_servico) VALUES (?, ?)");
        $stmt->execute([$id_cliente, $servico]);

        header('Location: ../user/agenda.php?sucesso=1');
        exit();
    } catch (Exception $e) {
        header('Location: ../user/agenda.php?erro=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>