<div class="corpo">

<form id="form1" name="form_usuarios" method="post" action="#" onsubmit="formSubmit(this, 'verifica_acao_ajax.php?tabela=usuarios&acao=listar'); return false;">

  <div align="left">
  
    <table width="600" cellspacing="2" class="borda_tabela">
	
	  <tr><td colspan="2"><div class="alerta" id="alerta"></div></td></tr>	
      
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="left"><h3><strong>Cadastro de Usuários</strong></h3></td>
        
      </tr>
                 
      <tr>
	  
        <td height="41" align="left">Nome:</td>
        
        <td align="left">
        
        <label>
        
        <!-- Exibe na tela o campo for_razao_social da tabela fornecedor. O "@" é utilizado para remover mensagens de erro do PHP.  -->
        <input name="usu_nome" type="text" id="usu_nome" value="<?php $usu_nome = $oquefazer->registros->USU_NOME; $usu_nome = ucwords(mb_strtolower($usu_nome, 'UTF-8')); echo $usu_nome; ?>" size="50" maxlength="40" style="background-color:  #C3C7C7;" />
       
       </label>
	   
	   <label class="obrigatorio">*</label>
        
        </td>
        
      </tr>
      
      <tr>
        
        <td width="113" height="41" align="left">Login:</td>
        
        <td width="371" align="left">
        
        <label>
                
        <!-- 
        Exibe na tela o campo for_nome_fantasia da tabela fornecedor. O "@" é utilizado para remover mensagens de erro do PHP. 
        -->
        <input name="usu_login" type="text" id="usu_login" value="<?php echo @$oquefazer->registros->USU_LOGIN; ?>" size="25" maxlength="20" style="background-color:  #C3C7C7;" /> 
        
        </label>
		
	    <label class="obrigatorio">*</label>
        
        </td>
        
      </tr>
      
      <tr>
      
        <td height="41" align="left">Senha:</td>
        
        <td align="left">
        
        <label>
                       
        <!-- 
        Exibe na tela o campo for_endereco da tabela fornecedor. O "@" é utilizado para remover mensagens de erro do PHP. 
        -->
        <input name="usu_senha" type="password" id="usu_senha" size="25" maxlength="20" style="background-color:  #C3C7C7;"/>
        
        </label>
		        
        </td>
        
      </tr>
            
      <tr class="titulos_lista_pesquisa">
        
        <td colspan="2" align="center">
        
          </br>
          
          <p>
          
            <input class="botao" type="submit" name="salvar" id="salvar" value="Salvar" onclick="return validar_editar_usuario()"/>
                        
            <input class="botao" type="button" name="cancelar" id="cancelar" value="Voltar" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'usuarios', acao: 'listar' });" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="tabela" value="usuarios" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. -->
            <input type="hidden" name="acao" value="<?php echo 'gravar_'.$acao.'_usuarios' ?>" />
            
            <!-- Campo oculto utilizado para passar parâmetros pela url. Passa o valor do campo usu_codigo pela url. -->
            <input type="hidden" name="codigo" value="<?php echo $oquefazer->registros->USU_CODIGO; ?>" />
       
        </p>
        
        </td>
        
      </tr>
      
    </table>
    
  </div>
  
</form>

</div>