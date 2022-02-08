<?php 

$email = $_POST['email'];
$senha = md5($_POST['senha']);

include 'connect.php';

//Comando de Pesquisa
$sql = "SELECT * FROM usuario WHERE email = '$email' and senha = '$senha'";
//

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {	
	if ($row['status_usuario'] == 1) {
		session_start();
		$_SESSION["id_usuario"]			= $row['id_usuario'];

		if ($row['tipo'] == "comum") {
		$_SESSION["acesso_comum"]		= $row['nome'];	
		}
		elseif ($row['tipo'] == "avaliador") {
		$_SESSION["acesso_avaliador"]	= $row['nome'];
		}
		elseif ($row['tipo'] == "adm") {
		$_SESSION["acesso_adm"]			= $row['nome'];		
		}
		elseif ($row['tipo'] == "orientador") {
		$_SESSION["acesso_orientador"]	= $row['nome'];		
		}
		header('location: index.php');	
	}
		else{
		echo "<h1>Sua conta foi desativada, fale com um administrador para ativar novamente.
		</h1>";
		}
}		
else{
	//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	echo "<script type='text/javascript'>
	      alert('Login Inválido ! Verifique suas credenciais e tente novamente.');
	      window.location.href = 'login.php'
	      </script>";

}

mysqli_close($conn);

?>




