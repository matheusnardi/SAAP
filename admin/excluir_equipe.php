<?php 
session_start();

$id_equipe  = $_POST['id_equipe'];

include 'connect.php';

if (mysqli_query($conn, "UPDATE associacao SET id_equipe=NULL WHERE id_equipe=$id_equipe")) {

    $query_projetos = mysqli_query($conn, "SELECT * FROM projeto WHERE id_equipe=$id_equipe");

    while($projetos = mysqli_fetch_array($query_projetos)){

        $endereco = "../".$projetos['endereco'];
        unlink ($endereco);
    }
    
    if(mysqli_query($conn, "DELETE FROM projeto WHERE id_equipe = '$id_equipe'")){

        if(mysqli_query($conn, "DELETE FROM equipe WHERE id_equipe = '$id_equipe'")){
            header('location: consulta_equipe.php');
        }
        else{
            echo "Error: <br>" . mysqli_error($conn);
        }

    }
    else{
        echo "Error: <br>" . mysqli_error($conn);
    }

} 
else {
      echo "Error: <br>" . mysqli_error($conn);
}


mysqli_close($conn);


?>




