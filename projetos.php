<?php include 'cabecalho.php'; 

include 'connect.php';
$avaliador = $_SESSION['id_usuario'];
$sql = "select * from avaliacao_alberto_feres where id_avaliador like $avaliador";
//Comando de Pesquisa
$result = mysqli_query($conn, $sql);
// 
?>
    <br/>
    <br/>
    <br/>

    <!--login-->
    <?php while ($row = mysqli_fetch_array($result)){
      $projeto = $row['id_projeto'];
      $sql2 = "select * from projeto where id_projeto like $projeto";
      $result2 = mysqli_query($conn, $sql2);
      $row2     = mysqli_fetch_assoc($result2); ?>
  <div class="container">
    <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $row2['titulo']; ?></h5>
      <form method="POST" action="avaliacao.php">
        <input type="text" name="id_projeto" value="<?php echo $row['id_projeto']; ?>" readonly hidden>
        <?php if($row['status_avaliacao'] == 1){ ?>
        <button class="btn btn-primary" type="submit">Editar Nota</button>
        <?php } ?>
        <?php if($row['status_avaliacao'] == 0){ ?>
        <button class="btn btn-primary" type="submit">Avaliar</button>
        <?php } ?>
      </form>  
    </div>
  </div>
  </div>
    <?php } ?> 
    <!--Fim_login-->

<?php include 'rodape.php'; ?>