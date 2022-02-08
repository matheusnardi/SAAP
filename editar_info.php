<?php 

include 'connect.php';

$id_equipe = $_POST["id_equipe"];
$descricao = $_POST["descricao"];
$id_curso  = $_POST["id_curso"];
$nome      = $_POST["nome"];

$query = mysqli_query($conn, 
"UPDATE equipe SET descricao='$descricao', nome='$nome' WHERE id_equipe=$id_equipe");

if($query)
{
    mysqli_close($conn);
    echo "<script type='text/javascript'>
             window.location.href = history.back()
            </script>";
}
else{
    echo "ERRO AO EDITAR DESCRIÇÃO";
}

?>