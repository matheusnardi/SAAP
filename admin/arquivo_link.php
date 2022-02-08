<?php 

include 'connect.php';

$tipo = $_GET['tipo'];
$escolha = $_GET['escolha'];
$id_projeto = $_GET['id_projeto'];

// Arquivo
if($tipo == 1){
  // Liberar envio de arquivo
    if($escolha == 1){
        mysqli_query($conn, "UPDATE projeto SET endereco_count = 1 WHERE id_projeto=$id_projeto");
    }
  // Bloquear envio de arquivo
    elseif($escolha == 2){
        mysqli_query($conn, "UPDATE projeto SET endereco_count = 0 WHERE id_projeto=$id_projeto");
    }
  // Liberar envio de TODOS os arquivo
    elseif($escolha == 3){
      mysqli_query($conn, "UPDATE projeto SET endereco_count = 3");
  }
  // Bloquear envio de TODOS os arquivo
    else{
      mysqli_query($conn, "UPDATE projeto SET endereco_count = 0");
  }
}

// Link
else{
  // Liberar envio de link
    if($escolha == 1){
        mysqli_query($conn, "UPDATE projeto SET link_count = 1 WHERE id_projeto=$id_projeto");
    }
  // Bloquear envio de link
    elseif($escolha == 2){
        mysqli_query($conn, "UPDATE projeto SET link_count = 0 WHERE id_projeto=$id_projeto");
    }
  // Liberar envio de TODOS os links
    elseif($escolha == 3){
      mysqli_query($conn, "UPDATE projeto SET link_count = 1");
  }
  // Bloquear envio de TODOS os links
    elseif($escolha == 4){
      mysqli_query($conn, "UPDATE projeto SET link_count = 0");
  }
  // Liberar links para projetos aprovados
    else{
      mysqli_query($conn, "UPDATE projeto SET link_count = 1 WHERE status_aprovacao > 1");
    }
}

echo "<script type='text/javascript'>
        window.location.href = history.back()
      </script>";

?>