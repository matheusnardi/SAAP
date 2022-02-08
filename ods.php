<?php

// Query de ODS que o avaliador ainda NÃO associou
$query_ods = mysqli_query($conn, 
"SELECT * FROM ods 
WHERE id_ods 
NOT IN (SELECT id_ods FROM associacao_ods WHERE id_usuario = $id_avaliador)");

if($url == "/inscricao_inicial.php"){
    $pagina = 1;
    $titulo = "Inscrição para Avaliação Inicial";
    $endereco = "inscricao_inicial.php";
}
else{
    $pagina = 2;
    $titulo = "Inscrição Feira de Avaliação";
    $endereco = "inscricao_final.php";
}

?>

<br/>

<center>
<h1 class="mb-3 font-weight-normal"> <?php echo $titulo ?> </h1><br/> 
<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="associar_ods.php" method="POST">
            <input type="text" name="pagina" value="<?php echo $pagina; ?>" hidden readonly>
            <div class="form-group">
                <label class="font-weight-normal h4">ODS de preferência:</label>
                <?php
                $count = 0; 
                while ($associacao_ods = mysqli_fetch_array($query_associacao_ods)) {
                    $count = $count + 1; 
                    $id_associacao = $associacao_ods['id_associacao'];
                ?>

                    <p class="font-weight-bold p-2 mt-2" style="width: 300px; border: 2px #C0C0C0 solid;"><?php echo $associacao_ods['categoria']; ?><br><a href="associar_ods.php?id_associacao=<?php echo $id_associacao; ?>&pagina=<?php echo $pagina ?>">Remover</a></p>

                <?php   
                }
                ?>
                <select class="form-control mt-2" style="width: 300px;" name="id_ods" id="ods" required>
                    <option value="">Selecione...</option>
                    <?php 
                    while($ods = mysqli_fetch_array($query_ods)){ 
                    ?>
                        <option value="<?php echo $ods['id_ods']; ?>"><?php echo $ods['categoria']; ?></option>
                        <?php 
                    } 
                    ?>
                </select>
                <button type="submit" name="id_usuario" value="<?php echo $id_avaliador; ?>" style="width: 300px;" class="btn btn-outline-success mt-1"><b>Adicionar</b></button>
            </div><br/>
            <a href="<?php echo $endereco ?>?inscricao=1" style="width: 300px;" class="btn btn-md btn-primary btn-block"><b><?php if($count == 0){ echo "Não tenho preferência"; } else { echo "Prosseguir"; } ?></b></a>
            <a href="perfil_avaliador.php" style="width: 300px;" class="btn btn-md btn-outline-primary btn-block"><b>Voltar</b></a>
        </form><br/>
    </div>
</div>
</center>