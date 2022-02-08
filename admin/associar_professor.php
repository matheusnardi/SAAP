<?php 

//Conexão com o Banco
include 'connect.php';
//

$id_usuario     =   $_POST["id_usuario"];
$id_curso       =   $_POST["curso"];
$id_instituicao =   $_POST["instituicao"];

if(mysqli_query($conn, "INSERT INTO associacao_professor(
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
    if($_POST["consulta"] == 0){
        echo "<script type='text/javascript'>
        alert('Professor Associado com Sucesso!');
        window.location.href = 'regisprof.php'
        </script>";
    }
    else{
        echo "<script type='text/javascript'>
        alert('Professor Associado com Sucesso!');
        window.location.href = ''
        </script>";
    }


    }
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>