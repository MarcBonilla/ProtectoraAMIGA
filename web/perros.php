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
        <title>Perros</title>
        <link rel="stylesheet" href="../css/stylePerros.css">
        <link rel="stylesheet" href="../css/styleAdopta.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="cont" id="blur">
            <header>
                <a href="../index.php"><img src="../img/back.png" class="back"></a>
                <div class="toggle" onclick="menu()"></div>
                <ul class="navigation">
                    <li><a href="gatos.php" class="gatos">Gatos</a></li>
                    <li><a href="exoticos.php" class="exoticos">Exóticos</a></li>
                    <li><a href="about.php">Sobre Nosotros</a></li>
                    <li><a href="donativos.php">Donativos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="../php/logout.php">Logout</a></li>
                        <li><a href="../php/animales.php" id="panel">Panel de Control</a></li>
                    <?php else: ?>
                        <li><a href="../php/login.php" id="login">Iniciar Sessión</a></li>
                    <?php endif; ?>
                </ul>
            </header>
            <br><br><br>
            <?php
                echo "<br><br><br>";
                $sentencia = $conn->prepare("SELECT * FROM animales WHERE tipo='perro'");
                $sentencia->execute();  
                $animales = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                foreach ($animales as $animal) {
                    echo "<section>";
                    echo "<div class='container'>";
                    echo '<div class="left" style="background: url(../img/'.$animal['nombre'].'.jpg) no-repeat center / cover;"></div>';
                    echo "<div class='right'>";
                    echo "<div class='content'>";
                    echo "<h1>".$animal["nombre"]."</h1>";
                    echo "<p>".$animal["descripcion"]."</p>";
                    echo "<a href='#' class='btn' onclick='toggle()'>Adóptame</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</section>";
                }
            ?>
        </div>
        <div id="popup">
            <h2>Datos de contacto</h2>
            <br/>
            <form action="#" method="post">
                Nombre: <br/>
                <input type="text" name="nombre" placeholder="Nombre" class="field"><br/><br/>
                Apellidos: <br/>
                <input type="text" name="apellidos" placeholder="Apellidos" class="field"><br/><br/>
                Teléfono: <br/>
                <input type="tel" name="telefono" placeholder="Teléfono" class="field" maxlength="9"><br/><br/>
                Email: <br/>
                <input type="text" name="email" placeholder="Email" class="field"><br/><br/><br/>
                <input type="submit" name="submit" value="Enviar" class="submit">
                <a href="#" onclick="toggle()" class="close">Cerrar</a>
            </form>
            
        </div>
        <script>
            function menu() {
                var menuToggle = document.querySelector('.toggle');
                var navigation = document.querySelector('.navigation') 
                menuToggle.classList.toggle('active');
                navigation.classList.toggle('active');
            }  
        </script>
        <script type="text/javascript">
            function toggle() {
                blur = document.getElementById('blur');
                blur.classList.toggle('active');
                popup = document.getElementById('popup');
                popup.classList.toggle('active');
            }
        </script>

        <!--?php
            if (isset($_POST['submit'])) {
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $telefono = $_POST['telefono'];
                $email = $_POST['email'];

                $headers =  'MIME-Version: 1.0' . "\r\n"; 
                $headers .= 'From: $nombre $apellidos' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                $sent = mail('adopciones@protectoraamiga.com', "Adopción", "Se ha solicitado una adopción, Correo de contacto: ".$email, $headers);
            }
        ?-->
    </body>
</html>