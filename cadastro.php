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
    <title>Cadastro  - Coco Jambo Restaurante</title>
</head>
<body>
    <header></header>

    <!-- CADASTRO --> 
    <section>

        <!-- FORM DE CADASTRO -->
        <div>
            <h2>Cadastrar</h2>
            <form method="POST">
                <input type="text" name="usuario" placeholder="Usuário" maxlength="40" autocomplete="off" required><br>
                <input type="password" name="senha" placeholder="Senha" maxlength="15"><br>
                <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15"><br>
                <input type="submit" value="CADASTRAR">
            </form>
        </div>

        <!-- AVISO -->
        <div>
            <p>Já tem cadastro ? <a href="login.php">Clique aqui !</a></p>
        </div>

        <?php
            //Verificar se clicou no botao
            if(isset($_POST['usuario'])){
                $usuario = addslashes($_POST['usuario']);
                $senha = addslashes($_POST['senha']);
                $confirmarSenha = addslashes($_POST['confSenha']);
                //verificar se esta preenchido
                if(!empty($usuario) && !empty($senha) && !empty($confirmarSenha)){
                        $u->conectar("cj_usuarios","localhost","root","");
                        if($u->msgErro == "")//esta tudo ok
                        {
                            if($senha == $confirmarSenha){
                                if($u->cadastrar($usuario,$senha)){
                                    ?>
                                    <div id="msg-sucesso"> Cadastrado com sucesso ! Acesse para entrar !</div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="msg-erro"> Usuario já cadastrado !</div>
                                    <?php
                                }
                        }
                        else{
                            ?>
                            <div class="msg-erro"> Senha e confirmar senha não correspondem !</div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="msg-erro"><?phpecho "Erro: ".$u->$msgErro;?></div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="msg-erro"> Preencha todos os campos !</div>
                    <?php
                }
            }
        ?>
    </section>
</body>
</html>