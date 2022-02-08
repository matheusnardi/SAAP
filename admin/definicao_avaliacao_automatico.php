<?php 

    $consulta_projetos = mysqli_query($conn, "SELECT * FROM projeto WHERE status_aprovacao = 1");
    $qntd_projetos = mysqli_num_rows($consulta_projetos);

    $consulta_avaliadores = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'avaliador'");
    $qntd_avaliadores = mysqli_num_rows($consulta_avaliadores);

    $id_feira =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1"))['id_feira'];
?>

<br/>

<center>
<h1 class="mb-3 font-weight-normal"> Defininição de Avaliação </h1><br/>  
<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="incluir_avaliacao_aut.php" method="POST">
            <div class="form-group">
                <label class="font-weight-bold" for="p-a">Mínimo de projetos por avaliador</label>
                <input type="number" value="3" style="width: 300px;" name="projetos_avaliador" class="form-control" id="p-a" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="m-p-a">Máximo de projetos por avaliador</label>
                <input type="number" value="5" style="width: 300px;" name="max_projetos_avaliador" class="form-control" id="m-p-a" required>
            </div>  <br>
            <div class="form-group">
                <label class="font-weight-bold" for="a-p">Mínimo de avaliadores por projeto</label>
                <input type="number" value="3" style="width: 300px;" name="avaliadores_projeto" class="form-control" id="a-p" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="m-a-p">Máximo de avaliadores por projeto</label>
                <input type="number" value="5" style="width: 300px;" name="max_avaliadores_projeto" class="form-control" id="m-a-p" required>
            </div>
            <p>Total de avaliadores: <span class="text-primary font-weight-bold"><?php echo $qntd_avaliadores ?></span></p>
            <p>Total de projetos: <span class="text-primary font-weight-bold"><?php echo $qntd_projetos ?></span></p>
            <button style="width: 300px;" name="id_feira" value="<?php echo $id_feira ?>" class="btn btn-md btn-primary btn-block" type="submit"><b>Definir Avaliações</b></button>
        </form><br/>
    </div>
</div>
</center>