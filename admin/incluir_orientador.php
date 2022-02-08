<?php 

include 'connect.php';

$nome = $_POST['nome'];
$nome = strtoupper($nome);

if (mysqli_query($conn, 
"INSERT INTO orientador VALUES (NULL, '$nome');
")) {
    echo "<script type='text/javascript'>
			alert('Orientador registrado com Sucesso!');
			window.location.href = 'regisorien.php'
			</script>";
}
else{
    echo mysqli_error($conn);
}

?>