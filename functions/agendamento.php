<?php

require_once("helpers.php");
global $pdo;

function mostrarAgendamentos($id_usuario, $pdo){
    $sql = "SELECT 
    AGENDA.id_agenda,
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
        USUARIO ON CLIENTE.id_usuario = USUARIO.id_usuario
    LEFT JOIN    -- ALTERADO AQUI
    FUNCIONARIO ON AGENDA.id_funcionario = FUNCIONARIO.id_funcionario
    WHERE 
        USUARIO.id_usuario = :id_usuario AND agenda.status_agenda = 'pendente'";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//MOSTRAR AGENDA DO FUNCIONÁRIO

function buscarAgendamentosPorFuncionario($id_funcionario, $pdo) {
    $sql = "
        SELECT 
            a.id_agenda,
            c.nome AS nome_cliente,
            c.numero_telefone,
            s.nome AS servico,
            a.horario,
            a.data,
            c.foto AS foto_cliente
        FROM AGENDA a
        JOIN CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
        JOIN CLIENTE c ON cs.id_cliente = c.id_cliente
        JOIN SERVICO s ON cs.id_servico = s.id_servico
        WHERE a.id_funcionario = :id_funcionario AND status_agenda = 'pendente'
        ORDER BY a.data, a.horario
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>