<?php 

  include 'cabecalho.php';

  include 'connect.php';

  $id_usuario = $_SESSION["id_usuario"];

  $nome = $_SESSION["acesso_comum"];

  $id_equipe = $_GET['id_equipe'];
  $id_curso = $_GET['id_curso'];

  $query = mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe=$id_equipe");
  $equipe = mysqli_fetch_assoc($query);

  ?> 
  
  <br>

  <center><h3 class="mb-3 font-weight-normal">Equipe <br><?php echo $equipe['nome'] ?></center>

  <br>

  <div class="container">

    <?php 
      include 'projetos_equipe.php'; 
  
      include 'membros_equipe.php';

      include 'info_equipe.php';
    ?>

 <center> <a href="index.php" class="btn btn-primary" style="margin-top: 5%; width: 300px;">Voltar</a> </center>

  </div><br>

<?php
  include 'rodape.php';
?>