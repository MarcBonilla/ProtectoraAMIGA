<?php
    require "database.php"; 
    $id = $_GET['id'];

    $query = $conn->prepare("SELECT * FROM animales WHERE id = ".$id);
    $query->execute();  
    $values = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($values as $value) {
      $nombre = $value['nombre'];
      $desc = $value['descripcion'];
    }

    if (!empty($_POST['descripcion']) && !empty($_POST['estado'])) {
        $sql = "UPDATE animales SET descripcion = :descripcion, estado = :estado WHERE id = ".$id;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':descripcion', $_POST['descripcion']);
        $stmt->bindParam(':estado', $_POST['estado']);
        if ($stmt->execute()) {
          $message = 'Successfully edited animal';
          header('Location: animales.php');
        } else {
          $message = 'Sorry there must have been an issue editing your animal';
        }
      }
      
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <title>Edit</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleFormulario.css">
  </head>
  <body>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div id="contenedor">
      <h1 class="titulo"><?php echo $nombre ?></h1>
      <form action="edit.php?id=<?php echo $id ?>" method="POST">
          <strong>ESTADO:</strong><br><br>
          <input type="radio" id="adoptado" name="estado" value="adoptado">
          <label for="adoptado">Adoptado</label><br>
          <input type="radio" id="reservado" name="estado" value="reservado">
          <label for="reservado">Reservado</label><br>
          <input type="radio" id="urgente" name="estado" value="urgente">
          <label for="urgente">Urgente</label><br>
          <input type="radio" id="adopcion" name="estado" value="---">
          <label for="adopcion">En Adopción</label><br><br>
          <strong>DESCRIPCIÓN:</strong><br><textarea name="descripcion" type="textbox" rows="12" cols="100"><?php echo $desc ?></textarea><br><br>
          <input type="submit" value="Submit">
          <input name="cancel" type="button" value="Salir" onclick="location.href = 'animales.php';">
      </form>
    </div>
    <script>

    </script>
  </body>
</html>