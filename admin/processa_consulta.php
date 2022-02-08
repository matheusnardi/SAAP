<?php 
//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$tipo_usuario = $_POST['tipo_usuario'];
//

if ($tipo_usuario == 1) {
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}
elseif ($tipo_usuario == 2) {
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}
elseif ($tipo_usuario == 3) {
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}
elseif ($tipo_usuario == 4) {
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}
elseif ($tipo_usuario == 5) {
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}
else{
  $tipo_usuario = 5;
  header('location: consulta_usuario.php?tipo_usuario='.$tipo_usuario);
}

//Comando para inserir

mysqli_close($conn);
//

?>