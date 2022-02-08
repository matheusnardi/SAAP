<?php include 'cabecalhodash.php';?>

    <br/>
    <br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Cadastro de Orientador </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="incluir_orientador.php" method="POST">
            <div class="form-group">
              <label class="font-weight-bold" for="nome">Nome</label>
              <input type="text" style="width: 300px;" name="nome" class="form-control text-uppercase" id="nome" aria-describedby="nameHelp" placeholder="Nome completo" required>
            </div><br/>
            <button style="width: 300px;" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button>
          </form><br/>
      </div>
    </div>
    </center>

<?php include 'rodapedash.php'; ?>