<?php 

if(isset($_SESSION['acesso_adm'])){
    $titulo = "Esse aluno ainda não possui uma equipe!";
    $subtitulo = "Aluno: $nome";
    $regisequipe = "<form action='regisequipe.php' method='GET'>
                        <button name='id_aluno' value='$id_usuario' type='submit' class='btn btn-lg btn-outline-primary' style='height: 100px; width: 50%; font-size: 1.8em; margin-top: 5%;'>Criar Equipe</button>
                    </form>";
    $sair = "<br><br><a href='consulta_aluno.php' class='btn btn-md btn-primary btn-block' style='margin-top: 10px; width: 300px;'>Voltar</a><br>";
}
else{
    $titulo = "Você ainda não possui uma equipe!";
    $subtitulo = "Clique no botão abaixo para criar, ou aguarde ser adicionado à uma equipe existente.";
    $regisequipe = "<form action='regisequipe.php'>
                        <button type='submit' class='btn btn-lg btn-outline-primary' style='height: 100px; width: 50%; font-size: 1.8em; margin-top: 5%;'>Criar Equipe</button>
                    </form>";
    $sair = "<br><br><a href='logout.php' class='btn btn-md btn-primary btn-block' style='margin-top: 10px; width: 300px;'>Sair</a><br>";
}

?>

<br><br>

<center>
    
    <h1 class="mb-3 font-weight-normal"><?php echo $titulo; ?></h1>
    <h3 class="mb-3 font-weight-normal"><?php echo $subtitulo; ?></h3>

    <?php 
    echo $regisequipe; 
    echo $sair;
    ?>

    
</center>