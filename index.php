<?php
include("Class/conexao.php");

$sql_query = $mysqli->query("SELECT * FROM cardapio") or die ($mysqli->error);
$sql_query_bebidas = $mysqli->query("SELECT * FROM bebidas") or die ($mysqli->error);
$sql_query_combos = $mysqli->query("SELECT * FROM combos") or die ($mysqli->error);
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
        <h2>Confira nosso cardápio !</h2>

        <!-- PRATOS -->
        <h3> Pratos </h3>
        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Prato</th>
                    <th>Descrição</th>
                    <th>Preço</th>
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

        <!-- BEBIDAS -->
        <h3> Bebidas </h3>
        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Bebidas</th>
                    <th>Descrição</th>
                    <th>Preço</th>
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
                        <td><input type="button" value="Pedir" onclick="pedir()"></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <!-- COMBOS -->
        <h3> Combos </h3>
        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Combos</th>
                    <th>Descrição</th>
                    <th>Preço</th>
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