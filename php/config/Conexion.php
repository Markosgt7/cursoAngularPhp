<?php
include "env.php";

try {
  $pdoCon = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."; charset=utf8", DBUSER, DBPASS);
  $pdoCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  "Conexión exitosa";
} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();  
}