<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("location: index.php");
    exit;
}

require_once 'Class/usuarios.php';
$u = new Usuario;

if(isset($_POST['usuario'])){
    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    //verificar se esta preenchido
    if(!empty($usuario) && !empty($senha) && !empty($confirmarSenha)){
        $u->conectar("cj_usuarios","localhost","root","");
            if($u->msgErro == ""){ //esta tudo ok
                if($senha == $confirmarSenha){
                    if($u->cadastrar($usuario,$senha)){
                        ?><script> msg = "Cadastrado com sucesso ! Acesse para entrar !"</script><?php
                    }else{
                        ?><script>msg = "Usuario já cadastrado !";</script><?php
                    }
                }else{
                    ?><script>msg = "Senha e confirmar senha não correspondem !";</script><?php
                }
            }else{
                ?><script>msg = "Erro: "<?.$u->$msgErro;?></script><?php
            }
    }else{
        ?><script>msg = "Preencha todos os campos !";</script><?php
    }
}


?>

<script>
    onload=alerta();
    function alerta(){
        alert(msg);
        window.location = "admin.php";
    }
</script>