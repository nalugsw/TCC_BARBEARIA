<?php
session_start();
require_once '../includes/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header('Location: login.php');
    exit();
}

// Processa marcação de dias inativos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data_inativa'])) {
    $data = $_POST['data_inativa'];
    $motivo = $_POST['motivo'] ?? '';
    
    try {
        $stmt = $pdo->prepare("INSERT INTO dias_inativos (data_inativa, motivo) VALUES (?, ?)");
        $stmt->execute([$data, $motivo]);
        $mensagem = "Dia marcado como inativo com sucesso!";
    } catch (PDOException $e) {
        $erro = "Erro ao marcar dia como inativo: " . $e->getMessage();
    }
}

// Busca dias já marcados como inativos
$stmt = $pdo->query("SELECT * FROM dias_inativos ORDER BY data_inativa DESC");
$diasInativos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Painel Administrativo</h1>
        
        <?php if (isset($mensagem)): ?>
            <div class="mensagem sucesso"><?= $mensagem ?></div>
        <?php endif; ?>
        
        <?php if (isset($erro)): ?>
            <div class="mensagem erro"><?= $erro ?></div>
        <?php endif; ?>
        
        <h2>Marcar Dia como Inativo</h2>
        <form method="post">
            <div class="form-group">
                <label for="data_inativa">Data:</label>
                <input type="date" id="data_inativa" name="data_inativa" required>
            </div>
            
            <div class="form-group">
                <label for="motivo">Motivo (opcional):</label>
                <input type="text" id="motivo" name="motivo">
            </div>
            
            <button type="submit">Marcar como Inativo</button>
        </form>
        
        <h2>Dias Inativos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Motivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diasInativos as $dia): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($dia['data_inativa'])) ?></td>
                        <td><?= htmlspecialchars($dia['motivo']) ?></td>
                        <td>
                            <a href="marca_inativo.php?acao=remover&id=<?= $dia['id'] ?>" 
                               onclick="return confirm('Tem certeza que deseja remover este dia inativo?')">
                                Remover
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <p><a href="../index.php">Voltar para o site</a> | <a href="logout.php">Sair</a></p>
    </div>
</body>
</html>