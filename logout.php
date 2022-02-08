<?php
session_start();

include 'connect.php';

// if(isset($_SESSION["acesso_avaliador"])){
// 	$id_usuario = $_SESSION['id_usuario'];
// 	if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao_professor WHERE id_usuario = $id_usuario")) < 1){
// 		$sql2 		= "SELECT * FROM avaliacao_final WHERE id_avaliador = $id_usuario";
// 		$result 	= mysqli_query($conn, $sql2);
// 		$contador 	= 0;
// 		while ($row	= mysqli_fetch_array($result)) {
// 			if ($row['status_avaliacao'] == 0) {
// 				$contador = $contador + 1;
// 			}
// 		}
// 		if ($contador == 0) {
// 			$sql 		= "update usuario set status_usuario = 0 where id_usuario = '$id_usuario'";
// 			if (mysqli_query($conn, $sql)) {		
// 			}else{
// 			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 			}
// 		}
// 	}
// }
session_destroy();
header('location: login.php');

?>