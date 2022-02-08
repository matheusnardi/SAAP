<?php include 'cabecalhodash.php'; 

include 'connect.php';

$consulta_equipe = mysqli_query($conn, 
"SELECT * FROM equipe");

?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO DELETAR ESSA EQUIPE? Ao fazer isso, os projetos vinculados também serão excluídos.');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Equipes </h1>

    <br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Curso</th>
        <th scope="col">Projetos</th>
        <th scope="col">Membros</th>
        <th scope="col">#</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_equipe)) {
        $id_equipe = $consulta_row['id_equipe'];
        $nome     = $consulta_row['nome'];

        $projetos = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM projeto WHERE id_equipe=$id_equipe"));

        $membros = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_equipe=$id_equipe GROUP BY id_usuario"));

        $id_curso = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_curso FROM associacao WHERE id_equipe=$id_equipe GROUP BY id_curso"))['id_curso'];

        $curso = mysqli_fetch_assoc(mysqli_query($conn, "SELECT curso FROM curso WHERE id_curso=$id_curso"))['curso'];
      ?>

       
      <tr>
        <td><?php echo $id_equipe; ?></td>
        <td><?php echo $nome; ?></td>
        <td><?php echo $curso; ?></td>
        <td style="text-align: center;">
            <?php echo $projetos; ?>
        </td>
        <td style="text-align: center;">
            <?php echo $membros; ?>
        </td>
        <td style="text-align: center;">
            <form method="GET" action="home_equipes.php">
                <input type="text" name="id_equipe" value="<?php echo $id_equipe; ?>" hidden readonly>
                <button class="btn btn-primary" name="id_curso" value="<?php echo $id_curso ?>" type="submit"><i class="fas fa-sign-in-alt"></i></button>
            </form>
        </td>    
        <td style="text-align: center;">
            <form method="POST" action="excluir_equipe.php">
                <button class="btn btn-danger" onclick="return confirmar()" name="id_equipe" value="<?php echo $id_equipe; ?>" type="submit"><i class="fas fa-trash"></i></button>
            </form>
        </td>                             
      </tr>
              
    <?php } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
