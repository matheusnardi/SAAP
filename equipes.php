<?php 

    $query = mysqli_query
    ($conn, 
    "SELECT associacao.id_equipe, equipe.nome, equipe.descricao, curso.curso, curso.id_curso
    FROM ((associacao
    INNER JOIN equipe ON associacao.id_equipe = equipe.id_equipe)
    INNER JOIN curso ON associacao.id_curso = curso.id_curso)
    WHERE associacao.id_usuario = $id_usuario and associacao.id_equipe IS NOT NULL 
    ORDER BY associacao.id_associacao;"
    );

if(isset($_SESSION['acesso_adm'])){
    $titulo = $nome;
    $mensagem = "Se o aluno estuda em dois cursos, associe um novo. Ao fazer isso, poderá criar mais de uma equipe!";
    $sair = "<br><br><a href='consulta_aluno.php' class='btn btn-md btn-primary btn-block' style='margin-top: 10px; width: 300px;'>Voltar</a><br>";
    $regisequipe = "<form action='regisequipe.php' method='GET'>
                        <button name='id_aluno' value='$id_usuario' type='submit' class='btn btn-lg btn-outline-primary' style='height: 60px; width: 60px; font-size: 1.2em; font-weight: bold;'>+</button>
                    </form>";
    $parametro = "&id_usuario=$id_usuario&pagina=1";
}
else{
    $titulo = "Bem-vindo!<br>$nome";
    $mensagem = "Se você estuda em dois cursos, vá em opções para associar um novo. Ao fazer isso, poderá criar mais de uma equipe!";
    $sair = "";
    $regisequipe = "<form action='regisequipe.php'>
                        <button type='submit' class='btn btn-lg btn-outline-primary' style='height: 60px; width: 60px; font-size: 1.2em; font-weight: bold;'>+</button>
                    </form>";
    $parametro = "";
}

?>

<br>

<center><h3 class="mb-3 font-weight-normal"><?php echo $titulo; ?></h3></center>

<div class="container">

    <br>

    <div class="row">
        <div class="col">
            <h3 class="mb-3 font-weight-bold" style="border-bottom: 1px solid #A8A8A8; padding-bottom: 10px;">Equipes</h3>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

        <?php $count = 0; while($equipe = mysqli_fetch_array($query)){ $count = $count+1?>
         
        <div class="col mb-2">
            <div class="card" style="width: 20rem;">
                <p class="card-header" style="font-weight: bold;"><?php echo $equipe['curso'] ?></p>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $equipe['nome'] ?></h5>
                    <p class="card-text" style="max-width: 50ch; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $equipe['descricao']; ?></p>
                    <a href="home_equipes.php?id_equipe=<?php echo $equipe['id_equipe']; ?>&id_curso=<?php echo $equipe['id_curso']; ?><?php echo $parametro; ?>" class="btn btn-primary">Acessar Equipe</a>
                    </form>
                </div>
            </div>
        </div>

        <?php } 
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario = $id_usuario GROUP BY id_curso")) > 1 and $count < 2){ ?>
            
            <div class="col mb-2">
                <?php echo $regisequipe; ?>
            </div>

    <?php } 
        elseif($count < 2){ ?>
        <div class="col mb-2">
            <p style="color: gray; font-weight: bold;"><?php echo $mensagem; ?></p>
        </div>
       <?php } ?>

    </div>
    <br><br><br>
    <center><p style='color: blue; font-weight: bold;'>ATENÇÃO<br>Só é possível ter uma equipe por curso</p><br>

    <?php echo $sair; ?></center>
</div>