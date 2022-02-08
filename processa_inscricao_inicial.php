<?php 

include 'connect.php';

$id_associacao = $_POST['id_associacao'];

if (mysqli_query($conn, "INSERT INTO inscricao_inicial VALUES (NULL, $id_associacao)")) {
    echo "<script type='text/javascript'>
    alert('Inscrição realizada com sucesso!');
    window.location.href = 'perfil_avaliador.php'
    </script>";
}
else{
    echo "Erro ao inscrever-se";
}

?>