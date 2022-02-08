<?php include 'cabecalhodash.php'; 

include 'connect.php'; 
if (empty($_GET['id_projeto']) or empty($_GET['id_avaliador'])) {
	header('location: consulta_projeto.php');
}
else{
$id_projeto = $_GET['id_projeto'];
$id_avaliador = $_GET['id_avaliador'];
}

$consulta_comentario = mysqli_query($conn, "SELECT * FROM avaliacao_alberto_feres WHERE id_avaliador = '$id_avaliador' and id_projeto = '$id_projeto'");

$consulta_comentario = mysqli_fetch_assoc($consulta_comentario);


$consulta_nomeTitulo = mysqli_query($conn, "SELECT usuario.nome, projeto.titulo FROM avaliacao_alberto_feres as a 
INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
INNER JOIN projeto ON a.id_projeto = projeto.id_projeto
WHERE a.id_avaliador = '$id_avaliador' and a.id_projeto = '$id_projeto'");
$consulta_nomeTitulo = mysqli_fetch_assoc($consulta_nomeTitulo);

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

<h1 class="mb-3 font-weight-normal"> Comentários da Avaliação </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --> 
<h4 class="mb-3 font-weight-normal">De:</h4> <h3 class="mb-3 font-weight-normal"><?php echo $consulta_nomeTitulo['nome']; ?></h3>
<br/><br/>


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2">	
<?php 

	if (empty($consulta_comentario['obs_alunos'])) {
}
else{
	$obs_alunos = $consulta_comentario['obs_alunos'];

?>
	<div class="col mb-2">
	<div class="card border-secondary">
	  <div class="card-header border-secondary">
	    <h4><i class="fas fa-comment-dots"></i> Alunos</h4>
	  </div>
	  <div class="card-body">
	    <h5 class="card-title font-italic">"<?php echo $obs_alunos ?>"</h5>
	  </div>
	</div>
	</div>		
<?php } ?>		


<?php 

	if (empty($consulta_comentario['obs_comissao'])) {
}
else{
	$obs_comissao = $consulta_comentario['obs_comissao'];

?>
		<div class="col mb-2">
		<div class="card border-secondary">
		  <div class="card-header border-secondary">
		    <h4><i class="fas fa-comment-dots"></i> Comissão</h4>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title font-italic">"<?php echo $obs_comissao ?>"</h5>
		  </div>
		</div>
		</div>
<?php } ?>		
</div>
<br/>
<h4 class="mb-3 font-weight-normal">Para:</h4> <h3 class="mb-3 font-weight-normal"><?php echo $consulta_nomeTitulo['titulo']; ?></h3>
</div>
</center>
<br/>
<?php include 'rodapedash.php'; ?>