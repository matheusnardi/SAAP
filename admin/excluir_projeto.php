<?php 
session_start();

$id_projeto   = $_POST['id_projeto'];

include 'connect.php';

//Comando de Pesquisa
$sql = "DELETE FROM autor WHERE id_projeto = '$id_projeto'";
$sql2 = "DELETE FROM avaliacao_alberto_feres WHERE id_projeto = '$id_projeto'";
$sql3 = "DELETE FROM projeto WHERE id_projeto = '$id_projeto'";
//

//Comando de numero de linhas da pesquisa

if (mysqli_query($conn, $sql)) {
	if (mysqli_query($conn, $sql2)) {
		if (mysqli_query($conn, $sql3)) {
		header('location: consulta_projeto.php');   
		} else {
		      echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
		}   
	} else {
	      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
	}   
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Comando de verificação de linhas
mysqli_close($conn);


?>




