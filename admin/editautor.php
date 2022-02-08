<?php 
//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$id_projeto		= 	$_GET['id_projeto'];
$id_autor     =   $_GET['id_autor'];
//

/*if($id_projeto < 0){
  echo "<script type='text/javascript'>
       alert('Nenhum Projeto Selecionado !');
       window.location.href = 'regisautor.php'
       </script>";		
}
if ($autor == "retornar") {
	header('location: regisautor.php?id_projeto='.$id_projeto);
}*/

	if (mysqli_query($conn, "delete from autor where id_autor = '$id_autor'")) {
	header('location: regisautor.php?id_projeto='.$id_projeto);
	} 
	else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
//Comando para inserir

mysqli_close($conn);
//

?>