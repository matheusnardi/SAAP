<?php include 'cabecalhodash.php'; 
include 'connect.php'; 
$query = mysqli_query($conn,"SELECT * FROM curso");


?>


<br/>
<br/>
<center>
<h1 class="mb-3 font-weight-normal"> Escolha um curso para visualizar o Ranking </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>	
<div class="container">
	<div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
		<h3 class="mb-3 font-weight-normal"> Cursos </h3>
		<form action="media.php" method="GET">
			<div class="form-group">
				<select class="form-control" name="curso" id="exampleFormControlSelect1" style="width: 300px;" required>
				  <option value="-1">Todos</option>
				  <?php while($curso = mysqli_fetch_array($query)){ ?>
				  <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
				  <?php } ?>
				</select>
			</div><br/>
			<button style="width: 300px;" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-search"></i> Consultar</b></button>
		</form>
		<br/>
	</div>
</div>
</center>

<?php include 'rodapedash.php'; ?>