<?php 

include 'cabecalhodash.php';

include 'connect.php';

$id_usuario = $_GET["id_usuario"];

$query_associacao = mysqli_query($conn, 
       "SELECT associacao.id_associacao, associacao.id_curso, curso.curso
        FROM associacao
        INNER JOIN curso ON associacao.id_curso = curso.id_curso
        WHERE associacao.id_usuario=$id_usuario GROUP BY associacao.id_curso ORDER BY id_associacao
        ");

$nome_aluno = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nome FROM usuario WHERE id_usuario=$id_usuario"))['nome'];

?>

<br>
<center>
<h1 class="mb-3 font-weight-normal"> Associação de Curso </h1>
<h3 class="mb-3 font-weight-normal"><?php echo $nome_aluno; ?></h3>

<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>

        <?php
        $count = 0;
        while($padrao = mysqli_fetch_array($query_associacao)){ $count = $count + 1;
        ?>
            <form action="associar_curso.php" method="POST">

                <div class="form-group">
                    <label for="curso"><b><?php echo $count ?>º Curso</b></label>
                    <select class="form-control" style="width: 300px;" name="curso" id="curso" required>
                        <option value="">Padrão (<?php echo $padrao['curso'] ?>)</option>
                        <?php
                        $query_curso      = mysqli_query($conn,"SELECT * FROM curso WHERE id_instituicao=2 ORDER BY curso");
                        while($curso = mysqli_fetch_array($query_curso)){ ?>
                        <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group" style="display: none;">
                    <label for="instituicao"><b>Instituição</b></label>
                    <select class="form-control" style="width: 300px;" name="instituicao" id="instituicao" required>
                        <option value="2">ETEC Trajano Camargo</option>
                    </select>  
                </div>
                
                <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>" hidden readonly>
                            
                <button style="width: 300px;" name="id_associacao" value="<?php echo $padrao['id_associacao']; ?>" class="btn btn-md btn-success btn-block" type="submit"><b>Atualizar</b></button>
                <?php 
                if($count == 2){ 
                ?>
                <a href="associar_curso.php?id_associacao=<?php echo $padrao['id_associacao']; ?>&id_usuario=<?php echo $id_usuario; ?>" style="width: 300px;" class="btn btn-md btn-danger btn-block"><b>Deletar 2ºCurso</b></a>
                <?php
                }
                ?>

            </form><br/><br>
        <?php 
        }
        if($count < 2){ 
        ?>

            <form action="associar_curso.php" method="POST">

            <div class="form-group">
                <label for="curso"><b>2º Curso</b></label>
                <select class="form-control" style="width: 300px;" name="curso" id="curso" required>
                    <option value="">Nenhum</option>
                    <?php
                    $query_curso = mysqli_query($conn,"SELECT * FROM curso WHERE id_instituicao=2 ORDER BY curso");
                    while($curso = mysqli_fetch_array($query_curso)){ ?>
                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group" style="display: none;">
                <label for="instituicao"><b>Instituição</b></label>
                <select class="form-control" style="width: 300px;" name="instituicao" id="instituicao" required>
                    <option value="2">ETEC Trajano Camargo</option>
                </select>  
            </div>               
                        
            <button style="width: 300px;" name="id_usuario" value="<?php echo $id_usuario; ?>" class="btn btn-md btn-success btn-block" type="submit"><b>Associar novo curso</b></button>

        <?php
        } 
        ?>

        <a href="consulta_aluno.php" class="btn btn-md btn-primary btn-block" style="margin-top: 10px; width: 300px;">Voltar</a><br>    
                            
    </div><br>                  
</div>
</center>

<?php include 'rodapedash.php' ?>