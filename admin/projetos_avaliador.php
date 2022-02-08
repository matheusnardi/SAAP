<?php include 'cabecalhodash.php'; 

include 'connect.php'; 

if (empty($_GET['id_avaliador'])) {
	header('location: consulta_avaliador.php');
}
else{
$id_avaliador = $_GET['id_avaliador'];
}


$consulta_avaliador = mysqli_query($conn, "SELECT nome FROM usuario WHERE id_usuario = '$id_avaliador'");
$nome = mysqli_fetch_assoc($consulta_avaliador);

$consulta_projeto = mysqli_query($conn, "SELECT projeto.titulo, projeto.id_projeto, curso.curso, curso.id_curso FROM avaliacao_alberto_feres as a INNER JOIN projeto ON a.id_projeto = projeto.id_projeto INNER JOIN curso ON a.id_curso = curso.id_curso where a.id_avaliador = '$id_avaliador' and a.status_avaliacao = '0'");

$consulta_projeto2 = mysqli_query($conn, "SELECT projeto.titulo, projeto.id_projeto, curso.curso, curso.id_curso FROM avaliacao_alberto_feres as a INNER JOIN projeto ON a.id_projeto = projeto.id_projeto INNER JOIN curso ON a.id_curso = curso.id_curso where a.id_avaliador = '$id_avaliador' and a.status_avaliacao = '1'");

?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO APAGAR ESSA AVALIAÇÃO ?');
}
</script>

<br/>
<br/>

<center>
<div class="container">


<h1 class="mb-3 font-weight-normal"><?php echo $nome['nome']; ?></h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
<div class="card border-secondary">

<div class="card-header border-secondary h3 font-weight-normal">	
Avaliações
</div>

<div class="card-body">

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

	<?php 
	while ($consulta_row = mysqli_fetch_array($consulta_projeto)) {
		$id_projeto = $consulta_row['id_projeto'];
		$titulo_projeto = $consulta_row['titulo'];
		$id_curso = $consulta_row['id_curso'];

		$consulta_autores = mysqli_query($conn, "SELECT * FROM autor WHERE id_projeto = '$id_projeto'");
		$autores_row = mysqli_fetch_array($consulta_autores);
		$autores = $autores_row['nome'];
		while ($autores_row = mysqli_fetch_array($consulta_autores)) {
			$autores = $autores.", ".$autores_row['nome'];
		}
	?>
	<div class="col mb-2">	
		<div class="card border-danger" style="max-width: 18rem;">
		  <div class="card-body text-danger">
		     <p class="card-text h5"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $titulo_projeto; ?></p>
		    <p class="card-text">ID: <?php echo $id_projeto; ?></p>
		    <a class='btn btn-sm btn-outline-danger' href="avaliadores_projeto.php?id_projeto=<?php echo $id_projeto; ?>">Detalhes</a>&nbsp;&nbsp;<a href="excluir_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&pag=aval" onclick="return confirmar()" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
		  </div>
		  <a style="border-radius: 0px;" href="avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&id_curso=<?php echo $id_curso ?>&pag=aval" class="btn btn-danger"><b><i class="fas fa-tasks"></i> Avaliação</b></a>
		</div>
	</div>
	<?php
	} ?>

	<?php 
	while ($consulta_row = mysqli_fetch_array($consulta_projeto2)) {
		$id_projeto = $consulta_row['id_projeto'];
		$titulo_projeto = $consulta_row['titulo'];
		$id_curso = $consulta_row['id_curso'];

		$consulta_autores = mysqli_query($conn, "SELECT * FROM autor WHERE id_projeto = '$id_projeto'");
		$autores_row = mysqli_fetch_array($consulta_autores);
		$autores = $autores_row['nome'];
		while ($autores_row = mysqli_fetch_array($consulta_autores)) {
			$autores = $autores.", ".$autores_row['nome'];
		}
	?>
	<div class="col mb-2">
		<div class="card border-success" style="max-width: 18rem;">
		  <div class="card-body text-success">
		    <p class="card-text h5"><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo $titulo_projeto; ?></p>
		    <p class="card-text">ID: <?php echo $id_projeto; ?></p>
		    <a class='btn btn-sm btn-outline-success' href="avaliadores_projeto.php?id_projeto=<?php echo $id_projeto; ?>">Detalhes</a>&nbsp;&nbsp;<a href="excluir_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&pag=aval" onclick="return confirmar()" class="text-success"><i class="fa fa-trash" aria-hidden="true"></i></a>
		  </div>
		  <a style="border-radius: 0px;" href="avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&id_curso=<?php echo $id_curso ?>&pag=aval" class="btn btn-success"><b><i class="fas fa-edit"></i> Avaliação</b></a>
		</div>
	</div>
	<?php
	}
	?>

	<?php
	$sql 	 = "select * from avaliacao_alberto_feres where id_avaliador = '$id_avaliador'";
	$result = mysqli_query($conn, $sql);		
	if (mysqli_num_rows($result) < 2) { ?>
	<div class="col mb-2">	
		    <a class="btn btn-lg btn-outline-primary" href="definicao_avaliacao.php?id_avaliador=<?php echo $id_avaliador; ?>&escolha=2">+ Adicionar Avaliação</a>
	</div>		
	<?php 
		}
	?>

</div>
</div>
<div class="card-footer border-secondary">
	<b class="text-danger">Vermelho</b>: Pendente | <b class="text-success">Verde</b>: Concluído
</div>
</div>
</center>









<?php include 'rodapedash.php'; ?>