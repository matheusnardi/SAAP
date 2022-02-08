<?php 

include 'cabecalho.php';

$id_avaliador = $_SESSION['id_usuario'];

$profVerif = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao_professor WHERE id_usuario = $id_avaliador"));

if ($profVerif >= 1) {
    $query_avaliador = mysqli_query($conn, "SELECT *, u.nome AS nome_usuario, o.nome AS nome_professor FROM usuario as u
    INNER JOIN associacao_professor AS a ON u.id_usuario = a.id_usuario
    INNER JOIN orientador AS o ON a.id_professor = o.id_orientador 
    WHERE u.id_usuario = $id_avaliador");

    $avaliador = mysqli_fetch_array($query_avaliador);
    $id_associacao = $avaliador['id_associacao'];
}
else{
    $query_avaliador = mysqli_query($conn, "SELECT *, u.nome as nome_usuario FROM usuario as u WHERE u.id_usuario = $id_avaliador");

    $avaliador = mysqli_fetch_array($query_avaliador);
}

// Verifica se o professor já está inscrito
if(mysqli_num_rows(mysqli_query($conn, "SELECT id_usuario FROM inscricao_final WHERE id_usuario = $id_avaliador")) < 1){

    // Query de ODS que o avaliador JÁ associou
    $query_associacao_ods = mysqli_query($conn, 
    "SELECT a.id_associacao, a.id_ods, o.categoria FROM associacao_ods AS a
    INNER JOIN ods AS o ON a.id_ods = o.id_ods
    WHERE id_usuario = $id_avaliador
    ");

    // Antes de ir para a inscrição, o Avaliador deve selecionar seus ODS de interesse 
    if(empty($_GET['inscricao'])){
        include 'ods.php';
    }
    else{
    
    ?>

    <br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Inscrição Feira de Avaliação </h1><br/> 
    <div class="container">
        <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
            <form action="processa_inscricao_final.php" method="POST">
                <label class="font-weight-normal h4 mb-4">Confirme os dados</label>
                <div class="form-group">
                    <label class="font-weight-bold" for="nome">Seu nome é:</label>
                    <input type="text" value="<?php echo $avaliador['nome_usuario'] ?>" style="width: 300px;" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" required readonly>
                </div>
                <?php 
                if($profVerif >= 1){
                ?>
                    <div class="form-group">
                        <label class="font-weight-bold" for="professor">Você é o professor:</label>
                        <input type="text" value="<?php echo $avaliador['nome_professor'] ?>" style="width: 300px;" name="professor" class="form-control" id="professor" aria-describedby="nameHelp" required readonly>
                    </div>
                <?php
                }
                ?>  
                <div class="form-group">
                    <label class="font-weight-bold">ODS de preferência:</label>
                    <?php
                    $count = 0; 
                    while ($associacao_ods = mysqli_fetch_array($query_associacao_ods)) {
                        $count = $count + 1; 
                        $id_associacao = $associacao_ods['id_associacao'];
                    ?>

                        <p class="p-2 mt-2" style="width: 300px; border: 2px #C0C0C0 solid;"><?php echo $associacao_ods['categoria']; ?></p>

                    <?php   
                    }
                    if($count == 0){ 
                    ?>
                        <p class="p-2 mt-2" style="width: 300px; border: 2px #C0C0C0 solid;">Nenhuma preferência</p>
                    <?php
                    }
                    ?>
                </div><br/>
                <button style="width: 300px;" name="id_usuario" value="<?php echo $id_avaliador ?>" class="btn btn-md btn-primary btn-block" type="submit"><b>Inscrever-se</b></button>
                <a href="inscricao_inicial.php" style="width: 300px;" class="btn btn-md btn-outline-primary btn-block"><b>Voltar</b></a>
            </form><br/>
        </div>
    </div><br>
    </center>

<?php 
    }
}
    else{ 
?>
        <center>
        <br>
        <h1 class="mb-3 font-weight-normal text-secondary"> Você já está inscrito na Feira de Avaliação </h1><br/> 
        <a href="perfil_avaliador.php" style="width: 300px;" class="btn btn-md btn-outline-primary btn-block"><b>Voltar</b></a>
        </center>
<?php
    }  

include 'rodape.php';

?>