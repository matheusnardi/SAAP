<?php 

  include 'cabecalho.php';

  include 'connect.php';

  $id_usuario = $_SESSION["id_usuario"];

  $nome = $_SESSION["acesso_comum"];



  // Pesquisa para saber se esse é o primeiro login do aluno. Caso não for, precisara fazer a associação
  if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario=$id_usuario;")) > 0){

    // Pede para trocar a senha caso ainda não tenha trocado
    $email = mysqli_fetch_assoc(mysqli_query($conn, "SELECT email FROM usuario WHERE id_usuario = $id_usuario"))['email'];

    $limite = strpos($email, "@");
    $email = substr($email, 0, $limite);

    if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT senha FROM usuario WHERE id_usuario = $id_usuario"))['senha'] == md5($email)) {
      include 'trocar_senha.php';
    }
    else{
    
      if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM associacao WHERE id_usuario=$id_usuario and id_equipe IS NOT NULL")) > 0){
        include 'equipes.php';
      }
      else{
        include 'semequipe.php';
      }
          
    }

  }
  else{
      // Pede para trocar a senha caso ainda não tenha trocado
      $email = mysqli_fetch_assoc(mysqli_query($conn, "SELECT email FROM usuario WHERE id_usuario = $id_usuario"))['email'];

      $limite = strpos($email, "@");
      $email = substr($email, 0, $limite);
  
      if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT senha FROM usuario WHERE id_usuario = $id_usuario"))['senha'] == md5($email)) {
        include 'trocar_senha.php';
      }
      else{
        include 'associacao.php';
      }
      
  }

  include 'rodape.php';
  
?>
