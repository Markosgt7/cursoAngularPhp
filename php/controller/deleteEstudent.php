<?php

include'../config/Conexion.php';

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
  $id = $_GET['id'];
  if(isset($id) && $id != null){    
    $sql= "DELETE FROM student where studentId=:id";
    $stmt = $pdoCon->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();    
    echo json_encode(array("status"=>"success","code"=>200,"message"=>"categoria eliminada"));
  }else{
    echo json_encode(array("status"=>"error","code"=>400,"message"=>"no se envió id"));
  }

} catch (PDOException $e) {
  echo json_encode(array("satus"=>"error","code"=>500,"message"=>"no se pudo eliminar la categoria"));
}
