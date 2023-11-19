<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojas</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/lojas.css">
    <script src="js/general.js" defer></script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="lojas">
        <h3>Lojas</h3>
        <div class="lojas-inner">
            <?php
                $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                /* LOJAS */
                $sql = "SELECT * FROM `lojas`;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="loja">
                            <div class="loja-image" style="background-image: url('<?php echo $row["img_dir"]; ?>');"></div>
                            <div class="loja-info">
                                <h2><?php echo $row["name"]; ?></h2>
                                <div class="loja-content">
                                    <div class="loja-address">
                                        <h3>Endereço</h3>
                                        <p><?php echo $row["address"]; ?></p>
                                    </div>
                                    <div class="loja-sub">
                                        <div class="loja-opening">
                                            <h3>Funcionamento</h3>
                                            <p>Seg a Sáb das <?php echo $row["func_1"]; ?></p>
                                            <p>Dom e Feriados das <?php echo $row["func_2"]; ?></p>
                                        </div>
                                        <div class="loja-contact">
                                            <h3>Contato</h3>
                                            <p>Tel: <?php echo $row["phone"]; ?></p>
                                            <p>Whatsapp: <?php echo $row["whatsapp"]; ?></p>
                                        </div>
                                    </div>
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