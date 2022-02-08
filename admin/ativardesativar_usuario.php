<?php include 'cabecalhodash.php'; 
include 'connect.php';

$sql = "select * from usuario where tipo like 'avaliador' order by status_usuario";
$result = mysqli_query($conn, $sql);

?>
    <br/>
    <br/>
    <br/>

      <center>
      <div class="container">
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Status</th>
      <th scope="col">Alterar</th>
    </tr>
  </thead>
  <?php while ($row = mysqli_fetch_array($result)) { ?>
  <tbody>
    <tr>
      <td><?php echo $row['id_usuario'] ?></td>
      <td><?php echo $row['nome'] ?></td>
      <td>
        <?php if($row['status_usuario'] == 0){
                echo "Desativado";
          }else{
          echo "Ativado";
          } ?>        
      </td>
      <td>
        <form method="POST" action="processa_ativardesativar.php">
        <input type="text" name="status" value="<?php echo $row['status_usuario'] ?>" hidden readonly>
        <input type="text" name="id_usuario" value="<?php echo $row['id_usuario'] ?>" hidden readonly>
        <button class="btn btn-primary" type="submit">Alterar</button>
        </form>
      </td>
    </tr>
  </tbody>
  <?php } ?>
</table>
      </center>
    </div>

<?php include 'rodapedash.php'; ?>