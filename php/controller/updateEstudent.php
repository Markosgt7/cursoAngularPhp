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
  $studentId = $_POST["studentId"];
  $studentName = $_POST["studentName"];
  $studentAddress = $_POST["studentAddress"];
  $studentEmail = $_POST["studentEmail"];
  $studentMobile = $_POST["studentMobile"];
  $studentGender = $_POST["studentGender"];
  $studentBirthday = $_POST["studentBirthday"];

  if(isset($_POST['studentId']) || isset($_POST['studentName']) || isset($_POST['studentAddress']) || isset($_POST['studentEmail']) || isset($_POST['studentMobile']) || isset($_POST['studentGender']) || isset($_POST['studentBirthday'])){
    $sql="UPDATE student SET studentName=:studentName, studentAddress=:studentAddress, studentEmail=:studentEmail, studentMobile=:studentMobile,studentGender=:studentGender,studentBirthday=:studentBirthday WHERE studentId=:studentId";
    $stmt=$pdoCon->prepare($sql);
    $stmt->bindParam(':studentName',$studentName);
    $stmt->bindParam(':studentAddress',$studentAddress);
    $stmt->bindParam(':studentEmail',$studentEmail);
    $stmt->bindParam(':studentMobile',$studentMobile);
    $stmt->bindParam(':studentGender',$studentGender);
    $stmt->bindParam(':studentBirthday',$studentBirthday);
    $stmt->bindParam(':studentId',$studentId);
    $stmt->execute();
    $stmt->closeCursor();
    $student = [
      'studentId'=> $studentId,
      'studentName'=> $studentName,
      'studentAddress'=> $studentAddress,
      'studentEmail'=> $studentEmail,
      'studentMobile'=> $studentMobile,
      'studentGender'=> $studentGender,
      'studentBirthday'=> $studentBirthday,
    ];

    echo json_encode(array('status' => 200, 'message' => 'Estudiante actualizada',"data"=>$student));

  }else{
    echo json_encode(array('status' => 400, 'message' => 'Faltan datos para actualizar'));
  }

} catch (PDOException $e) {
  echo json_encode(array('status' => 500, 'message' => 'Error al actualizar','message'=> $e->getMessage()));

}