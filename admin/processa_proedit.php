<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$id_projeto    	= $_POST['id_projeto'];
$titulo			= $_POST['titulo'];
//


//Comando de inserção
$sql = "UPDATE projeto SET titulo = '$titulo' WHERE id_projeto = '$id_projeto'";
//

//Comando para inserir
if (mysqli_query($conn, $sql)) {
header('location: consulta_projeto.php');
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//*/

?>