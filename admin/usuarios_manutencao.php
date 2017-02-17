<?php

	class usuarios_manutencao {
		
		// Variáveis globais.
		var $resultado;
		var $registros;
		
		// Método construtor. Estabelece a conexão.
		function usuarios_manutencao() {
		
			// Instancia uma nova conexão a partir da variável "$con" existente no arquivo "conecta.php".
			$this->con = new conexao_mysql();	
			
		}
		
		// Lista as usuarioss.
		function listar_usuarios() {
			
			// A variável "$ordenacao" recebe o valor do parâmetro "ordem" passado pela url.
			@$ordenacao = $_REQUEST['ordem'];
			
			// Verifica se a variável é igual a vazio.
			if($ordenacao == '')
			{
			
				// Atribui o valor "usu_nome" a variável "$ordenacao_por".
				$ordenacao = "usu_nome";
				
			} 
			
			// A variável "$filtro" recebe o valor do parâmetro "filtro" passado pela url.
			@$filtro = $_REQUEST['pesquisa'];
			
			// Verifica se a variável é igual a vazio.
			if($filtro == '')
			{
				
				// Atribui o valor "vazio" a variável "$filtrar_por".
				$filtrar_por = '';
				
			}
			else
			{
				// Atribui o valor "filtro" a variável "$filtrar_por".
				$filtrar_por = $filtro;
				
			} 
			
			// Armazena a query sql na variável "$sql".
			$sql = "select * from tbl_usuarios where usu_nome like '".$filtrar_por."%' order by ".$ordenacao;
	
			// Armazena o resultado da execução da query sql na variável "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);		
	
		}
		
		// Excluir as usuarioss.
		function excluir_usuarios() {
			
			// Armazena a query sql na variável "$sql". $_REQUEST['codigo'] pega o parâmetro codigo que é passado na url.
			$sql = "delete from tbl_usuarios where usu_codigo= ".$_REQUEST['codigo'];
	
			// Armazena o resultado da execução da query sql na variável "$resultado".
			if($this->resultado = $this->con->banco->Execute($sql))
			{
				// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
				echo "<h4 class='alerta'>O registro foi exclu&iacute;do com sucesso.</h4>";
				
				return true;	
				
			}
			else 
			{
			
				// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
				echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel excluir o registro.</h4>";
				
				return false;
				
			}		
	
		}
						
		// Incluir as usuarioss.
		function gravar_incluir_usuarios() {
			
			if($_POST['usu_nome'] <> "" || $_POST['usu_nome'] <> null ){
				
				if($_POST['usu_login'] <> "" || $_POST['usu_login'] <> null ){
					
					if($_POST['usu_senha'] <> "" || $_POST['usu_senha'] <> null ){
			
							// A função sha1 é utilizada para criptografar a senha do usuário.			
							// A função base64_encode é utilizada para criptografar a senha do usuário.
							// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
							// Armazena a query sql na variável "$sql". $_REQUEST['usu_nome'] e $_REQUEST['cid_uf'] pega os parâmetros passados pelo formulário de acordo com O id.
							$sql = "insert into tbl_usuarios (usu_nome, usu_login, usu_senha) values (upper('".$_POST['usu_nome']."'), '".$_POST['usu_login']."', 
							'".sha1($_POST['usu_senha'])."')";
				
							// Armazena o resultado da execução da query sql na variável "$resultado".
							if($this->resultado = $this->con->banco->Execute($sql))
							{
							
								// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
								echo "<h4 class='alerta'>O registro foi inclu&iacute;do com sucesso.</h4>";
								
								return true;	
								
							}
							else 
							{
							
								// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
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
			
			// Armazena a query sql na variável "$sql".
			$sql = "select * from tbl_usuarios where usu_codigo= ".$_REQUEST['codigo'];

			// Armazena o resultado da execução da query sql na variável "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na variável "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();		
				
		}
		
		// Realiza a gravação da alteração na tabela usuarioss.
		function gravar_alterar_usuarios() {
			
			if($_POST['usu_nome'] <> "" || $_POST['usu_nome'] <> null) {
				
				if($_POST['usu_login'] <> "" || $_POST['usu_login'] <> null) {
			
						// Pega o valor do campo "usu_senha" e verifica se é vazio. Se for executa a query abaixo sem alterar o campo "usu_senha" da tabela "tbl_usuarios".
						if($_POST['usu_senha'] == '') {
						
							// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
							// Armazena a query sql na variável "$sql". 
							$sql = "update tbl_usuarios set usu_nome= upper('".$_POST['usu_nome']."'), usu_login= '".$_POST['usu_login']."' where usu_codigo= ".$_POST['codigo'];
						
						// Se o resultado da comparação acima for "false" verifica se o campo "usu_senha" é diferente de vazio. Se for executa a query abaixo alterando o campo 			
						// "usu_senha" da tabela "tbl_usuarios".
						} else if($_POST['usu_senha'] != '') {
							
							// A função sha1 é utilizada para criptografar a senha do usuário.
							// A função base64_encode é utilizada para criptografar a senha do usuário.
							// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
							// Armazena a query sql na variável "$sql". 
							$sql = "update tbl_usuarios set usu_nome= '".$_POST['usu_nome']."', usu_login= '".$_POST['usu_login']."', 
							usu_senha= '".sha1($_POST['usu_senha'])."' where usu_codigo= ".$_POST['codigo'];
										
						}
						
						// Armazena o resultado da execução da query sql na variável "$resultado".
						if($this->resultado = $this->con->banco->Execute($sql))
						{
						
							// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
							echo "<h4 class='alerta'>O registro foi alterado com sucesso.</h4>";
							
							return true;	
							
						}
						else 
						{
						
							// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
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
		
		// Conta o número de registros da tabela usuarios.
		function total_registros_usuarios() {
			
			// Armazena a query sql na variável "$sql".
			$sql = "select count(*) as TOTAL from tbl_usuarios";

			// Armazena o resultado da execução da query sql na variável "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na variável "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execução da query armazena na variável TOTAL.
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
										
					// Armazena a query sql na variável "$sql". $_REQUEST['codigo'] pega o parâmetro codigo que é passado na url.
					$sql = "delete from tbl_usuarios where usu_codigo in (".implode(',', $arr).")";
					
				}										
		
			}
												
			// Armazena o resultado da execução da query sql na variável "$resultado".
			if($this->resultado = $this->con->banco->Execute($sql))
			{
							
				// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
				echo "<h4 class='alerta'>Os registros foram exclu&iacute;dos com sucesso.</h4>";
				
				return true;	
				
			}
			else 
			{
			
				// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
				echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel exclu&iacute;r os registros.</h4>";
				
				return false;
				
			}		
	
		}
		
	}
	
?>
  

  
