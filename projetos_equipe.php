<?php 

if(isset($_SESSION['acesso_adm'])){
    $arquivo="../";
    $regisprojeto = "regispro.php";
    $metodo = "GET";
}
else{
    $arquivo="";
    $regisprojeto = "regisprojeto.php";
    $metodo = "POST";
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="row">
    <div class="col">
        <h3 class="mb-3 font-weight-bold" style="border-bottom: 1px solid #A8A8A8; padding-bottom: 10px;">Projetos</h3>
    </div>
</div>

<?php 

if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM projeto WHERE id_equipe = $id_equipe")) > 0){ ?>
    
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

        <?php 
            $query = mysqli_query($conn, 
            "SELECT *, o.nome AS orientador, co.nome AS coorientador FROM projeto AS p
            INNER JOIN orientador as o ON p.id_orientador = o.id_orientador
            INNER JOIN orientador as co ON p.id_coorientador = co.id_orientador
            WHERE id_equipe=$id_equipe");
            $cont = 0;
            while($projeto = mysqli_fetch_array($query)){ 
                $cont = $cont + 1;
        ?>
        
        <div class="col mb-2">
            <div class="card mb-3" style="box-shadow: 3px 3px 10px #495057;">
                <center>
                <div class="card-header">
                    <h5 class="card-title"><?php echo $projeto['titulo'] ?></h5>
                    <a class='btn btn-sm btn-outline-secondary' href="#" data-toggle="modal" data-target="#detalhe-<?php echo $cont; ?>">Detalhes</a>
                </div>
                <div class="card-body">

                    <!-- Arquivo -->
                    <p class="font-weight-bold">Arquivo</p>

                    <?php
                    if ($projeto['endereco'] != NULL){
                    ?>
                        
                        <div class="dropdown mt-1 mb-2">
                            Arquivo já enviado:
                            <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acessar
                            </a>
                            

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo $arquivo.$projeto['endereco'] ?>" download="<?php echo $projeto['titulo'] ?>.pdf">Baixar</a>
                                <a class="dropdown-item" href="<?php echo $arquivo.$projeto['endereco'] ?>" target="_blank">Visualizar</a>
                            </div>
                        </div>
                    <?php
                    }  
                    if($projeto['endereco_count'] > 0){
                    ?>

                        <form method="post" action="<?php echo $arquivo; ?>recebe_upload.php" enctype="multipart/form-data">
                            <input class="form-control mb-2" required type="file" name="arquivo">
                            <input type="text" hidden name="id_projeto" value="<?php echo $projeto['id_projeto']; ?>">
                            <input type="text" hidden name="id_curso" value="<?php echo $id_curso; ?>">
                            <button class="btn btn-outline-primary" name="id_equipe" value="<?php echo $id_equipe; ?>" type="input" style="width: 100%;">Enviar Arquivo</button>
                        </form>                      

                        <?php
                        if($projeto['endereco_count'] != 4){
                        ?>
                            <p class='' style='color: red;'><?php echo $projeto['endereco_count'] ?> alterações restantes.</p>
                    <?php
                        }
                    }
                    else{
                        echo "<p class='font-weight-bold' style='color: red;'>Você não pode mais alterar o arquivo.</p>";
                    } 
                    ?>

                    <hr>
                
                    <!-- Link -->

                    <?php 
                    if($projeto['status_aprovacao'] > 1){
                    ?>
                        <p class="font-weight-bold">Link do vídeo</p>
                    <?php 
                        if($projeto['link'] != NULL){
                    ?>
                         <p class=''>Link já enviado: <a href="<?php echo $projeto['link'] ?>" target="_blank">Acessar</a></p>
                    <?php
                        }
                        if($projeto['link_count'] > 0){
                    ?>
                        <form method="post" action="<?php echo $arquivo; ?>incluir_link.php">
                            <input style="width: 100%;" class="mb-2" type="text" name="link" placeholder="https://www.exemplo.com/exemplo">
                            <input type="text" hidden name="id_projeto" value="<?php echo $projeto['id_projeto']; ?>">
                            <button class="btn btn-outline-primary" type="input" style="width: 100%;">Inserir Link</button>
                        </form>
                    <?php
                        }
                        else{
                            echo "<p class='font-weight-bold' style='color: red;'>Você não pode mais alterar o link.</p>";
                        }
                    }
                    ?>
                </div>
                </center>
            </div>
        </div>

        <center>
        <div class="modal fade" id="detalhe-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="detalhe-<?php echo $cont; ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detalhe-<?php echo $cont; ?>Label"><?php echo $projeto['titulo'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                        <h4>Classificação: 
                            <?php 
                            if ($projeto['status_aprovacao'] == NULL) {
                                echo "<span class='text-secondary'>Pendente</span>";
                            }
                            elseif($projeto['status_aprovacao'] <= 0){
                                echo "<span class='text-danger'>Não Classificado</span>";
                            }
                            elseif($projeto['status_aprovacao'] == 1){
                                echo "<span class='text-success'>Classificado</span>";
                            }
                            elseif($projeto['status_aprovacao'] >= 2){
                                echo "<span class='text-success'>Classificado</span><br>
                                      Nota na Feira: ...";
                            }
                            ?> 
                        </h4>
                        <?php 
                            if ($projeto['comentario_aprovacao'] != NULL) {
                                echo "<h4>Comentário da classificação:</h4>";
                                ?>
                                <h5 class="text-weight-normal">"<?php echo $projeto['comentario_aprovacao']; ?>"</h5>
                                <?php
                            }
                            ?>
                        <br><br>
                        <h4>Orientador:</h4>
                        <h5><?php echo $projeto['orientador']; ?></h5>
                        <h4>Co-orientador:</h4>
                        <h5><?php echo $projeto['coorientador']; ?></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        </center>

        <?php } ?>

        </div>

<?php }
else{ ?>

    <div class="row">
    <div class="col">
        <form action="<?php echo $regisprojeto; ?>" method="<?php echo $metodo; ?>">
            <input type="text" hidden name="id_curso" value="<?php echo $id_curso; ?>">
            <button type="submit" name="id_equipe" value="<?php echo $id_equipe ?>" class="btn btn-lg btn-outline-primary" style="height: 60px; width: 60px; font-size: 1.2em; font-weight: bold;">+</button>
        </form>
    </div>
    </div>

<?php } ?>
<br><br>