<?php include 'cabecalhodash.php';
      // Banco  
        include 'connect.php';

if(empty($_GET['id_usuario'])){
$selecione['nome'] = "Selecione...";
$id_usuario = "";
}
else{
$id_usuario = $_GET['id_usuario'];  
$sql = mysqli_query($conn,"SELECT * FROM usuario WHERE id_usuario = '$id_usuario'");
$selecione = mysqli_fetch_assoc($sql);
}
if(empty($_GET['tipo_usuario'])){
  $tipo_usuario = 5;
}
else{
  $tipo_usuario = $_GET['tipo_usuario'];
}
$query = mysqli_query($conn,"SELECT * FROM usuario order by nome");

      // Fim_Banco       
    ?>

    <br/>
    <br/>

    <!--login-->
      <center>
         <h1 class="mb-3 font-weight-normal"> Redefinição de Senha </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>    
        <div class="container">
        <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="processa_senha.php" method="POST">
            <div class="form-group">  
              <label class="font-weight-bold" for="exampleFormControlSelect1">Usuário</label>
               <select class="form-control" style="width: 300px;" name="id_usuario"  readonly>
                <option value="<?php echo $id_usuario; ?>"><?php echo $selecione['nome']; ?></option>
              </select>
            </div>            
            <div class="form-group">
              <label class="font-weight-bold" for="exampleInputEmail1">Nova senha</label>
              <input type="password" style="width: 300px;" required name="nova_senha" class="form-control" id="exampleInputNova_Senha1" aria-describedby="senhaHelp">
            </div>
            <button style="width: 300px;" type="submit" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>" class="btn btn-md btn-primary btn-block"><b><i class="fas fa-redo-alt"></i> Redefinir</b></button>
          </form><br/>
        </div>
        </div>
      </center>
    <!--Fim_login-->







<?php include 'rodapedash.php'; ?>