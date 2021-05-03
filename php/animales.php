<?php
    session_start();
    require '../php/database.php';
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
    }

    $sentencia = $conn->prepare("SELECT * FROM animales ORDER BY tipo");
    $sentencia->execute();  
    $animales = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Animales</title>
        <link rel="icon" type="image/png" href="../img/logo.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styleDatabase.css">
        <link rel="stylesheet" href="../img/icons/css/font-awesome.css">
        <style>
            th {
                text-align: center; 
                vertical-align: middle
            }
        </style>
    </head>
    <body>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <th>SEXO</th>
                    <th>DESCRIPCION</th>
                    <th>ESTADO</th>
                    <th><input name="añadir" type="button" value="+" onclick="location.href = 'add.php';"></th>
                </tr>
            </thead>
            <?php foreach ($animales as $row) { ?> 
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['tipo'] ?></td>
                    <td><?php echo $row['sexo'] ?></td>
                    <td style="width: 50%"><?php echo $row['descripcion'] ?></td>
                    <td><?php echo $row['estado'] ?></td>
                    <td>
                        <div class="actions">
                            <a href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>
        <br><input name="cancel" class="btn" type="button" value="Salir" onclick="location.href = '../index.php';">
    </body>
</html