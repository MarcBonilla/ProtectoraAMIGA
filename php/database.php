<?php

$server = 'localhost';
$username = 'root';
$password = 'P@ssw0rd';
$database = 'ProtectoraAMIGA';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
  }

?>
  