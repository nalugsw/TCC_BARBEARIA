<?php

include("../../config/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'] ?? null;

    if ($acao == 'cadastro') {
        $nome = $_POST['nome'] ?? '';
        $duracao = $_POST['duracao'] ?? '';
        $valor = $_POST['valor'] ?? 0;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nomeImagem = $nome . '.' . $extensao;
            $caminhoRelativo = 'uploads/servicos/' . $nomeImagem;
            $caminhoDestino = '../../' . $caminhoRelativo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino)) {
                $stmt = $pdo->prepare("INSERT INTO servico (nome, duracao, valor, foto) VALUES (?, ?, ?, ?)");
                $stmt->execute([$nome, $duracao, $valor, $caminhoRelativo]);
                header("Location: ../../public/adm/servicos.php");
            }
        }
    }else if($acao == 'atualizacao'){
        $id = $_POST['id'] ?? null;

        if ($id) {
            try {
                $pdo->beginTransaction();

                $stmt = $pdo->prepare("SELECT * FROM servico WHERE id_servico = ?");
                $stmt->execute([$id]);
                $servicoAtual = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$servicoAtual) {
                    throw new Exception("Serviço não encontrado.");
                }

                $novoNome = $_POST['nome'] !== '' ? $_POST['nome'] : $servicoAtual['nome'];
                $novaDuracao = $_POST['duracao'] !== '' ? $_POST['duracao'] : $servicoAtual['duracao'];
                $novoValor = $_POST['valor'] !== '' ? floatval($_POST['valor']) : $servicoAtual['valor'];
                $novoCaminho = $servicoAtual['foto'];

                if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                    $nomeImagem = $novoNome . '.' . $extensao;
                    $novoCaminho = 'uploads/servicos/' . $nomeImagem;
                    $caminhoDestino = '../../' . $novoCaminho;

                    $imagemAntiga = '../../' . $servicoAtual['foto'];
                    if (file_exists($imagemAntiga)) {
                        unlink($imagemAntiga);
                    }

                    move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino);
                }

                $stmt = $pdo->prepare("UPDATE servico SET nome = ?, duracao = ?, valor = ?, foto = ? WHERE id_servico = ?");
                $stmt->execute([$novoNome, $novaDuracao, $novoValor, $novoCaminho, $id]);

                $pdo->commit();
                header("Location: ../../public/adm/servicos.php");
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Erro: " . $e->getMessage();
            }
        }
    }else if($acao == "excluirServico"){
        $id = $_POST['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("SELECT foto FROM servico WHERE id_servico = ?");
            $stmt->execute([$id]);
            $servico = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($servico) {
                $caminhoImagem = '../../'.$servico['foto'];
                if (file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }
                
                $stmt = $pdo->prepare("DELETE FROM servico WHERE id_servico = ?");
                $stmt->execute([$id]);

                header("Location: ../../public/adm/servicos.php");
                exit;
            } else {
                echo "Serviço não encontrado.";
            }
        }
    }
}
?>