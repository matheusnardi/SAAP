<?php include 'cabecalho.php'; 

$id_feira   = $_GET['id_feira'];
$id_curso   = $_GET['id_curso'];  
$id_projeto = $_GET['id_projeto'];
$id_avaliador = $_SESSION['id_usuario'];
$id_avaliacao = $_GET['id_avaliacao'];

$titulo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT titulo FROM projeto
WHERE id_projeto = $id_projeto"))['titulo'];

$link_video = mysqli_fetch_assoc(mysqli_query($conn, "SELECT link FROM projeto as p
WHERE id_projeto = $id_projeto"))['link'];

$curso = mysqli_fetch_assoc(mysqli_query($conn, "SELECT titulo, curso.curso FROM projeto as p
INNER JOIN curso on p.id_curso = curso.id_curso
WHERE id_projeto = $id_projeto"))['curso'];

$nota = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM avaliacao_final WHERE id_avaliacao = $id_avaliacao"));

?>

    <!-- Notas -->
<center>
<div class="container">
<br>
    <h1 class="mb-3 font-weight-normal"><?php echo $titulo; ?></h1>
    <h3 class="font-weight-normal mb-3"><?php echo $curso; ?></h3>
    <a class='btn btn-outline-dark mb-5' href="<?php echo $link_video ?>" target="_blank">Apresentação</a>

    <form method="POST" action="processa_avaliacao_final.php" class="mb-5">


      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
              Título
             <p class="font-weight-normal mb-0 mt-2">O nome está coerente com o projeto.</p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n1" id="n1-1" value="1" required <?php if($nota['n1'] == 1){echo "checked";} ?>>
          <label class="um" for="n1-1">Fraco</label>
          <input type="radio" name="n1" id="n1-2" value="2" required <?php if($nota['n1'] == 2){echo "checked";} ?>>
          <label class="dois" for="n1-2">Regular</label>
          <input type="radio" name="n1" id="n1-3" value="3" required <?php if($nota['n1'] == 3){echo "checked";} ?>>
          <label class="tres" for="n1-3">Bom</label>
          <input type="radio" name="n1" id="n1-4" value="4" required <?php if($nota['n1'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n1-4">Ótimo</label>
          <input type="radio" name="n1" id="n1-5" value="5" required <?php if($nota['n1'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n1-5">Excelente</label>
          <input type="radio" name="n1" id="n1-0" value="0" required <?php if($nota['n1'] == 0 && $nota['n1'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n1-0">Não aplicável</label>
          <input type="radio" name="n1" id="n1-6" value="6" required <?php if($nota['n1'] == 6){echo "checked";} ?>>
          <label class="seis" for="n1-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Planejamento da pesquisa
             <p class="font-weight-normal mb-0 mt-2">A questão e a hipótese estão claras e bem definidas. <br>
                Os objetivos são claros e relacionados com pesquisas similares. <br>
                Foi realizada pesquisa bibliográfica consistente. </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n2" id="n2-1" value="1" required <?php if($nota['n2'] == 1){echo "checked";} ?>>
          <label class="um" for="n2-1">Fraco</label>
          <input type="radio" name="n2" id="n2-2" value="2" required <?php if($nota['n2'] == 2){echo "checked";} ?>>
          <label class="dois" for="n2-2">Regular</label>
          <input type="radio" name="n2" id="n2-3" value="3" required <?php if($nota['n2'] == 3){echo "checked";} ?>>
          <label class="tres" for="n2-3">Bom</label>
          <input type="radio" name="n2" id="n2-4" value="4" required <?php if($nota['n2'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n2-4">Ótimo</label>
          <input type="radio" name="n2" id="n2-5" value="5" required <?php if($nota['n2'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n2-5">Excelente</label>
          <input type="radio" name="n2" id="n2-0" value="0" required <?php if($nota['n2'] == 0 && $nota['n2'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n2-0">Não aplicável</label>
          <input type="radio" name="n2" id="n2-6" value="6" required <?php if($nota['n2'] == 6){echo "checked";} ?>>
          <label class="seis" for="n2-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
                Justificativa 
             <p class="font-weight-normal mb-0 mt-2">
             A justificativa está embasada em dados científicos e pesquisa bibliográfica. <br>
                Foram escolhidos e planejados métodos de coleta, registro e análise de dados. <br>
                As variáveis para serem estudadas foram definidas. <br>
                Foi estabelecido um cronograma.
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n3" id="n3-1" value="1" required <?php if($nota['n3'] == 1){echo "checked";} ?>>
          <label class="um" for="n3-1">Fraco</label>
          <input type="radio" name="n3" id="n3-2" value="2" required <?php if($nota['n3'] == 2){echo "checked";} ?>>
          <label class="dois" for="n3-2">Regular</label>
          <input type="radio" name="n3" id="n3-3" value="3" required <?php if($nota['n3'] == 3){echo "checked";} ?>>
          <label class="tres" for="n3-3">Bom</label>
          <input type="radio" name="n3" id="n3-4" value="4" required <?php if($nota['n3'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n3-4">Ótimo</label>
          <input type="radio" name="n3" id="n3-5" value="5" required <?php if($nota['n3'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n3-5">Excelente</label>
          <input type="radio" name="n3" id="n3-0" value="0" required <?php if($nota['n3'] == 0 && $nota['n3'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n3-0">Não aplicável</label>
          <input type="radio" name="n3" id="n3-6" value="6" required <?php if($nota['n3'] == 6){echo "checked";} ?>>
          <label class="seis" for="n3-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Aplicabilidade e profundidade 
             <p class="font-weight-normal mb-0 mt-2">
             O projeto está inserido na agenda 2030 da ONU (ODS) e de acordo com os objetivos do desenvolvimento sustentável. <br>
                Tem embasamento bibliográfico. 
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n4" id="n4-1" value="1" required <?php if($nota['n4'] == 1){echo "checked";} ?>>
          <label class="um" for="n4-1">Fraco</label>
          <input type="radio" name="n4" id="n4-2" value="2" required <?php if($nota['n4'] == 2){echo "checked";} ?>>
          <label class="dois" for="n4-2">Regular</label>
          <input type="radio" name="n4" id="n4-3" value="3" required <?php if($nota['n4'] == 3){echo "checked";} ?>>
          <label class="tres" for="n4-3">Bom</label>
          <input type="radio" name="n4" id="n4-4" value="4" required <?php if($nota['n4'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n4-4">Ótimo</label>
          <input type="radio" name="n4" id="n4-5" value="5" required <?php if($nota['n4'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n4-5">Excelente</label>
          <input type="radio" name="n4" id="n4-0" value="0" required <?php if($nota['n4'] == 0 && $nota['n4'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n4-0">Não aplicável</label>
          <input type="radio" name="n4" id="n4-6" value="6" required <?php if($nota['n4'] == 6){echo "checked";} ?>>
          <label class="seis" for="n4-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Atitude Científica e Habilidades
             <p class="font-weight-normal mb-0 mt-2">
             Acredita no projeto, demonstra entusiasmo e determinação para superar as dificuldades do projeto. <br>
            Demonstra competência para analisar criticamente dados e informações. <br>
            Compreende diferentes pontos de vista, sabe distinguir e compreender situações novas. <br>
            Entende quais são os limites de seu projeto. <br>
            É capaz de formular considerações sobre a experiência realizada e compará-la com experiências similares.
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n5" id="n5-1" value="1" required <?php if($nota['n5'] == 1){echo "checked";} ?>>
          <label class="um" for="n5-1">Fraco</label>
          <input type="radio" name="n5" id="n5-2" value="2" required <?php if($nota['n5'] == 2){echo "checked";} ?>>
          <label class="dois" for="n5-2">Regular</label>
          <input type="radio" name="n5" id="n5-3" value="3" required <?php if($nota['n5'] == 3){echo "checked";} ?>>
          <label class="tres" for="n5-3">Bom</label>
          <input type="radio" name="n5" id="n5-4" value="4" required <?php if($nota['n5'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n5-4">Ótimo</label>
          <input type="radio" name="n5" id="n5-5" value="5" required <?php if($nota['n5'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n5-5">Excelente</label>
          <input type="radio" name="n5" id="n5-0" value="0" required <?php if($nota['n5'] == 0 && $nota['n5'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n5-0">Não aplicável</label>
          <input type="radio" name="n5" id="n5-6" value="6" required <?php if($nota['n5'] == 6){echo "checked";} ?>>
          <label class="seis" for="n5-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Criatividade  
             <p class="font-weight-normal mb-0 mt-2">
             Apresenta uma resposta original à questão levantada ou apresenta uma solução criativa ao problema identificado. <br>
            A proposta tem relevância social e potencial para transformar a realidade da comunidade em que o aluno vive.
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n6" id="n6-1" value="1" required <?php if($nota['n6'] == 1){echo "checked";} ?>>
          <label class="um" for="n6-1">Fraco</label>
          <input type="radio" name="n6" id="n6-2" value="2" required <?php if($nota['n6'] == 2){echo "checked";} ?>>
          <label class="dois" for="n6-2">Regular</label>
          <input type="radio" name="n6" id="n6-3" value="3" required <?php if($nota['n6'] == 3){echo "checked";} ?>>
          <label class="tres" for="n6-3">Bom</label>
          <input type="radio" name="n6" id="n6-4" value="4" required <?php if($nota['n6'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n6-4">Ótimo</label>
          <input type="radio" name="n6" id="n6-5" value="5" required <?php if($nota['n6'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n6-5">Excelente</label>
          <input type="radio" name="n6" id="n6-0" value="0" required <?php if($nota['n6'] == 0 && $nota['n6'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n6-0">Não aplicável</label>
          <input type="radio" name="n6" id="n6-6" value="6" required <?php if($nota['n6'] == 6){echo "checked";} ?>>
          <label class="seis" for="n6-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Inovação 
             <p class="font-weight-normal mb-0 mt-2">
             Inovou na abordagem (recursos, equipamentos, método) da pesquisa. <br>
            Relacionou informações de maneira original para superar as dificuldades do projeto. <br>
            Improvisou materiais ou equipamentos para alcançar o resultado final.
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n7" id="n7-1" value="1" required <?php if($nota['n7'] == 1){echo "checked";} ?>>
          <label class="um" for="n7-1">Fraco</label>
          <input type="radio" name="n7" id="n7-2" value="2" required <?php if($nota['n7'] == 2){echo "checked";} ?>>
          <label class="dois" for="n7-2">Regular</label>
          <input type="radio" name="n7" id="n7-3" value="3" required <?php if($nota['n7'] == 3){echo "checked";} ?>>
          <label class="tres" for="n7-3">Bom</label>
          <input type="radio" name="n7" id="n7-4" value="4" required <?php if($nota['n7'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n7-4">Ótimo</label>
          <input type="radio" name="n7" id="n7-5" value="5" required <?php if($nota['n7'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n7-5">Excelente</label>
          <input type="radio" name="n7" id="n7-0" value="0" required <?php if($nota['n7'] == 0 && $nota['n7'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n7-0">Não aplicável</label>
          <input type="radio" name="n7" id="n7-6" value="6" required <?php if($nota['n7'] == 6){echo "checked";} ?>>
          <label class="seis" for="n7-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Relevância Social
             <p class="font-weight-normal mb-0 mt-2">É algo importante para a sociedade, trazendo benefícios.</p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n8" id="n8-1" value="1" required <?php if($nota['n8'] == 1){echo "checked";} ?>>
          <label class="um" for="n8-1">Fraco</label>
          <input type="radio" name="n8" id="n8-2" value="2" required <?php if($nota['n8'] == 2){echo "checked";} ?>>
          <label class="dois" for="n8-2">Regular</label>
          <input type="radio" name="n8" id="n8-3" value="3" required <?php if($nota['n8'] == 3){echo "checked";} ?>>
          <label class="tres" for="n8-3">Bom</label>
          <input type="radio" name="n8" id="n8-4" value="4" required <?php if($nota['n8'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n8-4">Ótimo</label>
          <input type="radio" name="n8" id="n8-5" value="5" required <?php if($nota['n8'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n8-5">Excelente</label>
          <input type="radio" name="n8" id="n8-0" value="0" required <?php if($nota['n8'] == 0 && $nota['n8'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n8-0">Não aplicável</label>
          <input type="radio" name="n8" id="n8-6" value="6" required <?php if($nota['n8'] == 6){echo "checked";} ?>>
          <label class="seis" for="n8-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Clareza e Coerência
             <p class="font-weight-normal mb-0 mt-2">
             Descreveu de forma clara e objetiva o projeto. <br>
            Organizou as informações relevantes sobre o desenvolvimento e resultados alcançados. <br>
            Ficou clara a contribuição dos alunos ao projeto. <br>
            As informações estão organizadas de forma coerente.
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n9" id="n9-1" value="1" required <?php if($nota['n9'] == 1){echo "checked";} ?>>
          <label class="um" for="n9-1">Fraco</label>
          <input type="radio" name="n9" id="n9-2" value="2" required <?php if($nota['n9'] == 2){echo "checked";} ?>>
          <label class="dois" for="n9-2">Regular</label>
          <input type="radio" name="n9" id="n9-3" value="3" required <?php if($nota['n9'] == 3){echo "checked";} ?>>
          <label class="tres" for="n9-3">Bom</label>
          <input type="radio" name="n9" id="n9-4" value="4" required <?php if($nota['n9'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n9-4">Ótimo</label>
          <input type="radio" name="n9" id="n9-5" value="5" required <?php if($nota['n9'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n9-5">Excelente</label>
          <input type="radio" name="n9" id="n9-0" value="0" required <?php if($nota['n9'] == 0 && $nota['n9'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n9-0">Não aplicável</label>
          <input type="radio" name="n9" id="n9-6" value="6" required <?php if($nota['n9'] == 6){echo "checked";} ?>>
          <label class="seis" for="n9-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Apresentação
             <p class="font-weight-normal mb-0 mt-2">
             Apresentação Oral: explicou claramente o projeto, sem gírias. <br>
            A apresentação contém título, objetivo, introdução, desenvolvimento, imagens, conclusão, referências. <br>
            O vídeo apresenta o tempo máximo de cinco minutos com participação dos autores. 
             </p> 
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="n10" id="n10-1" value="1" required <?php if($nota['n10'] == 1){echo "checked";} ?>>
          <label class="um" for="n10-1">Fraco</label>
          <input type="radio" name="n10" id="n10-2" value="2" required <?php if($nota['n10'] == 2){echo "checked";} ?>>
          <label class="dois" for="n10-2">Regular</label>
          <input type="radio" name="n10" id="n10-3" value="3" required <?php if($nota['n10'] == 3){echo "checked";} ?>>
          <label class="tres" for="n10-3">Bom</label>
          <input type="radio" name="n10" id="n10-4" value="4" required <?php if($nota['n10'] == 4){echo "checked";} ?>>
          <label class="quatro" for="n10-4">Ótimo</label>
          <input type="radio" name="n10" id="n10-5" value="5" required <?php if($nota['n10'] == 5){echo "checked";} ?>>
          <label class="cinco" for="n10-5">Excelente</label>
          <input type="radio" name="n10" id="n10-0" value="0" required <?php if($nota['n10'] == 0 && $nota['n10'] != NULL){echo "checked";} ?>>
          <label class="zero" for="n10-0">Não aplicável</label>
          <input type="radio" name="n10" id="n10-6" value="6" required <?php if($nota['n10'] == 6){echo "checked";} ?>>
          <label class="seis" for="n10-6">Supera as expectativas</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Entre todos os projetos, estes estudantes merecem:
          </div>
      </div>
      <div class="custom-radio-final mb-5">
          <input type="radio" name="destaque" id="n12-1" value="Destaque em CRIATIVIDADE/INOVAÇÃO" required <?php if($nota['destaque'] == "Destaque em CRIATIVIDADE/INOVAÇÃO"){echo "checked";} ?>>
          <label class="destaque-1" for="n12-1">Destaque em<br>CRIATIVIDADE/INOVAÇÃO</label>

          <input type="radio" name="destaque" id="n12-2" value="Destaque em REFERENCIAL BIBLIOGRÁFICO" required  <?php if($nota['destaque'] == "Destaque em REFERENCIAL BIBLIOGRÁFICO"){echo "checked";} ?>>
          <label class="destaque-2" for="n12-2">Destaque em<br> REFERENCIAL BIBLIOGRÁFICO</label>

          <input type="radio" name="destaque" id="n12-3" value="Destaque em EMPREENDEDORISMO" required  <?php if($nota['destaque'] == "Destaque em EMPREENDEDORISMO"){echo "checked";} ?>>
          <label class="destaque-2" for="n12-3">Destaque em<br> EMPREENDEDORISMO</label>

          <input type="radio" name="destaque" id="n12-4" value="Destaque em RELEVÂNCIA SOCIAL" required  <?php if($nota['destaque'] == "Destaque em RELEVÂNCIA SOCIAL"){echo "checked";} ?>>
          <label class="destaque-1" for="n12-4">Destaque em<br> RELEVÂNCIA SOCIAL</label>

          <input type="radio" name="destaque" id="n12-5" value="Destaque em ORGANIZAÇÃO E APRESENTAÇÃO" required  <?php if($nota['destaque'] == "Destaque em ORGANIZAÇÃO E APRESENTAÇÃO"){echo "checked";} ?>>
          <label class="destaque-1" for="n12-5">Destaque em<br> ORGANIZAÇÃO E APRESENTAÇÃO</label>

          <input type="radio" name="destaque" id="n12-6" value="Nenhum" required  <?php if($nota['destaque'] == "Nenhum"){echo "checked";} ?>>
          <label class="destaque-3" for="n12-6">Nenhum Destaque</label>
      </div>

      <div class="card custom-card mb-1" style="max-width: 90%;">
          <div class="card-header h4">
          Considerando os critérios adotados, analise os pontos positivos e negativos do projeto. (Opcional)
          </div>
      </div>
      <div class="mb-5" style="max-width: 90%;">
        <textarea class="form-control" name="obs" placeholder="Insira aqui..." id="obs" rows="3"><?php echo $nota['obs']; ?></textarea>
      </div>
      <input type="text" name="id_feira" value="<?php echo $id_feira ?>" hidden readonly>
      <input type="text" name="id_curso" value="<?php echo $id_curso ?>" hidden readonly>
      <input type="text" name="id_projeto" value="<?php echo $id_projeto ?>" hidden readonly>                 
      <input class="btn btn-primary" type="submit" value="Concluir Avaliação" style="width: 90%; height: 70px; font-size: 1.5em;">

    </form>
</div>
</center>
    <!-- Fim_Notas --> 

<?php include 'rodape.php'; ?>