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
        <title>Donativos</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleDona.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <section>
            <header>
                <a href="../index.php"><img src="../img/back.png" class="back"></a>
                <div class="toggle" onclick="menu()"></div>
                <ul class="navigation">
                    <li><a href="about.php">Sobre Nosotros</a></li>
                    <li><a href="">Donativos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="../php/logout.php">Logout</a></li>
                        <li><a href="../php/animales.php" id="panel">Panel de Control</a></li>
                    <?php else: ?>
                        <li><a href="../php/login.php" id="login">Iniciar Sesión</a></li>   
                    <?php endif; ?>
                </ul>
            </header> 
            <script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <div class="donate">
                <div class="donate__left">
                    <img src="../img/white-heart.jpg" class="donate__left__heart">
                    <p class="donate__left__thanks">
                        <span class="donate__left__thanks--header">Muchas gracias!</span>
                        <span class="donate__left__thanks--text"> 
                            Gracias a usted nuestra protectora puede seguir ayudando a más animales.
                            Le estamos eternamente agradecidos
                        </span>
                    </p>
                </div>

                <div class="donate__right">
                        <p class="donate__right__header">Done ahora</p>
                        <form method="post" action="#">
                            
                                <select class="donate__right__select" id="dSelect" onchange="changeCurrency()">
                                    <option name="eur" value="€">€ EUR</option>
                                    <option name="usd" value="$">$ USD</option>
                                    <option name="eur" value="₿">₿ BTC</option>
                                    <option name="usd" value="¥">¥ JPY</option>
                                </select>

                                <script type="text/javascript">
                                    function changeCurrency() {
                                        ccy = document.getElementById("dSelect").value;
                                        // document.getElementById("currency1").innerHTML = "5 " + ccy;
                                        // document.getElementById("currency2").innerHTML = "10 " + ccy;
                                        // document.getElementById("currency3").innerHTML = "15 " + ccy;
                                        // document.getElementById("currency4").innerHTML = "20 " + ccy;
                                        document.getElementById("currency5").innerHTML = ccy;
                                    }
                                </script>

                            <div class="donate__right__pago--1">
                                <input type="radio" name="pago" value="uno"> Una vez
                            </div>
                            <div class="donate__right__pago--mes">
                                <input type="radio" name="pago" value="mensual"> Mensual
                            </div>

                            <div class="donate__right__qty">
                                <input type="button" value="5" class="donate__right__qty__btn donate__right__qty__btn--1" onclick="changeQuantity(this)"></button>
                                <input type="button" value="10" class="donate__right__qty__btn donate__right__qty__btn--2" onclick="changeQuantity(this)"></button>
                                <input type="button" value="15" class="donate__right__qty__btn donate__right__qty__btn--3" onclick="changeQuantity(this)"></button>
                                <input type="button" value="20" class="donate__right__qty__btn donate__right__qty__btn--4" onclick="changeQuantity(this)"></button>
                                <p id="currency5">€</p>
                                <input type="number" id="cantidad" class="donate__right__qty__own" placeholder="Ponga su cantidad">                        
                            </div>

                            <script type="text/javascript">
                                function changeQuantity(quantity) {
                                    console.log(quantity.value)
                                    $('#cantidad').attr('value', quantity.value);
                                }
                            </script>

                        </form>
                        <p class="donate__right__subheader">Método de pago</p>
                        <img src="../img/lock.png" class="donate__right__lock">
                        <p class="donate__right__secure">SECURE</p>

                        <button class="donate__right__btn donate__right__btn--1">
                            <p class="donate__right__btn__text"></p>
                            <img src="../img/mastercard.png" class="donate__right__btn__img">
                            <img src="../img/visa.png" class="donate__right__btn__img">
                        </button>

                        <button class="donate__right__btn donate__right__btn--2" onclick="redirPaypal()">
                            <p class="donate__right__btn__text"></p>
                            <img src="../img/paypal.png" class="donate__right__btn__img--pp">
                        </button>

                        <script type="text/javascript">
                            function redirPaypal() {
                                window.open('https://www.paypal.com/es/home', '_blank');
                            }
                        </script>
                </div>
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
    </body>
</html>
                