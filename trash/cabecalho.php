<?php session_start(); 

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

// DashBoard

if ($url == "/admin/index.php"){
  $dashboard_settings = "
      <link href='css/styles.css' rel='stylesheet' /> ";
  $dashboard_button = "<button class='btn btn-link btn-sm order-1 order-lg-0' id='sidebarToggle' href='#'><i class='fas fa-bars'></i></button>";
  $dashboard_rodape = "<script src='js/scripts.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js' crossorigin='anonymous'></script>
<script src='assets/demo/chart-area-demo.js'></script>
<script src='assets/demo/chart-bar-demo.js'></script>
<script src='assets/demo/datatables-demo.js'></script>";   
}
else{
  $dashboard_settings = "";
  $dashboard_button = "";
  $dashboard_rodape = "";  
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

<!-- DashBoard -->
    <?php echo $dashboard_settings; ?>

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">      

    <title><?php echo $titulo; ?></title>

  </head>
  <body>
    <!--Nav_bar-->
  <?php 
    include('navbar.php');
  ?>
    <!--Fim_Nav_bar-->