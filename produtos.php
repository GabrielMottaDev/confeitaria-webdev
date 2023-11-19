<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/produtos.css">
    <script src="js/general.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="all-products">
        <h3>Produtos</h3>
        <div class="products">
            <?php
                $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                /* PRODUTO */
                $sql = "SELECT * FROM `produtos`;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="product" product-id="<?php echo $row['id']; ?>">
                            <div class="product-image"
                                style="background-image: url('<?php echo $row['img_dir']; ?>');">
                            </div>
                            <div class="product-info">
                                <div class="product-title">
                                    <div class="product-name">
                                        <p><?php echo $row['name']; ?></p>
                                    </div>
                                    <p class="product-price">R$ <?php echo str_replace(".", ",", strval($row["price"]))?></p>
                                </div>
                                <div class="product-description">
                                    <p><?php echo $row['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    $conn->close();
                    return;
                }

                $conn->close();
            ?>
        </div>
    </section>

    <footer class="footer">
        <span class="js-year">2023</span> © Todos os Direitos Reservados a Confeitaria | Imagens meramente ilustrativas.
    </footer>
</body>

</html>