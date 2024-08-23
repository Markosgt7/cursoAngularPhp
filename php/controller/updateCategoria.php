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
  $cat_id = $_POST['cat_id'];
  $cat_nom = $_POST['cat_nom'];
  $cat_obs = $_POST['cat_obs'];
  $cat_est = $_POST['cat_est'];

  if(isset($_POST['cat_nom']) || isset($_POST['cat_obs']) || isset($_POST['cat_est']) || isset($_POST['cat_id'])){
    $sql="UPDATE categorias SET cat_nom=:cat_nom, cat_obs=:cat_obs, cat_est=:cat_est WHERE cat_id=:cat_id";
    $stmt=$pdoCon->prepare($sql);
    $stmt->bindParam(':cat_id',$cat_id);
    $stmt->bindParam(':cat_nom',$cat_nom);
    $stmt->bindParam(':cat_obs',$cat_obs);
    $stmt->bindParam(':cat_est',$cat_est);
    $stmt->execute();
    $stmt->closeCursor();
    $categorias = [
      'cat_id'=> $cat_id,
      'cat_nom'=> $cat_nom,
      'cat_obs'=> $cat_obs,
      'cat_est'=> $cat_est
    ];

    echo json_encode(array('status' => 200, 'message' => 'Categoria actualizada',"data"=>$categorias));

  }else{
    echo json_encode(array('status' => 400, 'message' => 'Faltan datos para actualizar'));
  }

} catch (PDOException $e) {
  echo json_encode(array('status' => 500, 'message' => 'Error al actualizar',"message"=> $e->getMessage()));

}