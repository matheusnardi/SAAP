<?php include 'cabecalhodash.php'; 

include 'connect.php';

$consulta_comentario = mysqli_query($conn, "SELECT * FROM avaliacao_final WHERE status_avaliacao = 1 and obs IS NOT NULL");

?>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Cometário </h1>

<br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id Avaliação</th>
        <th scope="col">Avaliador</th>
        <th scope="col">Projeto</th>
        <th scope="col">Comentário</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_comentario)) {

      if ($consulta_row['obs'] != "") {

            $id_avaliador = $consulta_row['id_avaliador'];
            $id_projeto   = $consulta_row['id_projeto'];
            $consulta_nomeTitulo = mysqli_query($conn, "SELECT usuario.nome, projeto.titulo FROM avaliacao_final as a 
              INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
              INNER JOIN projeto ON a.id_projeto = projeto.id_projeto
              WHERE a.id_avaliador = '$id_avaliador' and a.id_projeto = '$id_projeto'");
            $consulta_nomeTitulo = mysqli_fetch_assoc($consulta_nomeTitulo);
      ?>

       
      <tr>
        <td><?php echo $consulta_row['id_avaliacao']; ?></td>
        <td><?php echo $consulta_nomeTitulo['nome']; ?></td>
        <td><?php echo $consulta_nomeTitulo['titulo']; ?></td>
        <td><?php echo $consulta_row['obs']; ?></td>                           
      </tr>
              
    <?php   }
          } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
