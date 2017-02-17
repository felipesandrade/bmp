<div class="corpo">

  	<form id="form_pesquisa" name="form_pesquisa" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=especialidades&acao=listar'); return false;">
		
		<table>
		
			 <tr><td colspan="2"><div class="alerta" id="alerta"></div></td></tr>	
			 
			 <tr class="titulos_lista_pesquisa">
        
				<td colspan="2" align="left"><h3><strong>Pacientes Internados por Clínica</strong></h3></td>
        
			</tr>
					
		     <tr>
			
				<td> <strong> Prontuário: </strong></td>
		  			
			</tr>
			
			<tr>
			
				<td><input name="pac_prontuario" type="text" id="pac_prontuario" size="10" /></td>
			
			</tr>
	  
       		<tr>
			
				<td> <strong> Nome do Paciente: </strong></td>
		  			
			</tr>
			
			<tr>
			
				<td><input name="pac_nome" type="text" id="pac_nome" size="50" /></td>
			
			</tr>
			      
			<tr>
			
				<td><strong> Clínica: </strong></td>
											
			</tr>
			
			<tr>
			
				<td>
				
					<select name="pac_clinica" id="pac_clinica" >
						  
						 <option value="">Selecione uma Clínica</option>
						   
						 <option value="57">UTI 1</option>	
						 
						 <option value="58">UTI 2</option>	
						 
						 <option value="59">UTI 3</option>		
						 
						 <option value="60">UTI 4</option>						 
						  
						 <option value="4">Bloco Cirúrgico</option>		
																									   
					</select>
					
					<label class="obrigatorio">º</label> 
									
				</td>
			
			</tr>
							
		</table> <br/> <br/> 	
		
		<input class="botao" type="submit" name="botao_pesquisar" id="botao_pesquisar" value="Pesquisar"  alt="Pesquisar" style="width: 100px; margin-left: 100px;" onclick="return validar_clinica()" /> 
				
		<input class="botao" type="reset" name="botao_limpar" id="botao_limpar"  value="Limpar"  alt="Limpar" src="../imagens/button_gray.png" style="width: 100px;"  />
            
  	</form>
        
  <br />
  
  <form id="form_checked" name="form_checked" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=especialidades&acao=excluir_todos'); return false;">
  
  <table width="1280">
       
  <tr height="30" style="background-color: #626666;">
  
    <!--<th width="21" align="center"> <input type="checkbox" value="" name="excluir[]" onclick="seleciona()" /> </th>-->
	
	<th width="90" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Prontuário</a></strong></th>
  
    <th width="300" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Paciente</a></strong></th>
	
	<th width="60" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Idade</a></strong></th>
	
	<!--<th width="200" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Data Internacao</a></strong></th>-->
	
	<th width="120" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Tempo Internação</a></strong></th>
	
	<th width="390" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Procedimento</a></strong></th>
	
	<th width="120" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Clínica</a></strong></th>
	
	<th width="170" align="center"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar', ordem: 'esp_nome' });" style="color: #FFF;">Leito</a></strong></th>
              
  </tr>
 
  <?php
  		
		// Pega os registros e armazena na variável "$registros".
							
		while (!$oquefazer->resultado->EOF){	
		
		
	?>
  
  <tr>
   
    <!--<td align="center"> <input type="checkbox" name="excluir[]" value="<?php //echo $oquefazer->resultado->fields[6]; ?>" /> </td>-->
	
	<td align="center"> <?php $pac_prontuario = $oquefazer->resultado->fields[6]; echo $pac_prontuario; ?> </td> 
  
    <td><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'incluir' });"> <?php $pac_nome = $oquefazer->resultado->fields[7]; $pac_nome = ucwords(mb_strtolower($pac_nome, 'UTF-8')); echo $pac_nome; ?> </a></td> 
	
	<td align="center"> <?php $pac_idade = $oquefazer->resultado->fields[10]; echo $pac_idade; ?> </td> 
	
	<!--<td align="center"> <?php //$pac_data_internacao = $oquefazer->resultado->fields[12]; echo $pac_data_internacao; ?> </td> --> 
	
	<td align="center"> <?php $pac_tempo_internacao = $oquefazer->resultado->fields[13]; echo $pac_tempo_internacao; ?> </td> 
	
	<td> <?php $pac_procedimento = $oquefazer->resultado->fields[15];  $pac_procedimento = ucwords(mb_strtolower($pac_procedimento, 'UTF-8')); echo $pac_procedimento; ?> </td> 
	
	<td align="center"> <?php $pac_clinica = $oquefazer->resultado->fields[1]; $pac_clinica = ucwords(mb_strtolower($pac_clinica, 'UTF-8')); echo $pac_clinica; ?> </td> 
	
	<td align="center"> <?php $pac_leito = $oquefazer->resultado->fields[4]; $pac_leito = ucwords(mb_strtolower($pac_leito, 'UTF-8')); echo $pac_leito; ?> </td> 
                                 
    </tr>
     
  <?php 
	
		$oquefazer->resultado->MoveNext();
	
	}
  
  ?>
  
  </table>
  
  <br />
      
  <br />

  <br />
  
  </form>
  
  <table>
   
  		<tr>
  
    	<td height="62">
    
    
   		 </td>
    
  		</tr>
  
	</table>

</div>