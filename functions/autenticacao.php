<?php
@session_start();
require_once("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "SELECT * from usuario where email = :email and senha = :senha";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
    $ativo = $res[0]['status'];

    if($ativo == 'verificado'){
        $_SESSION['id_usuario'] = $res[0]['id_usuario'];
        $_SESSION['tipo_usuario'] = $res[0]['tipo_usuario'];
        $_SESSION['nome'] = $res[0]['nome'];
        echo "<script>window.location='../public/perfil.php'</script>";
    }else{
        $_SESSION['erro'] = "Usuário desativado. Contate o administrador";
        header("Location: ../public/index.php");
        exit();
    }
}else{
    $_SESSION['erro'] = "Usuário ou senha incorretos.";
    header("Location: ../public/index.php");
    exit();
}

?>