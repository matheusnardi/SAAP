<?php include 'cabecalhodash.php'; 

include 'connect.php'; 
if (empty($_GET['id_projeto'])) {
	header('location: consulta_projeto.php');
}
else{
$id_projeto = $_GET['id_projeto'];
}

$consulta_projeto = mysqli_query($conn, "SELECT titulo FROM projeto WHERE id_projeto = '$id_projeto'");
$titulo = mysqli_fetch_assoc($consulta_projeto);

$consulta_avaliador = mysqli_query($conn, "SELECT usuario.nome, usuario.id_usuario, curso.curso, curso.id_curso FROM avaliacao_alberto_feres as a INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario INNER JOIN curso ON a.id_curso = curso.id_curso where a.id_projeto = '$id_projeto' and a.status_avaliacao = '0'");

$consulta_avaliador2 = mysqli_query($conn, "SELECT usuario.nome, usuario.id_usuario, curso.curso, curso.id_curso FROM avaliacao_alberto_feres as a INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario INNER JOIN curso ON a.id_curso = curso.id_curso where a.id_projeto = '$id_projeto' and a.status_avaliacao = '1'");

$consulta_autores = mysqli_query($conn, "SELECT * FROM autor WHERE id_projeto = '$id_projeto'");
$autores_row = mysqli_fetch_array($consulta_autores);
$autores = $autores_row['nome'];
while ($autores_row = mysqli_fetch_array($consulta_autores)) {
	$autores = $autores."<br/>".$autores_row['nome'];
}

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


<h1 class="mb-3 font-weight-normal"><?php echo $titulo['titulo']; ?></h1><a class='btn btn-sm btn-outline-secondary' href="#" data-toggle="modal" data-target="#detalhe">Detalhes</a><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>

<div class="card border-secondary">

<div class="card-header border-secondary h3 font-weight-normal">	
Avaliações
</div>

<div class="card-body">

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

	<?php 
	while ($consulta_row = mysqli_fetch_array($consulta_avaliador)) {
		$id_avaliador = $consulta_row['id_usuario'];
		$nome_avaliador = $consulta_row['nome'];
		$id_curso = $consulta_row['id_curso'];
		$curso = $consulta_row['curso'];

	?>
	<div class="col mb-2">	
		<div class="card border-danger" style="max-width: 18rem;">
		  <div class="card-body text-danger">
		    <p class="card-text h5"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $nome_avaliador; ?></p>
		    <p class="card-text">ID: <?php echo $id_avaliador; ?></p>
		    <a class='btn btn-sm btn-outline-danger' href="projetos_avaliador.php?id_avaliador=<?php echo $id_avaliador; ?>">Detalhes</a>&nbsp;&nbsp;<a href="excluir_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&pag=pro" onclick="return confirmar()" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a><br/>
		  </div>
		  <a style="border-radius: 0px;" href="avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&id_curso=<?php echo $id_curso ?>&pag=pro" class="btn btn-danger"><b><i class="fas fa-tasks"></i> Avaliação</b></a>
		</div>
	</div>	
	<?php
	} ?>

	<?php 
	while ($consulta_row = mysqli_fetch_array($consulta_avaliador2)) {
		$id_avaliador = $consulta_row['id_usuario'];
		$nome_avaliador = $consulta_row['nome'];
		$id_curso = $consulta_row['id_curso'];

	?>
	<div class="col mb-2">	
		<div class="card border-success" style="max-width: 18rem;">
		  <div class="card-body text-success">
		    <p class="card-text h5"><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo $nome_avaliador; ?></p>
		    <p class="card-text">ID: <?php echo $id_projeto; ?></p>
		    <a class='btn btn-sm btn-outline-success' href="projetos_avaliador.php?id_avaliador=<?php echo $id_avaliador; ?>">Detalhes</a>&nbsp;&nbsp;<a href="excluir_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&pag=pro" onclick="return confirmar()" class="text-success"><i class="fa fa-trash" aria-hidden="true"></i></a>
		  </div>
		  <a style="border-radius: 0px;" href="avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&id_curso=<?php echo $id_curso ?>&pag=pro" class="btn btn-success"><b><i class="fas fa-edit"></i> Avaliação</b></a>
		</div>
	</div>	
	<?php
	}
	?>

	<?php
	$sql 	 = "select * from avaliacao_alberto_feres where id_projeto = '$id_projeto'";
	$result = mysqli_query($conn, $sql);		
	if (mysqli_num_rows($result) < 3) { ?>
	<div class="col mb-2">	

		    <a class="btn btn-lg btn-outline-primary" href="definicao_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&escolha=2">+ Adicionar Avaliação</a>

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

<div class="modal fade" id="detalhe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><?php echo $titulo['titulo']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
      	<h4 class="mb-3 font-weight-normal">Curso:</h4> <h5><?php echo $curso ?></h5><br/>
      	<h4 class="mb-3 font-weight-normal">Autores:</h4> <h5><?php echo $autores; ?></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php include 'rodapedash.php'; ?>