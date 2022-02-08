<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$curso 			= $_POST['curso'];
$instituicao 	= $_POST['instituicao'];
//

//Comando de inserção
if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM curso WHERE curso='$curso'")) > 0){
	mysqli_close($conn);
	echo "<script type='text/javascript'>
	      alert('Curso já Existente!');
	      window.location.href = 'regiscur.php'
	      </script>";
}
else{
	$sql = "INSERT INTO curso (curso, id_instituicao) VALUES ('$curso', '$instituicao')";
	//

	//Comando para inserir
	if (mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'>
			alert('Curso Registrado com Sucesso!');
			window.location.href = 'regiscur.php'
			</script>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	//
}
?>