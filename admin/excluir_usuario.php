<?php 
session_start();

$id_usuario   = $_POST['id_usuario'];
$tipo_usuario = $_POST['tipo_usuario'];

include 'connect.php';

//Comando de Pesquisa
$sql = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
//

//Comando de numero de linhas da pesquisa

if (mysqli_query($conn, $sql)) {
       header('location: consulta_usuario.php');
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Comando de verificação de linhas

mysqli_close($conn);


?>




