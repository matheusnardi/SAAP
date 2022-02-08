<?php include 'cabecalhodash.php';
      // Banco  
        include 'connect.php'; 
      // Fim_Banco

if (empty($_GET['id_projeto'])) {
  header('location: consulta_projeto.php');
}
else{
  $id_projeto = $_GET['id_projeto'];
}

$pesquisa_projeto = mysqli_query($conn, "SELECT id_projeto, titulo FROM projeto WHERE id_projeto = '$id_projeto'");
$pesquisa_projeto = mysqli_fetch_assoc($pesquisa_projeto);

    ?>

    <br/>
    <br/>

    <!--login-->
      <center>
    <h1 class="mb-3 font-weight-normal"> Edição de Projeto </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
        <div class="container">
        <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="processa_proedit.php" method="POST">
            <div class="form-group">
              <label class="font-weight-bold" for="exampleInputName1">Título</label>
              <input type="text" style="width: 300px;" name="titulo" value="<?php echo $pesquisa_projeto['titulo']; ?>" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
            </div><br/>
            <button type="submit" style="width: 300px;" name="id_projeto" value="<?php echo $id_projeto; ?>" class="btn btn-md btn-success"><b><i class="fas fa-redo-alt"></i> Atualizar</b></button>                                       
          </form><br/>
          </div>                                    
        </div>
      </center>
    <!--Fim_login-->







<?php include 'rodapedash.php'; ?>