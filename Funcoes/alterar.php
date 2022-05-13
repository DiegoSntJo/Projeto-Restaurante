<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

    include("../Class/conexao.php");

    $prato = $_GET["prato"];
    $descricao = $_GET["descricao"];
    $preco = $_GET["preco"];

    $codigo = $_GET["codigo"];

?>

    <script>
        function alerta(){
            resu = alert(msg);
            window.location = "../admin.php";
        }
    </script>

<?php

    $sql= "SELECT * FROM cardapio WHERE codigo ='$codigo'";
    $resultado= mysqli_query($db_conec,$sql);

    if(!empty($_GET["codigo"])){
        $query="UPDATE cardapio SET prato='".$prato."',descricao='".$descricao."',preco='".$preco."' WHERE codigo=".$codigo;
        $msg = "Falha ao alterar os dados.";
          ?><script>
                msg= "Prato editado com sucesso !";
                onload=alerta();
            </script><?php
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