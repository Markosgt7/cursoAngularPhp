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
  $studentName = $_POST["studentName"];
  $studentAddress = $_POST["studentAddress"];
  $studentEmail = $_POST["studentEmail"];
  $studentMobile = $_POST["studentMobile"];
  $studentGender = $_POST["studentGender"];
  $studentBirthday = $_POST["studentBirthday"];

  $sql = "INSERT INTO student (studentName, studentAddress,studentEmail,studentMobile,studentBirthday,studentGender) values ('$studentName','$studentAddress','$studentEmail','$studentMobile','$studentBirthday','$studentGender')";
  $stmt = $pdoCon->prepare($sql);
  $stmt->execute();
  if($stmt){
    echo json_encode(["status" => "success", "code"=>200,"message"=>"estudiante creado con exito" ]);
  }else{
    echo json_encode(["status" => "error", "code"=>500,"message"=>"algo salio mal"]);
  }

} catch (PDOException $e) {
  echo json_encode(["status" => "error", "code"=>500, "message"=> $e->getMessage()]);
}
