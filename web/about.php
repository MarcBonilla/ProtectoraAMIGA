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
        <title>Sobre Nosotros</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleAbout.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <section>
            <header>
                <a href="../index.php"><img src="../img/back.png" class="back"></a>
                <div class="toggle" onclick="menu()"></div>
                <ul class="navigation">
                    <li><a href="">Sobre Nosotros</a></li>
                    <li><a href="donativos.php">Donativos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="../php/logout.php">Logout</a></li>
                        <li><a href="../php/animales.php" id="panel">Panel de Control</a></li>
                    <?php else: ?>
                        <li><a href="../php/login.php" id="login">Iniciar Sesión</a></li>   
                    <?php endif; ?>
                </ul>
            </header>
            <div class="about">
                <p class="subtitulos">Sobre AMIGA</p>
                <p class="textoInfo">
                    Somos una organización protectora de animales especializada, desde 1996, 
                    en la ayuda a perros, gatos y animales exóticos maltratados y/o abandonados; una organización 
                    española totalmente independiente que no recibe subvenciones de organismos oficiales, 
                    empresas ni partidos políticos.<br><br>
                    Durante los primeros años los animales eran cuidados en casas particulares 
                    mientras se intenta darles en adopción hasta que se pudo tener el primer refugio, 
                    y pasando luego por otros diferentes.<br><br>
                    Gracias al Ayuntamiento de Tarragona, y tras muchos años de luchar, se consiguió iniciar 
                    la construcción de nuestro actual refugio en el Polígono Riuclar de Tarragona, el 10 de 
                    enero de 2003, y desde su inauguración estamos allí.<br><br>
                    En la actualidad, la Protectora cuenta con instalaciones dedicadas con jaulas para albergar 
                    gatos, perros y animales exóticos, que también tienen su espacio abierto para salir a diario. Además dispone de 
                    un Consultorio Veterinario propio, oficinas de recepción, sanitarios y almacén.
                </p>
            </div>
        </section>
        <div class="personas">
            <div class="persona" id="persona1">
                <img class="foto" src="../img/marc.png">
                <p class="infoPers"><span class="nombre">Marc Bonilla</span> <br><span class="trabajo">VICEPRESIDENTE EJECUTIVO</span><br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vel nibh lacus. Maecenas mollis elit nulla, 
                    vitae maximus odio pharetra et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere 
                    cubilia curae; Phasellus at mauris tempor, interdum dui at, tempus sapien. Praesent sit amet sollicitudin 
                    lacus. 
                </p>
            </div><br><br>
            <div class="persona">
                <img class="foto" src="../img/roger.png">
                <p class="infoPers"><span class="nombre">Roger Collado</span> <br><span class="trabajo">DIRECTOR GENERAL</span><br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vel nibh lacus. Maecenas mollis elit nulla, 
                    vitae maximus odio pharetra et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere 
                    cubilia curae; Phasellus at mauris tempor, interdum dui at, tempus sapien. Praesent sit amet sollicitudin 
                    lacus. 
                </p>
            </div>
        </div><br><br>
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
    </body>
</html>