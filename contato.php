<?php
    include 'config.php';
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["subject"]) || empty($_POST["message"]))) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            header("Location: /");
        }
        return;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $conn = new mysqli($GLOBALS['sql_host'], $GLOBALS['sql_user'], $GLOBALS['sql_pass'], $GLOBALS['sql_db']);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $status = "Aguardando retirada";
        $code = strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9)).strval(rand(0,9));

        /* INSERT CONTATO */
        $sql = "INSERT INTO `contatos` (`name`, `email`, `phone`, `subject`, `message`) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["phone"]."', '".$_POST["subject"]."', '".$_POST["message"]."');";
    
        if ($conn->query($sql) === true) {

        } else {
            $conn->close();
            return;
        }

        $conn->close();
        
        header("Location: contato.php");
        return;
    }

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contato</title>
        <link rel="stylesheet" href="css/general.css">
        <link rel="stylesheet" href="css/contato.css">
        <script src="js/general.js" defer></script>
        <script src="js/slideshow.js" defer></script>
    </head>

    <body>
        <?php include 'nav.php'; ?>

        <section class="contact">
            <h3>Contato</h3>
            <div class="contact-inner">
                <div class="g-contato">
                    <form action="contato.php" method="post">
                        <div class="contact-fields">
                            <div>
                                <label for="name">Nome:</label>
                                <input type="text" name="name">
                            </div>
                            <div>
                                <label for="email">Email:</label>
                                <input type="email" name="email">
                            </div>
                            <div>
                                <label for="phone">Telefone:</label>
                                <input type="text" name="phone">
                            </div>
                            <div>
                                <label for="subject">Assunto:</label>
                                <select name="subject">
                                    <option value>Selecione um assunto</option>
                                    <option value="elogio">Elogio</option>
                                    <option value="reclamação">Reclamação</option>
                                    <option value="sugestão">Sugestão</option>
                                    <option value="duvida">Duvida</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="g-message">
                                <label for="message">Mensagem:</label>
                                <textarea name="message" cols="30" rows="10"></textarea>
                            </div>
                            <div class="g-button">
                                <button type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="g-atendimento contact-info">
                    <h4>Central de Atendimento</h4>
                    <p>De Seg a Sex das 09h às 18h</p>
                    <p>Sáb das 09h às 17h</p>
                    <p>sac@confeitaria.com.br</p>
                    <br/>
                    <p>Tel: 21. 2142-3953 | 4800-3591</p>
                </div>
                <div class="g-imprensa contact-info">
                    <h4>Assessoria de Imprensa</h4>
                    <p><strong>CF Ltda.</strong></p>
                    <p>Tel: 21. 2475-3981</p>
                    <br/>
                    <p><strong>Gabriel Motta</strong></p>
                    <p>gabriel@confeitaria.com</p>
                </div>
            </div>
        </section>

        <footer class="footer">
            <span class="js-year">2023</span> © Todos os Direitos Reservados a
            Confeitaria | Imagens meramente ilustrativas.
        </footer>
    </body>

</html>