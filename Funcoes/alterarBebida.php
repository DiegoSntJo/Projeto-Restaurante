<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

    include("../Class/conexao.php");

    $bebida = $_GET["bebida"];
    $descricao = $_GET["descricao"];
    $preco = $_GET["preco"];

    $codigo = $_GET["codigo_bebida"];

?>

    <script>
        function alerta(){
            resu = alert(msg);
            window.location = "../admin.php";
        }
    </script>

<?php

    $sql= "SELECT * FROM bebidas WHERE codigo ='$codigo'";
    $resultado= mysqli_query($db_conec,$sql);

    if(!empty($_GET["codigo_bebida"])){
        $query="UPDATE bebidas SET bebida='".$bebida."',descricao='".$descricao."',preco='".$preco."' WHERE codigo=".$codigo;
        $msg = "Falha ao alterar os dados.";
?>
    <script>
        msg= "Bebida editada com sucesso !";
        onload=alerta();
    </script>
<?php
    }else{
        die ("Falha !");
    }

    echo $query;
    $res = mysqli_query($db_conec, $query);

    if(!$res){
        echo $msg;
    }else{
?>
    <script>
        onload=alerta();
    </script>
<?php
    }