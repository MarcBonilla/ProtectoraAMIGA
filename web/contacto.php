<?php
    session_start();

    require '../php/database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if (count($results) > 0) {
            $user = $results;
        }
    } 
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="../img/logo.png">
        <title>Contacto</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleContacto.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <section>
            <header>
                <a href="../index.php"><img src="../img/back.png" class="back"></a>
                <div class="toggle" onclick="menu()"></div>
                <ul class="navigation">
                    <li><a href="about.php">Sobre Nosotros</a></li>
                    <li><a href="donativos.php">Donativos</a></li>
                    <li><a href="">Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="../php/logout.php">Logout</a></li>
                        <li><a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=php_login_database" id="panel">Panel de Control</a></li>
                    <?php else: ?>
                        <li><a href="../php/login.php" id="login">Iniciar Sesión</a></li>   
                    <?php endif; ?>
                </ul>
            </header>
            <div class="contact">
			<h2 class="contact__header">Contáctanos</h2>
            <form action="#">
                <input type="text" name="nombre" class="contact__form--name contact__form--field" placeholder="NOMBRE" required>
                <input type="text" name="email" class="contact__form--email contact__form--field" placeholder="EMAIL" required>
                <input type="text" name="asunto" class="contact__form--subject contact__form--field" placeholder="ASUNTO" required>
                <textarea name="mensaje" class="contact__form--message" placeholder="MENSAJE"></textarea>
                <input type="submit" name="enviar" value="ENVIAR" class="contact__form--submit">
            </form>
            </div>
        </section>
        <div class="footer">
            <p class="footer-text">Copyright ©2021 Todos los derechos reservados</p>
            <p class="footer-text">contacto@protectoraamiga.com</p>
            <img src="../img/cc.png" class="footer-img">
            <img src="../img/logo.png" class="footer-logo">
            <p class="footer-text">Esta obra está bajo una licencia de Creative Commons</p>
        </div>
        <br><br>
        <script>
            function menu() {
                var menuToggle = document.querySelector('.toggle');
                var navigation = document.querySelector('.navigation') 
                menuToggle.classList.toggle('active');
                navigation.classList.toggle('active');
            }  
        </script>

        <?php
            if (isset($_POST['enviar'])) {
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $asunto = $_POST['asunto'];
                $mensaje = $_POST['mensaje'];

                $headers =  'MIME-Version: 1.0' . "\r\n"; 
                $headers .= 'From: $nombre' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                $sent = mail('adopciones@protectoraamiga.com', $asunto, $mensaje, $headers);
            }
        ?>
    </body>
</html>