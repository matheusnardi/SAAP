<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$titulo	      = 	$_POST['titulo'];
$id_curso		= 	$_POST['id_curso'];
$id_equipe        =     $_POST['id_equipe'];
//

//Comando de inserção
$sql     = "INSERT INTO projeto (titulo, id_curso, id_equipe, endereco_count) VALUES ('$titulo', '$id_curso', '$id_equipe', 4)";
//

//Comando para inserir
if (mysqli_query($conn, $sql)) {
      echo "<script type='text/javascript'>
			alert('Projeto Registrado com Sucesso!');
			window.location.href = 'regispro.php'
			</script>";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//

?>