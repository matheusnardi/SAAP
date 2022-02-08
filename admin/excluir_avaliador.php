<?php 
session_start();

$id_avaliador   = $_POST['id_avaliador'];

include 'connect.php';

//Comando de Pesquisa
$sql2 = "DELETE FROM avaliacao_alberto_feres WHERE id_avaliador = '$id_avaliador'";
$sql3 = "DELETE FROM usuario WHERE id_usuario = '$id_avaliador'";
//

//Comando de numero de linhas da pesquisa

	if (mysqli_query($conn, $sql2)) {
		if (mysqli_query($conn, $sql3)) {
		header('location: consulta_avaliador.php');   
		} else {
		      echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
		}   
	} else {
	      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
	}   

//Comando de verificação de linhas
mysqli_close($conn);


?>




