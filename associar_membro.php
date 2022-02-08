<?php 

//Conexão com o Banco
include 'connect.php';
//

$id_associacao     =   $_POST["id_associacao"];
$id_equipe         =   $_POST["id_equipe"];
$id_curso          =   $_POST["id_curso"];

if(mysqli_query($conn, 
"UPDATE associacao
SET id_equipe=$id_equipe
WHERE id_associacao=$id_associacao;
"))
{
    mysqli_close($conn);
    echo "<script type='text/javascript'>
             window.location.href = history.back()
            </script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>