<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$id_usuario		= $_POST['id_usuario'];
$nome 			= $_POST['nome'];
$email 			= $_POST['email'];
$tipo			= $_POST['tipo'];
$tipo_usuario 	= $_POST['tipo_usuario'];
//


//Comando de inserção
$sql = "UPDATE usuario SET nome = '$nome', email = '$email', tipo = '$tipo' WHERE id_usuario = '$id_usuario'";
//

//Comando para inserir
if (mysqli_query($conn, $sql)) {
header('location: consulta_usuario.php');
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//*/

?>