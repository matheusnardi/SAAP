<?php
session_start(); 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$id_projeto 	= $_POST['projeto'];
$id_avaliador	= $_POST['avaliador'];
//

$sql 	= "select * from projeto where id_projeto = '$id_projeto'";
$result = mysqli_query($conn, $sql);
$row	= mysqli_fetch_assoc($result);

$id_curso = $row['id_curso'];

//Comando de inserção
$sql2 = "select * from avaliacao_alberto_feres where id_avaliador = '$id_avaliador' and id_projeto = '$id_projeto'";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "insert into avaliacao_alberto_feres (id_projeto, id_avaliador, id_curso, status_avaliacao, nota_1, nota_2, nota_3, nota_4, nota_5, nota_6, nota_7, nota_8, nota_9, nota_10, nota_11, nota_12, nota_13)
values ('$id_projeto', '$id_avaliador', '$id_curso', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
//

//Comando para inserir Notas
if ($row = mysqli_fetch_assoc($result2)) {
		echo "<script type='text/javascript'>
	      alert('Esse avaliador já foi designado pra este projeto !');
	      window.location.href = 'definicao_avaliacao.php'
	      </script>";

}
else {

	if (mysqli_query($conn, $sql3)) {
      header('location: definicao_avaliacao.php');
	}	 	
	else {
      echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
	}	
}

mysqli_close($conn);
//
?>