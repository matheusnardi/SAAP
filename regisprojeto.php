<?php 

  include 'cabecalho.php';

  $id_equipe = $_POST['id_equipe'];
  $id_curso = $_POST['id_curso'];

  // Consulta de ODS
  $query_ods = mysqli_query($conn, "SELECT * FROM ods");

?>

<br><br>
<center>
    <h1 class="mb-3 font-weight-normal"> Registro de Projeto </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>
    <div class="container">

      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>

        <form action="incluir_projeto.php" method="POST">

            <div class="form-group">
                <label for="titulo"><b>Título</b></label>
                <input type="text" style="width: 300px;" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp" placeholder="Título do projeto" required>
            </div>

            <div class="form-group">  
                <label for="orientador"><b>Orientador</b></label>
                <select class="form-control" style="width: 300px;" name="id_orientador" id="orientador" required>
                    <option value="">Selecione...</option>
                    <?php   
                    // Consulta de Orientadores
                    $query_orientador = mysqli_query($conn, "SELECT * FROM orientador");
                    while($orientador = mysqli_fetch_array($query_orientador)){ ?>
                    <option value="<?php echo $orientador['id_orientador']; ?>"><?php echo $orientador['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">  
                <label for="coorientador"><b>Co-Orientador</b></label>
                <select class="form-control" style="width: 300px;" name="id_coorientador" id="coorientador" required>
                    <option value="">Selecione...</option>
                    <?php 
                    // Consulta de Orientadores
                    $query_orientador = mysqli_query($conn, "SELECT * FROM orientador");
                    while($orientador = mysqli_fetch_array($query_orientador)){ ?>
                    <option value="<?php echo $orientador['id_orientador']; ?>"><?php echo $orientador['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">  
                <label for="ods"><b>ODS</b></label>
                <select class="form-control" style="width: 300px;" name="id_ods" id="ods" required>
                    <option value="">Selecione...</option>
                    <?php while($ods = mysqli_fetch_array($query_ods)){ ?>
                    <option value="<?php echo $ods['id_ods']; ?>"><?php echo $ods['categoria']; ?></option>
                    <?php } ?>
                </select>
            </div><br/>

            <input type="text" hidden name="id_curso" value="<?php echo $id_curso; ?>">

            <button style="width: 300px;" name="id_equipe" value="<?php echo $id_equipe ?>" class="btn btn-md btn-success btn-block" type="submit"><b><i class="fas fa-plus"></i> Registrar</b></button>
            <a href="index.php" class="btn btn-md btn-primary btn-block" style="margin-top: 10px; width: 300px;">Voltar</a><br>

        </form><br/>

      </div>

    </div>
</center>

<?php

  include 'rodape.php';

?>