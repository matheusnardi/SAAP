<?php include 'cabecalhodash.php'; 

include 'connect.php';

// Pesquisa de avaliadores

$total_avaliadores = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'avaliador'");
$total_avaliadores = mysqli_num_rows($total_avaliadores);

$avaliadores_definidos = mysqli_query($conn, "SELECT id_avaliador FROM avaliacao_final GROUP BY id_avaliador");
$avaliadores_definidos = mysqli_num_rows($avaliadores_definidos);

$faltam_avaliar = mysqli_query($conn, "SELECT id_avaliador FROM avaliacao_final WHERE status_avaliacao = 0 GROUP BY id_avaliador");
$faltam_avaliar = mysqli_num_rows($faltam_avaliar);

$ja_avaliaram = mysqli_query($conn, "SELECT id_avaliador FROM avaliacao_final WHERE status_avaliacao = 1 GROUP BY id_avaliador");
$ja_avaliaram = mysqli_num_rows($ja_avaliaram);

// Pesquisa de projetos

$total_equipes = mysqli_query($conn, "SELECT * FROM equipe");
$total_equipes = mysqli_num_rows($total_equipes);

$equipes_sem_projeto = mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe NOT IN (SELECT id_equipe FROM projeto)");
$equipes_sem_projeto = mysqli_num_rows($equipes_sem_projeto);

$equipe_sem_membro = mysqli_query($conn, "SELECT * FROM equipe WHERE id_equipe NOT IN (SELECT id_equipe FROM associacao)");
$equipe_sem_membro = mysqli_num_rows($equipe_sem_membro);

$aluno_sem_equipe = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'comum' AND id_usuario NOT IN (SELECT id_usuario FROM associacao WHERE id_equipe IS NOT NULL)");
$aluno_sem_equipe = mysqli_num_rows($aluno_sem_equipe);

// Pesquisa de projetos

$total_projetos = mysqli_query($conn, "SELECT * FROM projeto");
$total_projetos = mysqli_num_rows($total_projetos);

$projetos_definidos = mysqli_query($conn, "SELECT id_projeto FROM avaliacao_final GROUP BY id_projeto");
$projetos_definidos = mysqli_num_rows($projetos_definidos);

$projetos_faltam_avaliar = mysqli_query($conn, "SELECT id_projeto FROM avaliacao_final WHERE status_avaliacao = 0 GROUP BY id_projeto");
$projetos_faltam_avaliar = mysqli_num_rows($projetos_faltam_avaliar);

$ja_avaliados = mysqli_query($conn, "SELECT id_projeto FROM avaliacao_final WHERE status_avaliacao = 1 GROUP BY id_projeto");
$ja_avaliados = mysqli_num_rows($ja_avaliados);

// Pesquisa de usuarios

$total_alunos = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'comum'");
$total_alunos = mysqli_num_rows($total_alunos);

$total_orientadores = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'orientador'");
$total_orientadores = mysqli_num_rows($total_orientadores);

$total_adm = mysqli_query($conn, "SELECT * FROM usuario WHERE tipo = 'adm'");
$total_adm = mysqli_num_rows($total_adm);

$total_usuarios = $total_alunos + $total_orientadores + $total_adm + $total_avaliadores;

// barra de progresso

$total_avaliacao = mysqli_query($conn, "SELECT * FROM avaliacao_final");
$total_avaliacao = mysqli_num_rows($total_avaliacao);

if ($total_avaliacao == 0) {
  $progresso = 0;
}
else{
    $avaliacao_finalizada = mysqli_query($conn, "SELECT * FROM avaliacao_final WHERE status_avaliacao = 1");
    $avaliacao_finalizada = mysqli_num_rows($avaliacao_finalizada);

    $progresso = ($avaliacao_finalizada*100)/$total_avaliacao;
    $progresso = round($progresso);
}



?>

<div class="container">
<!--                 <h1 class="mt-4">Administração</h1><br/> -->
<br/>
  <div class="row">
      <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-info mb-3">
            <h5 class="card-header"><i class="fas fa-users"></i> Avaliadores</h5>
            <div class="card-body">
              <p class="card-text" style="font-size: 18px;">Cadastrados: <b style="font-size: 30px;"><?php echo $total_avaliadores; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Definidos: <b style="font-size: 30px;"><?php echo $avaliadores_definidos; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Faltam avaliar: <b style="font-size: 30px;"><?php echo $faltam_avaliar; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Já Avaliaram: <b style="font-size: 30px;"><?php echo $ja_avaliaram; ?></b></p>
            </div>
            <div class="card-footer bg-transparent border-light"><a href="consulta_avaliador.php" class="card-link text-white">Ver detalhes</a></div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-warning mb-3">
            <h5 class="card-header"><i class="fas fa-book-open"></i> Projetos</h5>
            <div class="card-body">
              <p class="card-text" style="font-size: 18px;">Cadastrados: <b style="font-size: 30px;"><?php echo $total_projetos; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Definidos: <b style="font-size: 30px;"><?php echo $projetos_definidos; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Faltam avaliar: <b style="font-size: 30px;"><?php echo $projetos_faltam_avaliar; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Já Avaliados: <b style="font-size: 30px;"><?php echo $ja_avaliados; ?></b></p>
            </div>
            <div class="card-footer bg-transparent border-light"><a href="consulta_projeto.php" class="card-link text-white">Ver detalhes</a></div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-success mb-3">
            <h5 class="card-header"><i class="fas fa-comment-dots"></i> Equipes</h5>
            <div class="card-body">
              <p class="card-text" style="font-size: 18px;">Total: <b style="font-size: 30px;"><?php echo $total_equipes; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Sem membros: <b style="font-size: 30px;"><?php echo $equipe_sem_membro; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Sem projetos: <b style="font-size: 30px;"><?php echo $equipes_sem_projeto; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Alunos sem Equipe: <b style="font-size: 30px;"><?php echo $aluno_sem_equipe; ?></b></p>
            </div>
            <div class="card-footer bg-transparent border-light"><a href="consulta_equipe.php" class="card-link text-white">Ver detalhes</a></div>
          </div>
      </div>
      <div class="col-xl-3 col-md-6">
          <div class="card text-white bg-danger mb-3">
            <h5 class="card-header"><i class="fas fa-user"></i> Usuários</h5>
            <div class="card-body">
              <p class="card-text" style="font-size: 18px;">Total: <b style="font-size: 30px;"><?php echo $total_usuarios; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Alunos: <b style="font-size: 30px;"><?php echo $total_alunos; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Orientadores: <b style="font-size: 30px;"><?php echo $total_orientadores; ?></b></p>
              <p class="card-text" style="font-size: 18px;">Administradores: <b style="font-size: 30px;"><?php echo $total_adm; ?></b></p>
            </div>
            <div class="card-footer bg-transparent border-light"><a href="consulta_usuario.php" class="card-link text-white">Ver detalhes</a></div>
          </div>
      </div>

      <?php
      $feira = mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1");
      if (mysqli_num_rows($feira) == 1) {
        $feira = mysqli_fetch_assoc($feira);
          $nome_feira = $feira['nome'];
          $edicao_feira = $feira['edicao'];
          $id_feira = $feira['id_feira'];
        ?>

        <div class="col-xl-12 col-md-12">
          <div class="card text-white mb-3" style="background-color: #008080;">
            <center><h5 class="card-header"><?php echo $edicao_feira."ª ".$nome_feira." em andamento." ?></h5></center>
            <div class="card-body">
              <h5 class="card-text"> Porcentagem de Conclusão - <a href="consulta_avaliacao.php" class="card-link text-white" style="font-size: 14px;"> Ver detalhes</a> </h5>
              <div class="progress" style="height: 40px;">
                <div class="progress-bar bg-info" role="progressbar" style="font-size: 20px; width: <?php echo $progresso."%"; ?>;" aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progresso; ?>%</div>
              </div>
            </div>
          </div>       
        </div>

        <div class="col-xl-12 col-md-12">
          <center>
            <a style="width: 100%; font-size: 2em" onclick="return confirm('Tem certeza que deseja encerrar a Feira?')" class="btn btn-danger mb-3" href="processa_feira.php?id_feira=<?php echo $id_feira ?>">Encerrar Feira de Avaliação</a>
          </center>
        </div>

      <?php
      }
      else{ 

        if (empty(mysqli_fetch_assoc(mysqli_query($conn, "SELECT edicao FROM feira ORDER BY id_feira DESC LIMIT 1;"))['edicao'])) {
          $edicao = 1;
        }
        else{
          $edicao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT edicao FROM feira ORDER BY id_feira DESC LIMIT 1;"))['edicao'] + 1;
        }
        
        ?>

        <div class="col-xl-12 col-md-12">
          <div class="card text-white mb-3" style="background-color: #008080;">
            <center><h5 class="card-header">Feira de Avaliação</h5>
            <div class="card-body">
              <form action="processa_feira.php" method="GET" style="width: 50%">
                <div class="form-group">
                  <label class="font-weight-bold" for="nome">Nome da feira</label>
                  <input type="text" name="nome" class="form-control" id="nome" aria-describedby="nameHelp" value="Feira de Avaliação Online Trajano Camargo" required>
                </div>
                <div class="form-group">
                  <label class="font-weight-bold" for="edicao">Edição</label>
                  <input type="number" name="edicao" class="form-control" id="edicao" aria-describedby="nameHelp" value="<?php echo $edicao ?>" required>
                </div><br/>
                <button class="btn btn-md btn-success btn-block" onclick="return confirm('Tem certeza que deseja iniciar uma Feira?')" type="submit"><b>Abrir Feira de Avaliação</b></button>
              </form>
            </div>
            </center>
          </div>
        </div>

      <?php
      }
      ?>

  </div>

</div>




<?php include 'rodapedash.php'; ?>
