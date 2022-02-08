<?php 

session_start(); 

//Conexão com o Banco
include 'connect.php';
//

// Variáveis do Registro
$n1 	    = 	$_POST['n1'];
$n2 	    = 	$_POST['n2'];
$n3		    = 	$_POST['n3'];
$n4 	    = 	$_POST['n4'];
$n5		    = 	$_POST['n5'];
$n6		    = 	$_POST['n6'];
$n7		    = 	$_POST['n7'];
$n8		    = 	$_POST['n8'];
$n9		    = 	$_POST['n9'];
$n10	    = 	$_POST['n10'];
$destaque	= 	$_POST['destaque'];
$obs        =   $_POST['obs'];

$id_feira       =   $_POST['id_feira'];
$id_curso       =   $_POST['id_curso'];
$id_projeto     =   $_POST['id_projeto'];
$id_avaliador 	= 	$_SESSION["id_usuario"];

$status_feira = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status_abertura FROM feira WHERE id_feira = $id_feira"))['status_abertura'];

if ($status_feira == 1) {

    if (mysqli_query($conn, 
    "UPDATE avaliacao_final
    SET n1 = $n1, n2 = $n2, n3 = $n3, n4 = $n4, n5 = $n5, n6 = $n6, n7 = $n7, n8 = $n8, n9 = $n9, n10 = $n10, obs = '$obs', destaque = '$destaque', status_avaliacao = 1 
    WHERE id_avaliador = '$id_avaliador' and id_projeto = '$id_projeto'
    ")) {
        mysqli_close($conn);
        echo "<script type='text/javascript'>
            window.location.href = 'perfil_avaliador.php'
            </script>";
    }
    else{
        echo mysqli_error($conn);
        mysqli_close($conn);
    }

}
else{
    mysqli_close($conn);
    echo "<script type='text/javascript'>
    alert('Essa feira já foi encerrada!');
    window.location.href = 'perfil_avaliador.php'
    </script>";
}



?>