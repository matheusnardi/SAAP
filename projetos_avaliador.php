<?php
error_reporting(0);

	$feira = mysqli_query($conn, "SELECT * FROM feira WHERE status_abertura = 1");
	$feira = mysqli_fetch_assoc($feira);
	$id_feira = $feira['id_feira'];
	$nome_feira = $feira['nome'];
    $edicao_feira = $feira['edicao'];

	$consulta_projeto = mysqli_query($conn, 
    "SELECT a.*, c.curso, p.titulo, p.endereco, p.link, p.status_aprovacao, e.nome, p.id_equipe, e.descricao, ods.categoria, o.nome AS orientador, co.nome AS coorientador FROM avaliacao_final AS a
    INNER JOIN projeto AS p ON a.id_projeto = p.id_projeto
    INNER JOIN curso AS c ON p.id_curso = c.id_curso
    INNER JOIN equipe AS e ON p.id_equipe = e.id_equipe
    INNER JOIN orientador as o ON p.id_orientador = o.id_orientador
    INNER JOIN orientador as co ON p.id_coorientador = co.id_orientador
    INNER JOIN ods as ods ON p.id_ods = ods.id_ods
    WHERE id_avaliador = $id_avaliador AND a.status_avaliacao = 0
    ORDER BY a.status_avaliacao");

    $consulta_projeto2 = mysqli_query($conn, 
    "SELECT a.*, c.curso, p.titulo, p.endereco, p.link, p.status_aprovacao, e.nome, p.id_equipe, e.descricao, ods.categoria, o.nome AS orientador, co.nome AS coorientador FROM avaliacao_final AS a
    INNER JOIN projeto AS p ON a.id_projeto = p.id_projeto
    INNER JOIN curso AS c ON p.id_curso = c.id_curso
    INNER JOIN equipe AS e ON p.id_equipe = e.id_equipe
    INNER JOIN orientador as o ON p.id_orientador = o.id_orientador
    INNER JOIN orientador as co ON p.id_coorientador = co.id_orientador
    INNER JOIN ods as ods ON p.id_ods = ods.id_ods
    WHERE a.id_avaliador = $id_avaliador AND a.status_avaliacao = 1
    ORDER BY a.status_avaliacao");
?>

<div class="card border-dark mt-5">

	<div class="card-header border-dark h3 font-weight-normal">
	<?php echo $edicao_feira."ª ".$nome_feira ?>
	</div>
	<div class="card-body">

		<div style="width: 80%; display: flex; flex-wrap: wrap;">

			<?php $cont = 0;
			while ($consulta_row = mysqli_fetch_array($consulta_projeto)) {
				$id_projeto = $consulta_row['id_projeto'];
				$id_avaliacao = $consulta_row['id_avaliacao'];

				$avaliacoes = mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto");

                $qntd_avaliacoes = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto"));

                $qntd_avaliacoes_feitas = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto AND status_avaliacao = 1"));

				$titulo_projeto = $consulta_row['titulo'];
				$id_curso = $consulta_row['id_curso'];
				$id_equipe = $consulta_row['id_equipe'];
				$status_avaliacao = $consulta_row['status_avaliacao'];
				$link_video = $consulta_row['link'];
				$cont = $cont+1;

				$consulta_membros = mysqli_query($conn, 
				"SELECT id_associacao, usuario.id_usuario, usuario.nome 
				FROM associacao as a
				INNER JOIN usuario ON a.id_usuario = usuario.id_usuario 
				WHERE id_equipe = $id_equipe
				GROUP BY id_usuario");

				$membros_row = mysqli_fetch_array($consulta_membros);
				$membros = $membros_row['nome'];

				while ($membros_row = mysqli_fetch_array($consulta_membros)) {
					$membros = $membros."<br/>".$membros_row['nome'];
				}
			?>
				<div style="width: 100%; margin-bottom: 5%;">	
					<div class="card border-warning">
						<div class="card-body text-warning">
							<p class="card-text h5 text-dark"><?php echo $titulo_projeto; ?></p>
							<p class="card-text text-dark">Avaliações restantes: <?php echo $qntd_avaliacoes-$qntd_avaliacoes_feitas; ?></p>
							<a class='btn btn-sm btn-outline-warning' href="#" data-toggle="modal" data-target="#detalhe-<?php echo $cont; ?>">Detalhes</a>
							<a class='btn btn-sm btn-outline-warning' href="#" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>">Avaliações</a>
							<div class="dropdown mt-1">
								<a class='btn btn-outline-warning' href="<?php echo $link_video ?>" target="_blank">Apresentação</a>
								<a class="btn btn-outline-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Arquivo
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="<?php echo $consulta_row['endereco'] ?>" download="<?php echo $titulo_projeto ?>.pdf">Baixar</a>
									<a class="dropdown-item" href="<?php echo $consulta_row['endereco'] ?>" target="_blank">Visualizar</a>
								</div>
							</div>
						</div>
						<a style="border-radius: 0px;" href="avaliacao_final.php?id_projeto=<?php echo $id_projeto; ?>&id_avaliacao=<?php echo $id_avaliacao ?>&id_curso=<?php echo $id_curso; ?>&id_feira=<?php echo $id_feira ?>" class="footer btn btn-md btn-warning btn-block"><b>Avaliar Projeto</b></a>
					</div>
				</div>

				<center>
					
				<div class="modal fade" id="detalhe-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="detalhe-<?php echo $cont; ?>Label" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="detalhe-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
								<h4 class="mb-3 font-weight-normal">ODS:</h4> <h5><?php echo $consulta_row['categoria']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Curso:</h4> <h5><?php echo $consulta_row['curso']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Equipe:</h4> <h5><?php echo $consulta_row['nome']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Membros:</h4> <h5><?php echo $membros; ?></h5>
								<br><br>
								<h4>Orientador:</h4>
								<h5><?php echo $consulta_row['orientador']; ?></h5>
								<h4>Co-orientador:</h4>
								<h5><?php echo $consulta_row['coorientador']; ?></h5>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="avaliacoes-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="avaliacoes-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="avaliacoes-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left" style="max-height: 400px; overflow-y: auto;">
                                <?php 
                                    if ($qntd_avaliacoes_feitas > 0) {
                                        $count_avaliacao = 0;

                                        $media_avaliacao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10))Media FROM avaliacao_final WHERE id_projeto = $id_projeto AND status_avaliacao = 1"))['Media'];

										$media_avaliacao = (100 * $media_avaliacao)/60;

                                        if ($media_avaliacao >= 90) {
                                            echo "<h3>Média Final: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 70){
                                            echo "<h3>Média Final: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 50){
                                            echo "<h3>Média Final: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 0){
                                            echo "<h3>Média Final: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
                                        }

                                        while ($mostrar_avaliacoes = mysqli_fetch_assoc($avaliacoes)) {
                                            $count_avaliacao = $count_avaliacao+1;
                                            $id_avaliacao = $mostrar_avaliacoes['id_avaliacao'];
                                            $qntd_criterios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ((n1+n2+n3+n4+n5+n6+n7+n8+n9+n10))qntd 
                                            FROM avaliacao_final
                                            WHERE id_avaliacao = $id_avaliacao; "))['qntd']; 
											
											$qntd_criterios = (100*$qntd_criterios)/60;
                                            ?>

                                            <div class="mb-2 p-2" style="border: #138496 solid 2px;">
                                            <h3><?php echo $count_avaliacao."ª "; ?>Avaliação</h4>

                                            <?php 
                                            if($mostrar_avaliacoes['status_avaliacao'] == 0){ 
                                            ?>
                                               <h5 class="text-secondary">Avaliação Pendente</h5>
                                            </div>                
                                            <?php 
                                            }
                                            else{ 
												if ($qntd_criterios >= 90) {
													echo "<h5>Média: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
												}
												elseif($qntd_criterios >= 70){
													echo "<h5>Média: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
												}
												elseif($qntd_criterios >= 50){
													echo "<h5>Média: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
												}
												elseif($qntd_criterios >= 0){
													echo "<h5>Média: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
												}
                                            ?>
											</div> 
                                            <?php
											}
                                        }
                                    }
                                    else{
                                        echo "<h3 class='text-secondary'>Ainda não foram feitas avaliações.</h3>";
                                    }
                                	?>
                            </div>
                            <div class="modal-footer">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				</center>

			<?php
			}
			?>
			
			<?php
			while ($consulta_row = mysqli_fetch_array($consulta_projeto2)) {
				$id_projeto = $consulta_row['id_projeto'];
				$id_avaliacao = $consulta_row['id_avaliacao'];

				$avaliacoes = mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto");

                $qntd_avaliacoes = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto"));

                $qntd_avaliacoes_feitas = mysqli_num_rows(
                    mysqli_query($conn, "SELECT * 
                FROM avaliacao_final as a
                INNER JOIN usuario ON a.id_avaliador = usuario.id_usuario
                WHERE id_projeto = $id_projeto AND status_avaliacao = 1"));

				$titulo_projeto = $consulta_row['titulo'];
				$id_curso = $consulta_row['id_curso'];
				$id_equipe = $consulta_row['id_equipe'];
				$status_avaliacao = $consulta_row['status_avaliacao'];
				$link_video = $consulta_row['link'];
				$cont = $cont+1;

				$consulta_membros = mysqli_query($conn, 
				"SELECT id_associacao, usuario.id_usuario, usuario.nome 
				FROM associacao as a
				INNER JOIN usuario ON a.id_usuario = usuario.id_usuario 
				WHERE id_equipe = $id_equipe
				GROUP BY id_usuario");

				$membros_row = mysqli_fetch_array($consulta_membros);
				$membros = $membros_row['nome'];

				while ($membros_row = mysqli_fetch_array($consulta_membros)) {
					$membros = $membros."<br/>".$membros_row['nome'];
				}
			?>
				<div style="width: 100%; margin-bottom: 5%;">	
					<div class="card border-info">
						<div class="card-body text-info">
							<p class="card-text h5 text-dark"><?php echo $titulo_projeto; ?></p>
							<p class="card-text text-dark">Avaliações restantes: <?php echo $qntd_avaliacoes-$qntd_avaliacoes_feitas; ?></p>
							<a class='btn btn-sm btn-outline-info' href="#" data-toggle="modal" data-target="#detalhe-<?php echo $cont; ?>">Detalhes</a>
							<a class='btn btn-sm btn-outline-info' href="#" data-toggle="modal" data-target="#avaliacoes-<?php echo $cont; ?>">Avaliações</a>
							<div class="dropdown mt-1">
								<a class='btn btn-outline-info' href="<?php echo $link_video ?>" target="_blank">Apresentação</a>
								<a class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Arquivo
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="<?php echo $consulta_row['endereco'] ?>" download="<?php echo $titulo_projeto ?>.pdf">Baixar</a>
									<a class="dropdown-item" href="<?php echo $consulta_row['endereco'] ?>" target="_blank">Visualizar</a>
								</div>
							</div>
						</div>
						<a style="border-radius: 0px;" href="avaliacao_final.php?id_projeto=<?php echo $id_projeto; ?>&id_avaliacao=<?php echo $id_avaliacao ?>&id_curso=<?php echo $id_curso; ?>&id_feira=<?php echo $id_feira ?>" class="footer btn btn-md btn-info btn-block"><b><i class="fas fa-edit"></i> Editar Avaliação</b></a>
					</div>
				</div>

				<center>
					
				<div class="modal fade" id="detalhe-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="detalhe-<?php echo $cont; ?>Label" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="detalhe-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
								<h4 class="mb-3 font-weight-normal">ODS:</h4> <h5><?php echo $consulta_row['categoria']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Curso:</h4> <h5><?php echo $consulta_row['curso']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Equipe:</h4> <h5><?php echo $consulta_row['nome']; ?></h5><br/>
								<h4 class="mb-3 font-weight-normal">Membros:</h4> <h5><?php echo $membros; ?></h5>
								<br><br>
								<h4>Orientador:</h4>
								<h5><?php echo $consulta_row['orientador']; ?></h5>
								<h4>Co-orientador:</h4>
								<h5><?php echo $consulta_row['coorientador']; ?></h5>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="avaliacoes-<?php echo $cont; ?>" tabindex="-1" aria-labelledby="avaliacoes-<?php echo $cont; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="avaliacoes-<?php echo $cont; ?>Label"><?php echo $titulo_projeto; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left" style="max-height: 400px; overflow-y: auto;">
                                <?php 
                                    if ($qntd_avaliacoes_feitas > 0) {
                                        $count_avaliacao = 0;

                                        $media_avaliacao = mysqli_fetch_assoc(mysqli_query($conn, "SELECT (avg(n1)+avg(n2)+avg(n3)+avg(n4)+avg(n5)+avg(n6)+avg(n7)+avg(n8)+avg(n9)+avg(n10))Media FROM avaliacao_final WHERE id_projeto = $id_projeto AND status_avaliacao = 1"))['Media'];

										$media_avaliacao = (100 * $media_avaliacao)/60;

                                        if ($media_avaliacao >= 90) {
                                            echo "<h3>Média Final: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 70){
                                            echo "<h3>Média Final: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 50){
                                            echo "<h3>Média Final: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
                                        }
                                        elseif($media_avaliacao >= 0){
                                            echo "<h3>Média Final: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
                                        }

                                        while ($mostrar_avaliacoes = mysqli_fetch_assoc($avaliacoes)) {
                                            $count_avaliacao = $count_avaliacao+1;
                                            $id_avaliacao = $mostrar_avaliacoes['id_avaliacao'];
                                            $qntd_criterios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ((n1+n2+n3+n4+n5+n6+n7+n8+n9+n10))qntd 
                                            FROM avaliacao_final
                                            WHERE id_avaliacao = $id_avaliacao; "))['qntd']; 
											
											$qntd_criterios = (100*$qntd_criterios)/60;
                                            ?>

                                            <div class="mb-2 p-2" style="border: #138496 solid 2px;">
                                            <h3><?php echo $count_avaliacao."ª "; ?>Avaliação</h4>

                                            <?php 
                                            if($mostrar_avaliacoes['status_avaliacao'] == 0){ 
                                            ?>
                                               <h5 class="text-secondary">Avaliação Pendente</h5>
                                            </div>                
                                            <?php 
                                            }
                                            else{ 
												if ($qntd_criterios >= 90) {
													echo "<h5>Média: <span style='color: #43A047;'>MB - Muito bom</span></h3><br>";
												}
												elseif($qntd_criterios >= 70){
													echo "<h5>Média: <span style='color: #30AD23;'>B - Bom</span></h3><br>";
												}
												elseif($qntd_criterios >= 50){
													echo "<h5>Média: <span style='color: #1C39BB;'>R - Regular</span></h3><br>";
												}
												elseif($qntd_criterios >= 0){
													echo "<h5>Média: <span style='color: #DD3333;'>I - Insuficiente</span></h3><br>";
												}
                                            ?>
											</div> 
                                            <?php
											}
                                        }
                                    }
                                    else{
                                        echo "<h3 class='text-secondary'>Ainda não foram feitas avaliações.</h3>";
                                    }
                                	?>
                            </div>
                            <div class="modal-footer">
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				</center>

			<?php
			}
			?>

			<!-- <div class="col mb-2">	
				<a class="btn btn-lg btn-outline-primary" href="" data-toggle='modal' data-target='#ajuda' style="max-width: 18rem;">
					Clique aqui para saber Avaliar !
				</a>
							
			</div> -->

		</div>
	</div>
	<div class="card-footer border-dark">
		<div style="font-size: 18px" class="font-weight-normal"><b class="text-warning">Amarelo</b>: Pendente | <b class="text-info">Azul</b>: Avaliado</div>
	</div>	
</div>


<br/>
<div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <h4>Como Avaliar?</h4><br/>
        <p><b>Primeiro Passo:</b> <br/>Clique em "Avaliar Projeto" no projeto que deseja avaliar
        <img src="/img/avaliar.png" width="200" height="75" alt="ERROR" loading="lazy"></p><br/>
        <p><b>Segundo Passo:</b> <br/>Arraste os círculos azuis para a direita/esquerda, definindo assim, uma nota para cada critério
        <img src="/img/avaliacao.png" width="400" height="138" alt="ERROR" loading="lazy"></p><br/>
        <p><b>Terceiro Passo:</b> <br/>Você pode fazer um comentário para a equipe de Alunos e Comissão, mas não é obrigatório.
        <img src="/img/comentario.png" width="400" height="159" alt="ERROR" loading="lazy"></p><br/>
        <p><b>Quarto Passo:</b> <br/>Após definir todas as notas, basta clicar no botão "Enviar Avaliação"
        <img src="/img/enviar.png" width="400" height="25" alt="ERROR" loading="lazy"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
