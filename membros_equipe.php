<?php 

if(isset($_SESSION['acesso_adm'])){
  $arquivo = "../";
}
else{
  $arquivo = "";
}

?>

<div class="row">
    <div class="col">
        <h3 class="mb-3 font-weight-bold" style="border-bottom: 1px solid #A8A8A8; padding-bottom: 10px;">Membros</h3>
    </div>
</div>

<?php 

$query_membros = mysqli_query($conn, 
"SELECT associacao.id_associacao, associacao.id_usuario, usuario.nome
FROM associacao
INNER JOIN usuario ON associacao.id_usuario = usuario.id_usuario 
WHERE id_equipe=$id_equipe 
GROUP BY id_usuario"
);

$count = 0;

?> 

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

<?php

while ($membros = mysqli_fetch_array($query_membros)) 
{
  $count = $count+1; 
  $id_associacao = $membros['id_associacao'];
  
  if($membros['id_usuario'] == $id_usuario && !isset($_SESSION['acesso_adm'])){
    $botao = "
      <p><i>Você.</i></p>
    ";
  }
  else{
    if(mysqli_num_rows($query_membros) == 1){
      $botao = "";
    }
    else{
      $botao = "
          <input type='text' hidden name='id_curso' value='$id_curso'>
          <input type='text' hidden name='id_equipe' value='$id_equipe'>
          <button type='submit' style='width: 100%;' name='id_associacao' value='$id_associacao' class='btn btn-outline-danger'>Remover Membro</button>";
    }
  }

  ?>

  <div class="col mb-2">
    <div class="card bg-light mb-3" style="max-width: 18rem; box-shadow: 2px 2px 5px #495057;">
      <div class="card-body">
        <h5 class="card-title"><?php echo $membros['nome']; ?></h5>
          <form id='remover' onsubmit="return confirm('VOCÊ REALMENTE DESEJA REMOVER ESSE MEMBRO?');" action='<?php echo $arquivo; ?>remover_membro.php' method='POST'>
            <?php echo $botao; ?>
          </form>
      </div>
    </div>
  </div>

<?php
}
if($count < 6){ 

  $query_aluno = mysqli_query($conn, 
  "SELECT associacao.id_associacao, usuario.nome
  FROM associacao
  INNER JOIN usuario ON associacao.id_usuario = usuario.id_usuario
  WHERE id_curso=$id_curso and id_equipe IS NULL;
  ");
  
  ?>

  <div class="col mb-2">
    <form action="<?php echo $arquivo; ?>associar_membro.php" method="POST">
        <div class="form-group">
          <select class="form-control" style="width: 18rem;" name="id_associacao" id="usuario" required>
              <option value="">Selecione...</option>
              <?php while($aluno = mysqli_fetch_array($query_aluno)){ ?>
              <option value="<?php echo $aluno['id_associacao']; ?>"><?php echo $aluno['nome']; ?></option>
              <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <input type="text" hidden name="id_curso" value="<?php echo $id_curso; ?>">
          <button type="submit" style="width: 18rem;" name="id_equipe" value="<?php echo $id_equipe ?>" class="btn btn-lg btn-outline-primary">Adicionar Membro</button>
        </div>
    </form>
  </div>

<?php 
}
?>
</div>
