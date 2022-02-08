<?php

include 'connect.php';

if (empty($_POST['nenhum'])) {

$ods = array(
 1 => $_POST['ods-1'],
 2 => $_POST['ods-2'],
 3 => $_POST['ods-3'],
 4 => $_POST['ods-4'],
 5 => $_POST['ods-5'],
 6 => $_POST['ods-6'],
 7 => $_POST['ods-7'],
 8 => $_POST['ods-8'],
 9 => $_POST['ods-9'],
 10 => $_POST['ods-10'],
 11 => $_POST['ods-11'],
 12 => $_POST['ods-12'],
 13 => $_POST['ods-13'],
 14 => $_POST['ods-14'],
 15 => $_POST['ods-15'],
 16 => $_POST['ods-16'],
 17 => $_POST['ods-17']
);

}

$nome 		= 	$_POST['nome'];
$email 		= 	$_POST['email'];
$senha 		= 	md5($_POST['senha']);
$tipo		= 	"avaliador";

$id_professor = $_POST['professor'];

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM usuario WHERE email = '$email'")) > 0) {
    echo "<script type='text/javascript'>
    alert('ESSE EMAIL JÁ ESTÁ CADASTRADO!');
    window.location.href = ''
    </script>";
}
else{
    $sql = "INSERT INTO usuario (nome, email, tipo, senha, status_usuario) VALUES ('$nome', '$email', '$tipo', '$senha', 1)";

    if (mysqli_query($conn, $sql)) {

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
            $id_associacao = mysqli_insert_id($conn);
            
            $count = 0;
            $query_ods = "";
            for ($i=1; $i < 18; $i++) { 
                if ($ods[$i] != NULL) {
                    $count = $count + 1;
                    $id_ods = $ods[$i];
                    $query_ods .= "INSERT INTO associacao_ods VALUES (NULL, $id_usuario, $id_ods);";
                }
            }

            if ($count != 0) {
                if (mysqli_multi_query($conn, $query_ods)) {
                    mysqli_close($conn);
                    $conn 	= mysqli_connect($servername, $username, $password, $dbname);
                    if (mysqli_query($conn, "INSERT INTO inscricao_inicial VALUES (NULL, $id_associacao)")) {
                        echo "<script type='text/javascript'>
                        alert('Registro e Inscrição realizados com SUCESSO! Associado ODS de preferência');
                        window.location.href = 'login.php'
                        </script>";
                    }
                    else{
                        mysqli_query($conn, "DELETE FROM associacao_professor WHERE id_associacao = $id_associacao");
                        mysqli_query($conn, "DELETE FROM associacao_ods WHERE id_usuario = $id_usuario");  
                        mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = $id_usuario");
                        echo "ERRO AO INSCREVER COM ODS. VOLTE A PÁGINA E TENTE NOVAMENTE.";
                        echo mysqli_error($conn);
                    }
                }
                else{
                    mysqli_query($conn, "DELETE FROM associacao_professor WHERE id_associacao = $id_associacao"); 
                    mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = $id_usuario");
                    echo "ERRO AO ASSOCIAR ODS. VOLTE A PÁGINA E TENTE NOVAMENTE.";
                }
            }
            else{
                if (mysqli_query($conn, "INSERT INTO inscricao_inicial VALUES (NULL, $id_associacao)")) {
                    echo "<script type='text/javascript'>
                    alert('Registro e Inscrição realizados com SUCESSO! Sem ODS de preferência');
                    window.location.href = 'login.php'
                    </script>";
                }
                else{
                    mysqli_query($conn, "DELETE FROM associacao_professor WHERE id_associacao = $id_associacao"); 
                    mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = $id_usuario");
                    echo "ERRO AO INSCREVER SEM ODS. VOLTE A PÁGINA E TENTE NOVAMENTE.";
                }
            }
             
        }
        else{
            mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = $id_usuario");
            echo "ERRO AO ASSOCIAR PROFESSOR. VOLTE A PÁGINA E TENTE NOVAMENTE.";
        }
    }
    else{
        echo "ERRO AO CADASTRAR. VOLTE A PÁGINA E TENTE NOVAMENTE.";
    }    

}

?>