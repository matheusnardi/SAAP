<?php 

if (!empty($_GET['pag'])) {
    include 'cabecalho.php';
}

?>

<br/><br>

<center>
<h1 class="mb-3 font-weight-normal">Alterar Senha</h1>

<div class="container">
    <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>

        <form action="processa_senha.php" method="POST">

        <div class="form-group">
            <label class="font-weight-bold" for="NovaSenha">Nova senha</label>
            <input type="password" minlength="8" style="width: 300px;" name="nova_senha" class="form-control senha" id="NovaSenha" placeholder="Senha" required>
        </div> 

        <div class="form-group">
            <label class="font-weight-bold" for="CNovaSenha">Confirmar senha</label>
            <input type="password" style="width: 300px;" class="form-control" id="CNovaSenha" placeholder="Repita a senha" required>
        </div>

        <button style="width: 300px;" name="id_usuario" value="<?php echo $id_usuario; ?>" class="btn btn-md btn-primary btn-block" type="submit" onclick="validarSenha()"><b>Alterar</b></button>

        <?php 
            if (!empty($_GET['pag'])) { 
        ?>
                <a href="index.php" class="btn btn-md btn-primary btn-block" style="margin-top: 10px; width: 300px;">Voltar</a><br>         
        <?php  
            }
        ?>

        </form><br/>

</div>
</center>

<?php 

if (!empty($_GET['pag'])) {
    include 'rodape.php';
}

?>