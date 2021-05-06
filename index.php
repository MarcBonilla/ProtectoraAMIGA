<?php
    session_start();

    require 'php/database.php';

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
        <link rel="icon" type="image/png" href="img/logo.png">
        <title>Protectora Amiga</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <section>
            <div class="circle"></div>
            <header>
                <a href=""><img src="img/logo.png" class="logo"></a>
                <div class="toggle" onclick="menu()"></div>
                <ul class="navigation">
                    <li><a href="web/about.php">Sobre Nosotros</a></li>
                    <li><a href="web/donativos.php">Donativos</a></li>
                    <li><a href="web/contacto.php">Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="php/logout.php">Logout</a></li>
                        <li><a href="php/animales.php" id="panel">Panel de Control</a></li>
                    <?php else: ?>
                        <li><a href="php/login.php" id="login">Iniciar Sesión</a></li>   
                    <?php endif; ?>
                </ul>
            </header>
            <div class="content">
                <div class="textBox">
                    <h2>Protectora <span class="emp">AMIGA</span></h2>
                    <p>Somos una organización protectora de animales especializada, desde 1996, 
                       en la ayuda a perros y gatos maltratados y/o abandonados; una organización 
                       española totalmente independiente que no recibe subvenciones de organismos oficiales, 
                       empresas ni partidos políticos.</p>
                    <a href="web/perros.php" class="url">Ver perros</a>
                </div>
                <div class="imgBox">
                    <img src="img/img1.png" class="animal">
                </div><br><br>
            </div>
            <ul class="thumb">
                <li class="perro"><img src="img/thumb1.png" onclick="imgSlider('img/img1.png'); cambiarColor('#1F0400'); cambiarURL('perros'); bouncePerro();"></li>
                <li class="gato"><img src="img/thumb2.png" onclick="imgSlider('img/img2.png'); cambiarColor('#562822'); cambiarURL('gatos'); bounceGato();"></li>
                <li class="exotico"><img src="img/thumb3.png" onclick="imgSlider('img/img3.png'); cambiarColor('#A79B7B'); cambiarURL('exóticos'); bounceExo();"></li>
            </ul>
        </section>
        <script type="text/javascript">
            function imgSlider(item) {
                document.querySelector('.animal').src = item;
                element = document.querySelector('.animal');
                element.classList.remove('on'); 
                void element.offsetWidth;
                element.classList.add('on'); 
            }
            function bouncePerro() {
                element = document.querySelector('.perro');
                element.classList.remove('on'); 
                void element.offsetWidth;
                element.classList.add('on'); 
            }
            function bounceGato() {
                element = document.querySelector('.gato');
                element.classList.remove('on'); 
                void element.offsetWidth;
                element.classList.add('on'); 
            }
            function bounceExo() {
                element = document.querySelector('.exotico');
                element.classList.remove('on'); 
                void element.offsetWidth;
                element.classList.add('on'); 
            }
            function cambiarColor(color) {
                const circle = document.querySelector('.circle');
                const emp = document.querySelector('.emp');
                const url = document.querySelector('.url');
                circle.style.background = color; 
                emp.style.color = color;
                url.style.background = color;
            }
            function cambiarURL(tipo) {
                document.querySelector('.url').innerHTML = 'Ver ' + tipo;
                if (tipo == 'exóticos') document.querySelector('.url').href = 'web/exoticos.php';
                else document.querySelector('.url').href = 'web/' + tipo + '.php';
            }     
            function menu() {
                var menuToggle = document.querySelector('.toggle');
                var navigation = document.querySelector('.navigation') 
                menuToggle.classList.toggle('active');
                navigation.classList.toggle('active');
            }       
        </script>
    </body>
</html>