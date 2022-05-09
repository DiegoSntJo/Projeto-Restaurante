<?php
    session_start();
    include("../Class/conexao.php");

    $combo = $_GET["combo"];
    $descricao = $_GET["descricao"];
    $preco = $_GET["preco"];

    $codigo = $_GET["codigo_combo"];

?>

    <script>
        function alerta(){
            resu = alert(msg);
            window.location = "../admin.php";
        }
    </script>

<?php

    $sql= "SELECT * FROM combos WHERE codigo ='$codigo'";
    $resultado= mysqli_query($db_conec,$sql);

    if(!empty($_GET["codigo_combo"])){
        $query="UPDATE combos SET combo='".$combo."',descricao='".$descricao."',preco='".$preco."' WHERE codigo=".$codigo;
        $msg = "Falha ao alterar os dados.";
?>
    <script>
        msg= "Combo editado com sucesso !";
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