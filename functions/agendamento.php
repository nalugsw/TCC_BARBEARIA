<?php

function mostrarAgendamentos($id_usuario, $pdo){
    $sql = "SELECT 
    CLIENTE.nome AS nome,
    SERVICO.nome AS servico,
    AGENDA.data AS data,
    AGENDA.horario AS horario,
    FUNCIONARIO.nome AS funcionario
    FROM 
        AGENDA
    JOIN 
        CLIENTE_SERVICO ON AGENDA.id_cliente_servico = CLIENTE_SERVICO.id_cliente_servico
    JOIN 
        CLIENTE ON CLIENTE_SERVICO.id_cliente = CLIENTE.id_cliente
    JOIN 
        SERVICO ON CLIENTE_SERVICO.id_servico = SERVICO.id_servico
    JOIN 
        FUNCIONARIO ON AGENDA.id_funcionario = FUNCIONARIO.id_funcionario
    JOIN 
        USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
    WHERE 
        USUARIO.id_usuario = :id_usuario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>