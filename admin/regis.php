<?php 

include 'cabecalhodash.php';

?>

    <br/>
    <br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Cadastro de Aluno </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
    <div class="container">
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
          <form action="incluir.php" method="POST">
            <div class="form-group">
              <label class="font-weight-bold" for="nome">Nome</label>
              <input type="text" style="width: 300px;" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" placeholder="Nome Completo" required>
            </div>  
            <div class="form-group">
              <label class="font-weight-bold" for="email">Email</label>
              <input type="email" style="width: 300px;" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Endereço de Email" required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="senha">Senha</label>
              <input type="password" style="width: 300px;" name="senha" class="form-control" id="senha" placeholder="Senha" required>
            </div><br/>
            <button style="width: 300px;" name="tipo" value="comum" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button>
          </form><br/>
    </div>
    </center>

<?php include 'rodapedash.php'; ?>