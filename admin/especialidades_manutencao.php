<?php

	class especialidades_manutencao {
		
		// Vari�veis globais.
		var $resultado;
		var $registros;
		
		// M�todo construtor. Estabelece a conex�o.
		function especialidades_manutencao() {
		
			// Instancia uma nova conex�o a partir da vari�vel "$con" existente no arquivo "conecta.php".
			$this->con = new conexao();	
			
		}
		
		// Lista as fornecedors.
		function listar_especialidades() {			
						
					// A vari�vel "$ordenacao" recebe o valor do par�metro "ordem" passado pela url.
					@$ordenacao = $_REQUEST['ordem'];
					
					// Verifica se a vari�vel � igual a vazio.
					if($ordenacao == '')
					{
					
						// Atribui o valor "for_nome" a vari�vel "$ordenacao_por".
						$ordenacao = "esp_nome";
						
					} 
					
					// A vari�vel "$filtro" recebe o valor do par�metro "filtro" passado pela url.
					@$filtro = $_REQUEST['pesquisa'];
					
					// Verifica se a vari�vel � igual a vazio.
					if($filtro == '')
					{
						
						// Atribui o valor "vazio" a vari�vel "$filtrar_por".
						$filtrar_por = '';
						
					}
					else
					{
						// Atribui o valor "filtro" a vari�vel "$filtrar_por".
						$filtrar_por = $filtro;
						
					} 
					
					// Armazena a query sql na vari�vel "$sql".
					$sql = "select * from tbl_especialidades where esp_nome like '%".$filtrar_por."%' order by ".$ordenacao;
			
					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
		}
			
		// Excluir as fornecedors.
		function excluir_especialidades() {
			
			// Armazena a query sql na vari�vel "$sql". $_REQUEST['codigo'] pega o par�metro codigo que � passado na url.
			$sql = "delete from tbl_especialidades where esp_codigo in (".$_REQUEST['codigo'].")";
									
			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			if($this->resultado = $this->con->banco->Execute($sql))
			{
				// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
				echo "<h4 class='alerta'>O registro foi exclu&iacute;do com sucesso.</h4>";
				
				return true;	
				
			}
			else 
			{
			
				// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
				echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel excluir o registro.</h4>";
				
				return false;
				
			}		
	
		}
		
		// Excluir as especialidades.
		function excluir_todos_especialidades() {
						
			function filter($dados)
			{  
        
				$arr = Array();        
		
				foreach($dados AS $dado) 
				
				$arr[] = (int)$dado;  
        
				return $arr;  
    		
			}
			
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
							
				if(!@$_POST['excluir']){
									
					echo "<h4 class='alerta'>Selecione pelo menos um registro.</h4>";
				
					return false;
			
				} else {
																									
					$arr = filter(@$_POST['excluir']);
										
					// Armazena a query sql na vari�vel "$sql". $_REQUEST['codigo'] pega o par�metro codigo que � passado na url.
					$sql = "delete from tbl_especialidades where esp_codigo in (".implode(',', $arr).")";
					
				}										
		
			}
												
			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			if($this->resultado = $this->con->banco->Execute($sql))
			{
							
				// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
				echo "<h4 class='alerta'>Os registros foram exclu&iacute;dos com sucesso.</h4>";
				
				return true;	
				
			}
			else 
			{
			
				// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
				echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel exclu&iacute;r os registros.</h4>";
				
				return false;
				
			}		
	
		}
						
		// Incluir as especialidades.
		function gravar_incluir_especialidades() {
			
			if(($_POST['esp_nome']) <> ""){
									
				// Como o "cid_codigo" � um campo num�rico � necess�rio tirar as aspas simples('). J� nos outros casos devemos usar aspas simples p/ indicar uma string.	
				// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
				// Armazena a query sql na vari�vel "$sql". Os $_POST['for_razao_social'] dentre outros pegam os par�metros passados pelo formul�rio de acordo com O id.
				$sql = "insert into tbl_especialidades (esp_nome) values (upper('".$_POST['esp_nome']."'))";
				
		
				// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
				if($this->resultado = $this->con->banco->Execute($sql))
				{
					// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
					echo "<h4 class='alerta'>O registro foi inclu&iacute;do com sucesso.</h4>";
					
					return true;	
					
				}
				else 
				{
				
					// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
					echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel incluir o registro.</h4>";
					
					return false;
					
				}
			
			}else{
				
				echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";

			}
				
		}
		
		// Alterar as especialidades.
		function listar_alterar_especialidades() {
													
					// Armazena a query sql na vari�vel "$sql".
					$sql = "select * from tbl_especialidades where esp_codigo= ".$_REQUEST['codigo'];

					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
					// Armazena o resultado na vari�vel "$this->registros". 
					$this->registros = $this->resultado->FetchNextObject();			
												
		}
		
		// Realiza a grava��o da altera��o na tabela fornecedors.
		function gravar_alterar_especialidades() {

				if($_POST['esp_nome'] <> ""){					
						
					// Como o "cid_codigo" � um campo num�rico � necess�rio tirar as aspas simples('). J� nos outros casos devemos usar aspas simples p/ indicar uma string.		
					// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
					// Armazena a query sql na vari�vel "$sql". 
					$sql = "update tbl_especialidades set esp_nome= upper('".$_POST['esp_nome']."') where esp_codigo= ".$_POST['codigo'];
																	
					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					if($this->resultado = $this->con->banco->Execute($sql))
					{
							
						// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
						echo "<h4 class='alerta'> O registro foi alterado com sucesso.</h4>";
								
						return true;	
								
					}
					else 
					{
							
						// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
						echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel alterar o registro.</h4>";
														
						return false;
								
					}								
				
				}else{
					
					echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";					
					
				}				
		}
		
		// Conta o n�mero de registros da tabela fornecedor.
		function total_registros_especialidades() {
			
			// Armazena a query sql na vari�vel "$sql".
			$sql = "select count(*) as TOTAL from tbl_especialidades";

			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na vari�vel "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execu��o da query armazena na vari�vel TOTAL.
			return $this->registros->TOTAL;	
				
		}
		
		// Fun��o utilizada para listar as cidades na combo list do arquivo "fornecedor_form.php".
		function listar_estados() {
		
			// Vari�vel que ser� utilizada para retornar as cidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Vari�vel utilizada para armazenar a query sql que ser� executada.
			$sql = "select * from tbl_estados order by est_nome";
			
			// Vari�vel criada para armazenar o resultado da execu��o da query sql existente dentro da vari�vel "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do c�digo � utilizada para verificar em qual cidade o fornecedor foi cadastrado.
			// Este la�o traz a cidade j� armazenada no banco de dados para aquele fornecedor. Altera��o do registro do fornecedor.
			// Este la�o est� sendo utilizado para quando o usu�rio estiver realizando uma altera��o no cadastro de fornecedores, no campo de cidades.
			// La�o de repeti��o usado para receber todos os registros existentes na tabela.
			// A vari�vel "$regcid" recebe todos os resultados referentes a execu��o da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Vari�vel criada para armazenar o registro que ficara setado para "selected". Por enquanto ser� vazia.
				$selecionado = '';
				
				// Verifica se o registro de cidade selecionado pelo usu�rio � igual ao registro existente na tabela. Se for executa o c�digo abaixo.
				if(@$this->registros->EST_CODIGO == @$regcid->EST_CODIGO) {
				
					// Aramazena na vari�vel "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				// Est� parte do c�digo � utilizada para listar todas as cidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta vari�vel armazena a lista de cidades existentes na tabela de cidades. 
				// Isto � feito atav�s da montagem de um html que ser� aramazenado na vari�vel "$retorna" para ser exibido na tela do usu�rio.
				$retorna = $retorna.'<option value="'.$regcid->EST_CODIGO.'"'.$selecionado.'>'.$regcid->EST_NOME.'</option>';
								
			}
			
			// Retorna o valor existente dentro da vari�vel "$retorna" que ser� exibido na tela. Monta os "<option>" do HTML.
			return $retorna;

		}
		
		function listar_cidades() {
			
			$retorna = '';
				
			if($_REQUEST['codigo_estado'] == '') {
					
			$sql = "select * from tbl_cidades where est_codigo= 28 order by cid_nome";
			
			} else {
			
			$sql = "select * from tbl_cidades where est_codigo= ".$_REQUEST['codigo_estado']. " order by cid_nome";	
							
			$resultado = $this->con->banco->Execute($sql);
			
			while($regcid = $resultado->FetchNextObject()) {
			
				$selecionado = '';
		
				if(@$this->registros->CID_CODIGO == @$regcid->CID_CODIGO) {
		
					$selecionado = 'selected';	
			
				}
				
				$retorna =  $retorna.'<option value="'.$regcid->CID_CODIGO.'"'.$selecionado.'>'.$regcid->CID_NOME.'</option>';
						
		}
		
		return $retorna;
		
		}
									
	}
	
}
	
?>