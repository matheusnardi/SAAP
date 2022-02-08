<?php

    $consulta_projeto_inicial = mysqli_query($conn, 
    "SELECT *, c.curso, p.titulo, p.endereco, p.status_aprovacao, e.nome, p.id_equipe, e.descricao, ods.categoria, o.nome AS orientador, co.nome AS coorientador FROM avaliacao_inicial AS a
    INNER JOIN projeto AS p ON a.id_projeto = p.id_projeto
    INNER JOIN curso AS c ON p.id_curso = c.id_curso
    INNER JOIN equipe AS e ON p.id_equipe = e.id_equipe
    INNER JOIN orientador as o ON p.id_orientador = o.id_orientador
    INNER JOIN orientador as co ON p.id_coorientador = co.id_orientador
    INNER JOIN ods as ods ON p.id_ods = ods.id_ods
    WHERE id_avaliador = $id_avaliador AND p.status_aprovacao IS NULL
    ORDER BY status_avaliacao");

    $consulta_projeto_aprovacao = mysqli_query($conn, 
    "SELECT *, c.curso, p.titulo, p.endereco, p.status_aprovacao, e.nome, p.id_equipe, e.descricao, ods.categoria, o.nome AS orientador, co.nome AS coorientador FROM avaliacao_inicial AS a
    INNER JOIN projeto AS p ON a.id_projeto = p.id_projeto
    INNER JOIN curso AS c ON p.id_curso = c.id_curso
    INNER JOIN equipe AS e ON p.id_equipe = e.id_equipe
    INNER JOIN orientador as o ON p.id_orientador = o.id_orientador
    INNER JOIN orientador as co ON p.id_coorientador = co.id_orientador
    INNER JOIN ods as ods ON p.id_ods = ods.id_ods
    WHERE id_avaliador = $id_avaliador AND p.status_aprovacao IS NOT NULL AND p.status_aprovacao < 2 AND p.status_aprovacao > -1
    ORDER BY p.status_aprovacao");

?>

<div class="card border-secondary">
    <div class="card-header border-secondary h3 font-weight-normal">
        Avaliação Inicial
    </div>
    <div class="card-body">
        <div class="row">
            <?php 
            $cont = 0;
            while ($consulta = mysqli_fetch_array($consulta_projeto_inicial)) {
                $id_projeto = $consulta['id_projeto'];

                $id_avaliacao = $consulta['id_avaliacao'];

                $avaliacoes = mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto");

                $qntd_avaliacoes = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto"));

                $qntd_avaliacoes_feitas = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto AND status_avaliacao = 1"));

                $titulo_projeto = $consulta['titulo'];
                $id_curso = $consulta['id_curso'];
                $id_equipe = $consulta['id_equipe'];
                $status_avaliacao = $consulta['status_avaliacao'];
                $cont = $cont+1;

                $consulta_membros = mysqli_query($conn, 
                "SELECT id_associacao, usuario.id_usuario, usuario.nome 
                FROM associacao as a
                INNER JOIN usuario ON a.id_usuario = usuario.id_usuario 
                WHERE id_equipe = $id_equipe
                GROUP BY id_usuario");

                $membros_row = mysqli_fetch_array($consulta_membros);
                $membros = $membros_row['nome'];

                while ($membros_row = mysqli_fetch_array($consulta_membros)) {
                    $membros = $membros."<br/>".$membros_row['nome'];
                }

                // Informações do card de projeto

                $cor = "info";
                $btn_acao = "
                        <div style='display: inline-flex;'>
                        <a style='border-radius: 0px; width:70%;' href='' class='footer btn btn-md btn-$cor' data-toggle='modal' data-target='#avaliacoes-$cont'><b>Aguardando Classificação</b></a>
                        <a style='border-radius: 0px; width:31%;' href='avaliacao_inicial.php?id_projeto=$id_projeto&id_avaliacao=$id_avaliacao' class='footer btn btn-md btn-outline-info'><b>Editar</b></a>
                        </div>";

                if ($status_avaliacao == 0) {
                    $cor = "warning";
                    $btn_acao = "<a style='border-radius: 0px;' href='avaliacao_inicial.php?id_projeto=$id_projeto&id_avaliacao=$id_avaliacao' class='footer btn btn-md btn-$cor btn-block'><b>Avaliar Projeto</b></a>";
                }
            ?>

                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">	
                    <div class="card border-<?php echo $cor ?>">
                        <div class="card-body">
                            <p class="card-text h5"><?php echo $titulo_projeto; ?></p>
                            <p class="card-text">Avaliações restantes: <?php echo $qntd_avaliacoes-$qntd_avaliacoes_feitas; ?></p>
                            <a class='btn btn-sm btn-outline-<?php echo $cor ?>' href="#" data-toggle="modal" data-target="#detalhe-<?php echo $cont; ?>">Detalhes</a>
                            <a class='btn btn-sm btn-outline-<?php echo $cor ?>' href="#" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>">Avaliações</a>
                            <div class="dropdown mt-1">
                                <a class="btn btn-outline-<?php echo $cor ?> dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Arquivo
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?php echo $consulta['endereco'] ?>" download="<?php echo $titulo_projeto ?>.pdf">Baixar</a>
                                    <a class="dropdown-item" href="<?php echo $consulta['endereco'] ?>" target="_blank">Visualizar</a>
                                </div>
                            </div>
                        </div>
                        <?php echo $btn_acao; ?>
                    </div>
                </div>

                <center>

                <div class="modal fade" id="detalhe-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="detalhe-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="detalhe-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                <h4 class="mb-3 font-weight-normal">ODS:</h4> <h5><?php echo $consulta['categoria']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Curso:</h4> <h5><?php echo $consulta['curso']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Equipe:</h4> <h5><?php echo $consulta['nome']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Membros:</h4> <h5><?php echo $membros; ?></h5>
                                <br><br>
                                <h4>Orientador:</h4>
                                <h5><?php echo $consulta['orientador']; ?></h5>
                                <h4>Co-orientador:</h4>
                                <h5><?php echo $consulta['coorientador']; ?></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="avaliacoes-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="avaliacoes-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="avaliacoes-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left" style="max-height: 400px; overflow-y: auto;">
                                <?php 
                                    if ($qntd_avaliacoes_feitas > 0) {
                                        $btn_aprovacao = "<a href='#' class='btn btn-danger' data-toggle='modal' data-target='#reprovar-$cont' data-dismiss='modal'>Desclassificar</a>
                                        <a href='#' class='btn btn-success' data-toggle='modal' data-target='#aprovar-$cont' data-dismiss='modal'>Classificar</a>";
                                        $count_avaliacao = 0;

                                        $media_avaliacao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10))Media FROM avaliacao_inicial WHERE id_projeto = $id_projeto AND status_avaliacao = 1"))['Media'];

                                        if ($media_avaliacao >= 9) {
                                            echo "<h3>Média Final: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 7){
                                            echo "<h3>Média Final: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 5){
                                            echo "<h3>Média Final: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 0){
                                            echo "<h3>Média Final: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
                                        }

                                        while ($mostrar_avaliacoes = mysqli_fetch_assoc($avaliacoes)) {
                                            $count_avaliacao = $count_avaliacao+1;
                                            $id_avaliacao = $mostrar_avaliacoes['id_avaliacao'];
                                            $qntd_criterios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (n1+n2+n3+n4+n5+n6+n7+n8+n9+n10)acertos 
                                            FROM avaliacao_inicial 
                                            WHERE id_avaliacao = $id_avaliacao; "))['acertos'];         
                                            ?>

                                            <div class="mb-2 p-2" style="border: #138496 solid 2px;">
                                            <h3><?php echo $count_avaliacao."ª "; ?>Avaliação</h4>
                                            <h5>Avaliador: <?php echo $mostrar_avaliacoes['nome'] ?></h5>

                                            <?php 
                                            if($mostrar_avaliacoes['status_avaliacao'] == 0){ 
                                            ?>
                                               <h5 class="text-secondary">Avaliação Pendente</h5>
                                            </div>                
                                            <?php 
                                            }
                                            else{ 
                                            ?>

                                            
                                            <h5>Critérios atingidos: <?php echo $qntd_criterios; ?></h5>
                                            <div style="height: 200px; width:80%px; overflow-y: scroll;">
                                                <p>
                                                Pontualidade no cumprimento de prazos
                                                    <?php 
                                                        if($mostrar_avaliacoes['n1'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Atendimento as normas e diretrizes para os autores
                                                    <?php 
                                                        if($mostrar_avaliacoes['n2'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Aplicação das Normas da ABNT atualizadas
                                                    <?php 
                                                        if($mostrar_avaliacoes['n3'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Apresentação, organização e clareza do plano de pesquisa de acordo com as normas e diretrizes para autores
                                                    <?php 
                                                        if($mostrar_avaliacoes['n4'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Título coerente com o tema da Feira de Projetos e Tecnologia
                                                    <?php 
                                                        if($mostrar_avaliacoes['n5'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Objetivos claros e condizentes com as ODS
                                                    <?php 
                                                        if($mostrar_avaliacoes['n6'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Justificativa, com conhecimento científico sobre o problema e soluções
                                                    <?php 
                                                        if($mostrar_avaliacoes['n7'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Criatividade e inovação
                                                    <?php 
                                                        if($mostrar_avaliacoes['n8'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Metodologia científica detalhada
                                                    <?php 
                                                        if($mostrar_avaliacoes['n9'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Profundidade e abrangência da pesquisa
                                                    <?php 
                                                        if($mostrar_avaliacoes['n10'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                            </div>
                                            <?php
                                            }
                                            $soma_avaliacao = $soma_avaliacao+$qntd_criterios;
                                        }
                                    }
                                    else{
                                        $btn_aprovacao = "";
                                        echo "<h3 class='text-secondary'>Ainda não foram feitas avaliações.</h3>";
                                    }
                                    
                                ?>
                            </div>
                            <div class="modal-footer">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <?php echo $btn_aprovacao; ?>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="reprovar-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="reprovar-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="reprovar-<?php echo $cont; ?>Label">Desclassificação</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="aprovacao.php" method="GET">
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;"> 
                                    <label for="comentario-R">Comentário a respeito da Desclassificação:</label>
                                    <textarea class="form-control" id="comentario-R" name="comentario" placeholder="Insira aqui..." rows="3"></textarea>
                                    <input type="text" name="id_projeto" value="<?php echo $id_projeto ?>" hidden readonly>
                                    <input type="text" name="aprovacao" value="0" hidden readonly>      
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>" data-dismiss="modal">Voltar</a>
                                    <input type="submit" class="btn btn-danger" value="Desclassificar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="aprovar-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="aprovar-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="aprovar-<?php echo $cont; ?>Label">Classificação</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="aprovacao.php" method="GET">
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                    <label for="comentario-A">Comentário a respeito da Classificação:</label>
                                    <textarea class="form-control" id="comentario-A" name="comentario" placeholder="Insira aqui..." rows="3"></textarea>
                                    <input type="text" name="id_projeto" value="<?php echo $id_projeto ?>" hidden readonly>
                                    <input type="text" name="aprovacao" value="1" hidden readonly>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>" data-dismiss="modal">Voltar</a>
                                    <input type="submit" class="btn btn-success" value="Classificar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </center>

            <?php
            }
            if ($cont == 0) { 
            ?>
                <h3 class="text-secondary mb-2 ml-3">Não há projetos para avaliar...</h3>
            <?php    
            } 
            ?>
        </div>

        <hr>

        <h3 class="ml-3 mb-5">Classificados/Não classificados</h3>

        <div class="row">

        <?php $cont = 100;
            while ($consulta = mysqli_fetch_array($consulta_projeto_aprovacao)) {
                $id_projeto = $consulta['id_projeto'];

                $avaliacoes = mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto");

                $qntd_avaliacoes = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto"));

                $qntd_avaliacoes_feitas = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_inicial as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto AND status_avaliacao = 1"));

                $titulo_projeto = $consulta['titulo'];
                $id_curso = $consulta['id_curso'];
                $id_equipe = $consulta['id_equipe'];
                $status_aprovacao = $consulta['status_aprovacao'];
                $cont = $cont+1;

                $consulta_membros = mysqli_query($conn, 
                "SELECT id_associacao, usuario.id_usuario, usuario.nome 
                FROM associacao as a
                INNER JOIN usuario ON a.id_usuario = usuario.id_usuario 
                WHERE id_equipe = $id_equipe
                GROUP BY id_usuario");

                $membros_row = mysqli_fetch_array($consulta_membros);
                $membros = $membros_row['nome'];

                while ($membros_row = mysqli_fetch_array($consulta_membros)) {
                    $membros = $membros."<br/>".$membros_row['nome'];
                }

                // Informações do card de projeto

                $cor = "success";
                $status = "APROVADO";

                if ($status_aprovacao == 0) {
                    $cor = "danger";
                    $status = "REPROVADO";
                }

                $btn_acao = "
                        <a style='border-radius: 0px;' href='' class='footer btn btn-md btn-$cor' data-toggle='modal' data-target='#avaliacoes-$cont'><b>Alterar Classificação</b></a>";
 
                ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3">	
                    <div class="card border-<?php echo $cor ?>">
                        <div class="card-body">
                            <p class="card-text h5"><?php echo $titulo_projeto; ?></p>
                            <p class="card-text font-weight-bold text-<?php echo $cor ?>"><?php echo $status; ?></p>
                            <a class='btn btn-sm btn-outline-<?php echo $cor ?>' href="#" data-toggle="modal" data-target="#detalhe-<?php echo $cont; ?>">Detalhes</a>
                            <a class='btn btn-sm btn-outline-<?php echo $cor ?>' href="#" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>">Avaliações</a>
                        </div>
                        <?php echo $btn_acao; ?>
                    </div>
                </div>

                <center>

                <div class="modal fade" id="detalhe-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="detalhe-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="detalhe-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                <h4 class="mb-3 font-weight-normal">ODS:</h4> <h5><?php echo $consulta['categoria']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Curso:</h4> <h5><?php echo $consulta['curso']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Equipe:</h4> <h5><?php echo $consulta['nome']; ?></h5><br/>
                                <h4 class="mb-3 font-weight-normal">Membros:</h4> <h5><?php echo $membros; ?></h5>
                                <br><br>
                                <h4>Orientador:</h4>
                                <h5><?php echo $consulta['orientador']; ?></h5>
                                <h4>Co-orientador:</h4>
                                <h5><?php echo $consulta['coorientador']; ?></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="avaliacoes-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="avaliacoes-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="avaliacoes-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left" style="max-height: 400px; overflow-y: auto;">
                                <?php 
                                    $btn_aprovacao = "
                                    <a id='retirar' onclick=\"return confirm('RETIRAR APROVAÇÃO?')\" href='aprovacao.php?id_projeto=$id_projeto&aprovacao=NULL' class='btn btn-info'>Retirar Classificação</a>";
                                    if ($qntd_avaliacoes_feitas > 0) {
                                        $count_avaliacao = 0;

                                        $media_avaliacao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10))Media FROM avaliacao_inicial WHERE id_projeto = $id_projeto AND status_avaliacao = 1"))['Media'];

                                        if ($media_avaliacao >= 9) {
                                            echo "<h3>Média Final: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 7){
                                            echo "<h3>Média Final: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 5){
                                            echo "<h3>Média Final: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 0){
                                            echo "<h3>Média Final: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
                                        }
                                        while ($mostrar_avaliacoes = mysqli_fetch_assoc($avaliacoes)) {
                                            $count_avaliacao = $count_avaliacao+1;
                                            $id_avaliacao = $mostrar_avaliacoes['id_avaliacao'];
                                            $qntd_criterios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (n1+n2+n3+n4+n5+n6+n7+n8+n9+n10)acertos 
                                            FROM avaliacao_inicial 
                                            WHERE id_avaliacao = $id_avaliacao; "))['acertos'];         
                                            ?>

                                            <div class="mb-2 p-2" style="border: #138496 solid 2px;">
                                            <h3><?php echo $count_avaliacao."ª "; ?>Avaliação</h4>
                                            <h5>Avaliador: <?php echo $mostrar_avaliacoes['nome'] ?></h5>

                                            <?php 
                                            if($mostrar_avaliacoes['status_avaliacao'] == 0){ 
                                            ?>
                                               <h5 class="text-secondary">Não avaliou</h5>
                                            </div>                            
                                            <?php 
                                            }
                                            else{ 
                                            ?>

                                            
                                            <h5>Critérios atingidos: <?php echo $qntd_criterios; ?></h5>
                                            <div style="height: 200px; width:80%px; overflow-y: scroll;">
                                                <p>
                                                Pontualidade no cumprimento de prazos
                                                    <?php 
                                                        if($mostrar_avaliacoes['n1'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Atendimento as normas e diretrizes para os autores
                                                    <?php 
                                                        if($mostrar_avaliacoes['n2'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Aplicação das Normas da ABNT atualizadas
                                                    <?php 
                                                        if($mostrar_avaliacoes['n3'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Apresentação, organização e clareza do plano de pesquisa de acordo com as normas e diretrizes para autores
                                                    <?php 
                                                        if($mostrar_avaliacoes['n4'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Título coerente com o tema da Feira de Projetos e Tecnologia
                                                    <?php 
                                                        if($mostrar_avaliacoes['n5'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Objetivos claros e condizentes com as ODS
                                                    <?php 
                                                        if($mostrar_avaliacoes['n6'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Justificativa, com conhecimento científico sobre o problema e soluções
                                                    <?php 
                                                        if($mostrar_avaliacoes['n7'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Criatividade e inovação
                                                    <?php 
                                                        if($mostrar_avaliacoes['n8'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Metodologia científica detalhada
                                                    <?php 
                                                        if($mostrar_avaliacoes['n9'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                                <p>
                                                Profundidade e abrangência da pesquisa
                                                    <?php 
                                                        if($mostrar_avaliacoes['n10'] == 1){
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/3/3b/Eo_circle_green_checkmark.svg' alt='APLICADO'>";
                                                        }
                                                        else{
                                                            echo "<img style='height: 20px; width: 20px; display: inline-block;' src='https://upload.wikimedia.org/wikipedia/commons/c/cc/Cross_red_circle.svg' alt='NÃO APLICADO'>";
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                            </div>
                                            <?php
                                            }
                                        }
                                    }
                                    else{
                                        echo "<h3 class='text-secondary'>Não foram feitas avaliações.</h3>";
                                    }
                                    
                                ?>
                            </div>
                            <div class="modal-footer">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <?php echo $btn_aprovacao; ?>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </center>

        <?php
            }
            if ($cont == 100) { 
        ?>
                <h3 class="text-secondary ml-3">Não há projetos Classificados/Não classificados...</h3>
        <?php    
            } 
        ?>

        </div>
    </div>
    <div class="card-footer border-secondary">
        <div style="font-size: 18px" class="font-weight-normal"><b class="text-warning">Amarelo</b>: Pendente | <b class="text-info">Azul</b>: Avaliado</div>
        <div style="font-size: 18px" class="font-weight-normal"><b class="text-danger">Vermelho</b>: Não Classificado | <b class="text-success">Verde</b>: Classificado</div>
    </div>
</div>