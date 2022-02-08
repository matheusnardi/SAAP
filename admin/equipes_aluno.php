<?php 

    include 'cabecalhodash.php';

    include 'connect.php';

    $id_usuario = $_GET["id_usuario"];

    $nome = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nome FROM usuario WHERE id_usuario = $id_usuario"))['nome'];
        
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario=$id_usuario and id_equipe IS NOT NULL")) > 0){
        include '../equipes.php';
    }
    else{
        include '../semequipe.php';
    }

    include 'rodapedash.php';

?>