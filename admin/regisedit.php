<?php include 'cabecalhodash.php';
      // Banco  
        include 'connect.php'; 
      // Fim_Banco

$id_usuario   = $_GET['id_usuario'];
$tipo_usuario = $_GET['tipo_usuario'];

$pesquisa_cadastro = mysqli_query($conn, "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'");
$pesquisa_cadastro = mysqli_fetch_assoc($pesquisa_cadastro);

    ?>

    <br/>
    <br/>

    <!--login-->
      <center>
    <h1 class="mb-3 font-weight-normal"> Edição de Cadastro </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
        <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="processa_regisedit.php" method="POST">
            <div class="form-group">
              <label class="font-weight-bold" for="exampleInputName1">Nome Completo</label>
              <input type="text" style="width: 300px;" name="nome" value="<?php echo $pesquisa_cadastro['nome']; ?>" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
            </div>  
            <div class="form-group">
              <label class="font-weight-bold" for="exampleInputEmail1">Email</label>
              <input type="email" style="width: 300px;" name="email" value="<?php echo $pesquisa_cadastro['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">  
              <label class="font-weight-bold" for="exampleFormControlSelect1">Tipo</label>
              <select class="form-control" style="width: 300px;" name="tipo" id="exampleFormControlSelect1" required>
                <option value="<?php echo $pesquisa_cadastro['tipo']; ?>">
                  Padrão (
                  <?php 
                  if($pesquisa_cadastro['tipo'] == "comum"){
                    $pesquisa_cadastro['tipo'] = "Aluno";
                    } echo $pesquisa_cadastro['tipo']; ?>
                  )
                </option>
                <option value="comum">Aluno</option>
                <option value="avaliador">Avaliador</option>
                <option value="orientador">Orientador</option>
                <option value="adm">Administrador</option>
              </select>
            </div><br/>
            <input type="text" name="id_usuario" value="<?php echo $id_usuario; ?>" hidden readonly>

            <a class="btn btn-md btn-warning " style="width: 150px;" href="redefinir_senha.php?id_usuario=<?php echo $id_usuario; ?>&tipo_usuario=<?php echo $tipo_usuario; ?>" role="button"><b><i class="fas fa-random"></i> Trocar Senha</b></a>

            <a class="btn btn-md btn-info " style="width: 150px;" href="consulta_usuario.php" role="button"><b><i class="fas fa-arrow-left"></i> Voltar</b></a><div style="font-size: 1%;">&nbsp;</div>

            <button type="submit" style="width: 300px;" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>" class="btn btn-md btn-success btn-block mt-1"><b><i class="fas fa-redo-alt"></i> Atualizar</b></button> 

                         
          </form><br/> 
          </div>                                    
        </div>
      </center>
    <!--Fim_login-->







<?php include 'rodapedash.php'; ?>