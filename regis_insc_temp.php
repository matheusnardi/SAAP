<?php 
include 'cabecalho.php';

$query_ods = mysqli_query($conn, "SELECT * FROM ods");
?>

<script type="text/javascript">

  function validarProfessor(){
    var professor = document.getElementById('professor').value;
    var professorR = document.getElementById('professorR').value;
    if (professor != professorR) {
        alert("SELECIONE NOMES IGUAIS");
        event.preventDefault ();
    }

    var email = document.getElementById('email').value;
    var emailR = document.getElementById('emailR').value;
    if (email != emailR) {
        alert("EMAILS DIFERENTES");
        event.preventDefault ();
    }

    var senha = document.getElementById('senha').value;
    var senhaR = document.getElementById('senhaR').value;
    if (senha != senhaR) {
        alert("SENHAS DIFERENTES");
        event.preventDefault ();
    }
  }

</script>

    <br/>

    <div class="container" style="display: flex; align-items: center; flex-direction: column;">
    <h1 class="mb-3 font-weight-normal"> Cadastro e Inscrição </h1><br/>
      <div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0; padding: 10px;"><br/>
          <form action="processa_regis_insc_temp.php" method="POST">
            <div class="form-group">
              <label class="font-weight-bold" for="nome">Nome</label>
              <input type="text" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" placeholder="Nome Completo" required>
            </div><br>
            <div class="form-group">
              <label class="font-weight-bold" for="email">E-mail</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Endereço de Email" required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="emailR">Repita o E-mail</label>
              <input type="email" name="emailR" class="form-control" id="emailR" aria-describedby="emailHelp" placeholder="Endereço de Email" required>
            </div><br>
            <div class="form-group">
              <label class="font-weight-bold" for="senha">Senha</label>
              <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="senhaR">Repita a Senha</label>
              <input type="password" name="senhaR" class="form-control" id="senhaR" placeholder="Senha" required>
            </div><br>
            <div class="form-group">
                <label for="professor"><b>Selecione seu nome:</b></label>
                <select class="form-control" name="professor" id="professor" required>
                    <option value="">...</option>
                    <?php 
                    $query_professores = mysqli_query($conn, "SELECT * FROM orientador
                    WHERE id_orientador NOT IN (SELECT id_professor FROM associacao_professor)");
                    while($professor = mysqli_fetch_array($query_professores)){ ?>
                    <option value="<?php echo $professor['id_orientador']; ?>"><?php echo $professor['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="professorR"><b>Selecione novamente:</b></label>
                <select class="form-control" name="professorR" id="professorR" required>
                    <option value="">...</option>
                    <?php 
                    $query_professores = mysqli_query($conn, "SELECT * FROM orientador
                    WHERE id_orientador NOT IN (SELECT id_professor FROM associacao_professor)");
                    while($professor = mysqli_fetch_array($query_professores)){ ?>
                    <option value="<?php echo $professor['id_orientador']; ?>"><?php echo $professor['nome']; ?></option>
                    <?php } ?>
                </select>
            </div><br/>
            <div class="form-group">
                <label class="font-weight-bold">Selecione seus ODS de preferência:</label><br>

                <input type="checkbox" id="nenhum" name="nenhum" value="nenhum">
                <label for="nenhum" class="text-danger"> Não tenho preferência</label><br>
                <?php 
                while($ods = mysqli_fetch_array($query_ods)){ 
                    $id_ods = $ods['id_ods'];
                    $categoria = $ods['categoria'];
                ?>
                    <input type="checkbox" id="ods-<?php echo $id_ods ?>" name="ods-<?php echo $id_ods ?>" value="<?php echo $id_ods ?>">
                    <label for="ods-<?php echo $id_ods ?>"> <?php echo $categoria ?></label><br>
                <?php 
                } 
                ?>
            </div>
            <button style="width: 300px;" name="tipo" value="professor" class="btn btn-md btn-primary btn-block" type="submit" onclick="validarProfessor()"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button>
          </form><br/>          
      </div>
      <br>
    </div>

<?php include 'rodape.php'; ?>