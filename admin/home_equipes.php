<?php 

  include 'cabecalhodash.php';

  include 'connect.php';

  $id_usuario = "";

  $id_equipe = $_GET['id_equipe'];
  $id_curso = $_GET['id_curso'];

  $query = mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe=$id_equipe");
  $equipe = mysqli_fetch_assoc($query);

  if (!empty($_GET['pagina'])) {
    if($_GET['pagina'] == 1){
      $voltar = "equipes_aluno.php?id_usuario=$id_usuario";

      $id_usuario = $_GET["id_usuario"];

      $nome = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nome FROM usuario WHERE id_usuario = $id_usuario"))['nome'];
    }
    else if($_GET['pagina'] == 2){
      $voltar = "consulta_projeto.php";
    }
  }
  else{
    $voltar = "consulta_equipe.php";
  }

  ?> 
  
  <br>

  <center><h3 class="mb-3 font-weight-normal">Equipe <br><?php echo $equipe['nome'] ?></center>

  <br>

  <div class="container">

    <?php 
      include '../projetos_equipe.php'; 
  
      include '../membros_equipe.php';

      include '../info_equipe.php';
    ?>

 <center> <a href="<?php echo $voltar; ?>" class="btn btn-primary" style="margin-top: 5%; width: 300px;">Voltar</a> </center>

  </div><br>

<?php
  include 'rodapedash.php';
?>