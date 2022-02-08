<?php 
include 'cabecalhodash.php'; 
include 'connect.php';

$sql      = 
"select id_projeto, id_curso, count(*), 
(avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10)+avg(n11))Nota_final
from avaliacao_final where status_avaliacao = 1
group by id_projeto order by Nota_final DESC";

$result = mysqli_query($conn, $sql);

$contador = 0;
$media = 0;

while ($row = mysqli_fetch_array($result)) {
	$contador = $contador+1;
	$media = $media+$row['Nota_final'];
}

if($contador != 0){
    $media_final = $media/$contador;
}
else{
    $media_final = 0;
}
?>


<br/>
<br/>

<center>
<h1 class="mb-3 font-weight-normal"> Média da Nota Total de Avaliações</h1>	

<br/>
<br/>

<div class="container">
	<div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
		<h3 class="mb-3 font-weight-normal"> Nota </h3><br/>
		<h2 class="mb-3 font-weight-normal"> <?php echo round($media_final, 2); ?> de 66</h2>
	</div>
</div>

<?php include 'rodapedash.php'; ?>		