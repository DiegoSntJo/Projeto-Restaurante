<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

    include ("../Class/usuarios.php");

    $codigo = $_GET["codigo"];

    $query = "DELETE FROM usuarios WHERE id_usuario =". $codigo;
    $res = mysqli_query($db_conec_users, $query);

    if(!$res){
        echo "Falha ao Excluir.";
    }else{
        header('Location: ../admin.php');
    }