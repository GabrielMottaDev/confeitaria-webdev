<?php
    include 'config.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET["id"])) {
        header('Location: /');
        return;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (empty($_POST["produto_id"]) || empty($_POST["loja"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password-confirm"]) || empty($_POST["name"]) || empty($_POST["phone"]))) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            header("Location: /");
        }
        return;
    }

    $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $status = "Aguardando retirada";
        $code = strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9));

        /* INSERT PEDIDO */
        $sql = "INSERT INTO `pedidos` (`produto_id`, `loja_id`, `status`, `password`, `code`, `name`, `email`, `phone`) VALUES ('".$_POST["produto_id"]."', '".$_POST["loja"]."', '".$status."', '".sha1($_POST['password'], false)."', '".$code."', '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["phone"]."');";
    
        if ($conn->query($sql) === true) {

        } else {
            $conn->close();
            return false;
        }

        /* PEDIDO */
        $sql = "SELECT * FROM `pedidos` WHERE `id`='".$conn->insert_id."' AND `password`='".sha1($_POST['password'], false)."';";
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
        
        header("Location: pedido.php");
        return;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer pedido</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/fazer-pedido.css">
    <script src="js/general.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="consult-order">
        <h3>Fazer pedido</h3>
        <div class="g-contato">
            <form action="fazer-pedido.php" method="post">
                <div class="consult-order-fields">
                    <?php
                        /* PRODUTO */
                        $sql = "SELECT * FROM `produtos` WHERE `id`='".$_GET["id"]."';";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <input type="hidden" name="produto_id" value="<?php echo $row["id"]; ?>" />
                                <div>
                                    <label for="produto">Produto:</label>
                                    <input type="text" name="produto" value="<?php echo $row["name"]; ?>" disabled>
                                </div>
                                <?php
                            }
                        } else {
                            $conn->close();
                            return;
                        }
                    ?>
                    <div>
                        <label for="loja">Loja:</label>
                        <select name="loja">
                            <option value>Selecione uma loja</option>
                            <?php
                                /* LOJA */
                                $sql = "SELECT * FROM `lojas`;";
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                        <?php
                                    }
                                } else {
                                    $conn->close();
                                    return;
                                }
                                $conn->close();
                            ?>
                            
                        </select>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" name="email">
                    </div>
                    <div>
                        <label for="password">Senha:</label>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <label for="password-confirm">Confirmar senha:</label>
                        <input type="password" name="password-confirm">
                    </div>
                    <div>
                        <label for="name">Nome:</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label for="phone">Celular:</label>
                        <input type="text" name="phone">
                    </div>
                    <div class="g-button">
                        <button type="submit">Finalizar pedido</button>
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