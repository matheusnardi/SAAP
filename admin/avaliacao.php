<?php include 'cabecalhodash.php';
include 'connect.php';

$id_curso     = $_GET['id_curso']; 
$id_projeto   = $_GET['id_projeto'];
$avaliador    = $_GET['avaliador'];
$pag          = $_GET['pag'];

$sql = "select * from avaliacao_alberto_feres where id_avaliador like $avaliador and id_projeto like $id_projeto";

$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);

$consulta_avaliacao = mysqli_query($conn, "SELECT curso.curso, projeto.titulo, usuario.nome FROM avaliacao_alberto_feres as a
          INNER JOIN curso on a.id_curso = curso.id_curso
          INNER JOIN projeto on a.id_projeto = projeto.id_projeto
          INNER JOIN usuario on a.id_avaliador = usuario.id_usuario
          WHERE a.id_curso = '$id_curso' and a.id_projeto = '$id_projeto' and a.id_avaliador = '$avaliador'");
$consulta_avaliacao = mysqli_fetch_assoc($consulta_avaliacao);

// $consulta_autores = mysqli_query($conn, "SELECT * FROM autor WHERE id_projeto = '$id_projeto'");
// $autores_row = mysqli_fetch_array($consulta_autores);
// $autores = $autores_row['nome'];
// while ($autores_row = mysqli_fetch_array($consulta_autores)) {
//   $autores = $autores.", ".$autores_row['nome'];
// }

?>

    <br/>
    <br/> 
    <div class="container">
    <center><h1 class="mb-3 font-weight-normal"><?php echo $consulta_avaliacao['titulo']; ?> </h1><!-- <hr style="border-color: #C0C0C0;" /> -->
    <h3 class="mb-3 font-weight-normal"><?php echo $consulta_avaliacao['curso']; ?> </h3></center><br/>
<!--     <p class="mb-3 font-weight-normal"><b>Autores:</b> <?php echo $autores; ?> </p> -->
    <!-- Notas -->
    <form method="POST" action="processa_avaliacao.php">
    <input type="text" name="id_projeto" value="<?php echo $id_projeto; ?>" readonly hidden>
    <input type="text" name="id_aval" value="<?php echo $avaliador; ?>" readonly hidden>

          <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
            <div class="card-header">
              <h3 class="mb-3 font-weight-normal">Título (5 pontos)</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Relação com tema de estudo/Objetivo (0 a 3) </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display1" value="<?php echo $row['nota_1']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta1" class="custom-range" id="customRange1" min="0" step="0.5" max="3" value="<?php echo $row['nota_1']; ?>" oninput="display1.value=value" onchange="display1.value=value"> 
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Clareza do título (0 a 2) </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display2" value="<?php echo $row['nota_2']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta2" class="custom-range" id="customRange2" min="0" step="0.5" max="2" value="<?php echo $row['nota_2']; ?>" oninput="display2.value=value" onchange="display2.value=value">
                 </p>
                </div>                
              </blockquote>
            </div>
          </div>
        </div>

        <br/>
        <br/>

          <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
            <div class="card-header">
              <h3 class="mb-3 font-weight-normal">Introdução/Referencial Teórico (30 pontos)</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Clareza, atratividade e didática na apresentação (0 a 10) </b>                   
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display3" value="<?php echo $row['nota_3']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta3" class="custom-range" id="customRange3" min="0" step="0.5" max="10" value="<?php echo $row['nota_3']; ?>" oninput="display3.value=value" onchange="display3.value=value"> 
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Apresentação do contexto teórico e da justificativa do trabalho (0 a 10) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display4" value="<?php echo $row['nota_4']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta4" class="custom-range" id="customRange4" min="0" step="0.5" max="10" value="<?php echo $row['nota_4']; ?>" oninput="display4.value=value" onchange="display4.value=value">
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Relação lógica entre o contexto teórico e os objetivos do trabalho (0 a 10) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display5" value="<?php echo $row['nota_5']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta5" class="custom-range" id="customRange5" min="0" step="0.5" max="10" value="<?php echo $row['nota_5']; ?>" oninput="display5.value=value" onchange="display5.value=value">
                 </p>                 
                </div>                
              </blockquote>
            </div>
          </div>
        </div>

    <br/>
    <br/>

          <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
            <div class="card-header">
              <h3 class="mb-3 font-weight-normal">Metodologia (15 pontos)</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Relação/Coerência entre metodologia e objetivos de trabalho (0 a 7,5) </b>                   
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display6" value="<?php echo $row['nota_6']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta6" class="custom-range" id="customRange6" min="0" step="0.5" max="7.5" value="<?php echo $row['nota_6']; ?>" oninput="display6.value=value" onchange="display6.value=value"> 
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Detalhamento do procedimento metodológico (0 a 7,5) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display7" value="<?php echo $row['nota_7']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta7" class="custom-range" id="customRange7" min="0" step="0.5" max="7.5" value="<?php echo $row['nota_7']; ?>" oninput="display7.value=value" onchange="display7.value=value">
                 </p>              
                </div>                
              </blockquote>
            </div>
          </div>
        </div>

        <br/>
        <br/>

          <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
            <div class="card-header">
              <h3 class="mb-3 font-weight-normal">Resultados apresentados (15 pontos)</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Relação/Coerência entre os resultados apresentados/metodologia e objetivos de trabalho (0 a 7,5) </b>                   
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display8" value="<?php echo $row['nota_8']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta8" class="custom-range" id="customRange8" min="0" step="0.5" max="7.5" value="<?php echo $row['nota_8']; ?>" oninput="display8.value=value" onchange="display8.value=value"> 
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Qualidade dos resultados apresentados (0 a 7,5) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display9" value="<?php echo $row['nota_9']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta9" class="custom-range" id="customRange9" min="0" step="0.5" max="7.5" value="<?php echo $row['nota_9']; ?>" oninput="display9.value=value" onchange="display9.value=value">
                 </p>              
                </div>                
              </blockquote>
            </div>
          </div>
        </div>

        <br/>
        <br/>

          <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
            <div class="card-header">
              <h3 class="mb-3 font-weight-normal">Conclusão/Referências e qualidade do trabalho (35 pontos)</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Relação da conclusão do trabalho com todo o contexto apresentado (0 a 10) </b>  
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display10" value="<?php echo $row['nota_10']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta10" class="custom-range" id="customRange10" min="0" step="0.5" max="10" value="<?php echo $row['nota_10']; ?>" oninput="display10.value=value" onchange="display10.value=value"> 
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Adequação com a normatização de referências (0 a 5) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display11" value="<?php echo $row['nota_11']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta11" class="custom-range" id="customRange11" min="0" step="0.5" max="5" value="<?php echo $row['nota_11']; ?>" oninput="display11.value=value" onchange="display11.value=value">
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Forma de apresentação dos alunos, utilização de termos técnicos, ausência de integrantes, apresentação durante a argumentação (0 a 10) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display12" value="<?php echo $row['nota_12']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta12" class="custom-range" id="customRange12" min="0" step="0.5" max="10" value="<?php echo $row['nota_12']; ?>" oninput="display12.value=value" onchange="display12.value=value">
                 </p>
                 <p>
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Atendimento as normas do evento (0 a 10) </b>
                    </label><br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display13" value="<?php echo $row['nota_13']; ?>" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta13" class="custom-range" id="customRange13" min="0" step="0.5" max="10" value="<?php echo $row['nota_13']; ?>" oninput="display13.value=value" onchange="display13.value=value">
                 </p>                                                
                </div>                
              </blockquote>
            </div>
          </div>
        </div>

        <br/>
        <br/>

            <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
              <div class="card-header">
                <h3 class="mb-3 font-weight-normal">Observações para o grupo de alunos</h3>
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <div class="form-group">
                    <textarea class="form-control" name="obs1" placeholder="Insira aqui..." id="exampleFormControlTextarea1" rows="3"><?php echo $row['obs_alunos']; ?></textarea> 
                  </div>              
                </blockquote>
              </div>
            </div>
          </div>
        
            <div style="border-style: solid; border-width: thin; border-color: #C0C0C0;"><div class="card">
              <div class="card-header">
                <h3 class="mb-3 font-weight-normal">Observações para a comissão de avaliação</h3>
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <div class="form-group">
                    <textarea class="form-control" name="obs2" placeholder="Insira aqui..." id="exampleFormControlTextarea1" rows="3"><?php echo $row['obs_comissao']; ?></textarea> 
                  </div>              
                </blockquote>
              </div>
            </div>
         </div> 

         <br/>
         <br/>                                           

    <center> <button style="width: 100%;" name="pag" value="<?php echo $pag ?>" class="btn btn-lg btn-primary btn-block" type="submit"><b><i class="fas fa-check"></i> Enviar Avaliação</b></button> </center>
  
    </form><br/>
    </div>

    <!-- Fim_Notas --> 

<?php include 'rodapedash.php'; ?>