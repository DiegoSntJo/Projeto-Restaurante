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

if(isset($_FILES['arquivo'])){
    
    $arquivo = $_FILES['arquivo'];
    $prato = $_POST['prato'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $enviado = "Arquivo enviado !";

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
        $mensagem = "Prato enviado com sucesso !";
    }else{
        $mensagem = "Falha ao enviar arquivo";
    }
}

if(isset($_FILES['arquivoBebida'])){
    
    $arquivoBebida = $_FILES['arquivoBebida'];
    $bebida = $_POST['bebida'];
    $descricaoBebida = $_POST['descricaoBebida'];
    $precoBebida = $_POST['precoBebida'];

    $enviado = "Arquivo enviado !";

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
        $mensagem = "Bebida enviada com sucesso !";
    }else{
        $mensagem = "Falha ao enviar arquivo";
    }
}

if(isset($_FILES['arquivoCombos'])){
    
    $arquivoCombos = $_FILES['arquivoCombos'];
    $combo = $_POST['combo'];
    $descricaoCombo = $_POST['descricaoCombo'];
    $precoCombo = $_POST['precoCombo'];

    $enviado = "Arquivo enviado !";

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
        $mensagem = "Combo enviado com sucesso !";
    }else{
        $mensagem = "Falha ao enviar arquivo";
    }
}

?>
    <script>
        enviado = "<?=$enviado?>"
        mensagem = "<?=$mensagem?>";
        function alerta(){
            alert(enviado);
            alert(mensagem);
            window.location = "admin.php";
        }
        onload=alerta();
    </script>
<?php