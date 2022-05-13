<?php
     require_once 'Class/usuarios.php';
     $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login  - Coco Jambo Restaurante</title>
</head>
<body>
    <header></header>

    <!-- LOGIN  -->
    <section>

        <!-- FORM DE LOGIN  -->
        <div>
            <h2>Entrar</h2>
            <form method="POST">
                <input type="text" name="usuario" placeholder="Usuário" maxlength="40" autocomplete="off" required><br>
                <input type="password" name="senha" placeholder="Senha" maxlength="15" required><br>
                <input type="submit" value="ACESSAR">
            </form>
        </div>
    
        <!-- CONEXÃO COM DB --> 
        <?php
        if(isset($_POST['usuario'])){
          $usuario = addslashes($_POST['usuario']);
          $senha = addslashes($_POST['senha']);
          //verificar se esta preenchido
          if(!empty($usuario) && !empty($senha)){
            $u->conectar("cj_usuarios","localhost","root","");
            if($u->msgErro == ""){
              if($u->logar($usuario,$senha)){
                if($usuario == "Adm"){
                  header("location: admin.php");
                }else{
                  header("location: funcionario.php");
                }
              }
              else{
                ?>
                  <div class="msg-erro"> Usuário e/ou senha estão incorretos!</div>
                <?php
              }
            }
            else{
              ?>
                <div class="msg-erro"><?phpecho "Erro: ".$u->$msgErro;?></div>
              <?php
            }
          }
          else{
            ?>
              <div class="msg-erro">Preencha todos os campos !</div>
            <?php
          }
        }
      ?>

    </section>
</body>
</html>