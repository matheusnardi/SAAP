<?php 

include 'connect.php';

if(!empty($_GET['id_feira'])){

    $id_feira = $_GET['id_feira'];

    if (mysqli_query($conn, 
    "UPDATE feira SET status_abertura = 0, data_final = now() WHERE id_feira = $id_feira
    ")) {

        echo "<script type='text/javascript'>
        alert('Feira encerrada com sucesso!');
        window.location.href = 'index.php';
        </script>";
    }
    else{
        echo "Erro ao encerrar feira";
    }
    
}
else{
    $nome = $_GET['nome'];
    $edicao = $_GET['edicao'];

    if (mysqli_query($conn, 
    "INSERT INTO feira (nome, edicao, data_inicio, status_abertura)
    VALUES ('$nome', $edicao, now(), 1)
    ")) {
        if (mysqli_query($conn, "UPDATE projeto SET status_aprovacao = -1 WHERE status_aprovacao = 0") && mysqli_query($conn, "UPDATE projeto SET status_aprovacao = 2 WHERE status_aprovacao = 1")) {
            if (mysqli_query($conn, "DELETE FROM inscricao_inicial")) {
                if (mysqli_query($conn, "UPDATE projeto SET link_count = 1 WHERE status_aprovacao = 2")) {
                    if (mysqli_query($conn, "UPDATE projeto SET endereco_count = 0 WHERE status_aprovacao = 2")) {
                        echo "<script type='text/javascript'>
                        alert('Feira aberta com sucesso!');
                        window.location.href = 'index.php';
                        </script>";
                    }
                    else{
                        echo "Erro ao redefinir contador de endereço";
                    }   
                }
                else{
                    echo "Erro ao redefinir links";
                }
            }
            else{
                echo "Erro ao redefinir inscricao inicial";
            }
        }
        else{
            echo "Erro ao redefinir projetos";
        }   
    }
    else{
        echo "Erro ao abrir feira";
    }
}
?>