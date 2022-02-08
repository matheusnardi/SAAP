<?php 

include 'connect.php';

$id_projeto = $_GET['id_projeto'];
$aprovacao = $_GET['aprovacao'];
$comentario = $_GET['comentario'];

if (empty($comentario)) {
    $comentarioUP = "";
}
else{
    $comentarioUP = ", comentario_aprovacao = '$comentario'";
}

if (mysqli_query($conn, "UPDATE projeto SET status_aprovacao = $aprovacao $comentarioUP WHERE id_projeto = $id_projeto")) {

    echo "<script type='text/javascript'>
			window.location.href = 'perfil_avaliador.php';
			</script>";
}
else{
    echo "Erro ao concluir aprovação";
}

?>