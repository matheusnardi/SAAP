<?php
    include "connect.php";

    $id_equipe = $_POST["id_equipe"];

    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = 'uploads/autorizacao/';
    
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 10; // 10Mb
    
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('pdf');
    
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;
    
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
    
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivo']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
        exit; // Para a execução do script
    }
    
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    
    // Faz a verificação da extensão do arquivo
    $tmp = explode('.', $_FILES['arquivo']['name']);
    $extensao = strtolower(end($tmp));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        echo "Por favor, envie arquivos com as seguintes extensões: pdf";
        echo "<br> <a href='javascript:history.back()'>Voltar</a>";
    }
    
    // Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
        echo "O arquivo enviado é muito grande, envie arquivos de até 10Mb.";
        echo "<br> <a href='javascript:history.back()'>Voltar</a>";
    }
    
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
        // Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .pdf
            $nome_final = time().'.pdf';
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }
    
        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

            // Verifica se a autorizacao já possuí um arquivo
            $antigo_endereco = mysqli_fetch_assoc(mysqli_query($conn, "SELECT autorizacao FROM equipe WHERE id_equipe=$id_equipe;"))['autorizacao'];    
            
            // Inserir novo endereco do arquivo no banco de dados
            $novo_endereco = $_UP['pasta'].$nome_final;

            if(mysqli_query($conn, "UPDATE equipe SET autorizacao = '$novo_endereco' WHERE id_equipe=$id_equipe;")){
                // echo "<br> Novo endereço inserido no banco de dados";

                // Apaga o arquivo antigo, caso exista
                if($antigo_endereco != NULL){
                    // Tentativa de excluir o arquivo armazenado
                    if(unlink ($antigo_endereco)){
                        // echo "<br> Arquivo antigo excluido com sucesso! <br> Caminho: ".$endereco;
                    }
                    else{
                        // echo "<br> Erro ao excluir arquivo antigo";
                    }
                }

                // Upload efetuado com sucesso
                // echo "<br> Upload efetuado com sucesso!";
                mysqli_close($conn);
                echo "<script type='text/javascript'>
                        alert('Projeto enviado com Sucesso!');
                        window.location.href = history.back()
                        </script>";

            }
            else{
                // Não foi possível fazer o upload, pois o endereco não foi inserido no banco
                unlink ($novo_endereco);
                echo "<br> Não foi possível enviar o arquivo, tente novamente <br>";
                echo "<br> <a href='javascript:history.back()'>Voltar</a>";
            }       

        } 
        else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "<br> Não foi possível enviar o arquivo, tente novamente <br>";
            echo "<br> <a href='javascript:history.back()'>Voltar</a>";
        }
    }   
    mysqli_close($conn);
?>