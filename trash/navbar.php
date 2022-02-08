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
  }
elseif (isset($_SESSION["acesso_avaliador"])){
    $usuario  = $_SESSION["acesso_avaliador"];
    $aval     = "<li class='nav-item active'>
                  <a class='nav-link' href='projetos.php'>Avaliação</a>
                 </li>";
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
                        <a class='nav-link' href='regiscur.php''>Curso</a>
                        <a class='nav-link' href='regispro.php''>Projeto</a>
                        <a class='nav-link' href='regisautor.php''>Autores</a>
                        <a class='nav-link' href='regispag.php''>Página</a>
                        </nav>
                    </div>                    ";

    $user_options     = " 
                 <a class='dropdown-item' href='$admin_link'>Administração</a>
                 <div class='dropdown-divider'></div>";

    $gerenciamento = "
                    <a class='nav-link' href='redefinir_senha.php'>
                        Redefinir Senha</a>
                    <a class='nav-link' href='ativardesativar_usuario.php'>
                        Desativar/Ativar Usuário</a>
                    <a class='nav-link' href='definicao_avaliacao.php'>
                        Definição de Avaliação</a>";

    $paginas_dashboard = "<a class='nav-link' href='https://tcctcc.000webhostapp.com/'>
                          Home</a>
                          <a class='nav-link' href='media.php'>
                          Ranking de Notas</a>";                 
  }
elseif (isset($_SESSION["acesso_orientador"])){
    $usuario  = $_SESSION["acesso_orientador"];           
  }      
else {
    $pagina   = $fazer_login;
    $comando  = "Login";
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

    <!-- nav bar-->

<nav class="navbar navbar-expand navbar-dark" style="background-color: #152199;">
  <a class="navbar-brand" href="index.php"><b>TCC</b></a>
  <?php echo $dashboard_button; ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
          <?php echo $aval;     
          ?>  
    </ul>    
  </div>

  <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item active">
        <a class="nav-link"> Bem-Vindo <?php echo $usuario; ?> </a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <?php echo $user_options; ?>
              <a class="dropdown-item" onclick="<?php echo $onclick; ?>" href="<?php echo $pagina; ?>"><?php echo $comando; ?></a>
          </div>
      </li>
  </ul>  

</nav> 