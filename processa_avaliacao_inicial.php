<?php 

session_start(); 

//Conexão com o Banco
include 'connect.php';
//

// Variáveis do Registro
$n1 	= 	$_POST['n1'];
$n2 	= 	$_POST['n2'];
$n3		= 	$_POST['n3'];
$n4 	= 	$_POST['n4'];
$n5		= 	$_POST['n5'];
$n6		= 	$_POST['n6'];
$n7		= 	$_POST['n7'];
$n8		= 	$_POST['n8'];
$n9		= 	$_POST['n9'];
$n10	= 	$_POST['n10'];

$id_avaliacao   =   $_POST['id_avaliacao'];

if (mysqli_query($conn, 
"UPDATE avaliacao_inicial SET
n1 = $n1, n2 = $n2, n3 = $n3, n4 = $n4, n5 = $n5, n6 = $n6, n7 = $n7, n8 = $n8, n9 = $n9, n10 = $n10, status_avaliacao = 1
WHERE id_avaliacao = $id_avaliacao
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

?>