<div class="corpo">

	<h3> <strong> Lista de Solicitantes </strong> </h3>

  	<form id="form_pesquisa" name="form_pesquisa" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=solicitantes&acao=listar'); return false;">
	  
       		<strong> Pesquisar: </strong>
	  
      		<input name="pesquisa" type="text" id="pesquisa" size="50" /> 
                 
      		<input type="image" name="botao_pesquisar" id="botao_pesquisar" src="../imagens/pesquisar.png" />
            
  	</form>
        
  <br />
  
  <form id="form_checked" name="form_checked" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=solicitantes&acao=excluir_todos'); return false;">
  
  <table width="719">
       
  <tr height="30" style="background-color: #626666;">
  
    <th width="21" align="center"> <input type="checkbox" value="" name="excluir[]" onclick="seleciona()" /> </th>
  
    <th width="250" align="left"><strong><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'solicitantes', acao: 'listar', ordem: 'und_nome' });" style="color: #FFF;">Solicitantes</a></strong></th>
          
    <th colspan="4" align="center" title="Inserir"><a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'solicitantes', acao: 'incluir' });" style="color: #FFF;"> <img src="../imagens/inserir.png" /> Novo </a></th>
    
  </tr>
 
  <?php
  		
		// Pega os registros e armazena na variável "$registros".
		while(@$oquefazer->registros = @$oquefazer->resultado->FetchNextObject()) {
			
	?>
  
  <tr>
   
    <td align="center"> <input type="checkbox" name="excluir[]" value="<?php echo $oquefazer->registros->UND_CODIGO; ?>" /> </td>
  
    <td> <?php $und_nome = $oquefazer->registros->UND_NOME; $und_nome = ucwords(mb_strtolower($und_nome, 'UTF-8')); echo $und_nome; ?> </td> 
               
    <td width="20" align="center" title="Editar" >
    
    <a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'solicitantes', acao: 'alterar', codigo: '<?php echo $oquefazer->registros->UND_CODIGO; ?>'});" ><img src="../imagens/editar.png" /></a>
    
    </td>
            
    <td width="20" align="center" title="Excluir">
    
    <a href="javascript:confirmar_exclusao_solicitantes('<?php echo $oquefazer->registros->UND_CODIGO; ?>')"><img src="../imagens/excluir.png" /></a>
    
    </td>
      
    </tr>
     
  <?php } ?>
  
  </table>
  
  <br />
    
  	<input id="excluir_selecionados" type="image" name="Excluir" src="../imagens/excluir.png" title="Excluir Registros Selecionados"/>
  
  	<label for="excluir_selecionados"> Excluir Registros Selecionados </label>
  
  <br />

  <br />
  
  </form>
  
  <table>
   
  		<tr>
  
    	<td height="62">
    
    		<p> <strong>N&uacute;mero de Registros:</strong> <?php echo $oquefazer->total_registros_solicitantes(); ?> </p>
    
   		 </td>
    
  		</tr>
  
	</table>

</div>