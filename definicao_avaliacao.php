<?php 
include 'cabecalhodash.php';
include 'connect.php';

$sql 	= "select * from projeto";
$sql3 	= "select * from usuario where tipo = 'avaliador'";


$result  = mysqli_query($conn, $sql);
$result3 = mysqli_query($conn, $sql3);

?>
<br/>
<br/>
<br/>

<center>
	<h1> Definição de Avaliação </h1>

	<br/>
	<br/>
	<br/>

<div class="card" style="width: 450px; border:0;">
	<form method="POST" action="incluir_avaliacao.php">
		<div class="container">
		<div class="form-group">  
		    <label for="exampleFormControlSelect1">Projetos</label>
		    <select class="form-control" name="projeto" id="exampleFormControlSelect1">
		      <option>Selecione...</option>
		      <?php while($row = mysqli_fetch_array($result)){ 
					$id_projeto = $row['id_projeto'];
						$sql2 	 = "select * from avaliacao_alberto_feres where id_projeto = '$id_projeto'";
						$result2 = mysqli_query($conn, $sql2);		
						if (mysqli_num_rows($result2) < 3) { ?>
		      				 <option value="<?php echo $row['id_projeto']; ?>"><?php echo $row['titulo']; ?></option>
				<?php 
						}
					 }      ?>
		    </select>
		</div>
		<div class="form-group">  
		    <label for="exampleFormControlSelect1">Avaliadores</label>
		    <select class="form-control" name="avaliador" id="exampleFormControlSelect1">
		      <option>Selecione...</option>
		      <?php while($row3 = mysqli_fetch_array($result3)){ 
					$id_avaliador = $row3['id_usuario'];
						$sql4 	 = "select * from avaliacao_alberto_feres where id_avaliador = '$id_usuario'";
						$result4 = mysqli_query($conn, $sql4);		
						if (mysqli_num_rows($result4) < 2) { ?>
		      				 <option value="<?php echo $row3['id_usuario']; ?>"><?php echo $row3['nome']; ?></option>
				<?php 
						}
					 }      ?>
		    </select>
		</div>	
		<button class="btn btn-primary" type="submit">Definir</button>
		</div>
	</form>
</div>	
</center>		
<?php include 'rodapedash.php'; ?>