<div class="corpo">

<form id="form1" name="form_especialidades" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=especialidades&acao=listar'); return false;" >

  <div align="left">
    
    <table width="500" cellspacing="2" class="borda_tabela">
	
	  <tr><td colspan="2"><div class="alerta" id="alerta"></div></td></tr>	
	     
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="left"><h3><strong>Cadastro de Especialidades</strong></h3></td>
        
      </tr>
         
      <tr>
	  
        <td height="41" align="left">Nome:</td>
        
        <td align="left">
        
        <label>
        
        <!-- 
        Exibe na tela o campo for_razao_social da tabela fornecedor. O "@" é utilizado para remover mensagens de erro do PHP.  
        -->
        <input name="esp_nome" type="text" id="esp_nome" value="<?php $esp_nome = $oquefazer->registros->ESP_NOME; $esp_nome = ucwords(mb_strtolower($esp_nome, 'UTF-8')); echo $esp_nome; ?>" size="55" maxlength="40" style="background-color:  #C3C7C7;" />
       
       </label>
	   
	   <label class="obrigatorio">*</label>
        
        </td>
        
      </tr>
      
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="center">
		
		  </br>
		                    
          <p>
          
            <input class="botao" type="submit" name="salvar" id="salvar" value="Salvar"  onclick="return validar_especialidade()" />
                        
            <input class="botao" type="button" name="cancelar" id="cancelar" value="Voltar" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar' });" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="tabela" value="especialidades" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="acao" value="<?php echo 'gravar_'.$acao.'_especialidades' ?>" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. Passa o valor do campo usu_codigo pela url. -->
            <input type="hidden" name="codigo" value="<?php echo $oquefazer->registros->ESP_CODIGO; ?>" />
       
        </p>
        
        </td>
        
      </tr>
      
    </table>
    
  </div>
  
</form>

</div>