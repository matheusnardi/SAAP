<?php include 'cabecalho.php'; 

include 'connect.php'; 

$id_avaliador = $_SESSION['id_usuario'];

$nome = $_SESSION["acesso_avaliador"];
?>

<center>
	<div class="container">

		<br/>
		<h1 class="mb-3 font-weight-normal">Bem-Vindo(a)<br/><?php echo $nome; ?></h1><br/>

		<?php
		// Verifica se o avaliador é um professor
		if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao_professor WHERE id_usuario = $id_avaliador")) > 0){
			include 'projetos_professor.php';
		}

		// Verifica se existe uma feira aberta
		if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1")) > 0) {

			// Projetos Avaliador
			include 'projetos_avaliador.php';
		}
		else{ ?>
			<h1 class="text-secondary mt-5">Não há nenhuma feira disponível</h1>
	<?php }
		?>
		

	</div>
</center>

<?php
include 'rodape.php'; 
?>