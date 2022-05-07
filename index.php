<?php
include("Class/conexao.php");

$sql_query = $mysqli->query("SELECT * FROM cardapio") or die ($mysqli->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coco Jambo Restaurante</title>
</head>

<body>
    <header>
        <a href="login.php">Clique aqui !</a>
    </header>
    <section>
        <!-- CARDÁPIO -->
        <div>
            <h3>Confira nosso cardápio !</h3>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Prato</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th></th>
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
                        <td><input type="button" value="Pedir" onclick="pedir()"></td>
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