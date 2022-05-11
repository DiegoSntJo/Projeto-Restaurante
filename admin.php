<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("location: index.php");
    exit;
}

include("Class/conexao.php");
include("Class/usuarios.php");


$sql_query = $mysqli->query("SELECT * FROM cardapio") or die ($mysqli->error);
$sql_query_usuarios = $mysqli_users->query("SELECT * FROM usuarios") or die ($mysqli->error);
$sql_query_bebidas = $mysqli->query("SELECT * FROM bebidas") or die ($mysqli->error);
$sql_query_combos = $mysqli->query("SELECT * FROM combos") or die ($mysqli->error);

if (!empty($_GET["codigo"])){
    $res = mysqli_query($db_conec, "SELECT * FROM cardapio WHERE codigo= " . $_GET["codigo"]);
    $linha = mysqli_fetch_row($res);
    $codigo = $linha[0];
    $prato = $linha[1];
    $preco = $linha[2];
    $nome = $linha[3];
    $path = $linha[4];
    $descricao = $linha[5];
}else{
    $codigo = "";
    $prato = "";
    $preco = "";
    $nome = "";
    $path = "";
    $descricao = "";
}

if (empty($_GET["codigo_usuario"])){
    $res = mysqli_query($db_conec_users, "SELECT * FROM usuarios");
    $linha = mysqli_fetch_row($res);
    $codigoUsuario = $linha[0];
    $usuario = $linha[1];
    $antigaSenha = $linha[2];
}else{
    $codigoUsuario = "";
    $usuario = "";
    $antigaSenha = "";
}

if (!empty($_GET["codigo_bebida"])){
    $res = mysqli_query($db_conec, "SELECT * FROM bebidas WHERE codigo= " . $_GET["codigo_bebida"]);
    $linha = mysqli_fetch_row($res);
    $codigoBebida = $linha[0];
    $bebida = $linha[1];
    $precoBebida = $linha[2];
    $nomeBebida = $linha[3];
    $pathBebida = $linha[4];
    $descricaoBebida = $linha[5];
}else{
    $codigoBebida = "";
    $bebida = "";
    $precoBebida = "";
    $nomeBebida = "";
    $pathBebida = "";
    $descricaoBebida = "";
}

if (!empty($_GET["codigo_combo"])){
    $res = mysqli_query($db_conec, "SELECT * FROM combos WHERE codigo= " . $_GET["codigo_combo"]);
    $linha = mysqli_fetch_row($res);
    $codigoCombo = $linha[0];
    $combo = $linha[1];
    $precoCombo = $linha[2];
    $nomeCombo = $linha[3];
    $pathCombo = $linha[4];
    $descricaoCombo = $linha[5];
}else{
    $codigoCombo = "";
    $combo = "";
    $precoCombo = "";
    $nomeCombo = "";
    $pathCombo = "";
    $descricaoCombo = "";
}

if(isset($_FILES['arquivo'])){
    
    $arquivo = $_FILES['arquivo'];
    $prato = $_POST['prato'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    echo "Arquivo enviado !";

    $pasta = "Midia/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png')
        die("Tipo de arquivo não aceito");

    $path = $pasta.$novoNomeDoArquivo.".".$extensao;    
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);

    if($deu_certo){
        $mysqli->query("INSERT INTO cardapio (nome,path,prato,descricao,preco) VALUES ('$nomeDoArquivo','$path','$prato','$descricao','$preco')") or die ($mysql->error);
        echo "<p>Prato enviado com sucesso !</p>";
    }else{
        echo "Falha ao enviar arquivo";
    }
}

if(isset($_FILES['arquivoBebida'])){
    
    $arquivoBebida = $_FILES['arquivoBebida'];
    $bebida = $_POST['bebida'];
    $descricaoBebida = $_POST['descricaoBebida'];
    $precoBebida = $_POST['precoBebida'];

    echo "Arquivo enviado !";

    $pasta = "Midia/";
    $nomeDoArquivo = $arquivoBebida['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png')
        die("Tipo de arquivo não aceito");

    $path = $pasta.$novoNomeDoArquivo.".".$extensao;    
    $deu_certo = move_uploaded_file($arquivoBebida["tmp_name"], $path);

    if($deu_certo){
        $mysqli->query("INSERT INTO bebidas (nome,path,bebida,descricao,preco) VALUES ('$nomeDoArquivo','$path','$bebida','$descricaoBebida','$precoBebida')") or die ($mysql->error);
        echo "<p>Bebida enviada com sucesso !</p>";
    }else{
        echo "Falha ao enviar arquivo";
    }
}

if(isset($_FILES['arquivoCombos'])){
    
    $arquivoCombos = $_FILES['arquivoCombos'];
    $combo = $_POST['combo'];
    $descricaoCombo = $_POST['descricaoCombo'];
    $precoCombo = $_POST['precoCombo'];

    echo "Arquivo enviado !";

    $pasta = "Midia/";
    $nomeDoArquivo = $arquivoCombos['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png')
        die("Tipo de arquivo não aceito");

    $path = $pasta.$novoNomeDoArquivo.".".$extensao;    
    $deu_certo = move_uploaded_file($arquivoCombos["tmp_name"], $path);

    if($deu_certo){
        $mysqli->query("INSERT INTO combos (nome,path,combo,descricao,preco) VALUES ('$nomeDoArquivo','$path','$combo','$descricaoCombo','$precoCombo')") or die ($mysql->error);
        echo "<p>Combo enviada com sucesso !</p>";
    }else{
        echo "Falha ao enviar arquivo";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Coco Jambo Restaurante</title>
    <script  src="Funcoes/script.js"></script>
    <!-- MATERIALIZE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>
<body>

    <header>
        <!--MENU MOBILE-->
        <ul class="sidenav" id="menu-mobile">
            <li><a class="sidenav-close " href="#home">Home</a></li>
            <li><a class="sidenav-close modal-trigger" href="#adicionarPrato-modal">Adicionar Prato</a></li>
            <li><a class="sidenav-close modal-trigger" href="#adicionarBebida-modal">Adicionar Bebida</a></li>
            <li><a class="sidenav-close modal-trigger" href="#adicionarCombo-modal">Adicionar Combo</a></li>
            <li><a class="sidenav-close" href="cadastro.php">Cadastrar Usuario</a></li>
            <li><input type="button" value="Sair" onclick=sair()></li>
        </ul>

        <div class="navbar-fixed">
            <nav class="navbar z-depth-0">
                <div class="nav-wrapper container">
                    <a href=""><img class="logo_img" src="img/logo.png">
                    <ul class="right light hide-on-med-and-down">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#adicionarPrato-modal" class="modal-trigger">Adicionar Prato</a></li>
                        <li><a href="#adicionarBebida-modal" class="modal-trigger">Adicionar Bebida</a></li>
                        <li><a href="#adicionarCombo-modal" class="modal-trigger">Adicionar Combo</a></li>
                        <li><a href="#cadastrarUsuario-modal" class="modal-trigger">Cadastrar</a></li>
                        <li><a href="#removerUsuario-modal" class="modal-trigger">Remover</a></li>
                        <li><a href="#mudarSenha-modal" class="modal-trigger">Mudar Senha</a></li>
                        <li><input type="button" value="Sair" onclick=sair()></li>
                    </ul>

                    <a href="#" data-target="menu-mobile" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </div>

    </header>

    <section>
        <!--MODAL CADASTRO DE USUÁRIO-->
        <div class="modal" id="cadastrarUsuario-modal">
            <div class="modal-content">
                <h3>Cadastrar usuário</h3>
                <form method="POST" action="cadastro.php">
                    <input type="text" name="usuario" placeholder="Usuário" maxlength="40" autocomplete="off" required><br>
                    <input type="password" name="senha" placeholder="Senha" maxlength="15" required><br>
                    <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15" required><br>
                    <input type="submit" value="CADASTRAR">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close">Voltar</a>
            </div>
        </div>

        <!--MODAL MUDAR SENHA-->
        <div class="modal" id="mudarSenha-modal">
            <div class="modal-content">
                <h3>Mudar senha</h3>
                <form method="POST" action="Funcoes/alterarSenha.php">
                    <input type="hidden" name="codigo_usuario" id="codigo_usuario" value="<?=$codigoUsuario ?>">
                    <input type="hidden" name="antigaSenha" id="antigaSenha" value="<?=$antigaSenha ?>">
                    <p>Usuário: <?=$usuario ?></p><br>
                    <input type="password" name="novaSenha" placeholder="Nova senha" maxlength="15"><br>
                    <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15"><br>
                    <input type="submit" value="MUDAR">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close">Voltar</a>
            </div>
        </div>

        <!--MODAL REMOVER USUÁRIO-->
        <div class="modal" id="removerUsuario-modal">
            <div class="modal-content">
                <h3>Remover usuário</h3>
                <table border="1" cellpadding="10">
                    <thead>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Excluir</th>
                    </thead>
                        
                    <tbody>
                        <?php
                            while($arquivo = $sql_query_usuarios->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $arquivo['id_usuario']; ?></td>
                            <td><?php echo $arquivo['usuario']; ?></td>
                            <td><input type="button" value="Excluir" onclick="excluirUsuario(<?php echo $arquivo['id_usuario']; ?>)"></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close">Voltar</a>
            </div>
        </div>

        <!--MODAL ADICIONAR PRATO AO CARDÁPIO-->
        <div class="modal" id="adicionarPrato-modal">
            <div class="modal-content">
                <h3>Adicionar prato ao cardápio</h3>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="prato" placeholder="Nome do prato" maxlength="30" autocomplete="off"><br>
                    <input type="text" name="descricao" placeholder="Descrição do prato" autocomplete="off"><br>
                    <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                    <input type="file" name="arquivo"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close">Voltar</a>
            </div>
        </div>

        <!--MODAL EDITAR PRATO-->
        <div class="modal" id="editarPrato-modal">
            <div class="modal-content">
                <h3>Editar prato do cardápio</h3>
                <form method="GET" action="Funcoes/alterar.php">
                    <input type="hidden" name="codigo" id="codigo" value="<?=$codigo ?>">
                    <input type="text" name="prato" placeholder="Nome do prato" maxlength="30" autocomplete="off" value="<?=$prato?>"><br>
                    <input type="text" name="descricao" placeholder="Descrição do prato" autocomplete="off" value="<?=$descricao?>"><br>
                    <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$preco?>"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close" href="admin.php">Voltar</a>
            </div>
        </div>

        <!--MODAL ADICIONAR BEBIDA AO CARDÁPIO-->
        <div class="modal" id="adicionarBebida-modal">
            <div class="modal-content">
                <h3>Adicionar bebida ao cardápio</h3>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="bebida" placeholder="Nome da bebida" maxlength="30" autocomplete="off"><br>
                    <input type="text" name="descricaoBebida" placeholder="Descrição da bebida" autocomplete="off"><br>
                    <input type="number" name="precoBebida" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                    <input type="file" name="arquivoBebida"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
               <a class="btn blue-logo modal-action modal-close" href="admin.php">Voltar</a>
            </div>
        </div>

        <!--MODAL EDITAR BEBIDA-->
        <div class="modal" id="editarBebida-modal">
            <div class="modal-content">
                <h3>Editar bebida do cardápio</h3>
                <form method="GET" action="Funcoes/alterarBebida.php">
                    <input type="hidden" name="codigo_bebida" id="codigoBebida" value="<?=$codigoBebida?>">
                    <input type="text" name="bebida" placeholder="Nome da bebida" maxlength="30" autocomplete="off" value="<?=$bebida?>"><br>
                    <input type="text" name="descricao" placeholder="Descrição da bebida" autocomplete="off" value="<?=$descricaoBebida?>"><br>
                    <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$precoBebida?>"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close" href="admin.php">Voltar</a>
            </div>
        </div>

        <!--MODAL ADICIONAR COMBO AO CARDÁPIO-->
        <div class="modal" id="adicionarCombo-modal">
            <div class="modal-content">
                <h3>Adicionar combo ao cardápio</h3>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="combo" placeholder="Nome da combo" maxlength="30" autocomplete="off"><br>
                    <input type="text" name="descricaoCombo" placeholder="Descrição da combo" autocomplete="off"><br>
                    <input type="number" name="precoCombo" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                    <input type="file" name="arquivoCombos"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close">Voltar</a>
            </div>
        </div>

        <!--MODAL EDITAR COMBO-->
        <div class="modal" id="editarCombo-modal">
            <div class="modal-content">
                <h3>Editar combo do cardápio</h3>
                <form method="GET" action="Funcoes/alterarCombo.php">
                    <input type="hidden" name="codigo_combo" id="codigoCombo" value="<?=$codigoCombo?>">
                    <input type="text" name="combo" placeholder="Nome do combo" maxlength="30" autocomplete="off" value="<?=$combo?>"><br>
                    <input type="text" name="descricao" placeholder="Descrição do combo" autocomplete="off" value="<?=$descricaoCombo?>"><br>
                    <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$precoCombo?>"><br>
                    <input type="submit">
                </form>
            </div>

            <div class="modal-footer">
                <a class="btn blue-logo modal-action modal-close" href="admin.php">Voltar</a>
            </div>
        </div>

        <!-- CARDÁPIO -->
        <h2>Cardápio</h2>
        <div>
            <!-- PRATOS -->
            <h3>Pratos</h3>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Prato</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>

                <tbody>
                <?php
                while($arquivo = $sql_query->fetch_assoc()){
                ?>
                    <tr>
                        <td><img height="50" src="<?php echo $arquivo['path']; ?>"></td>
                        <td><?php echo $arquivo['prato']; ?></td>
                        <td><?php echo $arquivo['descricao']; ?></td>
                        <td><?php echo $arquivo['preco']; ?></td>
                        <td><button class="modal-trigger" onclick="alterar(<?php echo $arquivo['codigo']; ?>)">Editar</button></td>
                        <td><input type="button" value="Excluir" onclick="excluir(<?php echo $arquivo['codigo']; ?>)"></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            <!-- BEBIDAS -->
            <h3>Bebidas</h3>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Bebida</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>

                <tbody>
                <?php
                while($arquivoBebida = $sql_query_bebidas->fetch_assoc()){
                ?>
                    <tr>
                        <td><img height="50" src="<?php echo $arquivoBebida['path']; ?>"></td>
                        <td><?php echo $arquivoBebida['bebida']; ?></td>
                        <td><?php echo $arquivoBebida['descricao']; ?></td>
                        <td><?php echo $arquivoBebida['preco']; ?></td>
                        <td><button class="modal-trigger" onclick="alterarBebida(<?php echo $arquivoBebida['codigo']; ?>)">Editar</button></td>
                        <td><input type="button" value="Excluir" onclick="excluirBebida(<?php echo $arquivoBebida['codigo']; ?>)"></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            <!-- COMBOS -->
            <h3>Combos</h3>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Combo</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>

                <tbody>
                <?php
                while($arquivoCombos = $sql_query_combos->fetch_assoc()){
                ?>
                    <tr>
                        <td><img height="50" src="<?php echo $arquivoCombos['path']; ?>"></td>
                        <td><?php echo $arquivoCombos['combo']; ?></td>
                        <td><?php echo $arquivoCombos['descricao']; ?></td>
                        <td><?php echo $arquivoCombos['preco']; ?></td>
                        <td><button class="modal-trigger" onclick="alterarCombo(<?php echo $arquivoCombos['codigo']; ?>)">Editar</button></td>
                        <td><input type="button" value="Excluir" onclick="excluirCombo(<?php echo $arquivoCombos['codigo']; ?>)"></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        
    </section>

    <!--GOOGLE ICONS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- JQUERY --> 
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- JAVASCRIPT -->
    <script>
        $(document).ready(function(){
            // MENU MOBILE
            $('.sidenav').sidenav();
            // MODAL
            $(".modal").modal();
            // MODAL AUTOMATICO
            slot = document.getElementById("codigo").value;
            slot1 = document.getElementById("codigoBebida").value;
            slot2 = document.getElementById("codigoCombo").value;
            if(slot != ""){
                $('#editarPrato-modal').modal('open');
            }else if(slot1 != ""){
                $('#editarBebida-modal').modal('open'); 
            }else if(slot2 != ""){
                $('#editarCombo-modal').modal('open'); 
            }
        });
    </script>
</body>
</html>