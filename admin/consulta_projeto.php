<?php include 'cabecalhodash.php'; 

include 'connect.php'; 

$consulta_projeto = mysqli_query($conn, "SELECT curso.curso, id_projeto, titulo, id_equipe, curso.id_curso, link, link_count, endereco, endereco_count FROM projeto as p INNER JOIN curso ON p.id_curso = curso.id_curso");


?>

<script type="text/javascript">
  function confirmar(){
  return confirm('DESEJA MESMO APAGAR ESSE PROJETO ?');
}

</script>

<br/>

<center>
  <div class="container">

  <h1 class="mb-3 font-weight-normal"> Consulta de Projeto </h1><br>

  <div class="dropdown mb-2">
      <a class="btn btn-info dropdown-toggle" style="width: 100px" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Arquivo
      </a>
      

      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <!-- <a class="dropdown-item" href="../uploads" download>Baixar todos</a> -->
          <a href='arquivo_link.php?tipo=1&escolha=3' class='dropdown-item'>Liberar para todos</a>
          <a href='arquivo_link.php?tipo=1&escolha=4' class='dropdown-item'>Bloquear para todos</a>
      </div>
  </div>

  <div class="dropdown mb-2">
      <a class="btn btn-info dropdown-toggle" style="width: 100px" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Link
      </a>
      

      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a href='arquivo_link.php?tipo=2&escolha=3' class='dropdown-item'>Liberar para todos</a>
          <a href='arquivo_link.php?tipo=2&escolha=4' class='dropdown-item'>Bloquear para todos</a>
          <a href='arquivo_link.php?tipo=2&escolha=5' class='dropdown-item'>Liberar para aprovados</a>
      </div>
  </div>




<br/>

  <table id="table_id" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Titulo</th>
        <th scope="col">Curso</th>
        <th scope="col">Equipe</th>
        <!-- <th scope="col">Avaliadores</th> -->
        <!-- <th scope="col">Avaliação</th> -->
        <th scope="col">Arquivo</th>
        <th scope="col">Link</th>
        <th scope="col">#</th>
        <th scope="col">#</th>        
      </tr>
    </thead>
    <tbody>
    <?php while ($consulta_row = mysqli_fetch_array($consulta_projeto)) { 

      $id_projeto = $consulta_row['id_projeto'];

      $titulo_projeto = $consulta_row['titulo'];

      $id_curso = $consulta_row['id_curso'];

      $id_equipe = $consulta_row['id_equipe'];

      $equipe = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe=$id_equipe"));

      $link = $consulta_row['link'];

      $endereco = $consulta_row['endereco'];

      // $consulta_projeto2 = mysqli_query($conn, "SELECT * FROM avaliacao_alberto_feres WHERE id_projeto = '$id_projeto' GROUP BY status_avaliacao ORDER BY status_avaliacao DESC");

      // $qntdAval = mysqli_query($conn, "SELECT * FROM avaliacao_alberto_feres WHERE id_projeto = '$id_projeto'");

      // $qntdAval = mysqli_num_rows($qntdAval);

        // if (mysqli_num_rows($consulta_projeto2) > 0) {
        //   while ($consulta_row2 = mysqli_fetch_array($consulta_projeto2)) {
        //     if ($consulta_row2['status_avaliacao'] == 0) {
        //       $avaliacao = "Pendente";
        //     }
        //     else{
        //       $avaliacao = "Concluído";
        //     }
        //   }
        // }
        // else{
        //       $avaliacao = "Não Definido";
        // }

      ?>

       
      <tr>
        <td><?php echo $consulta_row['id_projeto']; ?></td>
        <td><?php echo $consulta_row['titulo']; ?></td>
        <td><?php echo $consulta_row['curso']; ?></td>
        <td>        
          <form method="GET" action="home_equipes.php">
              <input type="text" name="id_equipe" value="<?php echo $id_equipe; ?>" hidden readonly>
              <input type="text" name="pagina" value="2" hidden readonly>
              <button class="btn btn-outline-info" style='color: black;' name="id_curso" value="<?php echo $id_curso ?>" type="submit"><?php echo $equipe['nome'] ?></button>
          </form>
        </td>
        <!-- <td style="text-align: center;">
          <a href="avaliadores_projeto.php?id_projeto=<?php //echo $id_projeto; ?>" class='btn btn-outline-info' style='color: black;'><?php //echo $qntdAval; ?></a>
        </td> -->
        <!-- <td><?php //echo $avaliacao; ?></td> -->
        <td style="text-align: center;">
          <div class="dropdown mt-1 mb-2">
              <?php
                if($consulta_row['endereco_count'] < 1){
                  echo "<a class='btn btn-outline-danger dropdown-toggle' style='color: black;' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Bloqueado</a>";
                  $alterar_status = "arquivo_link.php?id_projeto=$id_projeto&tipo=1&escolha=1";
                }
                else{
                  echo "<a class='btn btn-outline-success dropdown-toggle' style='color: black;' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Liberado</a>";
                  $alterar_status = "arquivo_link.php?id_projeto=$id_projeto&tipo=1&escolha=2";
                }
              ?>      
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <?php 
                if($endereco != NULL){
                  echo "<a class='dropdown-item' href='../$endereco' download='$titulo_projeto.pdf'>Baixar</a>
                  <a class='dropdown-item' href='../$endereco' target='_blank'>Visualizar</a>";
                }
              ?>
              <a class='dropdown-item' href='<?php echo $alterar_status; ?>'>Alterar Status</a>
              </div>
          </div>
        </td>
        <td style="text-align: center;">
          <div class="dropdown mt-1 mb-2">
            <?php
              if($consulta_row['link_count'] < 1){
                echo "<a class='btn btn-outline-danger dropdown-toggle' style='color: black;' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Bloqueado</a>";
                $alterar_status_link = "arquivo_link.php?id_projeto=$id_projeto&tipo=2&escolha=1";
              }
              else{
                echo "<a class='btn btn-outline-success dropdown-toggle' style='color: black;' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Liberado</a>";
                $alterar_status_link = "arquivo_link.php?id_projeto=$id_projeto&tipo=2&escolha=2";
              }
            ?>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <?php 
                if($link != NULL){
                  echo "<a class='dropdown-item' href='$link' target='_blank'>Acessar</a>";
                }
              ?>
              <a class='dropdown-item' href='<?php echo $alterar_status_link; ?>'>Alterar Status</a>     
            </div>
          </div>
        </td>
        <td style="text-align: center;"><a href="proedit.php?id_projeto=<?php echo $id_projeto; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a></td>           
        <td style="text-align: center;"><form method="POST" action="excluir_projeto.php">
          <button class="btn btn-danger" onclick="return confirmar()" name="id_projeto" value="<?php echo $id_projeto; ?>" type="submit"><i class="fas fa-trash"></i></button>
          </form></td>                   
      </tr>
              
    <?php } ?>
    </tbody>
  </table>
  </div><br/>
</center>

<?php include 'rodapedash.php'; ?>
