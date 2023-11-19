<?php
    include 'config.php';
    session_start();
    if (!empty($_SESSION["pedido"]) && !empty($_SESSION["produto"]) && !empty($_SESSION["loja"])) {

        function trySearch(){
            $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            /* PEDIDO */
            $sql = "SELECT * FROM `pedidos` WHERE `id`='".$_SESSION["pedido"]["id"]."' AND `password`='".$_SESSION["pedido"]["password"]."';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $pedido = $row;
                }
            } else {
                $conn->close();
                return false;
            }

            /* PRODUTO */
            $sql = "SELECT * FROM `produtos` WHERE `id`='".$pedido["produto_id"]."';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $produto = $row;
                }
            } else {
                $conn->close();
                return false;
            }

            /* LOJA */
            $sql = "SELECT * FROM `lojas` WHERE `id`='".$pedido["loja_id"]."';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $loja = $row;
                }
            } else {
                $conn->close();
                return false;
            }

            $conn->close();

            $_SESSION["pedido"] = $pedido;
            $_SESSION["produto"] = $produto;
            $_SESSION["loja"] = $loja;
            
            return true;
        }

        if(trySearch() == false){
            // se der erro
            
        } else {
            // se der tudo certo

        }
        
    } else {
        header('Location: consular-pedido.php');
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/pedido.css">
    <script src="js/general.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="order">
        <div class="order-inner">
            <div class="order-inner-left">
                <div>
                    <h2>Dados do cliente</h2>
                    <p>Nome: <?php echo $_SESSION["pedido"]["name"]?></p>
                    <p>Email: <?php echo $_SESSION["pedido"]["email"]?></p>
                    <p>Celular: <?php echo $_SESSION["pedido"]["phone"]?></p>
                </div>
                <div>
                    <h2>Informações do produto</h2>
                    <div class="product">
                        <div class="product-image"
                            style="background-image: url('<?php echo $_SESSION["produto"]["img_dir"]?>');">
                        </div>
                        <div class="product-info">
                            <div class="product-title">
                                <div class="product-name">
                                    <p><?php echo $_SESSION["produto"]["name"]?></p>
                                </div>
                                <p class="product-price">R$ <?php echo str_replace(".", ",", strval($_SESSION["produto"]["price"]))?></p>
                            </div>
                            <div class="product-description">
                                <p><?php echo $_SESSION["produto"]["description"]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-inner-right">
                <h2>Informações do pedido</h2>
                <p>Nº do pedido: <b><?php echo $_SESSION["pedido"]["id"]?></b></p>
                <p>Status: <b><?php echo $_SESSION["pedido"]["status"]?></b></p>
                <p>Código para retirada: <b><?php echo $_SESSION["pedido"]["code"]?></b></p>
                <div class="loja">
                    <div class="loja-image"
                        style="background-image: url('<?php echo $_SESSION["loja"]["img_dir"]?>');">
                    </div>
                    <div class="loja-info">
                        <h2><?php echo $_SESSION["loja"]["name"]?></h2>
                        <div class="loja-content">
                            <div class="loja-address">
                                <h3>Endereço</h3>
                                <p><?php echo $_SESSION["loja"]["address"]?></p>
                            </div>
                            <div class="loja-sub">
                                <div class="loja-opening">
                                    <h3>Funcionamento</h3>
                                    <p>Seg a Sáb das <?php echo $_SESSION["loja"]["func_1"]?></p>
                                    <p>Dom e Feriados das <?php echo $_SESSION["loja"]["func_2"]?></p>
                                </div>
                                <div class="loja-contact">
                                    <h3>Contato</h3>
                                    <p>Tel: <?php echo $_SESSION["loja"]["phone"]?></p>
                                    <p>Whatsapp: <?php echo $_SESSION["loja"]["whatsapp"]?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </section>

    <footer class="footer">
        <span class="js-year">2023</span> © Todos os Direitos Reservados a Confeitaria | Imagens meramente ilustrativas.
    </footer>
</body>

</html>