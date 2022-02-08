<?php 

include 'cabecalhodash.php';
include 'connect.php';

if(empty($_GET["id_aluno"])){
    $query_alunos = mysqli_query($conn, 
    "SELECT associacao.id_usuario, usuario.nome
    FROM associacao
    INNER JOIN usuario ON associacao.id_usuario = usuario.id_usuario 
    WHERE id_equipe IS NULL 
    GROUP BY id_usuario");
?>
    <br/><br/>
<center>
<h1 class="mb-3 font-weight-normal">Cadastro de Equipe</h1>
<h3 class="mb-3 font-weight-normal">Selecione um aluno para prosseguir.</h3><br/><br/>

<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="regisequipe.php" method="GET">
            <div class="form-group">  
                <label for="aluno"><b>Aluno</b></label>
                <select class="form-control" style="width: 300px;" name="id_aluno" id="aluno" required>
                    <option value="">Selecione...</option>
                    <?php while($aluno = mysqli_fetch_array($query_alunos)){ ?>
                    <option value="<?php echo $aluno['id_usuario']; ?>"><?php echo $aluno['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button style="width: 300px;" class="btn btn-md btn-success btn-block" type="submit"><b>Avançar</b></button><br>
            <p class="font-weight-bold" style="color: red; width: 300px;">São listados apenas os alunos que possuem associação.</p>
        </form><br/>
    </div>
</div>
</center>

<?php
}
else{
    $id_aluno = $_GET['id_aluno'];
    $nome_aluno = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nome FROM usuario WHERE id_usuario=$id_aluno"))['nome'];

    $query_curso = mysqli_query($conn,
    "SELECT associacao.id_associacao, associacao.id_curso, curso.curso
    FROM associacao
    INNER JOIN curso ON associacao.id_curso = curso.id_curso
    WHERE id_usuario=$id_aluno AND id_equipe IS NULL
    GROUP BY id_curso");
?>

    <br/><br/>
    <center>

        <h1 class="mb-3 font-weight-normal"> Cadastro de Equipe </h1>
        <h3 class="mb-3 font-weight-normal">Aluno: <?php echo $nome_aluno; ?></h3><br/><br/>

        <div class="container">
            <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
                <form action="incluir_equipe.php" method="POST">
                    <div class="form-group">
                        <label class="font-weight-bold" for="nome">Nome da Equipe</label>
                        <input type="text" style="width: 300px;" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" placeholder="Ex: Quarteto Fantástico" required>
                    </div>  
                    <div class="form-group">
                        <label class="font-weight-bold" for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" placeholder="Ex: Somos uma equipe de super-heróis que tem o objetivo de salvar o mundo." rows="3" style="width: 300px;"></textarea>
                    </div>
                    <div class="form-group">  
                        <label for="curso"><b>Cursos do Aluno</b></label>
                        <select class="form-control" style="width: 300px;" name="id_associacao" id="curso" required>
                            <option value="">Selecione...</option>
                            <?php while($curso = mysqli_fetch_array($query_curso)){ ?>
                            <option value="<?php echo $curso['id_associacao']; ?>"><?php echo $curso['curso']; ?></option>
                            <?php } ?>
                        </select>
                    </div><br/>
                    <button style="width: 300px;" class="btn btn-md btn-success btn-block" type="submit"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button><br>
                </form><br/>
            </div>
        </div>

    </center>

<?php 
}
include 'rodapedash.php';
?>