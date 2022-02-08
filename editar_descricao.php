<?php 

include 'connect.php';

$id_equipe = $_POST["id_equipe"];
$descricao = $_POST["descricao"];
$id_curso  = $_POST["id_curso"];

$query = mysqli_query($conn, 
"UPDATE equipe SET descricao='$descricao' WHERE id_equipe=$id_equipe");

if($query)
{
    mysqli_close($conn);
    header('location:home_equipes.php?id_equipe='.$id_equipe.'&id_curso='.$id_curso);
}
else{
    echo "ERRO AO EDITAR DESCRIÇÃO";
}

?>