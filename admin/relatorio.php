<?php include 'cabecalhodash.php';
include 'connect.php'; 
$query = mysqli_query($conn,"SELECT * FROM projeto WHERE id_projeto IN (SELECT id_projeto FROM avaliacao_final WHERE status_avaliacao = 1)");
?>

<br/>
<br/>
<center>
<h1 class="mb-3 font-weight-normal"> Escolha um projeto para gerar o Relatório </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>	
<div class="container">
	<div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
		<h3 class="mb-3 font-weight-normal"> Projetos </h3>
		<form action="gerarpdf.php" method="GET" target="_blank">
			<div class="form-group">
				<select class="form-control" name="projeto" style="width: 300px;" required>
				  <option value="">Selecione...</option>
				  <?php while($projeto = mysqli_fetch_array($query)){ ?>
				  <option value="<?php echo $projeto['id_projeto']; ?>"><?php echo $projeto['titulo']; ?></option>
				  <?php } ?>
				</select>
			</div><br/>
			<button style="width: 300px;" class="btn btn-md btn-primary btn-block" type="submit"><i class="fas fa-spinner"></i> <b>Gerar</b></button>
		</form><br/>
	</div>	
</div>
</center>


<?php include 'rodapedash.php'; ?>