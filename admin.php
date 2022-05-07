<?php
session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }

include("Class/conexao.php");

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
        echo "<p>Arquivo enviado com sucesso para acessa-lo</p>";
    }
    else
        echo "Falha ao enviar arquivo";
}

$sql_query = $mysqli->query("SELECT * FROM cardapio") or die ($mysqli->error);
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
         res = confirm("Tem certeza que deseja excluir este compromisso ?");
        if(res){
            window.location = "Funcoes/excluir.php?codigo=" + codigo;
        }
    }
</script>

<body>
    <header>
        <input type="button" value="Cadastrar usuário" onclick="cadastrar()">
        <input type="button" value="Sair" onclick="sair()"><br><br>
    </header>
    <section>
        <!-- ADICIONAR AO CARDÁPIO -->
        <div>
            <h2>Adicionar prato ao cardápio</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="prato" placeholder="Nome do prato"><br>
                <input type="text" name="descricao" placeholder="Descrição do prato"><br>
                <input type="number" name="preco" placeholder="Preço"><br>
                <input type="file" name="arquivo"><br>
                <input type="submit">
            </form>
        </div>

         <!-- CARDÁPIO -->
         <div>
            <h3>Cardápio !</h3>
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
                        <td><input type="button" value="Editar" onclick=""></td>
                        <td><input type="button" value="Excluir" onclick="excluir(<?php echo $arquivo['codigo']; ?>)"></td>
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