<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/slider.css">
    <script src="js/general.js" defer></script>
    <script src="js/slider.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>
    <section class="slider">
        <div class="slider-container">

            <div class="slide-frame fade">
                <img src="rsrc/img/banner/banner1.png" style="width:100%">
            </div>

            <div class="slide-frame fade">
                <img src="rsrc/img/banner/banner2.png" style="width:100%">
            </div>

            <a class="prev" onclick="prevSlide(this)">❮</a>
            <a class="next" onclick="nextSlide(this)">❯</a>

        </div>
    </section>
    <section class="featured-products">
        <h3>Produtos em destaque</h3>
        <div class="products">
            <?php
                $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                /* PRODUTO */
                $sql = "SELECT * FROM `produtos` WHERE `featured`='1';";
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