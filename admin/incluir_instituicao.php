<?php 

include 'connect.php';

$ins = $_POST["instituicao"];

if(mysqli_query($conn, "INSERT INTO instituicao (nome) VALUES ('$ins')")){
    echo "<script type='text/javascript'>
			alert('Instituição Registrada com Sucesso!');
			window.location.href = 'regisinstituicao.php'
			</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>