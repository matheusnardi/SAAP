<?php session_start();

header('Content-Type: text/html; charset=utf-8');

//Pesquisa do Título
include('connect.php');

$url        = "$_SERVER[REQUEST_URI]";
$fim_string = strpos($url, '?'); 

if ($fim_string > 0) {
  $url = substr($url, 0, $fim_string);
}

if ($url == "/") {
  $url = "/index.php";
}

$sql = "SELECT * FROM pagina WHERE url = '$url'";

$result = mysqli_query($conn, $sql);
$row  = mysqli_fetch_assoc($result);

$titulo = $row['titulo'];

//Permissão de acesso
if(isset($_SESSION["acesso_adm"])){
  $permissao = $row['permissao_adm'];
} elseif (isset($_SESSION["acesso_comum"])) {
  $permissao = $row['permissao_comum'];
} elseif (isset($_SESSION["acesso_avaliador"])) {
  $permissao = $row['permissao_avaliador'];
} elseif (isset($_SESSION["acesso_orientador"])) {
  $permissao = $row['permissao_orientador'];
}
else{
  $permissao = $row['permissao_sem_usuario'];
}

if ($permissao == "sim") {
}
else{
    // admin
  $admin_pos = strpos($url, 'admin');

  if ($admin_pos > 0) {
    header ('location: https://tcctcc.000webhostapp.com/');
    $admin_link = "index.php";
  }
  else{
    header ('location: index.php');
    $admin_link = "admin/index.php";
  }
}

if ($url == "/index.php"){ 

  if (isset($_SESSION["acesso_adm"]) or isset($_SESSION["acesso_avaliador"]) or isset($_SESSION["acesso_orientador"]) or isset($_SESSION["acesso_comum"])) {

    if (isset($_SESSION["acesso_adm"])) {
      header('location: admin/index.php');
    }
    elseif (isset($_SESSION["acesso_avaliador"])) {
      header('location: perfil_avaliador.php');
    }

  }
  else{
    if ($url == "/index.php"){
    header('location: login.php');
    }
  }

}



if ($url == "/login.php"){ 

  if (isset($_SESSION["acesso_adm"]) or isset($_SESSION["acesso_avaliador"]) or isset($_SESSION["acesso_orientador"]) or isset($_SESSION["acesso_comum"])) {  

    if (isset($_SESSION["acesso_adm"])) {
      header('location: admin/index.php');
    }
    elseif (isset($_SESSION["acesso_avaliador"])) {
      header('location: perfil_avaliador.php');
    }
    elseif (isset($_SESSION["acesso_orientador"])) {
      header('location: index.php');
    }
    else{
      header('location: index.php');
    }
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- FontAwesome -->

  <script src="https://kit.fontawesome.com/ddf700f071.js" crossorigin="anonymous"></script>

  <!-- JS -->
  <script type="text/javascript">

    function validarSenha(){
      var NovaSenha = document.getElementById('NovaSenha').value;
      var CNovaSenha = document.getElementById('CNovaSenha').value;
      if (NovaSenha != CNovaSenha) {
          alert("SENHAS DIFERENTES!\nFAVOR DIGITAR SENHAS IGUAIS");
          event.preventDefault ();
      }
    }

  </script>

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- CSS personalizado -->
  <link rel="stylesheet" href="css/style.css">


  <title><?php echo $titulo; ?></title>
  

  </head>
  <body style="background-color: #F5F5F5;">
    <!--Nav_bar-->
  <?php 
  if ($url != "/login.php") {
    include('navbar.php');
  }
  ?>
    <!--Fim_Nav_bar-->