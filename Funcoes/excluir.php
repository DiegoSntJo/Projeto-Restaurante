<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

    include ("../Class/conexao.php");

    $codigo = $_GET["codigo"];

    $query = "DELETE FROM cardapio WHERE codigo =". $codigo;
    $res = mysqli_query($db_conec, $query);

    if(!$res){
        echo "Falha ao Excluir.";
    }else{
        header('Location: ../admin.php');
    }