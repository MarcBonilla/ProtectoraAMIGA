<?php
    include "database.php"; 
    $id = $_GET['id']; 
    $sentencia = $conn->prepare("DELETE FROM animales WHERE id = '$id'");
    $sentencia->execute();  
    if ($sentencia) {
        header("location:animales.php"); 
        exit;
    } else {
        echo "Error deleting animal"; 
    }
?>