<?php 

//Conexão com o Banco
include 'connect.php';
//

//Irá verificar se o campo "status" está vazio. Pois caso esteja, essa página é carregada para registrar um usuário. Se "status" tiver algum valor, a página é carregada para alterar o status de liberação do registro de avaliadores
if (empty($_GET['status'])) {
    $nome 		= 	$_POST['nome'];
    $email 		= 	$_POST['email'];
    $senha 		= 	md5($_POST['senha']);
    $tipo		= 	$_POST['tipo'];
    
    if ($tipo == "comum") {
        $tipo_alert = "Aluno";
        $pagina		= "associacao.php";
    }
    elseif ($tipo == "adm") {
        $tipo_alert = "Administrador";
        $pagina		= "regisadm.php";
    }
    elseif ($tipo == "professor"){
        $tipo_alert = "Professor";
        $pagina		= "regisprof.php";
        $tipo       = "avaliador";
    }
    else{
        $tipo_alert = "Avaliador";
        $pagina		= "regisaval.php";
    }


    //Comando de inserção
    $sql = "INSERT INTO usuario (nome, email, tipo, senha, status_usuario) VALUES ('$nome', '$email', '$tipo', '$senha', 1)";
    //

    //Comando para inserir
    if (mysqli_query($conn, $sql)) {
        if($tipo == "comum"){

            $id_usuario = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT id_usuario FROM usuario WHERE email like '$email'")
            );

            $id_usuario = $id_usuario["id_usuario"];

            echo "<script type='text/javascript'>
            alert('$tipo_alert Registrado com Sucesso!');
            window.location.href = 'associacao.php?id_usuario=$id_usuario'
            </script>";

        }
        elseif($tipo_alert == "Professor"){

            $id_professor = $_POST['professor'];

            $id_usuario = mysqli_insert_id($conn);

            if(mysqli_query($conn, 
            "INSERT INTO associacao_professor(
                id_usuario,
                id_professor
            )
            VALUES(
                $id_usuario,
                $id_professor
            )"
            )){
                echo "<script type='text/javascript'>
                alert('$tipo_alert Registrado com Sucesso!');
                window.location.href = '$pagina'
                </script>"; 
            }
            else{
                echo "ERRO AO ASSOCIAR PROFESSOR";
            }

        }
        else{
            echo "<script type='text/javascript'>
            alert('$tipo_alert Registrado com Sucesso!');
            window.location.href = '$pagina'
            </script>"; 
        }    
    } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    //*/
}
elseif ($_GET['status'] == "Bloqueado"){
	$statuspag = mysqli_query($conn, "UPDATE pagina SET permissao_sem_usuario = 'sim' WHERE url = '/admin/regisaval.php'");
	header('location: regisaval.php');	
}
else{
	$statuspag = mysqli_query($conn, "UPDATE pagina SET permissao_sem_usuario = 'não' WHERE url = '/admin/regisaval.php'");
	header('location: regisaval.php');
}
//
?>