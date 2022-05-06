<?php
session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Coco Jambo Restaurante</title>
</head>

<script>
    function sair(){
        res = confirm("Tem certeza que deseja sair ?");
        if(res){
            window.location = "sair.php";
        }
    }
</script>

<body>
    <header>
        <input type="button" class="sidenav-close btn-sair" value="Sair" onclick="sair()">
    </header>
    <section>

    </section>
</body>
</html>