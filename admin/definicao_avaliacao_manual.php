<?php
$pag = "def";

	if (empty($_GET['id_projeto'])) {
		$readonlyPro = "";
		$optPro = "";
		$sizePro = 5;
	}
	else{
		$id_projetoAdd = $_GET['id_projeto'];
		$selecionePro = mysqli_query($conn, "SELECT titulo FROM projeto WHERE id_projeto = '$id_projetoAdd'");
		$selecionePro = mysqli_fetch_assoc($selecionePro);
		$selecionePro = $selecionePro['titulo'];
		$selecioneProValue = $id_projetoAdd;
		$readonlyPro = "readonly";
		$pag = "pro";
		$optPro = "<option value='$selecioneProValue' selected> $selecionePro </option>";
		$sizePro = 1;
	}
	if (empty($_GET['id_avaliador'])) {
		$readonlyAval = "";
		$optAval = "";
		$sizeAval = 5;
	}
	else{
		$id_avaliadorAdd = $_GET['id_avaliador'];
		$selecioneAval = mysqli_query($conn, "SELECT nome FROM usuario WHERE id_usuario = '$id_avaliadorAdd'");
		$selecioneAval = mysqli_fetch_assoc($selecioneAval);
		$selecioneAval = $selecioneAval['nome'];
		$selecioneAvalValue = $id_avaliadorAdd;
		$readonlyAval = "readonly";
		$pag = "aval";
		$optAval = "<option value='$selecioneAvalValue' selected> $selecioneAval </option>";
		$sizeAval = 1;
	}

	$sql 	= "select * from projeto";
	$sql3 	= "select * from usuario where tipo = 'avaliador'";


	$result  = mysqli_query($conn, $sql);
	$result3 = mysqli_query($conn, $sql3);

    $id_feira =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1"))['id_feira'];

	?>

	<br/>
	<br/>

	<center>
		<h1 class="mb-3 font-weight-normal"> Definição de Avaliação </h1><br/><!-- <hr style="border-color: #C0C0C0;" /> --><br/>
		<div class="container">
	<div style="background-color: #F5F5F5; width: 350px;border-style: solid; border-width: thin; border-color: #C0C0C0;"><br/>
		<form method="POST" action="incluir_avaliacao.php">
			<div class="form-group">  
				<label class="font-weight-bold" for="projetos">Projetos</label>
				<select style="width: 300px;" class="form-control" size="<?php echo $sizePro ?>" name="projeto" id="projetos" required <?php echo $readonlyPro; ?>>
				<?php echo $optPro;
					if ($readonlyPro == "") {
						while($row = mysqli_fetch_array($result)){ 
						$id_projeto = $row['id_projeto'];
							$sql2 	 = "select * from avaliacao_final where id_projeto = '$id_projeto'";
							$result2 = mysqli_query($conn, $sql2);		
							if (mysqli_num_rows($result2) < 5) { ?>
								<option value="<?php echo $row['id_projeto']; ?>"><?php echo $row['titulo']; ?></option>
					<?php 
							}
						}
					}	      ?>
				</select>
			</div>
			<div class="form-group">  
				<label class="font-weight-bold" for="avaliadores">Avaliadores</label>
				<select style="width: 300px;" class="form-control" size="<?php echo $sizeAval ?>" name="avaliador" id="avaliadores" required <?php echo $readonlyAval; ?>>
				<?php echo $optAval;
					if ($readonlyAval == "") {
						while($row3 = mysqli_fetch_array($result3)){ 
						$id_avaliador = $row3['id_usuario'];
							$sql4 	 = "select * from avaliacao_final where id_avaliador = '$id_avaliador'";
							$result4 = mysqli_query($conn, $sql4);		
							if (mysqli_num_rows($result4) < 5) { ?>
								<option value="<?php echo $row3['id_usuario']; ?>"><?php echo $row3['nome']; ?></option>
					<?php 
							}
						} 
					}	      ?>
				</select>
			</div>
            <input type="text" name="id_feira" value="<?php echo $id_feira ?>" hidden readonly>
			<button style="width: 300px;" name="pag" value="<?php echo $pag; ?>" class="btn btn-md btn-primary btn-block" type="submit"><b><i class="fas fa-check"></i> Definir</b></button>
		</form><br/>
		</div>
	</div>	
	</center>