<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['nombre']) && !empty($_POST['tipo'] && !empty($_POST['descripcion']) && !empty($_POST['estado']) && !empty($_POST['sexo']))) {
    $sql = "INSERT INTO animales (nombre, tipo, descripcion, estado, sexo) VALUES (:nombre, :tipo, :descripcion, :estado, :sexo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':descripcion', $_POST['descripcion']);
    $stmt->bindParam(':estado', $_POST['estado']);
    $stmt->bindParam(':sexo', $_POST['sexo']);
    if ($stmt->execute()) {
      $message = 'Successfully created new animal';
      header('Location: animales.php');
    } else {
      $message = 'Sorry there must have been an issue creating your animal';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <title>Add</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleFormulario.css">
  </head>
  <body>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div id="contenedor">
      <h1 class="titulo">FORMULARIO ANIMALES</h1>
      <form action="add.php" method="POST">
        <strong>NOMBRE:</strong> <input name="nombre" type="text" placeholder="Nombre" autofocus>
        <br><br><strong>TIPO</strong><br><br>
        <input type="radio" id="perro" name="tipo" value="perro">
        <label for="perro">Perro</label><br>
        <input type="radio" id="gato" name="tipo" value="gato">
        <label for="gato">Gato</label><br>
        <input type="radio" id="exotico" name="tipo" value="exotico">
        <label for="exotico">Exotico</label>
        <br><br><strong>ESTADO:</strong><br><br>
        <input type="radio" id="adoptado" name="estado" value="adoptado">
        <label for="adoptado">Adoptado</label><br>
        <input type="radio" id="reservado" name="estado" value="reservado">
        <label for="reservado">Reservado</label><br>
        <input type="radio" id="urgente" name="estado" value="urgente">
        <label for="urgente">Urgente</label><br>
        <input type="radio" id="adopcion" name="estado" value="---">
        <label for="adopcion">En Adopción</label><br><br>
        <strong>SEXO:</strong><br><br>
        <input type="radio" id="macho" name="sexo" value="macho">
        <label for="sexo">Macho</label><br>
        <input type="radio" id="hembra" name="sexo" value="hembra">
        <label for="sexo">Hembra</label><br><br>
        <strong>DESCRIPCIÓN:</strong><br><textarea name="descripcion" type="textbox" rows="4" cols="100"></textarea><br><br>
        <strong>IMAGEN:</strong> <input type="file" id="imagen"><br><br>
        <input type="submit" value="Submit">
        <input name="cancel" type="button" value="Salir" onclick="location.href = '../php/animales.php';">
      </form>
    </div>
  </body>
</html>