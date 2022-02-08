<?php include 'cabecalhodash.php'; 

include 'connect.php';

$consulta_avaliacao = mysqli_query($conn, "SELECT * FROM avaliacao_final");

?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO DELETAR ESSA AVALIAÇÃO ?');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Avaliação </h1>

<br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Avaliador</th>
        <th scope="col">Projeto</th>
        <th scope="col">Curso</th>
        <th scope="col">Status</th>
        <th scope="col">#</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_avaliacao)) {
        $id_avaliador = $consulta_row['id_avaliador'];
        $id_projeto   = $consulta_row['id_projeto'];
        $id_curso     = $consulta_row['id_curso'];

        $consulta_avaliacao2 = mysqli_query($conn, "SELECT curso.curso, projeto.titulo, usuario.nome FROM avaliacao_final as a
          INNER JOIN curso on a.id_curso = curso.id_curso
          INNER JOIN projeto on a.id_projeto = projeto.id_projeto
          INNER JOIN usuario on a.id_avaliador = usuario.id_usuario
          WHERE a.id_curso = '$id_curso' and a.id_projeto = '$id_projeto' and a.id_avaliador = '$id_avaliador'");
        $consulta_avaliacao2 = mysqli_fetch_assoc($consulta_avaliacao2);

            if ($consulta_row['status_avaliacao'] == 0) {
              $status_avaliacao = "Pendente";
            }
            else{
              $status_avaliacao = "Concluído";
            }       
      ?>

       
      <tr>
        <td><?php echo $consulta_row['id_avaliacao']; ?></td>
        <td><?php echo $consulta_avaliacao2['nome']; ?></td>
        <td><?php echo $consulta_avaliacao2['titulo']; ?></td>
        <td><?php echo $consulta_avaliacao2['curso']; ?></td>
        <td><?php echo $status_avaliacao; ?></td>
        <td style="text-align: center;"><a href="avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&id_curso=<?php echo $id_curso ?>&pag=avaliacao" class="btn btn-primary"><i class="fas fa-tasks"></i></a></td>    
        <td style="text-align: center;"><a href="excluir_avaliacao.php?id_projeto=<?php echo $id_projeto; ?>&avaliador=<?php echo $id_avaliador; ?>&pag=avaliacao" onclick="return confirmar()" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
      </tr>
              
    <?php } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
