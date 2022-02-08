<?php include 'cabecalho.php'; ?>

    <br/>
    <br/>
    <br/> 

    <!-- Notas -->

    <form method="GET" action="teste.php">

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Título</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> O nome está coerente com o projeto. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display1" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta1" class="custom-range" id="customRange1" min="0" step="1" max="6" value="0" oninput="display1.value=value" onchange="display1.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Justificativa</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Argumentos que demonstram o motivo, a razão e a importância da realização do projeto. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display2" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta2" class="custom-range" id="customRange2" min="0" step="1" max="6" value="0" oninput="display2.value=value" onchange="display2.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>            

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Atitudes</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Demonstra interesse pela pesquisa, valorizando o conhecimento. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display3" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta3" class="custom-range" id="customRange3" min="0" step="1" max="6" value="0" oninput="display3.value=value" onchange="display3.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Habilidades</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Teve aptidão para realizar a pesquisa, facilidade para apresentar e falar sobre a pesquisa. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display4" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta4" class="custom-range" id="customRange4" min="0" step="1" max="6" value="0" oninput="display4.value=value" onchange="display4.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Criatividade / Inovação</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Capacidade criadora original, trazendo benefícios para a sociedade. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display5" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta5" class="custom-range" id="customRange5" min="0" step="1" max="6" value="0" oninput="display5.value=value" onchange="display5.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Relevância Social</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> É algo importante para a sociedade, trazendo benefícios. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display6" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta6" class="custom-range" id="customRange6" min="0" step="1" max="6" value="0" oninput="display6.value=value" onchange="display6.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Profundidade</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Tem embasamento bibliográfico. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display7" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta7" class="custom-range" id="customRange7" min="0" step="1" max="6" value="0" oninput="display7.value=value" onchange="display7.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Banner e Estande</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> O banner contém título, objetivo, introdução, desenvolvimento, imagens, conclusão, referências e o estande está organizado. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display8" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta8" class="custom-range" id="customRange8" min="0" step="1" max="6" value="0" oninput="display8.value=value" onchange="display8.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

    <div class="container">
          <div class="card">
            <div class="card-header">
              <h3>Apresentação Oral</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Explicou claramente o projeto, sem gírias. </b>                   
                    </label> <br/>
                    <label for="formControlRange" style="font-size: 110%;">
                      Nota: <input type="text" size="1" id="display9" value="0" readonly style="border: 0; box-shadow: 0 0 0 0; outline: 0; text-align: center;">
                    </label>
                    <input type="range" name="pergunta9" class="custom-range" id="customRange9" min="0" step="1" max="6" value="0" oninput="display9.value=value" onchange="display9.value=value"> 
                 </p>                
                </div>                                 
              </blockquote>
            </div>
            <div class="card-footer" style="text-align: center;">
             <b>(0 - Não Aplicável) &nbsp; (1 - Fraco) &nbsp; (2 - Regular) &nbsp; (3 - Bom) &nbsp; (4 - Ótimo) &nbsp; (5 - Excelente) &nbsp; (6 - Supera as expectativas)</b>
            </div>            
          </div>
        </div>

        <br/>
        <br/>

          <center>
          <div class="card" style="width:  500px;">
            <div class="card-header">
              <h3>Selecione apenas 1 opção</h3>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <div class="form-group">
                 <p> 
                    <label for="formControlRange" style="font-size: 110%;">
                      <b> Entre todos os projetos, estes estudantes merecem: </b>                   
                    </label> <br/>
                    <div style="text-align: left;">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="Destaque em CRIATIVIDADE/INOVAÇÃO">
                      <label class="form-check-label" for="inlineRadio1">Destaque em CRIATIVIDADE/INOVAÇÃO</label>
                    </div><br/>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Destaque em EMPREENDEDORISMO">
                      <label class="form-check-label" for="inlineRadio1">Destaque em EMPREENDEDORISMO</label>
                    </div><br/>                    
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="Destaque em RELEVÂNCIA SOCIAL">
                      <label class="form-check-label" for="inlineRadio1">Destaque em RELEVÂNCIA SOCIAL</label>
                    </div><br/>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="radio" id="inlineRadio4" value="Nenhuma das anteriores">
                      <label class="form-check-label" for="inlineRadio1">Nenhuma das anteriores</label>
                    </div>                    
                 </p>                
                </div>                                 
              </blockquote>
            </div>            
          </div>
          </center>
        <br/>
        <br/>
                     
    <center> <input class="btn btn-primary" type="submit" value="Enviar"> </center>

    <br/>

    </form>

    <!-- Fim_Notas --> 

<?php include 'rodape.php'; ?>