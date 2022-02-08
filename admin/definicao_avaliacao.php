<?php 
	include 'cabecalhodash.php';
	include 'connect.php';

	if (!empty($_GET['escolha'])) {
		if($_GET['escolha'] == 1){
			if (empty($_GET['metodo'])) {
				?>
				<center>
				<div class="container">
					<h1 class="font-weight-normal mt-5 mb-5">Definição de Avaliação Inicial</h1>

					<div class="row mt-5">
						<div class="col-12 mb-5">
							<a href="definicao_avaliacao.php?escolha=1&metodo=1" class="btn btn-primary" style="width: 60%; font-size: 2em">Manual</a>
						</div>
						<div class="col-12">
							<a href="definicao_avaliacao.php?escolha=1&metodo=2" class="btn btn-primary" style="width: 60%; font-size: 2em">Automático</a>
						</div>
					</div>
				</div>
				</center>
				<?php
			}
			elseif($_GET['metodo'] == 1){
				include 'definicao_inicial_manual.php';
			}
			else{
				include 'definicao_inicial_automatico.php';
			}
		}
		else{
			if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1")) < 1) { 
			?>
			<center><h1 class="text-secondary mt-5">Não há nenhuma feira de avaliação aberta...</h1></center>
			<?php
			}
			else{
				if (empty($_GET['metodo'])) {
					?>
					<center>
					<div class="container">
						<h1 class="font-weight-normal mt-5 mb-5">Definição de Avaliação Final</h1>
	
						<div class="row mt-5">
							<div class="col-12 mb-5">
								<a href="definicao_avaliacao.php?escolha=2&metodo=1" class="btn btn-primary" style="width: 60%; font-size: 2em">Manual</a>
							</div>
							<div class="col-12">
								<a href="definicao_avaliacao.php?escolha=2&metodo=2" class="btn btn-primary" style="width: 60%; font-size: 2em">Automático</a>
							</div>
						</div>
					</div>
					</center>
					<?php
				}
				elseif($_GET['metodo'] == 1){
					include 'definicao_final_manual.php';
				}
				else{
					include 'definicao_final_automatico.php';
				}
			}
		}
	}
	else{ 
		?>

		<center>
		<div class="container">
			<h1 class="font-weight-normal mt-5 mb-5">Selecione o tipo de avaliação</h1>

			<div class="row mt-5">
				<div class="col-12 mb-5">
					<a href="definicao_avaliacao.php?escolha=1" class="btn btn-primary" style="width: 60%; font-size: 2em">Avaliação Inicial</a>
				</div>
				<div class="col-12">
					<a href="definicao_avaliacao.php?escolha=2" class="btn btn-primary" style="width: 60%; font-size: 2em">Avaliação Final</a>
				</div>
			</div>
		</div>
		</center>

		<?php
	}

	include 'rodapedash.php';
?>
