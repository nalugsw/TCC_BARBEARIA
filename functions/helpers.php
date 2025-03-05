<?php

//RECUPERA OS DADOS DO CLIENTE

function dadosCliente($id_usuario){
    global $pdo;
    $sql = "SELECT CLIENTE.nome, CLIENTE.numero_telefone, USUARIO.email
            FROM CLIENTE
            JOIN USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
            WHERE USUARIO.id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//PEGA O DIA DA SEMANA

function DiaDaSemana($data) {

    $diaDaSemana = date('l', strtotime($data));
    $diasDaSemana = [
        'Sunday' => 'Domingo',
        'Monday' => 'Segunda feira',
        'Tuesday' => 'Terça feira',
        'Wednesday' => 'Quarta feira',
        'Thursday' => 'Quinta feira',
        'Friday' => 'Sexta feira',
        'Saturday' => 'Sábado'
    ];
    
    return $diasDaSemana[$diaDaSemana];
}

//FUNÇÃO DE VERIFICAR SESSÃO

function verificaSession($permissao){
    if(!isset($_SESSION['id_usuario'])){
        header("location: /TCC_BARBEARIA/index.php");
        exit();
    }
    if($_SESSION['tipo_usuario'] !== $permissao){
        header("location: /TCC_BARBEARIA/index.php");
        exit();
    }
}

//FUNÇÃO DE BUSCAR IMAGEM NO DATABASE

function buscaImagemUsuario($id_usuario){
    global $pdo;
    $sql = "SELECT foto FROM CLIENTE WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($imagem && !empty($imagem['foto'])) {
        return "uploads/fotos/" . $imagem['foto']; 

    }

    $sql = "SELECT foto FROM FUNCIONARIO WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($imagem && !empty($imagem['foto'])) {
        return "uploads/fotos/" . $imagem['foto']; 
    }
    return "assets/img/avatar-padrao.jpg"; // Retorna a imagem padrão se não tiver nenhuma de nenhum cliente ou funcionario
}

?>