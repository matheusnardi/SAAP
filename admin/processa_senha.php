<?php 
session_start();

$nova_senha 	= md5($_POST['nova_senha']);
$id_usuario 	= $_POST['id_usuario'];
$tipo_usuario 	= $_POST['tipo_usuario'];

include 'connect.php';

//Comando de Pesquisa
$sql = "UPDATE usuario SET senha = '$nova_senha' WHERE id_usuario = '$id_usuario'";
//

//Comando de numero de linhas da pesquisa
if (mysqli_query($conn, $sql)) {
      	echo "<script type='text/javascript'>
	      alert('Senha alterada com sucesso !');
	      window.location.href = 'regisedit.php?tipo_usuario=$tipo_usuario&id_usuario=$id_usuario'
	      </script>";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Comando de verificação de linhas

mysqli_close($conn);


?>




