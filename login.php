<?php include 'cabecalho.php';

?>
    <br/>
    <br/>

    <!--login-->
      <center>
            <br/>
            <br/>
        <img class="mb-4" src="/img/novalogo.png" alt="" width="150" height="150">                               
        <h1 class="h2 mb-3 font-weight-normal"> Sistema de Avaliação e<br> Armazenamento de Projetos </h1>
        <div class="container">
          <form action="processa_login.php" method="POST">
            <br/>
              <div class="form-group">
                <input style="width: 300px;" type="email" name="email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
              </div>
              <div class="form-group">
                <input style="width: 300px;" type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
              </div>
              <div class="form-group">
                <div class="checkbox mb-3">
                </div>
              </div>
              <button style="width: 300px;" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
              <br/>
              <br/>
              <br/>
          </form>
        </div>
      </center>
    <!--Fim_login-->







<?php include 'rodape.php'; ?>