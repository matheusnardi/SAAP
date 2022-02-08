<?php 

//Conexão com o Banco
include 'connect.php';
//

if(empty($_GET['id_associacao'])){

    if(empty($_POST['id_associacao'])){

        $id_usuario     =   $_POST["id_usuario"];
        $id_curso       =   $_POST["curso"];
        $id_instituicao =   $_POST["instituicao"];

        if(mysqli_query($conn, "INSERT INTO associacao(
                                    id_usuario,
                                    id_curso,
                                    id_instituicao
                                )VALUES(
                                    $id_usuario,
                                    $id_curso,
                                    $id_instituicao
                                )"
                        )
            )
        {
            header('location: cursos_aluno.php?id_usuario='.$id_usuario);

            }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else{
        $id_associacao  = $_POST["id_associacao"];
        $id_usuario     =   $_POST["id_usuario"];
        $id_curso       =   $_POST["curso"];
        $id_instituicao =   $_POST["instituicao"];

        if(mysqli_query($conn, 
        "UPDATE associacao SET id_curso=$id_curso, id_instituicao=$id_instituicao, id_equipe=NULL
        WHERE id_associacao=$id_associacao;
        "
        )){
            header('location: cursos_aluno.php?id_usuario='.$id_usuario);
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
else{
    $id_associacao  = $_GET["id_associacao"];
    $id_usuario     =   $_GET["id_usuario"];

    if(mysqli_query($conn, 
        "DELETE FROM associacao WHERE id_associacao = $id_associacao;"
        )){
            header('location: cursos_aluno.php?id_usuario='.$id_usuario);
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}
?>