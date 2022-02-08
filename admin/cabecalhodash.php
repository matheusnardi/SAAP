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

if ($url == "/admin/media.php") {
  $table = 3;
}else{
  $table = 0;
}

// DashBoard

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">


<!-- Datatable     -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.css"/>

 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

<script type="text/javascript" language="javascript" class="init">
$(document).ready( function () {
    $('#table_id').DataTable({
      "scrollY": 400,
      "scrollX": true,
      "order": [[ <?php echo $table; ?>, "desc" ]],
      "language": {  
      "search":         "Procurar:",
      "lengthMenu": "Mostrar _MENU_ linhas por página",
      "zeroRecords": "Nenhum Resultado",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Nenhuma linha encontrada",
      "infoFiltered": "(Filtrado de _MAX_ linhas totais)"
       }
    });
} );  
</script>


<!-- FontAwesome -->

 <script src="https://kit.fontawesome.com/ddf700f071.js" crossorigin="anonymous"></script>

<!-- DashBoard -->
    <link href='dashboard/css/styles.css' rel='stylesheet' />

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

 <!-- CSS personalizado -->
 <link rel="stylesheet" href="../css/style.css">

<style type="text/css">

</style>      

    <title><?php echo $titulo; ?></title>

  </head>
  <body style="background-color: #F5F5F5;"> 
    <!--Nav_bar-->
  <?php 
    include('navbardash.php');
  ?>
    <!--Fim_Nav_bar-->
    <?php if(isset($_SESSION["acesso_adm"])){ ?>
    <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading" style="color: #dbdbdb;"><i class="fa fa-sticky-note fa-2" aria-hidden="true"></i> Páginas</div>
                    <?php echo $paginas_dashboard; ?>
                    <div class="sb-sidenav-menu-heading" style="color: #dbdbdb;"><i class="fa fa-user-plus fa-2" aria-hidden="true"></i> Cadastro</div>
                    <?php echo $cadastro; ?>
                    <div class="sb-sidenav-menu-heading" style="color: #dbdbdb;"><i class="fa fa-cogs fa-2" aria-hidden="true"></i> Gerenciamento</div>
                    <?php echo $gerenciamento; ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Bem-vindo</div>
                <?php echo $usuario; ?>
            </div>

    </div>
    <div id="layoutSidenav_content">
        <main>
      <?php } ?>    