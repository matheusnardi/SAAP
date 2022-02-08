<?php

include 'connect.php';

if (empty($_GET['projeto'])) {
	header('relatorio.php');
}
else{
	$id_projeto = $_GET['projeto'];
}

$media_individual = mysqli_query($conn, "select id_projeto, id_curso, count(*), avg(n1), avg(n2), avg(n3), avg(n4), avg(n5), avg(n6), avg(n7), avg(n8), avg(n9), avg(n10), avg(n11) 
from avaliacao_final where status_avaliacao = 1 and id_projeto = $id_projeto group by id_projeto");

$media_individual = mysqli_fetch_assoc($media_individual);

$media_final = mysqli_query($conn, "select id_projeto, id_curso, count(*), 
(avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10)+avg(n11))Nota_final
from avaliacao_final where status_avaliacao = 1 and id_projeto = $id_projeto group by id_projeto;");

$media_final = mysqli_fetch_assoc($media_final);
$media_final = round($media_final['Nota_final'], 2);

$nota_1 = round($media_individual['avg(n1)'], 2);
$nota_2 = round($media_individual['avg(n2)'], 2);
$nota_3 = round($media_individual['avg(n3)'], 2);
$nota_4 = round($media_individual['avg(n4)'], 2);
$nota_5 = round($media_individual['avg(n5)'], 2);
$nota_6 = round($media_individual['avg(n6)'], 2);
$nota_7 = round($media_individual['avg(n7)'], 2);
$nota_8 = round($media_individual['avg(n8)'], 2);
$nota_9 = round($media_individual['avg(n9)'], 2);
$nota_10 = round($media_individual['avg(n10)'], 2);
$nota_11 = round($media_individual['avg(n11)'], 2);

$titulo = mysqli_query($conn, "SELECT * FROM projeto WHERE id_projeto = '$id_projeto'");
$titulo = mysqli_fetch_assoc($titulo);
$titulo = $titulo['titulo'];

$equipe  = mysqli_query($conn, "SELECT equipe.nome, equipe.id_equipe FROM projeto 
                                INNER JOIN equipe ON projeto.id_equipe = equipe.id_equipe
                                WHERE id_projeto = '$id_projeto'");
$equipe  = mysqli_fetch_assoc($equipe);
$id_equipe = $equipe['id_equipe'];
$nome_equipe = $equipe['nome'];

$consulta_membros = mysqli_query($conn, 
"SELECT id_associacao, usuario.id_usuario, usuario.nome 
FROM associacao as a
INNER JOIN usuario ON a.id_usuario = usuario.id_usuario 
WHERE id_equipe = $id_equipe
GROUP BY id_usuario");

$membros_row = mysqli_fetch_array($consulta_membros);
$membros = $membros_row['nome'];

while ($membros_row = mysqli_fetch_array($consulta_membros)) {
  $membros = $membros.", ".$membros_row['nome'];
}

$id_curso = $media_individual['id_curso'];

$curso = mysqli_query($conn, "SELECT * FROM curso WHERE id_curso = '$id_curso'");
$curso = mysqli_fetch_assoc($curso);
$curso = $curso['curso'];

$consulta_avaliadores = mysqli_query($conn, "SELECT usuario.nome FROM avaliacao_final as a
INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
WHERE id_projeto = '$id_projeto'");
$avaliadores_row = mysqli_fetch_array($consulta_avaliadores);
$avaliadores = $avaliadores_row['nome'];
while ($avaliadores_row = mysqli_fetch_array($consulta_avaliadores)) {
	$avaliadores = $avaliadores.", ".$avaliadores_row['nome'];
} ?>

<html>
  <head>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <title>Relatório</title>
  </head>
  <body> 


<table class="table table-borderless" style="text-align: center;">
  <tbody>
  	<tr>
  	<td colspan="2" style="font-size: 40px;">Relatório de Avaliação</td>
  	</tr>
<!--   	<tr>
  	<td colspan="2"></td>
  	</tr> -->  	
  	<tr>
  	<td colspan="2" style="font-size: 30px;"><?php echo $titulo; ?></td>
  	</tr> 	
    <tr>
      <td style="font-size: 24px;">Critério 1: <b><?php echo $nota_1; ?></b></td>
      <td style="font-size: 24px;">Critério 7: <b><?php echo $nota_7; ?></b></td>
    </tr>
    <tr>
      <td style="font-size: 24px;">Critério 2: <b><?php echo $nota_2; ?></b></td>
      <td style="font-size: 24px;">Critério 8: <b><?php echo $nota_8; ?></b></td>
    </tr>
    <tr>
      <td style="font-size: 24px;">Critério 3: <b><?php echo $nota_3; ?></b></td>
      <td style="font-size: 24px;">Critério 9: <b><?php echo $nota_9; ?></b></td>
    </tr>
    <tr>
      <td style="font-size: 24px;">Critério 4: <b><?php echo $nota_4; ?></b></td>
      <td style="font-size: 24px;">Critério 10: <b><?php echo $nota_10; ?></b></td>
    </tr>
    <tr>
      <td style="font-size: 24px;">Critério 5: <b><?php echo $nota_5; ?></b></td>
      <td style="font-size: 24px;">Critério 11: <b><?php echo $nota_11; ?></b></td>
    </tr>
    <tr>
      <td style="font-size: 24px;">Critério 6: <b><?php echo $nota_6; ?></b></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 24px;">Nota Final: <b><?php echo $media_final; ?></b> de 66</td>		
    </tr>
    <tr>
      <td colspan="2" style="font-size: 24px;">Curso:<br/> <?php echo $curso; ?></td>	
    </tr>
    <tr>
      <td colspan="2" style="font-size: 24px;">Autores:<br/> <?php echo $membros; ?></td>	
    </tr>
    <tr>
      <td colspan="2" style="font-size: 24px;">Avaliadores:<br/> <?php echo $avaliadores; ?></td>	
    </tr>          
  </tbody>
</table>


  </body>
</html>