<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$titulo			    = 	$_POST['titulo'];
$id_equipe          =   $_POST['id_equipe'];
$id_curso           =   $_POST['id_curso'];
$id_orientador      =   $_POST['id_orientador'];
$id_coorientador    =   $_POST['id_coorientador'];
$id_ods             =   $_POST['id_ods'];

//

//Comando de inserção
$sql     = "INSERT INTO projeto (titulo, id_curso, id_equipe, endereco_count, id_orientador, id_coorientador, id_ods) VALUES ('$titulo', '$id_curso', '$id_equipe', '4', '$id_orientador', '$id_coorientador', '$id_ods' )";
//

//Comando para inserir
if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('location:home_equipes.php?id_equipe='.$id_equipe.'&id_curso='.$id_curso);
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//

?>