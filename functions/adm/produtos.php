<?php

session_start();
include('../../config/conexao.php');
$acao = $_POST['acao'];

if ($acao == 'atualizarStatus') {
    $id = $_POST['id_produto'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE produto SET status_produto = ? WHERE id_produto = ?");
    if ($stmt->execute([$status, $id])) {
        header("Location: ../../public/adm/produtos.php?msg=atualizado");
    } else {
        header("Location: ../../public/adm/produtos.php?msg=erro");
    }
    exit;
}else if($acao == 'editarProduto'){
    if (isset($_POST['id_produto']) && !empty($_POST['id_produto'])) {
        $id = $_POST['id_produto'];
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco = $_POST['valor'] ?? 0;


        if (!empty($_FILES['foto']['name'])) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nomeFoto = $nome . '.' . $extensao;
            $caminhoFoto = 'uploads/produtos/' . $nomeFoto;

            $destino = '../../' . $caminhoFoto;
            move_uploaded_file($_FILES['foto']['tmp_name'], $destino);
        } else {
            $stmt = $pdo->prepare("SELECT foto FROM produto WHERE id_produto = ?");
            $stmt->execute([$id]);
            $caminhoFoto = $stmt->fetchColumn();
        }

        $sql = "UPDATE produto SET nome = ?, descricao = ?, preco = ?, foto = ? WHERE id_produto = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $caminhoFoto, $id]);

        header("Location: ../../public/adm/produtos.php");
        exit;
    }
}else if($acao == 'excluirProduto'){
    $id = $_POST["id_produto"];

    $sql = $pdo->prepare("SELECT foto FROM produto WHERE id_produto = ?");
    $sql->execute([$id]);
    $produto = $sql->fetch(PDO::FETCH_ASSOC);

    if ($produto && file_exists("../../" . $produto["foto"])) {
        unlink("../../" . $produto["foto"]);
    }

    $sql = $pdo->prepare("DELETE FROM produto WHERE id_produto = ?");
    $sql->execute([$id]);

    header("Location: ../../public/adm/produtos.php");
    exit;

}else if($acao == 'adicionarProduto'){

        $nome = trim($_POST['nome']);
        $descricao = trim($_POST['descricao']);
        $valor = floatval($_POST['valor']);

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid('produto_') . "." . $extensao;
            $caminhoFinal = "../../uploads/produtos/" . $nomeArquivo;
            $caminhoDB = "uploads/produtos/" . $nomeArquivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFinal)) {
                $stmt = $pdo->prepare("INSERT INTO produto (nome, descricao, preco, foto, status_produto) VALUES (?, ?, ?, ?, 'ativo')");
                $stmt->execute([$nome, $descricao, $valor, $caminhoDB]);

                header("Location: ../../public/adm/produtos.php");
                exit;
            } else {
                header("Location: ../../public/adm/produtos.php?msg=erro_upload");
            }
        } else {
            header("Location: ../../public/adm/produtos.php?msg=erro_imagem");
        }

}

?>