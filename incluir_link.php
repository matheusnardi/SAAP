<?php 

include 'connect.php';

$id_projeto = $_POST["id_projeto"];
$link_video = $_POST["link"];

if(mysqli_query($conn, "UPDATE projeto SET link='$link_video', link_count = link_count-1 WHERE id_projeto=$id_projeto"))
{
    echo "<script type='text/javascript'>
    window.location.href = history.back()
  </script>";
}
else{
    echo "ERRO AO INSERIR LINK";
}

?>