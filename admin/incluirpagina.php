<?php 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$url 			= 	$_POST['url'];
$titulo 		= 	$_POST['titulo'];
$persemuser		= 	$_POST['per_semuser'];
$percom 		= 	$_POST['per_com'];
$peraval		= 	$_POST['per_aval'];
$perorien		= 	$_POST['per_orien'];
$peradm			= 	$_POST['per_adm'];
//

//Comando de inserção
$sql = "INSERT INTO pagina (url, titulo, permissao_comum, permissao_avaliador, permissao_orientador, permissao_adm, permissao_sem_usuario) VALUES ('$url', '$titulo', '$percom', '$peraval', '$perorien', '$peradm', '$persemuser')";
//

//Comando para inserir
if (mysqli_query($conn, $sql)) {
  echo "<script type='text/javascript'>
       alert('Página registrada com sucesso !');
       window.location.href = 'regispag.php'
       </script>";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//*/

?>