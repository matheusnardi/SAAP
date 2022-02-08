<?php 

include 'cabecalhodash.php';
include 'connect.php'; 

if(empty($_GET["consulta"])){
    $consulta = 0;
}
else{
    $consulta = 1;
}

$id_usuario = $_GET["id_usuario"];

// Pesquisa do Aluno
    $query_professor = mysqli_query($conn,"SELECT * FROM usuario WHERE id_usuario=$id_usuario");
    $query_professor = mysqli_fetch_array($query_professor);
// 

// Pesquisa de Cursos da ETEC Limeira
    $query_curso = mysqli_query($conn,"SELECT * FROM curso WHERE id_instituicao=2");
//

?>

    <br/><br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Associação do Professor </h1>
    <h2 class="mb-3 font-weight-normal"><?php echo $query_professor["nome"];?></h2>  

    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>

          <form action="associar_professor.php" method="POST">

            <div class="form-group">
                <label for="instituicao"><b>Instituição</b></label>
                <select class="form-control" style="width: 300px;" name="instituicao" id="instituicao" required>
                <option value="2">ETEC Trajano Camargo</option>
                </select>  
            </div> 

            <div class="form-group">
                <label for="curso"><b>Curso</b></label>
                <select class="form-control" style="width: 300px;" name="curso" id="curso" required>
                    <option value="">Selecione...</option>
                    <?php while($curso = mysqli_fetch_array($query_curso)){ ?>
                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
                    <?php } ?>
                </select>
            </div><br/>

            <input type="text" name="consulta" value="<?php echo $consulta; ?>" hidden readonly>

            <button style="width: 300px;" name="id_usuario" value="<?php echo $id_usuario; ?>" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-user-plus"></i> Associar</b></button>

          </form><br/>

    </div>
    </center>

<?php include 'rodapedash.php'; ?>