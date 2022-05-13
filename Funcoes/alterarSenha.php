<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

    include("../Class/usuarios.php");

    $novaSenha = $_POST["novaSenha"];
    $confSenha = $_POST["confSenha"];
    $antigaSenha = $_POST["antigaSenha"];

    $codigo = $_POST["codigo_usuario"];

    $sql= "SELECT * FROM usuarios WHERE id_usuario ='$codigo'";
    $resultado= mysqli_query($db_conec_users,$sql);

    //verificar se esta preenchido
    if(!empty($novaSenha) && !empty($confSenha)){
        if($novaSenha == $confSenha){
            if(md5($novaSenha) == $antigaSenha){
                ?><script>msg = "Use uma senha que não esteja em uso !";</script><?php
            }else{
                $query="UPDATE usuarios SET senha='". md5($novaSenha) ."' WHERE id_usuario=".$codigo;
                ?><script> msg = "Cadastrado com sucesso ! Acesse para entrar !"</script><?php
            }
        }else{
            ?><script>msg = "Senha e confirmar senha não correspondem !";</script><?php
        } 
    }else{
        ?><script>msg = "Preencha todos os campos !";</script><?php
    }

    $res = mysqli_query($db_conec_users, $query);
?>

    <script>
        onload=alerta();
        function alerta(){
            alert(msg);
            window.location = "../admin.php";
        }
    </script>