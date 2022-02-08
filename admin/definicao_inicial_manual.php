<?php 

if (empty($_GET['id_avaliador'])) {
    $query_avaliador = mysqli_query($conn, 
    "SELECT u.id_usuario, u.nome FROM inscricao_inicial AS i
    INNER JOIN associacao_professor as a ON i.id_associacao = a.id_associacao
    INNER JOIN usuario as u ON a.id_usuario = u.id_usuario
    ");
?>

    <center>
    <h1 class="font-weight-normal mt-2 mb-2">Escolha um avaliador</h1>
    <h5 class="font-weight-normal mt-2 mb-5"><b class="text-danger">Vermelho</b>: Não definido | <b class="text-success">Verde</b>: Já definido</h5>

    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="definicao_avaliacao.php" method="GET">
            <div class="form-group">
                <label class="font-weight-bold" for="avaliador">Avaliadores</label>
                <select id="avaliador" name="id_avaliador" style="width: 300px" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php
                    while ($avaliador = mysqli_fetch_array($query_avaliador)) {
                        $id_avaliador = $avaliador['id_usuario'];
                        if (mysqli_num_rows(mysqli_query($conn, "SELECT id_avaliador FROM avaliacao_inicial WHERE id_avaliador = $id_avaliador AND status_avaliacao = 0")) > 0) {
                            $cor = "background-color: #198754; color: white;";
                        }
                        else{
                            $cor = "background-color: #DC3545; color: white;";
                        }
                    ?>
                    <option style="<?php echo $cor ?>" value="<?php echo $id_avaliador; ?>"><?php echo $avaliador['nome']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div><br>
            <input type="text" name="escolha" value="1" required readonly hidden>
            <input type="text" name="metodo" value="1" required readonly hidden>
            <button style="width: 300px" class="btn btn-primary" type="submit">Prosseguir</button>
        </form><br>
    </div><br>
    </center>

<?php
}
else{
    $id_avaliador = $_GET['id_avaliador'];
    $query_avaliador = mysqli_query($conn, 
    "SELECT u.*, a.id_professor FROM usuario AS u
    INNER JOIN associacao_professor as a ON u.id_usuario = a.id_usuario 
    WHERE u.id_usuario = $id_avaliador");
    $avaliador = mysqli_fetch_assoc($query_avaliador);
    $id_professor = $avaliador['id_professor'];

    $query_ods = mysqli_query($conn, "SELECT id_ods FROM associacao_ods WHERE id_usuario = $id_avaliador");
    if (mysqli_num_rows($query_ods) > 0) {
        $ods = array();
        while ($aux_ods = mysqli_fetch_array($query_ods)) {
            $ods[] = $aux_ods['id_ods'];
        }
        $num = count($ods);
        $num--;
        $where_ods = "";
        for ($i=0; $i < $num; $i++) { 
            $where_ods .= "p.id_ods = $ods[$i] or ";
        }
        $where_ods .= "p.id_ods = $ods[$num]";
    }
    else{
        $where_ods = "p.id_ods IS NULL";
    }
    $query_projeto_ods = mysqli_query($conn, 
    "SELECT * FROM projeto as p 
    INNER JOIN ods as o ON p.id_ods = o.id_ods
    INNER JOIN curso as c ON p.id_curso = c.id_curso
    WHERE p.id_projeto NOT IN (SELECT id_projeto FROM avaliacao_inicial WHERE id_avaliador = $id_avaliador AND status_avaliacao = 0) AND id_orientador != $id_professor AND id_coorientador != $id_professor AND p.endereco IS NOT NULL AND p.status_aprovacao IS NULL AND ($where_ods) 
    ORDER BY p.id_ods");

    $query_projeto = mysqli_query($conn, 
    "SELECT * FROM projeto as p 
    INNER JOIN ods as o ON p.id_ods = o.id_ods
    INNER JOIN curso as c ON p.id_curso = c.id_curso
    WHERE p.id_projeto NOT IN (SELECT id_projeto FROM avaliacao_inicial WHERE id_avaliador = $id_avaliador AND status_avaliacao = 0) AND p.id_projeto NOT IN 
    (SELECT p.id_projeto FROM projeto as p 
    WHERE p.endereco IS NOT NULL AND p.status_aprovacao IS NULL AND ($where_ods)) AND id_orientador != $id_professor AND id_coorientador != $id_professor AND p.endereco IS NOT NULL AND p.status_aprovacao IS NULL
    ORDER BY titulo");

    $query_projetos_def = mysqli_query($conn, 
    "SELECT a.*, p.titulo, o.categoria FROM avaliacao_inicial AS a
    INNER JOIN projeto AS p ON a.id_projeto = p.id_projeto
    INNER JOIN ods AS o ON p.id_ods = o.id_ods
    WHERE a.id_avaliador = $id_avaliador AND a.status_avaliacao = 0");
?>

    <center>
        <h1 class="font-weight-normal mt-5 mb-2"><?php echo $avaliador['nome']; ?></h1>
        <h5 class="font-weight-normal mt-2 mb-5"><b class="text-danger">Vermelho</b>: Sem Avaliador | <b class="text-light" style="background-color: black;">Branco</b>: Com Avaliador <br> <b class="text-success">Verde</b>: Selecionado</h5>
    </center>

    <div class="container">
        <form action="incluir_avaliacao.php" method="POST">
            <h3>Projetos - ODS de preferência</h3>
            <hr>
            <input type="text" name="id_avaliador" value="<?php echo $id_avaliador ?>" hidden readonly>
            <input type="text" name="avaliacao" value="1" hidden readonly>
            <div class="custom-checkbox">
                <?php
                $count = -1;
                if (mysqli_num_rows($query_projeto_ods) > 0) {
                    while ($projeto_ods = mysqli_fetch_array($query_projeto_ods)) {
                        $count++;
                        $id_projeto = $projeto_ods['id_projeto'];
                        $titulo = $projeto_ods['titulo'];
                        $curso = $projeto_ods['curso'];
                        $ods = $projeto_ods['categoria'];
                        $qntd_avaliadores = mysqli_num_rows(mysqli_query($conn, "SELECT id_projeto FROM avaliacao_inicial WHERE id_projeto = $id_projeto AND status_avaliacao = 0"));
                        if ($qntd_avaliadores < 1) {
                            $cor = "class='vermelho'";
                        }
                        else{
                            $cor = "";
                        }
                    ?>
                        <input type="checkbox" id="projeto-<?php echo $id_projeto ?>" name="projeto[]" value="<?php echo $id_projeto ?>">
                        <label <?php echo $cor; ?> for="projeto-<?php echo $id_projeto ?>">
                            <?php echo $titulo ?><br><br>
                            <b>ODS</b>: <?php echo $ods; ?><br>
                            <b>Avaliadores</b>: <?php echo $qntd_avaliadores; ?>
                        </label>
                    <?php
                    }
                }
                else{
                    echo "<h4 class='text-secondary'>Nenhuma ODS de preferência encontrada.</h4>";
                }
                ?>
            </div>
        
            <br><h3>Projetos - Geral</h3>
            <hr>
            <div class="custom-checkbox">
                <?php
                if (mysqli_num_rows($query_projeto) > 0) {
                    while ($projeto = mysqli_fetch_array($query_projeto)) {
                        $count++;
                        $id_projeto = $projeto['id_projeto'];
                        $titulo = $projeto['titulo'];
                        $curso = $projeto['curso'];
                        $ods = $projeto['categoria'];
                        $qntd_avaliadores = mysqli_num_rows(mysqli_query($conn, "SELECT id_projeto FROM avaliacao_inicial WHERE id_projeto = $id_projeto AND status_avaliacao = 0"));
                        if ($qntd_avaliadores < 1) {
                            $cor = "class='vermelho'";
                        }
                        else{
                            $cor = "";
                        }
                    ?>
                        <input type="checkbox" id="projeto-<?php echo $id_projeto ?>" name="projeto[]" value="<?php echo $id_projeto ?>">
                        <label <?php echo $cor; ?> for="projeto-<?php echo $id_projeto ?>">
                            <?php echo $titulo ?><br><br>
                            <b>ODS</b>: <?php echo $ods; ?><br>
                            <b>Avaliadores</b>: <?php echo $qntd_avaliadores; ?>
                        </label>
                    <?php
                    }
                }
                else{
                    echo "<h4 class='text-secondary'>Nenhum projeto encontrado.</h4>";
                }
                ?>
            </div>
            <br><center><button class="btn btn-lg btn-primary" type="submit" style="width: 50%;">Definir Avaliações</button></center>
        </form>

        <br><h3>Já definidos a esse avaliador</h3>
            <hr>
            <div class="custom-div">
                <?php
                if (mysqli_num_rows($query_projetos_def) > 0) {
                    while ($projeto_def = mysqli_fetch_array($query_projetos_def)) {
                        $id_projeto = $projeto_def['id_projeto'];
                        $id_avaliacao = $projeto_def['id_avaliacao'];
                        $titulo = $projeto_def['titulo'];
                        $ods = $projeto_def['categoria'];
                        $qntd_avaliadores = mysqli_num_rows(mysqli_query($conn, "SELECT id_projeto FROM avaliacao_inicial WHERE id_projeto = $id_projeto AND status_avaliacao = 0"));

                    ?>
                        <div>
                            <?php echo $titulo ?><br><br>
                            <b>ODS</b>: <?php echo $ods; ?><br>
                            <b>Avaliadores</b>: <?php echo $qntd_avaliadores; ?><br>
                            <a href="excluir_avaliacao.php?id_avaliacao=<?php echo $id_avaliacao ?>&avaliacao=1" class="btn btn-danger" style="width: 100%">Remover</a>
                        </div>
                    <?php
                    }
                }
                else{
                    echo "<h4 class='text-secondary'>Nenhum projeto vinculado ao avaliador.</h4><br>";
                }
                ?>
            </div>
    </div>

<?php
}
?>