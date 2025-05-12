<?php

$id_usuario = $_SESSION['id_usuario'];

//CAMINHO ABSOLUTO DE PASTAS E ARQUIVOS

define("BASE_URL", "http://localhost/TCC_BARBEARIA/");

//RECUPERA OS DADOS DO CLIENTE

function dadosCliente($id_usuario){
    global $pdo;
    $sql = "SELECT CLIENTE.id_cliente, CLIENTE.nome, CLIENTE.numero_telefone, USUARIO.email
            FROM CLIENTE
            JOIN USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
            WHERE USUARIO.id_usuario = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//RECUPERA OS DADOS DO FUNCIONARIO

function dadosFuncionario(){
    global $pdo;
    $sql = "SELECT * FROM funcionario";
    $stmt = $pdo->prepare($sql);
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

//FUNÇÃO DE VERIFICAR SESSÃO ATIVA E SE O USUARIO PODE USAR A TELA

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

function enviarEmail($email, $assunto, $mensagem, $cabecalho){
    return mail($email, $assunto, $mensagem, $cabecalho);
}

?>