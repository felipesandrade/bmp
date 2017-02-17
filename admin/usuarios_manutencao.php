<?php

	class usuarios_manutencao {
		
		// Vari�veis globais.
		var $resultado;
		var $registros;
		
		// M�todo construtor. Estabelece a conex�o.
		function usuarios_manutencao() {
		
			// Instancia uma nova conex�o a partir da vari�vel "$con" existente no arquivo "conecta.php".
			$this->con = new conexao_mysql();	
			
		}
		
		// Lista as usuarioss.
		function listar_usuarios() {
			
			// A vari�vel "$ordenacao" recebe o valor do par�metro "ordem" passado pela url.
			@$ordenacao = $_REQUEST['ordem'];
			
			// Verifica se a vari�vel � igual a vazio.
			if($ordenacao == '')
			{
			
				// Atribui o valor "usu_nome" a vari�vel "$ordenacao_por".
				$ordenacao = "usu_nome";
				
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
			$sql = "select * from tbl_usuarios where usu_nome like '".$filtrar_por."%' order by ".$ordenacao;
	
			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);		
	
		}
		
		// Excluir as usuarioss.
		function excluir_usuarios() {
			
			// Armazena a query sql na vari�vel "$sql". $_REQUEST['codigo'] pega o par�metro codigo que � passado na url.
			$sql = "delete from tbl_usuarios where usu_codigo= ".$_REQUEST['codigo'];
	
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
						
		// Incluir as usuarioss.
		function gravar_incluir_usuarios() {
			
			if($_POST['usu_nome'] <> "" || $_POST['usu_nome'] <> null ){
				
				if($_POST['usu_login'] <> "" || $_POST['usu_login'] <> null ){
					
					if($_POST['usu_senha'] <> "" || $_POST['usu_senha'] <> null ){
			
							// A fun��o sha1 � utilizada para criptografar a senha do usu�rio.			
							// A fun��o base64_encode � utilizada para criptografar a senha do usu�rio.
							// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
							// Armazena a query sql na vari�vel "$sql". $_REQUEST['usu_nome'] e $_REQUEST['cid_uf'] pega os par�metros passados pelo formul�rio de acordo com O id.
							$sql = "insert into tbl_usuarios (usu_nome, usu_login, usu_senha) values (upper('".$_POST['usu_nome']."'), '".$_POST['usu_login']."', 
							'".sha1($_POST['usu_senha'])."')";
				
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
				
					} else{
						
						echo "<h4 class='alerta'>Campo senha com preenchimento obrigat&oacute;rio.</h4>";
					}
				
				} else{
					
					echo "<h4 class='alerta'>Campo login com preenchimento obrigat&oacute;rio.</h4>";
					
				}
			
			} else {
				
				echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";

			}
				
			}
		
		// Alterar as usuarioss.
		function listar_alterar_usuarios() {
			
			// Armazena a query sql na vari�vel "$sql".
			$sql = "select * from tbl_usuarios where usu_codigo= ".$_REQUEST['codigo'];

			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na vari�vel "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();		
				
		}
		
		// Realiza a grava��o da altera��o na tabela usuarioss.
		function gravar_alterar_usuarios() {
			
			if($_POST['usu_nome'] <> "" || $_POST['usu_nome'] <> null) {
				
				if($_POST['usu_login'] <> "" || $_POST['usu_login'] <> null) {
			
						// Pega o valor do campo "usu_senha" e verifica se � vazio. Se for executa a query abaixo sem alterar o campo "usu_senha" da tabela "tbl_usuarios".
						if($_POST['usu_senha'] == '') {
						
							// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
							// Armazena a query sql na vari�vel "$sql". 
							$sql = "update tbl_usuarios set usu_nome= upper('".$_POST['usu_nome']."'), usu_login= '".$_POST['usu_login']."' where usu_codigo= ".$_POST['codigo'];
						
						// Se o resultado da compara��o acima for "false" verifica se o campo "usu_senha" � diferente de vazio. Se for executa a query abaixo alterando o campo 			
						// "usu_senha" da tabela "tbl_usuarios".
						} else if($_POST['usu_senha'] != '') {
							
							// A fun��o sha1 � utilizada para criptografar a senha do usu�rio.
							// A fun��o base64_encode � utilizada para criptografar a senha do usu�rio.
							// Se as informa��es est�o sendo passadas pelo formul�rio � mais seguro sempre usar o "POST".
							// Armazena a query sql na vari�vel "$sql". 
							$sql = "update tbl_usuarios set usu_nome= '".$_POST['usu_nome']."', usu_login= '".$_POST['usu_login']."', 
							usu_senha= '".sha1($_POST['usu_senha'])."' where usu_codigo= ".$_POST['codigo'];
										
						}
						
						// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
						if($this->resultado = $this->con->banco->Execute($sql))
						{
						
							// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
							echo "<h4 class='alerta'>O registro foi alterado com sucesso.</h4>";
							
							return true;	
							
						}
						else 
						{
						
							// Caso a query sql n�o tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
							echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel alterar o registro.</h4>";
							
							return false;
							
						}

				}else{
					
					echo "<h4 class='alerta'>Campo login com preenchimento obrigat&oacute;rio.</h4>";
					
				}
			
			}else{
				
					echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";
				
				}	
							
		}
		
		// Conta o n�mero de registros da tabela usuarios.
		function total_registros_usuarios() {
			
			// Armazena a query sql na vari�vel "$sql".
			$sql = "select count(*) as TOTAL from tbl_usuarios";

			// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na vari�vel "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execu��o da query armazena na vari�vel TOTAL.
			return $this->registros->TOTAL;	
				
		}
		
		// Excluir as especialidades.
		function excluir_todos_usuarios() {
						
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
					$sql = "delete from tbl_usuarios where usu_codigo in (".implode(',', $arr).")";
					
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
		
	}
	
?>
  

  
