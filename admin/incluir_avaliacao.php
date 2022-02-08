<?php

include 'connect.php';

$id_avaliador = $_POST['id_avaliador'];
$projeto = $_POST['projeto'];
$avaliacao = $_POST['avaliacao'];

$p = count($projeto);

if ($avaliacao == 1) {
	if ($p > 0) {
		$query_avaliacao = "INSERT INTO avaliacao_inicial (id_projeto, id_avaliador, status_avaliacao) VALUES ";

		$num = $p-1;
		for ($i=0; $i < $num; $i++) { 
			$query_avaliacao .= "($projeto[$i], $id_avaliador, 0), ";
		}
		$query_avaliacao .= "($projeto[$num], $id_avaliador, 0);";

		if (mysqli_query($conn, $query_avaliacao)) {
			echo "<script type='text/javascript'>
				alert('Avaliação definida com sucesso!');
				window.location.href = history.back()
			  </script>";
		}
		else{
			echo "Erro! <br>";
		}
	}
	else{
		echo "<script type='text/javascript'>
		alert('Selecione pelo menos 1 projeto!');
		window.location.href = history.back()
	  	</script>";
	}
}
elseif($avaliacao == 2){
	if ($p > 0) {
		$query_avaliacao = "INSERT INTO avaliacao_final (id_projeto, id_avaliador, status_avaliacao, id_feira) VALUES ";

		$id_feira = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_feira FROM feira WHERE status_abertura = 1"))['id_feira'];

		$num = $p-1;
		for ($i=0; $i < $num; $i++) { 
			$query_avaliacao .= "($projeto[$i], $id_avaliador, 0, $id_feira), ";
		}
		$query_avaliacao .= "($projeto[$num], $id_avaliador, 0, $id_feira);";

		if (mysqli_query($conn, $query_avaliacao)) {
			echo "<script type='text/javascript'>
				alert('Avaliação definida com sucesso!');
				window.location.href = history.back()
			  </script>";
		}
		else{
			echo "Erro! <br>";
		}
	}
	else{
		echo "<script type='text/javascript'>
		alert('Selecione pelo menos 1 projeto!');
		window.location.href = history.back()
	  	</script>";
	}
}
else{
	echo "<script type='text/javascript'>
				window.location.href = history.back()
			  </script>";
}
?>