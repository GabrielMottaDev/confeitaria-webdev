<?php
    include 'config.php';
    session_start();
    if (!empty($_POST['n-pedido']) && !empty($_POST['password'])) {

        function trySearch(){
            $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            /* PEDIDO */
            $sql = "SELECT * FROM `pedidos` WHERE `id`='".$_POST['n-pedido']."' AND `password`='".sha1($_POST['password'], false)."';";
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
            header('Location: pedido.php');
            return;
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/consultar-pedido.css">
    <script src="js/general.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="consult-order">
        <h3>Consultar pedido</h3>
        <div class="g-contato">
            <form action="consultar-pedido.php" method="post">
                <div class="consult-order-fields">
                    <div>
                        <label for="n-pedido">Nº do pedido: </label>
                        <input type="text" name="n-pedido">
                    </div>
                    <div>
                        <label for="password">Senha:</label>
                        <input type="password" name="password">
                    </div>
                    <div class="g-button">
                        <button type="submit">Consultar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer class="footer">
        <span class="js-year">2023</span> © Todos os Direitos Reservados a Confeitaria | Imagens meramente ilustrativas.
    </footer>
</body>

</html>