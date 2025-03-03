<?php

@session_start();
if($_SESSION['id_usuario'] == ""){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>