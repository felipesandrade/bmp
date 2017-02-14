<?php

	class avaliacoes_manutencao {
		
		// Vari�veis globais.
		var $resultado;
		var $registros;
		
		// M�todo construtor. Estabelece a conex�o.
		function avaliacoes_manutencao() {
		
			// Instancia uma nova conex�o a partir da vari�vel "$con" existente no arquivo "conecta.php".
			$this->con = new conexao();	
			
		}
		
		// Lista as fornecedors.
		function listar_avaliacoes() {			
						
					// A vari�vel "$ordenacao" recebe o valor do par�metro "ordem" passado pela url.
					@$ordenacao = $_REQUEST['ordem'];
					
					// Verifica se a vari�vel � igual a vazio.
					if($ordenacao == '')
					{
					
						// Atribui o valor "for_nome" a vari�vel "$ordenacao_por".
						$ordenacao = "cha_data_abertura desc";
						
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
					$sql = "select 
									 c.cha_codigo
									,date_format(c.cha_data_abertura, '%d/%m/%Y %H:%i:%s') as cha_data_abertura
									,c.cha_paciente
									,e.esp_nome
									,u.und_nome
									,s.sta_descricao	
							from 
									tbl_avaliacoes c 
									inner join tbl_especialidades 	e	 on (c.esp_codigo = e.esp_codigo)
									inner join tbl_solicitantes 		u	 on (c.und_codigo = u.und_codigo)
									inner join tbl_status		    s	 on (c.sta_codigo = s.sta_codigo)
							where	
									e.esp_nome like '%".$filtrar_por."%'
									and s.sta_id = 'P'
							order by ".$ordenacao;
			
					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
		}
			
		// Incluir as avaliacoes.
		function gravar_incluir_avaliacoes() {
			
			if($_POST['cha_paciente'] <> "" || $_POST['cha_paciente'] <> null ){	
				
				if($_POST['esp_codigo'] <> "" || $_POST['esp_codigo'] <> null ){
					
						if($_POST['und_codigo'] <> "" || $_POST['und_codigo'] <> null ){
										
								// Como o "cid_codigo" � um campo num�rico � necess�rio tirar as aspas simples('). J� nos outros casos devemos usar aspas simples p/ indicar uma string.	
								// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
								// Armazena a query sql na vari�vel "$sql". Os $_POST['for_razao_social'] dentre outros pegam os par�metros passados pelo formul�rio de acordo com O id.
								$sql = "insert into tbl_avaliacoes (cha_data_abertura, cha_paciente, sta_codigo, esp_codigo, und_codigo) values (now(),upper('".$_POST['cha_paciente']."'), 1,'".$_POST['esp_codigo']."','".$_POST['und_codigo']."')";
								
						
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
					
						} else {

							echo "<h4 class='alerta'>Campo Solicitante com preenchimento obrigat&oacute;rio.</h4>";
							
						}
						 
				} else {
					
							echo "<h4 class='alerta'>Campo especialidade com preenchimento obrigat&oacute;rio.</h4>";

					}
					
			} else {
					
							echo "<h4 class='alerta'>Campo nome do paciente com preenchimento obrigat&oacute;rio.</h4>";

					}		
				
		}
		
		function atender_avaliacoes() {
													
					// Armazena a query sql na vari�vel "$sql".
					$sql = "update tbl_avaliacoes set cha_data_fechamento = now(), sta_codigo = 2 where cha_codigo = ".$_POST['codigo'];

					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					if($this->resultado = $this->con->banco->Execute($sql)) {
						
						// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
						echo "<h4 class='alerta'>A solicita&ccedil;&atilde;o foi atendida com sucesso.</h4>";
				
						return true;	
				
					} else {
						
						// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
						echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel atender a solicita&ccedil;&atilde;o.</h4>";
				
						return false;
				
					}			
												
		}
		
		function cancelar_avaliacoes() {
													
					// Armazena a query sql na vari�vel "$sql".
					$sql = "update tbl_avaliacoes set cha_data_fechamento = now(), sta_codigo = 3 where cha_codigo = ".$_POST['codigo'];

					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					if($this->resultado = $this->con->banco->Execute($sql)) {
						
						// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
						echo "<h4 class='alerta'>A solicita&ccedil;&atilde;o foi cancelada com sucesso.</h4>";
				
						return true;	
				
					} else {
						
						// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
						echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel cancelar a solicita&ccedil;&atilde;o.</h4>";
				
						return false;
				
					}			
												
		}
				
		// Alterar as avaliacoes.
		function listar_alterar_avaliacoes() {
													
					// Armazena a query sql na vari�vel "$sql".
					$sql = "select * from tbl_avaliacoes where cha_codigo= ".$_REQUEST['codigo'];

					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
					// Armazena o resultado na vari�vel "$this->registros". 
					$this->registros = $this->resultado->FetchNextObject();			
												
		}
		
		// Realiza a grava��o da altera��o na tabela fornecedors.
		function gravar_alterar_avaliacoes() {
			
				if($_POST['cha_paciente'] <> "" || $_POST['cha_paciente'] <> null ){	

					if($_POST['esp_codigo'] <> "" || $_POST['esp_codigo'] <> null){		

						if($_POST['und_codigo'] <> "" || $_POST['und_codigo'] <> null){
							
								// Como o "cid_codigo" � um campo num�rico � necess�rio tirar as aspas simples('). J� nos outros casos devemos usar aspas simples p/ indicar uma string.		
								// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
								// Armazena a query sql na vari�vel "$sql". 
								$sql = "update tbl_avaliacoes set cha_paciente = upper('".$_POST['cha_paciente']."'),  esp_codigo = ".$_POST['esp_codigo'].", und_codigo = ".$_POST['und_codigo']." where cha_codigo= ".$_POST['codigo'];
																				
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
					
						} else {
							
							echo "<h4 class='alerta'>Campo solicitante com preenchimento obrigat&oacute;rio.</h4>";					
							
						}
					} else {
						
							echo "<h4 class='alerta'>Campo especialidade com preenchimento obrigat&oacute;rio.</h4>";	
					}
					
				} else {
						
							echo "<h4 class='alerta'>Campo nome do paciente com preenchimento obrigat&oacute;rio.</h4>";

						}				
					
		}
		
		// Conta o n�mero de registros da tabela fornecedor.
		function total_registros_avaliacoes() {
			
			// Armazena a query sql na vari�vel "$sql".
			$sql = "select count(*) as TOTAL from tbl_avaliacoes where sta_codigo = '1'";

			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na vari�vel "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execu��o da query armazena na vari�vel TOTAL.
			return $this->registros->TOTAL;	
				
		}
		
		// Fun��o utilizada para listar as especialidades na combo list do arquivo "avaliacoes_form.php".
		function listar_especialidades() {
		
			// Vari�vel que ser� utilizada para retornar as cidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Vari�vel utilizada para armazenar a query sql que ser� executada.
			$sql = "select * from tbl_especialidades order by esp_nome";
			
			// Vari�vel criada para armazenar o resultado da execu��o da query sql existente dentro da vari�vel "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do c�digo � utilizada para verificar em qual especialidade o chamado foi cadastrado.
			// Este la�o traz a especialidade j� armazenada no banco de dados para aquele chamado. Altera��o do registro do chamado.
			// Este la�o est� sendo utilizado para quando o usu�rio estiver realizando uma altera��o no cadastro de chamado, no campo de especialidade.
			// La�o de repeti��o usado para receber todos os registros existentes na tabela.
			// A vari�vel "$regcid" recebe todos os resultados referentes a execu��o da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Vari�vel criada para armazenar o registro que ficara setado para "selected". Por enquanto ser� vazia.
				$selecionado = '';
				
				// Verifica se o registro de especialidade selecionado pelo usu�rio � igual ao registro existente na tabela. Se for executa o c�digo abaixo.
				if(@$this->registros->ESP_CODIGO == @$regcid->ESP_CODIGO) {
				
					// Aramazena na vari�vel "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				$esp_nome = $regcid->ESP_NOME; 
				
				$esp_nome = ucwords(mb_strtolower($esp_nome, 'UTF-8'));
				
				// Est� parte do c�digo � utilizada para listar todas as especialidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta vari�vel armazena a lista de cidades existentes na tabela de cidades. 
				// Isto � feito atav�s da montagem de um html que ser� aramazenado na vari�vel "$retorna" para ser exibido na tela do usu�rio.
				$retorna = $retorna.'<option value="'.$regcid->ESP_CODIGO.'"'.$selecionado.'>'.$esp_nome.'</option>';
								
			}
			
			// Retorna o valor existente dentro da vari�vel "$retorna" que ser� exibido na tela. Monta os "<option>" do HTML.
			return $retorna;

		}
		
		// Fun��o utilizada para listar as unidades na combo list do arquivo "avaliacoes_form.php".
		function listar_unidades() {
		
			// Vari�vel que ser� utilizada para retornar as unidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Vari�vel utilizada para armazenar a query sql que ser� executada.
			$sql = "select * from tbl_solicitantes order by und_nome";
			
			// Vari�vel criada para armazenar o resultado da execu��o da query sql existente dentro da vari�vel "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do c�digo � utilizada para verificar em qual unidade o chamado foi cadastrado.
			// Este la�o traz a unidade j� armazenada no banco de dados para aquele chamado. Altera��o do registro do chamado.
			// Este la�o est� sendo utilizado para quando o usu�rio estiver realizando uma altera��o no cadastro de chamado, no campo de unidade.
			// La�o de repeti��o usado para receber todos os registros existentes na tabela.
			// A vari�vel "$regcid" recebe todos os resultados referentes a execu��o da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Vari�vel criada para armazenar o registro que ficara setado para "selected". Por enquanto ser� vazia.
				$selecionado = '';
				
				// Verifica se o registro de especialidade selecionado pelo usu�rio � igual ao registro existente na tabela. Se for executa o c�digo abaixo.
				if(@$this->registros->UND_CODIGO == @$regcid->UND_CODIGO) {
				
					// Aramazena na vari�vel "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				$und_nome = $regcid->UND_NOME; 
				
				$und_nome = ucwords(mb_strtolower($und_nome, 'UTF-8'));
				
				// Est� parte do c�digo � utilizada para listar todas as unidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta vari�vel armazena a lista de unidades existentes na tabela de cidades. 
				// Isto � feito atav�s da montagem de um html que ser� aramazenado na vari�vel "$retorna" para ser exibido na tela do usu�rio.
				$retorna = $retorna.'<option value="'.$regcid->UND_CODIGO.'"'.$selecionado.'>'.$und_nome.'</option>';
								
			}
			
			// Retorna o valor existente dentro da vari�vel "$retorna" que ser� exibido na tela. Monta os "<option>" do HTML.
			return $retorna;

		}
		
}
	
?>