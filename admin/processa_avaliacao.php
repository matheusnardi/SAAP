<?php
session_start(); 

//Conexão com o Banco
include 'connect.php';
//

//Variáveis do Registro
$nota1 		= 	$_POST['pergunta1'];
$nota2 		= 	$_POST['pergunta2'];
$nota3		= 	$_POST['pergunta3'];
$nota4 		= 	$_POST['pergunta4'];
$nota5		= 	$_POST['pergunta5'];
$nota6		= 	$_POST['pergunta6'];
$nota7		= 	$_POST['pergunta7'];
$nota8		= 	$_POST['pergunta8'];
$nota9		= 	$_POST['pergunta9'];
$nota10		= 	$_POST['pergunta10'];
$nota11		= 	$_POST['pergunta11'];
$nota12		= 	$_POST['pergunta12'];
$nota13		= 	$_POST['pergunta13'];
$obs1		=	$_POST['obs1'];
$obs2		= 	$_POST['obs2'];
$id_projeto =   $_POST['id_projeto'];
$id_aval 	= 	$_POST["id_aval"];
$pag = $_POST['pag'];
//

//Comando de atualização
$sql = "update avaliacao_alberto_feres 
set nota_1 = $nota1, nota_2 = $nota2, nota_3 = $nota3, nota_4 = $nota4, nota_5 = $nota5, nota_6 = $nota6, nota_7 = $nota7, nota_8 = $nota8, nota_9 = $nota9, nota_10 = $nota10, nota_11 = $nota11, nota_12 = $nota12, nota_13 = $nota13, obs_alunos = '$obs1', obs_comissao = '$obs2', status_avaliacao = 1 
where id_avaliador = '$id_aval' and id_projeto = '$id_projeto'";
//

//Comando para inserir Notas
if (mysqli_query($conn, $sql)) {

	if ($pag == "aval") {
		echo "<script type='text/javascript'>
	      alert('Avaliação Realizada com Sucesso !');
	      window.location.href = 'projetos_avaliador.php?id_avaliador=$id_aval'
	      </script>";
	}
	elseif ($pag == "avaliacao") {
		echo "<script type='text/javascript'>
	      alert('Avaliação Realizada com Sucesso !');
	      window.location.href = 'consulta_avaliacao.php'
	      </script>";
	}
	else{
      echo "<script type='text/javascript'>
	      alert('Avaliação Realizada com Sucesso !');
	      window.location.href = 'avaliadores_projeto.php?id_projeto=$id_projeto'
	      </script>";
	  }
}
else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//
?>