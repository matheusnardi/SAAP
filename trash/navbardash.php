<!-- Sessão -->
<?php 

$fazer_login    = "login.php";
$fazer_logout   = "logout.php";

$usuario = "Usuário";

$onclick      = "";
$pagina       = $fazer_logout;
$comando      = "Sair";
$cadastro     = "";
$aval         = "";
$dashboard    = "";
$paginas_dashboard = "";

  $admin_pos = strpos($url, 'admin');

  if ($admin_pos > 0) {
    $admin_link = "index.php";
  }
  else{
    $admin_link = "admin/index.php";
  }


if (isset($_SESSION["acesso_comum"])){
    $usuario  = $_SESSION["acesso_comum"]; 
    $user_options     = NULL;
  }
elseif (isset($_SESSION["acesso_avaliador"])){
    $usuario  = $_SESSION["acesso_avaliador"];
    $aval     = "<li class='nav-item active'>
                  <a class='nav-link' href='projetos.php'>Avaliação</a>
                 </li>";
    $user_options     = NULL;
    $id_usuario = $_SESSION['id_usuario'];
    $sql     = "select * from avaliacao_alberto_feres where id_avaliador like $id_usuario";
    $result   = mysqli_query($conn, $sql);
    $contador   = 0;
    while ($row = mysqli_fetch_array($result)) {
      if ($row['status_avaliacao'] == 0) {
        $contador = $contador + 1;
      }
    }
    if ($contador > 0) {
      $onclick    = "confirmar()";
    }               
  }
elseif (isset($_SESSION["acesso_adm"])){
    $usuario  = $_SESSION["acesso_adm"]; 
    $cadastro = "
                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseUsers' aria-expanded='false' aria-controls='collapseUsers'
                        >
                        Usuários
                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div
                    ></a>
                    <div class='collapse' id='collapseUsers' aria-labelledby='headingOne' data-parent='#sidenavAccordion'>
                        <nav class='sb-sidenav-menu-nested nav'>
                        <a class='nav-link' href='regis.php'>Aluno</a>
                        <a class='nav-link' href='regisaval.php''>Avaliador</a>
                        <a class='nav-link' href='regisorien.php''>Orientador</a>
                        <a class='nav-link' href='regisadm.php''>Administrador</a>
                        </nav>
                    </div>

                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseOutros' aria-expanded='false' aria-controls='collapseOutros'
                        >
                        Outros
                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div
                    ></a>
                    <div class='collapse' id='collapseOutros' aria-labelledby='headingOne' data-parent='#sidenavAccordion'>
                        <nav class='sb-sidenav-menu-nested nav'>
                        <a class='nav-link' href='regisinstituicao.php'>Institução</a>
                        <a class='nav-link' href='regiscur.php'>Curso</a>
                        <a class='nav-link' href='regisequipe.php'>Equipe</a>
                        <a class='nav-link' href='regispro.php'>Projeto</a>
                        <a class='nav-link' href='regispag.php'>Página</a>
                        </nav>
                    </div>                    ";

    $user_options     = " 
                 <a class='dropdown-item' href='$admin_link'>Administração</a>
                 <div class='dropdown-divider'></div>";

    $gerenciamento = "
                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseConsulta' aria-expanded='false' aria-controls='collapseConsulta'
                        >
                        Consulta
                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div
                    ></a>
                    <div class='collapse' id='collapseConsulta' aria-labelledby='headingOne' data-parent='#sidenavAccordion'>
                        <nav class='sb-sidenav-menu-nested nav'>
                        <a class='nav-link' href='consulta_usuario.php'>
                            Usuário</a>
                        <a class='nav-link' href='consulta_avaliador.php'>
                            Avaliadores</a>
                        <a class='nav-link' href='consulta_projeto.php'>
                            Projetos</a>
                        <a class='nav-link' href='consulta_avaliacao.php'>
                            Avaliações</a>    
                        <a class='nav-link' href='consulta_comentario.php'>
                            Comentários</a>    
                        </nav>
                    </div>
                                                
                    <a class='nav-link' href='definicao_avaliacao.php'>
                        Definição de Avaliação</a>";

    $paginas_dashboard = "<a class='nav-link' href='index.php'>
                          Administração</a>
                          <a class='nav-link' href='relatorio.php'>
                          Relatório</a>
                          <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseNotas' aria-expanded='false' aria-controls='collapseNotas'
                        >
                        Notas
                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div
                    ></a>
                    <div class='collapse' id='collapseNotas' aria-labelledby='headingOne' data-parent='#sidenavAccordion'>
                        <nav class='sb-sidenav-menu-nested nav'>
                           <a class='nav-link' href='ranking.php'>
                          Ranking</a>
                          <a class='nav-link' href='notageral.php'>
                          Nota geral</a>
                        </nav>
                    </div>                        
                          ";                 
  }
elseif (isset($_SESSION["acesso_orientador"])){
    $usuario  = $_SESSION["acesso_orientador"];
    $user_options     = NULL;
  }      
else {
    if($url == "/admin/regisaval.php"){
        $pagina   = "../login.php";
    }else{
        $pagina   = $fazer_login;
    }
    $comando  = "Login";
    $user_options     = NULL;
  }

?>
<!-- Fim_Sessão -->

<script>
  function confirmar(){
    event.preventDefault();  
    var resposta = confirm("VOCÊ AINDA NÃO AVALIOU TODOS OS PROJETOS !");
    if (resposta == true){
        window.location.href = "logout.php";
    }else{
        window.location.href = "projetos.php";
    } 
}    
</script>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <i class="btn navbar-toggler-icon " id='sidebarToggle'></i>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <ul class="navbar-nav">
      <a class="navbar-brand" href="index.php">
        <img src="/img/Branco.png" width="30" height="30" class="d-inline-block align-top text-white" alt="" loading="lazy">
        SAAP
      </a>      
    </ul>
  <div class="navbar-collapse justify-content-center" id="navbarsExample08">
    
  </div>
  <ul class="navbar-nav">
<!--     <li class="nav-item active">
        <a class="nav-link"> Bem-Vindo <?php echo $usuario; ?> </a>
      </li> -->
      <li class="nav-item">
          <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <?php echo $user_options; ?>
              <a class="dropdown-item" onclick="<?php echo $onclick; ?>" href="<?php echo $pagina; ?>"><?php echo $comando; ?></a>
          </div>
      </li>
  </ul>    
</nav>