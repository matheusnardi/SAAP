<?php include 'cabecalhodash.php';?>
    <br/>
    <br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Registro de Página </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/> 
    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
        <form action="incluirpagina.php" method="POST">

          <div class="form-group">
            <label for="url"><b>URL</b></label>
            <input type="text" style="width: 300px;" placeholder="/exemplo.php" name="url" class="form-control" id="url" aria-describedby="nameHelp" required>
          </div>  
          <div class="form-group">
            <label for="titulo"><b>Titulo</b></label>
            <input type="text" style="width: 300px;" name="titulo" class="form-control" id="titulo" aria-describedby="nameHelp" placeholder="Titulo da página" required>
          </div><br/>
         </div><br/>
         <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/> 
           <h4 class="mb-3 font-weight-normal"> Permissões </h4>
          <div class="row">
            <div class="col col-6">
              <div class="form-group">
                <label for="exampleInputName1"><b>Sem Usuário</b></label>
              <select class="form-control" style="width: 100px;" name="per_semuser" id="exampleInputName1" required>
                <option value="não">Não</option>
                <option value="sim">Sim</option>
              </select>            
              </div>
          </div>
          <div class="col col-6">           
            <div class="form-group">
              <label for="exampleInputName1"><b>Comum</b></label>
              <select class="form-control" style="width: 100px;" name="per_com" id="exampleInputName1" required>
                <option value="não">Não</option>
                <option value="sim">Sim</option>
              </select>           
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col col-6">
          <div class="form-group">
            <label for="exampleInputName1"><b>Avaliador</b></label>
              <select class="form-control" style="width: 100px;" name="per_aval" id="exampleInputName1" required>
                <option value="não">Não</option>
                <option value="sim">Sim</option>
              </select>            
          </div> 
        </div>
        <div class="col col-6"> 
          <div class="form-group">
            <label for="exampleInputName1"><b>Orientador</b></label>
              <select class="form-control" style="width: 100px;" name="per_orien" id="exampleInputName1" required>
                <option value="não">Não</option>
                <option value="sim">Sim</option>
              </select>            
          </div>
        </div>
      </div>  
          <div class="form-group">
            <label for="exampleInputName1"><b>Administrador</b></label>
              <select class="form-control" style="width: 100px;" name="per_adm" id="exampleInputName1" required>
                <option value="não">Não</option>
                <option value="sim">Sim</option>
              </select>            
          </div><br/>
            <button style="width: 300px;" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-plus"></i> Registrar</b></button>
        </form><br/>
      </div>
    </div>
    </center>
    <br/>
    <br/>

<?php include 'rodapedash.php'; ?>