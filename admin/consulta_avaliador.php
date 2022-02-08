<?php include 'cabecalhodash.php'; 

include 'connect.php';

$consulta_avaliador = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'avaliador' ORDER BY nome");

?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO DELETAR ESSE AVALIADOR ?');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Avaliador </h1>

<br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Avaliação</th>
        <th scope="col">Projetos</th>
        <th scope="col">#</th>
        <th scope="col">#</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_avaliador)) {
        $id_avaliador = $consulta_row['id_usuario']; 

        $qntdPro = mysqli_query($conn, "SELECT * FROM avaliacao_alberto_feres WHERE id_avaliador = '$id_avaliador'");
        $qntdPro = mysqli_num_rows($qntdPro);
        $consulta_avaliador2 = mysqli_query($conn, "SELECT * FROM avaliacao_alberto_feres WHERE id_avaliador = '$id_avaliador' GROUP BY status_avaliacao ORDER BY status_avaliacao DESC");

        if (mysqli_num_rows($consulta_avaliador2) > 0) {
          while ($consulta_row2 = mysqli_fetch_array($consulta_avaliador2)) {
            if ($consulta_row2['status_avaliacao'] == 0) {
              $avaliacao = "Pendente";
            }
            else{
              $avaliacao = "Concluído";
            }
          }
        }
        else{
              $avaliacao = "Não Definido";
        }
      ?>

       
      <tr>
        <td><?php echo $consulta_row['id_usuario']; ?></td>
        <td><?php echo $consulta_row['nome']; ?></td>
        <td><?php echo $avaliacao; ?></td>
        <td><?php echo $qntdPro; ?></td>
        <td style="text-align: center;"><a href="projetos_avaliador.php?id_avaliador=<?php echo $id_avaliador; ?>" class="btn btn-info"><i class="fas fa-book-open"></i></a></td>
        <td style="text-align: center;"><form method="GET" action="regisedit.php">
          <input type="text" name="id_usuario" value="<?php echo $consulta_row['id_usuario'] ?>" hidden readonly>
          <button class="btn btn-success" name="tipo_usuario" value="avaliador" type="submit"><i class="fas fa-edit"></i></button>
          </form></td>    
            <td style="text-align: center;"><form method="POST" action="excluir_avaliador.php">
          <button class="btn btn-danger" onclick="return confirmar()" name="id_avaliador" value="<?php echo $id_avaliador; ?>" type="submit"><i class="fas fa-trash"></i></button>
          </form></td>                             
      </tr>
              
    <?php } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
