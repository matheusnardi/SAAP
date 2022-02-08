<?php 
include 'connect.php';

$id_avaliacao	= $_GET['id_avaliacao'];
$avaliacao = $_GET['avaliacao'];

if ($avaliacao == 1) {
	if (mysqli_query($conn, "DELETE FROM avaliacao_inicial WHERE id_avaliacao = $id_avaliacao")) {
		echo "<script type='text/javascript'>
				window.location.href = history.back()
			  </script>";
	}
	else{
		echo "Erro!";
	}
}
elseif($avaliacao == 2){
	if (mysqli_query($conn, "DELETE FROM avaliacao_final WHERE id_avaliacao = $id_avaliacao")) {
		echo "<script type='text/javascript'>
				window.location.href = history.back()
			  </script>";
	}
	else{
		echo "Erro!";
	}
}
else{
	echo "<script type='text/javascript'>
				window.location.href = history.back()
			  </script>";
}





?>