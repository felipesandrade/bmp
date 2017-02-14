<div class="corpo">

	<h3> <strong> Lista de Avaliações Médicas </strong> </h3>

  	<form id="form_pesquisa" name="form_pesquisa" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=avaliacoes&acao=listar'); return false;">
	  
       		<strong> Pesquisar: </strong>
	  
      		<input name="pesquisa" type="text" id="pesquisa" size="50" /> 
                 
      		<input type="image" name="botao_pesquisar" id="botao_pesquisar" src="../imagens/pesquisar.png" />
            
  	</form>
        
  <br />
  
  <form id="form_checked" name="form_checked" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=avaliacoes&acao=excluir_todos'); return false;">
  
  <table>
       
  <tr height="30" style="background-color: #626666;" align="center">  
     
		<th width="220" ><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar', ordem: 'cha_data_abertura' });" style="color: #FFF;">Data e Hora da Avaliação</a></strong></th>
		
		<th width="280"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar', ordem: 'cha_paciente' });" style="color: #FFF;">Paciente</a></strong></th>
		
		<th width="200" ><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar', ordem: 'esp_codigo' });" style="color: #FFF;">Especialidades</a></strong></th>
		
		<th width="200" ><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar', ordem: 'und_codigo' });" style="color: #FFF;">Solicitantes</a></strong></th>
		
		<th width="150"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar', ordem: 'sta_codigo' });" style="color: #FFF;">Status</a></strong></th>
			  
		<th width="200" title="Nova Avaliação" colspan="3"><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'incluir' });" style="color: #FFF;"> <img src="../imagens/inserir.png" /> Nova Avaliação </a></th>
		
  </tr>
 
  <?php
  		
		// Pega os registros e armazena na variável "$registros".
		while(@$oquefazer->registros = @$oquefazer->resultado->FetchNextObject()) {
			
	?>
  
  <tr align="center">   
  
		<td> <?php echo $oquefazer->registros->CHA_DATA_ABERTURA; ?> </td> 
		
		<td> <?php $cha_paciente = $oquefazer->registros->CHA_PACIENTE; $cha_paciente = ucwords(mb_strtolower($cha_paciente, 'UTF-8')); echo $cha_paciente; ?> </td> 
		
		<td> <?php $esp_nome = $oquefazer->registros->ESP_NOME; $esp_nome = ucwords(mb_strtolower($esp_nome, 'UTF-8')); echo $esp_nome; ?> </td> 
		
		<td> <?php $und_nome = $oquefazer->registros->UND_NOME; $und_nome = ucwords(mb_strtolower($und_nome, 'UTF-8')); echo $und_nome; ?> </td> 
		
		<td> <?php $sta_descricao = $oquefazer->registros->STA_DESCRICAO; $sta_descricao = ucwords(mb_strtolower($sta_descricao, 'UTF-8')); echo $sta_descricao; ?> </td> 
				   
		<td title="Editar" >
		
		<a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'alterar', codigo: '<?php echo $oquefazer->registros->CHA_CODIGO; ?>'});" ><img src="../imagens/editar.png" /></a>
		
		</td>
		
		<td title="Atender" >
		
		<a href="#" onclick="javascript:confirmar_atendimento_avaliacoes('<?php echo $oquefazer->registros->CHA_CODIGO; ?>')" ><img src="../imagens/atender.png" /></a>
		
		</td>
				
		<td title="Cancelar">
		
		<a href="javascript:confirmar_cancelamento_avaliacoes('<?php echo $oquefazer->registros->CHA_CODIGO; ?>')"><img src="../imagens/excluir.png" /></a>
		
		</td>
      
  </tr>
     
  <?php } ?>
  
  </table>
  
  <br />
  
  </form>
  
  <table>
   
  		<tr>
  
    	<td height="62">
    
    		<p> <strong>N&uacute;mero de Registros:</strong> <?php echo $oquefazer->total_registros_avaliacoes(); ?> </p>
    
   		 </td>
    
  		</tr>
  
	</table>

</div>