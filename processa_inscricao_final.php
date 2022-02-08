<?php 

include 'connect.php';

$id_usuario = $_POST['id_usuario'];

if (mysqli_query($conn, "INSERT INTO inscricao_final VALUES (NULL, $id_usuario)")) {
    echo "<script type='text/javascript'>
    alert('Inscrição realizada com sucesso!');
    window.location.href = 'perfil_avaliador.php'
    </script>";
}
else{
    echo "Erro ao inscrever-se";
}

?>