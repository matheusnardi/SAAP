<?php 
session_start();

$id_aluno  = $_POST['id_aluno'];

include 'connect.php';

if (mysqli_query($conn, "DELETE FROM associacao WHERE id_usuario = '$id_aluno'")) {

    if(mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = '$id_aluno'")){
       header('location: consulta_aluno.php');
    }
    else{
        echo "Error: <br>" . mysqli_error($conn);
    }
} else {
      echo "Error: <br>" . mysqli_error($conn);
}


mysqli_close($conn);


?>




