
<div class="corpo">

<form id="form1" name="form_avaliacoes" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=avaliacoes&acao=listar'); return false;" >

  <div align="left">
    
    <table width="500" cellspacing="2" class="borda_tabela">
	
	  <tr><td colspan="2"><div class="alerta" id="alerta"></div></td></tr>	
	     
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="left"><h3><strong>Cadastro de Avaliações Médicas</strong></h3></td>
        
      </tr>
	  
      <tr>
	  
        <td height="41" align="left">Paciente:</td>
        
        <td align="left">
        
        <label>
        
        <!-- 
        Exibe na tela o campo for_razao_social da tabela fornecedor. O "@" é utilizado para remover mensagens de erro do PHP.  
        -->
        <input name="cha_paciente" type="text" id="cha_paciente" value="<?php $cha_paciente = $oquefazer->registros->CHA_PACIENTE; $cha_paciente = ucwords(strtolower($cha_paciente)); echo $cha_paciente; ?>" size="55" maxlength="40" style="background-color: #C3C7C7;" />
       
       </label>
	           
        </td>
		
		<td> 
		
			<label class="obrigatorio">*</label>
		
		</td>
        
      </tr>
	  
	  <tr>
      
        <td height="41" align="left">Especialidade:</td>
        
        <td align="left">
                        
          		<select name="esp_codigo" id="esp_codigo" style="background-color:  #C3C7C7;" >
          		  
                  <option value="">Selecione uma Especialidade</option>
                    
                  <?php echo $oquefazer->listar_especialidades(); ?>
                                                                                               
                </select>
				
				<label class="obrigatorio">*</label>
                       
        </td>
          
      </tr>
	  
	  <tr>
      
        <td height="41" align="left">Solicitante:</td>
        
        <td align="left">
                        
          		<select name="und_codigo" id="und_codigo" style="background-color:  #C3C7C7;" >
          		  
                  <option value="">Selecione um Solicitante</option>
                    
                  <?php echo $oquefazer->listar_unidades(); ?>
                                                                                               
                </select>
				
				<label class="obrigatorio">*</label>
                       
        </td>
          
      </tr>         
           
      
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="center">
		
		  </br>
		                    
          <p>
          
            <input class="botao" type="submit" name="salvar" id="salvar" value="Salvar"  onclick="return validar_avaliacoes();" />
                        
            <input class="botao" type="button" name="cancelar" id="cancelar" value="Voltar" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar' });" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="tabela" value="avaliacoes" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="acao" value="<?php echo 'gravar_'.$acao.'_avaliacoes' ?>" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. Passa o valor do campo usu_codigo pela url. -->
            <input type="hidden" name="codigo" value="<?php echo $oquefazer->registros->CHA_CODIGO; ?>" />
       
        </p>
        
        </td>
        
      </tr>
      
    </table>
    
  </div>
  
</form>

</div>