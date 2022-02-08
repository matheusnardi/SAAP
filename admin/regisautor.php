<?php include 'cabecalhodash.php';

if(empty($_GET['id_projeto'])){
  $projetos = 1;
  $result   = mysqli_query($conn, "SELECT * FROM projeto");  
}
else{
  $projetos   = 0;
  $id_projeto = $_GET['id_projeto'];
  $result     = mysqli_query($conn, "SELECT * FROM autor WHERE id_projeto = '$id_projeto'");  
}


      // Banco  
	  include 'connect.php';
      // Fim_Banco       
    ?>

    <br/>
    <br/>

    <center>
      <?php if($projetos == 0){ 
        $pesquisa_titulo = mysqli_query($conn, "SELECT * FROM projeto WHERE id_projeto = '$id_projeto'");
        $rowtitulo = mysqli_fetch_assoc($pesquisa_titulo);
        if(empty($rowtitulo['titulo'])){
          $titulo = "Indisponível";
        }else{
          $titulo = $rowtitulo['titulo'];
         } ?>
    <h1 class="mb-3 font-weight-normal"> Cadastro de Autores </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <h4 class="mb-3 font-weight-normal"> <?php echo $titulo; ?> </h4><br/>
        <form action="incluirautor.php" method="POST">

          <div class="form-group">
            <label for="nome"><b>Nome</b></label>
            <input type="text" style="width: 300px;" name="autor" class="form-control" id="nome" aria-describedby="tituloHelp" placeholder="Nome completo do Autor" required>
          </div><br/>
          <a class="btn btn-warning" style="width: 150px;" href="regisautor.php" role="button"><b><i class="fas fa-random"></i> Trocar</b></a>          
          <a class="btn btn-success" style="width: 150px;" href="regispro.php" role="button"><b><i class="fas fa-check"></i> Finalizar</b></a>
          <div style="font-size: 1%;">&nbsp;</div>
          <button type="submit" style="width: 300px;" name="id_projeto" value="<?php echo $id_projeto; ?>" class="btn btn-info"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button>
          
          <br/><br/>
        </form>
      </div>
    </div>
            <br/>
            <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
            <table class="table" style="width: 300px; table-layout:fixed">
              <thead>
                <tr style="text-align: center;">
                  <th colspan="2" scope="col"><label class="h4 mb-3 font-weight-normal">Autores</label></th>
                </tr>
              </thead> 
                 <?php while ($row = mysqli_fetch_array($result)) { 
                  $id_autor = $row['id_autor'];?>

                   <tbody>
                    <tr>
                      <td style="word-wrap: break-word;"><b><?php echo $row['nome']; ?></b></td>
                      <td style="text-align: center;"><a class="text-danger" href="editautor.php?id_autor=<?php echo $id_autor; ?>&id_projeto=<?php echo $id_projeto; ?>"><i style="font-size: 150%;" class="fas fa-minus-circle"></i></a></td>                     
                    </tr>
                  </tbody>

                <?php } ?>
            </table>
            </div>
            <br/>
            <br/>        
        <?php }

              else { ?>
    <h1 class="mb-3 font-weight-normal"> Selecione um projeto </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
      <div class="container">
        <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="incluirautor.php" method="POST">
          <h3 class="mb-3 font-weight-normal">Projetos</h3> 
              <div class='form-group'>
                  <select class='form-control' style="width: 300px;" name='id_projeto' id='projeto' required>
                    <option value="">Selecione...</option>
                <?php  while($row = mysqli_fetch_array($result)){ ?>
                    <option value="<?php echo $row['id_projeto']; ?>"><?php echo $row['titulo']; ?></option>
                 <?php } ?>
                  </select>
              </div><br/>
            <button style="width: 300px;" name="autor" value="retornar" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-arrow-right"></i> Avançar</b></button>
        </form><br/>
        </div>
      </div>             
          <?php } ?>
    </center>    
    



<?php include 'rodapedash.php'; ?>