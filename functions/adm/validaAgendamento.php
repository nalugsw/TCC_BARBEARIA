<?php

if($REQUEST_METHOD == 'POST'){
    if($acao == 'finalizado'){
        $sql = "UPDATE agenda SET status = 'finalizado' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("location: ../../public/adm/horarios.php");
        exit();
    }else if($acao == 'cancelado'){
        $sql = "UPDATE agenda SET status = 'cancelado' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("location: ../../public/adm/horarios.php");
        exit();
    }else{
        $sql = "UPDATE agenda SET status = 'pendente' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("location: ../../public/adm/horarios.php");
        exit();
    }
}
?>