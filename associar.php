<?php 

//Conexão com o Banco
include 'connect.php';
//

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
    echo "<script type='text/javascript'>
    alert('Associado com Sucesso!');
    window.location.href = 'index.php'
    </script>";

    }
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>