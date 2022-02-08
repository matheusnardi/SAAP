<?php 

include 'cabecalhodash.php';
include 'connect.php';

if(empty($_GET["id_curso"])){
    $query_curso = mysqli_query($conn, 
    "SELECT * FROM curso");
?>
    <br/><br/>
<center>
<h1 class="mb-3 font-weight-normal">Cadastro de Projeto</h1>
<h3 class="mb-3 font-weight-normal">Selecione um curso para prosseguir.</h3><br/><br/>

<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="regispro.php" method="GET">
            <div class="form-group">  
                <label for="curso"><b>Curso</b></label>
                <select class="form-control" style="width: 300px;" name="id_curso" id="curso" required>
                    <option value="">Selecione...</option>
                    <?php while($curso = mysqli_fetch_array($query_curso)){ ?>
                    <option value="<?php echo $curso['id_curso']; ?>"><?php echo $curso['curso']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button style="width: 300px;" class="btn btn-md btn-success btn-block" type="submit"><b>Avançar</b></button><br>
        </form><br/>
    </div>
</div>
</center>

<?php
}
else{
    $id_curso = $_GET['id_curso'];
    $nome_curso = mysqli_fetch_assoc(mysqli_query($conn,"SELECT curso FROM curso WHERE id_curso=$id_curso"))['curso'];

    $query_equipe = mysqli_query($conn,
    "SELECT associacao.id_equipe, equipe.nome
    FROM associacao
    INNER JOIN equipe ON associacao.id_equipe = equipe.id_equipe
    WHERE id_curso=$id_curso
    GROUP BY id_equipe");
?>

    <br/><br/>
    <center>

        <h1 class="mb-3 font-weight-normal"> Cadastro de Projeto </h1>
        <h3 class="mb-3 font-weight-normal">Curso: <?php echo $nome_curso; ?></h3><br/><br/>

        <div class="container">
            <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
                <form action="incluirpro.php" method="POST">

                    <div class="form-group">
                      <label for="titulo"><b>Título</b></label>
                      <input type="text" style="width: 300px;" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp" placeholder="Título do projeto" required>
                    </div>

                    <div class="form-group">
                        <label for="equipe"><b>Equipe</b></label> 
                        <?php 
                        if(!empty($_GET['id_equipe'])){ 
                            $id_equipe = $_GET['id_equipe']; 
                            $nome_equipe = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe=$id_equipe"))['nome'];
                        ?>
                            <select class="form-control" style="width: 300px;" name="id_equipe" id="equipe" required readonly>
                                <option value="<?php echo $id_equipe; ?>"><?php echo $nome_equipe; ?></option>
                            </select>
                        <?php 
                        }
                        else{
                        ?>
                            <select class="form-control" style="width: 300px;" name="id_equipe" id="equipe" required>
                                <option value="">Selecione...</option>
                                <?php while($equipe = mysqli_fetch_array($query_equipe)){ ?>
                                <option value="<?php echo $equipe['id_equipe']; ?>"><?php echo $equipe['nome']; ?></option>
                                <?php } ?>
                            </select>
                        <?php
                        }
                        ?>
                    </div>

                    <br/>
                    <button name="id_curso" value="<?php echo $id_curso; ?>" style="width: 300px;" class="btn btn-md btn-success btn-block" type="submit"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button><br>
                </form><br/>
            </div>
        </div>

    </center>

<?php 
}
include 'rodapedash.php';
?>