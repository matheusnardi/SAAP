<?php include 'cabecalhodash.php'; 

include 'connect.php';

if(empty($_GET['tipo_usuario']) or $_GET['tipo_usuario'] == 5){
  $tipo_where = "";
  $tipo_de_usuario = 5;
}
elseif ($_GET['tipo_usuario'] == 1) {
  $tipo_where = "WHERE tipo = 'comum'";
  $tipo_de_usuario = 1;
}
elseif ($_GET['tipo_usuario'] == 2) {
  $tipo_where = "WHERE tipo = 'avaliador'";
  $tipo_de_usuario = 2;
}
elseif ($_GET['tipo_usuario'] == 3) {
  $tipo_where = "WHERE tipo = 'orientador'";
  $tipo_de_usuario = 3;
}
elseif ($_GET['tipo_usuario'] == 4) {
  $tipo_where = "WHERE tipo = 'adm'";
  $tipo_de_usuario = 4;
}
else{
  $tipo_where = "";
  $tipo_de_usuario = 5;
}

$consulta_usuario = mysqli_query($conn, "SELECT * FROM usuario $tipo_where ORDER BY nome");

?>
<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO APAGAR ESSE USUÁRIO ?');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Usuário </h1>

<br/>


<table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Status</th>
        <th>#</th>
        <th>#</th>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_usuario)) { 

        $nameUser = "id_usuario";
        $linkUser = "excluir_usuario.php";

        if ($consulta_row['tipo'] == "avaliador") {
            $nameUser = "id_avaliador";
            $linkUser = "excluir_avaliador.php";
          }  


      ?>

      <tr>
        <td><?php echo $consulta_row['id_usuario']; ?></td>
        <td><?php echo $consulta_row['nome']; ?></td>
        <td><?php echo $consulta_row['email']; ?></td>
        <td><?php echo $consulta_row['tipo']; ?></td>
        <td><?php if($consulta_row['status_usuario'] == 0){
            echo "Desativado";
            }else{
            echo "Ativado";
            } ?></td>
        <td style="text-align: center;"><form method="POST" action="processa_ativardesativar.php">
          <input type="text" name="status" value="<?php echo $consulta_row['status_usuario'] ?>" hidden readonly>
          <input type="text" name="id_usuario" value="<?php echo $consulta_row['id_usuario'] ?>" hidden readonly>
          <button class="btn btn-primary" name="tipo_usuario" value="<?php echo $tipo_de_usuario; ?>" type="submit"><i class="fas fa-random"></i></button>
          </form></td>
        <td style="text-align: center;"><form method="GET" action="regisedit.php">
          <input type="text" name="id_usuario" value="<?php echo $consulta_row['id_usuario'] ?>" hidden readonly>
          <button class="btn btn-success" name="tipo_usuario" value="<?php echo $tipo_de_usuario; ?>" type="submit"><i class="fas fa-edit"></i></button>
          </form></td>           
        <td style="text-align: center;"><form method="POST" action="<?php echo $linkUser; ?>">
          <input type="text" name="<?php echo $nameUser; ?>" value="<?php echo $consulta_row['id_usuario'] ?>" hidden readonly>
          <button class="btn btn-danger" onclick="return confirmar()" name="tipo_usuario" value="<?php echo $tipo_de_usuario; ?>" type="submit"><i class="fas fa-trash"></i></button>
          </form></td>                   
      </tr>        
    <?php } ?>
    </tbody>
  </table><br/>


  </div>
</center>

<?php include 'rodapedash.php'; ?>
