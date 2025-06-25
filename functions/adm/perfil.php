<?php
include("../../config/conexao.php");
session_start();

if (!isset($_POST['acao'])) {
    die("Ação inválida.");
}

$acao = $_POST['acao'];

switch ($acao) {
    case "atualizarPerfil":
        atualizarPerfil($pdo);
        break;

    case "adicionarImagem":
        adicionarImagemPortfolio($pdo);
        break;

    case "deletarPortfolio":
        deletarImagemPortfolio($pdo);
        break;

    default:
        echo "Ação não reconhecida.";
        break;
}

function atualizarPerfil($pdo) {
    $nome = $_POST['nome'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $id_usuario = $_SESSION['id_usuario']; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $caminhoDestino = 'uploads/fotos/funcionario/';
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = $id_usuario . '.' . $extensao;
        $caminhoCompleto = $caminhoDestino . $nomeArquivo;

        move_uploaded_file($_FILES['foto']['tmp_name'], "../../" . $caminhoCompleto);

        $sqlFoto = "UPDATE funcionario SET foto = :foto WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sqlFoto);
        $stmt->execute(['foto' => $caminhoCompleto, 'id' => $id_usuario]);
    }

    $stmt = $pdo->prepare("UPDATE funcionario SET nome = :nome WHERE id_usuario = :id");
    $stmt->execute(['nome' => $nome, 'id' => $id_usuario]);

    $stmt = $pdo->prepare("UPDATE INFORMACOES SET endereco = :endereco WHERE id_informacoes = 1");
    $stmt->execute(['endereco' => $endereco]);

    header("Location: ../../public/adm/perfil.php");
    exit();
}

function adicionarImagemPortfolio($pdo) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $caminhoDestino = 'uploads/portfolio/';
        $nomeArquivo = uniqid() . "_" . $_FILES['foto']['name'];
        $caminhoCompleto = $caminhoDestino . $nomeArquivo;

        move_uploaded_file($_FILES['foto']['tmp_name'], "../../" . $caminhoCompleto);

        $stmt = $pdo->prepare("INSERT INTO portfolio (imagem) VALUES (:imagem)");
        $stmt->execute(['imagem' => $caminhoCompleto]);

        header("Location: ../../public/adm/perfil.php");
        exit();
    } else {
        echo "Erro ao enviar imagem.";
    }
}

function deletarImagemPortfolio($pdo) {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        echo "ID da imagem não especificado.";
        exit();
    }

    $stmt = $pdo->prepare("SELECT imagem FROM portfolio WHERE id_portfolio = :id");
    $stmt->execute(['id' => $id]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($imagem) {
        $caminhoImagem = "../../" . $imagem['imagem'];
        if (file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }

        $stmt = $pdo->prepare("DELETE FROM portfolio WHERE id_portfolio = :id");
        $stmt->execute(['id' => $id]);

        header("Location: ../../public/adm/perfil.php");
        exit();
    } else {
        echo "Imagem não encontrada.";
    }
}
