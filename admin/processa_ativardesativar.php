<?php 
include 'connect.php';

$status = $_POST['status'];
$id_usuario = $_POST['id_usuario'];
$tipo_usuario = $_POST['tipo_usuario'];

if($status == 0){
  $status = 1;
}else{
  $status = 0;
}

$sql = "update usuario set status_usuario = $status where id_usuario like $id_usuario";

if(mysqli_query($conn, $sql)){
  header('location: consulta_usuario.php');
}
else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>