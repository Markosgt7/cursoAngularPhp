<?php
include "../config/Conexion.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE,PATCH');
header('Access-Control-Max-Age: 86000');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

if($_SERVER['REQUEST_METHOD']== 'OPTIONS'){
  header('HTTP/1.1 200 OK');
  exit();
}

try {
  //$cat_id = $_POST["cat_id"];
  $cat_nom = $_POST["cat_nom"];
  $cat_obs = $_POST["cat_obs"];
  $cat_est = $_POST["cat_est"];

  $sql = "INSERT INTO categorias (cat_nom, cat_obs,cat_est) values ('$cat_nom','$cat_obs','$cat_est')";
  $stmt = $pdoCon->prepare($sql);
  $stmt->execute();
  if($stmt){
    echo json_encode( array("status" => "success", "code"=>200,"message"=>"categoría creada con exito" ));
  }

} catch (PDOException $e) {
  echo json_encode( array("status" => "error", "code"=>500, "message"=> $e->getMessage() ));
}
