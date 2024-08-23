<?php
//conexion
include "../config/Conexion.php";
//Cabeceras CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE');
header("Access-Control-Max-Age: 86000");
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With');

//Generador de reporte
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header('HTTP/1.1 200 OK');
  exit();
}
try{
  $sql = "SELECT * FROM student";
  
  $query = $pdoCon->prepare($sql);
  $query->execute();
  
  //recuperar resultados
  $datos = [];
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $datos[] = $row;
    }

  echo json_encode(array("status"=>"success","code"=>200,"data"=> $datos));

}catch(PDOException $e){
  echo json_encode(array("status"=>"error","code"=>0,"message"=> $e->getMessage()));

}

