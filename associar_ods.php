<?php 

include 'connect.php';

// Verifica se o avaliador escolheu adicionar ou excluir uma associacao de ods

// Adicionar associacao
if (empty($_GET['id_associacao'])) {
    if($_POST['pagina'] == 1){
        $pagina = "/inscricao_inicial.php";
    }
    else{
        $pagina = "/inscricao_final.php";
    }
    $id_usuario = $_POST['id_usuario'];
    $id_ods = $_POST['id_ods'];

    if(mysqli_query($conn, "INSERT INTO associacao_ods VALUES (NULL, $id_usuario, $id_ods)")){
        header('Location:'.$pagina);
    }
    else{
        echo "Erro ao associar ODS";
    }
}
// Excluir associacao
else{
    if($_GET['pagina'] == 1){
        $pagina = "/inscricao_inicial.php";
    }
    else{
        $pagina = "/inscricao_final.php";
    }
    $id_associacao = $_GET['id_associacao'];

    if (mysqli_query($conn, "DELETE FROM associacao_ods WHERE id_associacao = $id_associacao")) {
        header('Location:'.$pagina);
    }
    else{
        echo "Erro ao excluir ODS";
    }
}
?>