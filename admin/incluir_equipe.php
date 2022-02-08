<?php 

include 'connect.php';

$id_associacao = $_POST["id_associacao"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];

$query = mysqli_query($conn, "INSERT INTO equipe (nome, descricao) VALUES ('$nome','$descricao')");

if($query)
{
    $id_equipe = mysqli_insert_id($conn);
    $query     = mysqli_query($conn, "UPDATE associacao 
                                      SET id_equipe = $id_equipe 
                                      WHERE id_associacao=$id_associacao;");
    if($query){
        echo "<script type='text/javascript'>
			alert('Equipe Registrada com Sucesso!');
			window.location.href = 'regisequipe.php'
			</script>";
    }
    else{
        echo "ERRO AO ATUALIZAR ASSOCIACAO";
    }
}
else{
    echo "ERRO AO CADASTRAR EQUIPE";
}

?>