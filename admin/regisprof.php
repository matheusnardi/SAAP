<?php include 'cabecalhodash.php';
      include 'connect.php'; 
if(isset($_SESSION["acesso_adm"])){
$statuspag = mysqli_query($conn, "SELECT permissao_sem_usuario FROM pagina WHERE url = '/admin/regisprof.php'");
              $statuspag = mysqli_fetch_assoc($statuspag);
              $statuspag = $statuspag['permissao_sem_usuario'];

              if ($statuspag == "não") {
                 $statuspag = "Bloqueado";
               }
               else {
                  $statuspag = "Liberado";
                }
  $btnstatus = "<div style='font-size: 1%;'>&nbsp;</div> 
            <a style='width: 300px;' class='btn btn-md btn-warning' href='incluir.php?status=$statuspag'><b>Status: $statuspag </b></a>";                
}else{
  $btnstatus = "";
} 
?>

<script type="text/javascript">

  function validarProfessor(){
    var professor = document.getElementById('professor').value;
    var professorR = document.getElementById('professorR').value;
    if (professor != professorR) {
        alert("SELECIONE NOMES IGUAIS");
        event.preventDefault ();
    }
  }

</script>

    <br/>
    <br/>

    <center>
    <h1 class="mb-3 font-weight-normal"> Cadastro de Professor </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>  
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
            </div>
            <div class="form-group">
                <label for="professor"><b>Selecione seu nome:</b></label>
                <select class="form-control" style="width: 300px;" name="professor" id="professor" required>
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
                <select class="form-control" style="width: 300px;" name="professorR" id="professorR" required>
                    <option value="">...</option>
                    <?php 
                    $query_professores = mysqli_query($conn, "SELECT * FROM orientador
                    WHERE id_orientador NOT IN (SELECT id_professor FROM associacao_professor)");
                    while($professor = mysqli_fetch_array($query_professores)){ ?>
                    <option value="<?php echo $professor['id_orientador']; ?>"><?php echo $professor['nome']; ?></option>
                    <?php } ?>
                </select>
            </div><br/>

            <button style="width: 300px;" name="tipo" value="professor" class="btn btn-md btn-primary btn-block" type="submit" onclick="validarProfessor()"><b><i class="fas fa-user-plus"></i> Cadastrar</b></button>
            <!-- <?php echo $btnstatus; ?> -->
          </form><br/>          
      </div>
      <br>
    </div>
    </center>

<?php include 'rodapedash.php'; ?>