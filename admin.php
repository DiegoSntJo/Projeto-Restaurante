<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("location: index.php");
    exit;
}

include("Class/conexao.php");

$sql_query = $mysqli->query("SELECT * FROM cardapio") or die ($mysqli->error);
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
</head>

<script>

    function sair(){
        res = confirm("Tem certeza que deseja sair ?");
        if(res){
            window.location = "Funcoes/sair.php";
        }
    }

    function cadastrar(){
            window.location = "cadastro.php";
    }

    function excluir(codigo){
         res = confirm("Tem certeza que deseja excluir este prato ?");
        if(res){
            window.location = "Funcoes/excluir.php?codigo=" + codigo;
        }
    }

    function excluirBebida(codigo){
         res = confirm("Tem certeza que deseja excluir esta bebida ?");
        if(res){
            window.location = "Funcoes/excluirBebida.php?codigo=" + codigo;
        }
    }

    function excluirCombo(codigo){
         res = confirm("Tem certeza que deseja excluir este combo ?");
        if(res){
            window.location = "Funcoes/excluirCombo.php?codigo=" + codigo;
        }
    }

    function alterar(codigo){
        window.location = "admin.php?codigo=" + codigo;
    }

    function alterarBebida(codigo){
        window.location = "admin.php?codigo_bebida=" + codigo;
    }

    function alterarCombo(codigo){
        window.location = "admin.php?codigo_combo=" + codigo;
    }
</script>

<body>

    <header>
        <input type="button" value="Cadastrar usuário" onclick="cadastrar()">
        <input type="button" value="Sair" onclick="sair()"><br><br>
    </header>

    <section>
        <!-- ADICIONAR PRATO AO CARDÁPIO -->
        <div>
            <h2>Adicionar prato ao cardápio</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="prato" placeholder="Nome do prato" maxlength="30" autocomplete="off"><br>
                <input type="text" name="descricao" placeholder="Descrição do prato" autocomplete="off"><br>
                <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                <input type="file" name="arquivo"><br>
                <input type="submit">
            </form>
        </div>

        <!-- EDITAR PRATO -->
        <div>
            <h2>Editar prato do cardápio</h2>
            <form method="GET" action="Funcoes/alterar.php">
                <input type="hidden" name="codigo" value="<?=$codigo ?>">
                <input type="text" name="prato" placeholder="Nome do prato" maxlength="30" autocomplete="off" value="<?=$prato?>"><br>
                <input type="text" name="descricao" placeholder="Descrição do prato" autocomplete="off" value="<?=$descricao?>"><br>
                <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$preco?>"><br>
                <input type="submit">
            </form>
        </div>

        <!-- ADICIONAR BEBIDA AO CARDÁPIO -->
        <div>
            <h2>Adicionar bebida ao cardápio</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="bebida" placeholder="Nome da bebida" maxlength="30" autocomplete="off"><br>
                <input type="text" name="descricaoBebida" placeholder="Descrição da bebida" autocomplete="off"><br>
                <input type="number" name="precoBebida" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                <input type="file" name="arquivoBebida"><br>
                <input type="submit">
            </form>
        </div>

        <!-- EDITAR BEBIDA -->
        <div>
            <h2>Editar bebida do cardápio</h2>
            <form method="GET" action="Funcoes/alterarBebida.php">
                <input type="hidden" name="codigo_bebida" value="<?=$codigoBebida?>">
                <input type="text" name="bebida" placeholder="Nome da bebida" maxlength="30" autocomplete="off" value="<?=$bebida?>"><br>
                <input type="text" name="descricao" placeholder="Descrição da bebida" autocomplete="off" value="<?=$descricaoBebida?>"><br>
                <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$precoBebida?>"><br>
                <input type="submit">
            </form>
        </div>

        <!-- ADICIONAR COMBO AO CARDÁPIO -->
        <div>
            <h2>Adicionar combo ao cardápio</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="combo" placeholder="Nome da combo" maxlength="30" autocomplete="off"><br>
                <input type="text" name="descricaoCombo" placeholder="Descrição da combo" autocomplete="off"><br>
                <input type="number" name="precoCombo" placeholder="Preço" maxlength="10" autocomplete="off"><br>
                <input type="file" name="arquivoCombos"><br>
                <input type="submit">
            </form>
        </div>

        <!-- EDITAR COMBO -->
        <div>
            <h2>Editar combo do cardápio</h2>
            <form method="GET" action="Funcoes/alterarCombo.php">
                <input type="hidden" name="codigo_combo" value="<?=$codigoCombo?>">
                <input type="text" name="combo" placeholder="Nome do combo" maxlength="30" autocomplete="off" value="<?=$combo?>"><br>
                <input type="text" name="descricao" placeholder="Descrição do combo" autocomplete="off" value="<?=$descricaoCombo?>"><br>
                <input type="number" name="preco" placeholder="Preço" maxlength="10" autocomplete="off" value="<?=$precoCombo?>"><br>
                <input type="submit">
            </form>
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
                        <td><input type="button" value="Editar" onclick="alterar(<?php echo $arquivo['codigo']; ?>)"></td>
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
                        <td><input type="button" value="Editar" onclick="alterarBebida(<?php echo $arquivoBebida['codigo']; ?>)"></td>
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
                        <td><input type="button" value="Editar" onclick="alterarCombo(<?php echo $arquivoCombos['codigo']; ?>)"></td>
                        <td><input type="button" value="Excluir" onclick="excluirCombo(<?php echo $arquivoCombos['codigo']; ?>)"></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        
    </section>
</body>
</html>