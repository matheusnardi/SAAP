<?php 

if(isset($_SESSION['acesso_adm'])){
    $arquivo = "../";
  }
  else{
    $arquivo = "";
  }

?>

<div class="row">
    <div class="col">
        <h3 class="mb-3 font-weight-bold" style="margin-top: 15px; border-bottom: 1px solid #A8A8A8; padding-bottom: 10px; width: 300px">Informações</h3>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
    <div class="col mb-2">
        <form action="<?php echo $arquivo; ?>editar_info.php" method="post">

            <div class="form-group">
                <label class="font-weight-bold" for="nome">Nome da Equipe</label>
                <input type="text" value="<?php echo $equipe['nome'] ?>" style="width: 300px;" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" placeholder="Ex: Quarteto Fantástico" required>
            </div>  

            <div class="form-group">
                <label class="font-weight-bold" for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" id="descricao" rows="5" style="width: 300px;"><?php echo $equipe['descricao'] ?></textarea>
            </div>
            <input type='text' hidden name='id_curso' value='$id_curso'>
            <button type="submit" name="id_equipe" value="<?php echo $id_equipe; ?>" class="btn btn-outline-success" style=" width: 300px;">Atualizar Informações</button>

        </form><br>
    </div>

    <?php
    if(mysqli_num_rows(mysqli_query($conn, "SELECT status_aprovacao FROM projeto WHERE id_equipe = $id_equipe AND status_aprovacao > 1")) > 0){ 
        $autorizacao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT autorizacao FROM equipe WHERE id_equipe = $id_equipe"))['autorizacao'];
    ?>
        <div class="col mb-2">
            <label class="font-weight-bold">Arquivo de Autorização</label><br>
            <?php 
            if ($autorizacao != NULL) { 
            ?>
                <object data="<?php echo $arquivo.$autorizacao ?>" type="application/pdf" width="300"><p>Use os botões abaixo para visualizar.</p>
                </object><br>
                <a class="btn btn-sm btn-outline-secondary mb-1" href="<?php echo $arquivo.$autorizacao ?>" download="<?php echo $equipe['nome'] ?>.pdf">Baixar</a>
                <a class="btn btn-sm btn-outline-secondary mb-1" href="<?php echo $arquivo.$autorizacao ?>" target="_blank">Visualizar</a>
            <?php
            } 
            ?>
           <form method="POST" action="<?php echo $arquivo; ?>recebe_aut.php" enctype="multipart/form-data">
                <input class="form-control mb-2" required type="file" name="arquivo" style="width: 300px;">
                <button class="btn btn-outline-primary" name="id_equipe" value="<?php echo $id_equipe; ?>" type="input" style="width: 300px;">Enviar Autorização</button>
            </form>    
        </div>
    <?php
    }
    ?>
</div>