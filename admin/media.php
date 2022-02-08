<?php include 'cabecalhodash.php'; 
include 'connect.php';

if (empty($_GET['curso'])) {
  header('ranking.php');
}
elseif ($_GET['curso'] == -1) {
  $curso  = "";
  $titulo = "Geral";
}
else{
  $id_curso = $_GET['curso'];
  $curso = "and id_curso = '$id_curso'";
  $titulo    = mysqli_query($conn, "select * from curso where id_curso = '$id_curso'");
  $titulo    = mysqli_fetch_assoc($titulo);
  $titulo    = $titulo['curso'];
  $titulo    = "de $titulo";
}



?>
    <br/>

<?php
$sql      = "select id_projeto, id_curso, count(*), (avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10)+avg(n11))Nota_final   
        from avaliacao_final
        where status_avaliacao = 1 $curso
        group by id_projeto order by Nota_final DESC";

$contador = 0;
$result = mysqli_query($conn, $sql); ?>

      <center>

  <h1 class="mb-3 font-weight-normal"> Ranking <?php echo $titulo ?></h1>

<br/>

      <div class="container">
<table id="table_id" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col">Posição</th>
      <th scope="col">Projeto</th>
      <th scope="col">Curso</th>
      <th scope="col">Nota</th>
    </tr>
  </thead>
  <tbody>
  <?php  
  while ($row = mysqli_fetch_array($result)) {
        $id_projeto = $row['id_projeto'];
        $id_curso   = $row['id_curso'];
        $media_final= $row['Nota_final'];
        $sql2       = "select * from projeto where id_projeto = '$id_projeto'";
        $result2    = mysqli_query($conn, $sql2);
        $row2       = mysqli_fetch_assoc($result2);
        $sql3       = "select * from curso where id_curso = '$id_curso'";
        $result3    = mysqli_query($conn, $sql3);
        $row3       = mysqli_fetch_assoc($result3);
        $titulo     = $row2['titulo'];
        $curso      = $row3['curso']; 
        $contador   = $contador+1  ?>

            <tr> 
              <td><?php echo $contador."º Lugar"; ?></td>
              <td><?php echo $titulo; ?></td>
              <td><?php echo $curso; ?></td>
              <td><?php echo round($media_final, 2); ?></td>
            </tr>

<?php 
  } ?>
    </tbody>
    </table><br/>
        </center>
      </div>

<?php include 'rodapedash.php'; ?>