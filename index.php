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
    <!-- HEADER -->
    <header>
        <!--MENU MOBILE-->
        <ul class="sidenav" id="menu-mobile">
            <li><a class="sidenav-close" href="#home">Home</a></li>
            <li><a class="sidenav-close" href="#pratos">Pratos</a></li>
            <li><a class="sidenav-close" href="#bebidas">Bebidas</a></li>
            <li><a class="sidenav-close" href="#combos">Combos</a></li>
            <li><a class="sidenav-close" href="#sobre">Sobre Nós</a></li>  
            <li><a class="sidenav-close" href="login.php">Login</a></li>
        </ul>

        <div class="navbar-fixed">
            <nav class="navbar z-depth-0">
                <div class="nav-wrapper container">
                    <!-- texto logo <h5 class="logo_text">Coco Jambo Restaurante - Sabores tropicais !</h5> -->
                    <!-- logo <a href=""><img class="logo_img" src="img/logo.png"> -->
            
                    <ul class="right light hide-on-med-and-down">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#sobre">Sobre Nós</a></li>
                        <li><a href="#unidades">Unidades</a></li>
                        <li><a href="#contato">Contato</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>

                    <a href="#" data-target="menu-mobile" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </div>
    </header>

    <!-- CARDÁPIO
    <h2>Confira nosso cardápio !</h2> -->

    <!-- PRATOS -->
    <section id="pratos">
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
    </section>

    <!-- BEBIDAS -->
    <section id="bebidas">
        <h3> Bebidas </h3>
        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Bebida</th>
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
    </section>

    <!-- COMBOS -->
    <section id="combos">
    <h3> Combos </h3>
        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <th>Preview</th>
                    <th>Combo</th>
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

    <!--GOOGLE ICONS-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- JQUERY --> 
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- JAVASCRIPT -->
    <script>
        //DROPDOWN
        const elemsDropdown = document.querySelectorAll(".dropdown-trigger");
        const instancesDropdown = M.Dropdown.init(elemsDropdown, {
            coverTrigger: false
        });

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