<?php
include("../../config/conexao.php");
session_start();
require_once("../../functions/helpers.php");
verificaSession("administrador");

header('Content-Type: application/json');

// Parâmetros da paginação
$pagina = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$porPagina = 15;
$offset = ($pagina - 1) * $porPagina;

// Verifica se há termo de busca
$termoBusca = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = '';
$params = [];

if (!empty($termoBusca)) {
    $where = 'WHERE nome LIKE :termo';
    $params[':termo'] = '%' . $termoBusca . '%';
}
$sql = " SELECT 
    C.id_cliente, 
    C.nome, 
    C.foto, 
    C.numero_telefone, 
    U.email 
FROM CLIENTE C
INNER JOIN USUARIO U ON C.id_usuario = U.id_usuario
$where
ORDER BY C.nome
LIMIT :offset, :porPagina
";

$stmt = $pdo->prepare($sql);

foreach ($params as $key => &$val) {
    $stmt->bindParam($key, $val);
}

$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para contar o total de clientes (para paginação)
$sqlCount = "SELECT COUNT(*) as total FROM CLIENTE $where";
$stmtCount = $pdo->prepare($sqlCount);

foreach ($params as $key => &$val) {
    $stmtCount->bindParam($key, $val);
}

$stmtCount->execute();
$totalClientes = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalClientes / $porPagina);

// Retorna os dados em JSON
echo json_encode([
    'clientes' => $clientes,
    'paginaAtual' => $pagina,
    'totalPaginas' => $totalPaginas,
    'totalClientes' => $totalClientes
]);
?>