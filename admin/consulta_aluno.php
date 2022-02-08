<?php include 'cabecalhodash.php'; 

include 'connect.php';

$consulta_aluno = mysqli_query($conn, 
"SELECT * FROM usuario 
WHERE tipo = 'comum' ORDER BY nome
");

?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO DELETAR ESSE ALUNO ?');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Alunos </h1>

    <br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Associação</th>
        <th scope="col">Cursos</th>
        <th scope="col">Equipes</th>
        <th scope="col">#</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_aluno)) {
        $id_aluno = $consulta_row['id_usuario'];
        $nome     = $consulta_row['nome'];

        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario=$id_aluno GROUP BY id_usuario")) == 0){
          $col1 = "<a class='btn btn-info' href='associacao.php?id_usuario=$id_aluno&consulta=1'>Não associado</a>
                    <span style='display: none;'><?php echo $span; ?></span>";
          $linkCurso = "associacao.php?id_usuario=$id_aluno&consulta=1";
          $linkEquipe = "associacao.php?id_usuario=$id_aluno&consulta=1";
          $qntdCurso = "Não associado";
          $qntdEquipe = "Não associado";
          $color = "class='btn btn-info'";
        }
        else{
          $col1 = "Associado";
          $linkCurso = "cursos_aluno.php?id_usuario=$id_aluno";
          $linkEquipe = "equipes_aluno.php?id_usuario=$id_aluno";

          $qntdCurso = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario = '$id_aluno' and id_curso IS NOT NULL GROUP BY id_curso"));

          $qntdEquipe = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario = '$id_aluno' and id_equipe IS NOT NULL GROUP BY id_equipe"));

          $color = "class='btn btn-outline-info' style='color: black;'";
        }
      ?>

       
      <tr>
        <td><?php echo $id_aluno; ?></td>
        <td><?php echo $nome; ?></td>
        <td style="text-align: center;">
            <?php echo $col1; ?>
        </td>
        <td style="text-align: center;">
            <a <?php echo $color; ?> href="<?php echo $linkCurso; ?>"><?php echo $qntdCurso; ?></a>
        </td>
        <td style="text-align: center;">
            <a <?php echo $color; ?> href="<?php echo $linkEquipe; ?>"><?php echo $qntdEquipe; ?></a>
        </td>
        <td style="text-align: center;">
            <form method="GET" action="regisedit.php">
                <input type="text" name="id_usuario" value="<?php echo $id_aluno; ?>" hidden readonly>
                <button class="btn btn-success" name="tipo_usuario" value="comum" type="submit"><i class="fas fa-edit"></i></button>
            </form>
        </td>    
        <td style="text-align: center;">
            <form method="POST" action="excluir_aluno.php">
                <button class="btn btn-danger" onclick="return confirmar()" name="id_aluno" value="<?php echo $id_aluno; ?>" type="submit"><i class="fas fa-trash"></i></button>
            </form>
        </td>                             
      </tr>
              
    <?php } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
