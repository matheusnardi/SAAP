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

?>