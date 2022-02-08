<?php 
include 'cabecalho.php'; 

$id_projeto = $_GET['id_projeto'];
$id_avaliador = $_SESSION['id_usuario'];
$id_avaliacao = $_GET['id_avaliacao'];

$titulo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT titulo FROM projeto
WHERE id_projeto = $id_projeto"))['titulo'];

$endereco = mysqli_fetch_assoc(mysqli_query($conn, "SELECT endereco FROM projeto as p
WHERE id_projeto = $id_projeto"))['endereco'];

$curso = mysqli_fetch_assoc(mysqli_query($conn, "SELECT titulo, curso.curso FROM projeto as p
INNER JOIN curso on p.id_curso = curso.id_curso
WHERE id_projeto = $id_projeto"))['curso'];

$nota = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM avaliacao_inicial WHERE id_avaliacao = $id_avaliacao"));



?>

<script type="text/javascript">

function verificaNotas(){

    var notas = document.getElementsByTagName("input");
    var count = 0;

    for (var i = 0; i < notas.length; i++) {
        if(notas[i].checked){
            count = count+1;
        }
    }

    if(count != 10){
        alert("Assinale todos os critérios.");
    }

}

</script>

<center>
<div class="container">

    <br>
    <h1 class="mb-3 font-weight-normal"><?php echo $titulo; ?></h1>
    <h3 class="font-weight-normal"><?php echo $curso; ?></h3>
    <div class="dropdown mt-1">
        <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Arquivo
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="<?php echo $endereco ?>" download>Baixar</a>
            <a class="dropdown-item" href="<?php echo $endereco ?>" target="_blank">Visualizar</a>
        </div>
    </div> 
    <br>

    <form method="POST" action="processa_avaliacao_inicial.php" class="mb-5">

    <div class="card border-dark mb-5" style="width: 80%">
        <div class="card-header h4">
            Em relação ao cumprimento do regulamento:
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Pontualidade no cumprimento de prazos
                        </div>
                        <div class="card-body pb-0">
                            <?php 
                            
                            if($nota['n1'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n1'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n1" id="n1-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n1-0"></label>
                                <input class="check" type="radio" name="n1" id="n1-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n1-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Atendimento as normas e diretrizes para os autores
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n2'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n2'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n2" id="n2-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n2-0"></label>
                                <input class="check" type="radio" name="n2" id="n2-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n2-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Aplicação das Normas da ABNT atualizadas
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n3'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n3'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n3" id="n3-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n3-0"></label>
                                <input class="check" type="radio" name="n3" id="n3-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n3-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
        </div>
    </div>
    

    <div class="card border-dark mb-5" style="width: 80%">
        <div class="card-header h4">
            Em relação ao desenvolvimento do projeto:
        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Apresentação, organização e clareza do plano de pesquisa de acordo com as normas e diretrizes para autores
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n4'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n4'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n4" id="n4-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n4-0"></label>
                                <input class="check" type="radio" name="n4" id="n4-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n4-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Título coerente com o tema da Feira de Projetos e Tecnologia
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n5'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n5'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n5" id="n5-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n5-0"></label>
                                <input class="check" type="radio" name="n5" id="n5-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n5-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Objetivos claros e condizentes com as ODS
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n6'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n6'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n6" id="n6-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n6-0"></label>
                                <input class="check" type="radio" name="n6" id="n6-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n6-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Justificativa, com conhecimento científico sobre o problema e soluções
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n7'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n7'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n7" id="n7-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n7-0"></label>
                                <input class="check" type="radio" name="n7" id="n7-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n7-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Criatividade e inovação
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n8'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n8'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n8" id="n8-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n8-0"></label>
                                <input class="check" type="radio" name="n8" id="n8-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n8-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Metodologia científica detalhada
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n9'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n9'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n9" id="n9-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n9-0"></label>
                                <input class="check" type="radio" name="n9" id="n9-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n9-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col">
                    <div class="card border-secondary mb-3" style="max-width: 30rem;">
                        <div class="card-header h5 font-weight-normal" style="min-height: 100px; display: flex; align-items: center;">
                            Profundidade e abrangência da pesquisa
                        </div>
                        <div class="card-body pb-0">
                        <?php 
                            
                            if($nota['n10'] == NULL){
                                $checked0 = "";
                                $checked1 = "";
                            }
                            elseif($nota['n10'] == 1){
                                $checked0 = "";
                                $checked1 = "checked";
                            }
                            else{
                                $checked0 = "checked";
                                $checked1 = "";
                            }
                            
                            ?>
                            <div class="custom-radio">
                                <input class="cross" type="radio" name="n10" id="n10-0" value="0" required <?php echo $checked0 ?>>
                                <label for="n10-0"></label>
                                <input class="check" type="radio" name="n10" id="n10-1" value="1" required <?php echo $checked1 ?>>
                                <label for="n10-1"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
        </div>
    </div>
    <input type="text" name="id_avaliacao" value="<?php echo $id_avaliacao ?>" hidden readonly>              
    <br><input class="btn btn-primary" onclick="verificaNotas()" type="submit" value="Concluir Avaliação" style="width: 80%; height: 70px; font-size: 1.5em;">

    </form>
</div>
</center>
    <!-- Fim_Notas --> 

<?php include 'rodape.php'; ?>