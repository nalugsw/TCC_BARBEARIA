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

?>