<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
  }

  require 'database.php';
  

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: ../index.php");
    } else {
      $message = 'Credenciales incorrectas';
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <meta charset="utf-8">
    <title>Iniciar Sessión</title>
    <link rel="stylesheet" href="../css/styleLogin.css">
  </head>
  <body>
    <form class="box" action="login.php" method="POST">
      <h1>Login</h1>
      <input name="email" type="text" placeholder="Email">
      <input name="password" type="password" placeholder="Password">
      <input type="submit" value="Submit">
      <input name="cancel" type="button" value="Salir" onclick="location.href = '../index.php';">
      <?php if(!empty($message)): ?>
        <p style="color: white"><?= $message ?></p>
      <?php endif; ?>
    </form>
  </body>
</html>