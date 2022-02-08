<?php 

include 'cabecalho.php';

include 'connect.php';

$id_usuario = $_SESSION["id_usuario"];

$query_associacao = mysqli_query($conn, 
       "SELECT associacao.id_curso, curso.curso
        FROM associacao
        INNER JOIN curso ON associacao.id_curso = curso.id_curso
        WHERE associacao.id_usuario=$id_usuario GROUP BY associacao.id_curso ORDER BY id_associacao
        ");

?>

<br>
<center>
    <h1 class="mb-3 font-weight-normal"> Associação de Curso </h1>
    
    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>

        <?php 
            if(mysqli_num_rows($query_associacao) >= 2){
                $mensagem = "
                    <p style='color: blue; font-weight: bold;'>Você já está vinculado a dois cursos.<br>Para quaisquer alterações, entre em contato com um administrador.</p>
                "; 
                $count = 0;
                while ($curso = mysqli_fetch_array($query_associacao)) 
                { $count = $count+1; 
                  $nome_curso = $curso['curso'];   ?>
                
                    <h5 class="mb-3 font-weight-normal"><?php echo $count; ?>º Curso: <b><br><?php echo $nome_curso; ?></b></h5><br>
                    
            <?php 
                }
            }
            else{ 
                    $curso = mysqli_fetch_assoc($query_associacao);
                    $nome_curso = $curso['curso'];
                    $id_curso = $curso['id_curso'];

                    $query_curso      = mysqli_query($conn,"SELECT * FROM curso WHERE id_instituicao=2 and id_curso != $id_curso ORDER BY curso");
                    $mensagem = "
                    <p style='color: red; font-weight: bold;'>ADICIONE UM CURSO APENAS SE FOR NECESSÁRIO!</p>
                    ";
            ?>

                    <h5 class="mb-3 font-weight-normal">1º Curso: <b><br><?php echo $nome_curso; ?></b></h5><br>

                    <?php echo $mensagem ?> <br>

                    <form action="associar_curso.php" method="POST">

                        <div class="form-group">
                            <label for="curso"><b>2º Curso</b></label>
                            <select class="form-control" style="width: 300px;" name="curso" id="curso" required>
                                <option value="">Selecione...</option>
                                <?php while($curso = mysqli_fetch_array($query_curso)){ ?>
                                <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
                                <?php } ?>
                            </select>
                        </div><br/>

                        <div class="form-group" style="display: none;">
                            <label for="instituicao"><b>Instituição</b></label>
                            <select class="form-control" style="width: 300px;" name="instituicao" id="instituicao" required>
                                <option value="2">ETEC Trajano Camargo</option>
                            </select>  
                        </div> 

                        <button style="width: 300px;" name="id_usuario" value="<?php echo $id_usuario; ?>" class="btn btn-md btn-success btn-block" type="submit"><b>Adicionar novo curso</b></button>

                    </form><br/>

           <?php } ?>
           <a href="index.php" class="btn btn-md btn-primary btn-block" style="margin-top: 10px; width: 300px;">Voltar</a><br>                        
           <?php echo $mensagem ?>
        </div><br>                  
    </div>
</center>

<?php include 'rodape.php' ?>