<?php 
//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$id_projeto		= 	$_POST['id_projeto'];
$autor        	=   $_POST['autor'];
//

if($id_projeto < 0){
  echo "<script type='text/javascript'>
       alert('Nenhum Projeto Selecionado !');
       window.location.href = 'regisautor.php'
       </script>";		
}
if ($autor == "retornar") {
	header('location: regisautor.php?id_projeto='.$id_projeto);
}
else{
	if (mysqli_query($conn, "INSERT INTO autor (nome, id_projeto) VALUES ('$autor', '$id_projeto')")) {
	header('location: regisautor.php?id_projeto='.$id_projeto);
	} 
	else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
 
//Comando para inserir

mysqli_close($conn);
//

?>