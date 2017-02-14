<?php

	class avaliacoes_manutencao {
		
		// Variáveis globais.
		var $resultado;
		var $registros;
		
		// Método construtor. Estabelece a conexão.
		function avaliacoes_manutencao() {
		
			// Instancia uma nova conexão a partir da variável "$con" existente no arquivo "conecta.php".
			$this->con = new conexao();	
			
		}
		
		// Lista as fornecedors.
		function listar_avaliacoes() {			
						
					// A variável "$ordenacao" recebe o valor do parâmetro "ordem" passado pela url.
					@$ordenacao = $_REQUEST['ordem'];
					
					// Verifica se a variável é igual a vazio.
					if($ordenacao == '')
					{
					
						// Atribui o valor "for_nome" a variável "$ordenacao_por".
						$ordenacao = "cha_data_abertura desc";
						
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
			
					// Armazena o resultado da execução da query sql na variável "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
		}
			
		// Incluir as avaliacoes.
		function gravar_incluir_avaliacoes() {
			
			if($_POST['cha_paciente'] <> "" || $_POST['cha_paciente'] <> null ){	
				
				if($_POST['esp_codigo'] <> "" || $_POST['esp_codigo'] <> null ){
					
						if($_POST['und_codigo'] <> "" || $_POST['und_codigo'] <> null ){
										
								// Como o "cid_codigo" é um campo numérico é necessário tirar as aspas simples('). Já nos outros casos devemos usar aspas simples p/ indicar uma string.	
								// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
								// Armazena a query sql na variável "$sql". Os $_POST['for_razao_social'] dentre outros pegam os parâmetros passados pelo formulário de acordo com O id.
								$sql = "insert into tbl_avaliacoes (cha_data_abertura, cha_paciente, sta_codigo, esp_codigo, und_codigo) values (now(),upper('".$_POST['cha_paciente']."'), 1,'".$_POST['esp_codigo']."','".$_POST['und_codigo']."')";
								
						
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
													
					// Armazena a query sql na variável "$sql".
					$sql = "update tbl_avaliacoes set cha_data_fechamento = now(), sta_codigo = 2 where cha_codigo = ".$_POST['codigo'];

					// Armazena o resultado da execução da query sql na variável "$resultado".
					if($this->resultado = $this->con->banco->Execute($sql)) {
						
						// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
						echo "<h4 class='alerta'>A solicita&ccedil;&atilde;o foi atendida com sucesso.</h4>";
				
						return true;	
				
					} else {
						
						// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
						echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel atender a solicita&ccedil;&atilde;o.</h4>";
				
						return false;
				
					}			
												
		}
		
		function cancelar_avaliacoes() {
													
					// Armazena a query sql na variável "$sql".
					$sql = "update tbl_avaliacoes set cha_data_fechamento = now(), sta_codigo = 3 where cha_codigo = ".$_POST['codigo'];

					// Armazena o resultado da execução da query sql na variável "$resultado".
					if($this->resultado = $this->con->banco->Execute($sql)) {
						
						// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
						echo "<h4 class='alerta'>A solicita&ccedil;&atilde;o foi cancelada com sucesso.</h4>";
				
						return true;	
				
					} else {
						
						// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
						echo "<h4 class='alerta'>N&atilde;o foi poss&iacute;vel cancelar a solicita&ccedil;&atilde;o.</h4>";
				
						return false;
				
					}			
												
		}
				
		// Alterar as avaliacoes.
		function listar_alterar_avaliacoes() {
													
					// Armazena a query sql na variável "$sql".
					$sql = "select * from tbl_avaliacoes where cha_codigo= ".$_REQUEST['codigo'];

					// Armazena o resultado da execução da query sql na variável "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
					// Armazena o resultado na variável "$this->registros". 
					$this->registros = $this->resultado->FetchNextObject();			
												
		}
		
		// Realiza a gravação da alteração na tabela fornecedors.
		function gravar_alterar_avaliacoes() {
			
				if($_POST['cha_paciente'] <> "" || $_POST['cha_paciente'] <> null ){	

					if($_POST['esp_codigo'] <> "" || $_POST['esp_codigo'] <> null){		

						if($_POST['und_codigo'] <> "" || $_POST['und_codigo'] <> null){
							
								// Como o "cid_codigo" é um campo numérico é necessário tirar as aspas simples('). Já nos outros casos devemos usar aspas simples p/ indicar uma string.		
								// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
								// Armazena a query sql na variável "$sql". 
								$sql = "update tbl_avaliacoes set cha_paciente = upper('".$_POST['cha_paciente']."'),  esp_codigo = ".$_POST['esp_codigo'].", und_codigo = ".$_POST['und_codigo']." where cha_codigo= ".$_POST['codigo'];
																				
								// Armazena o resultado da execução da query sql na variável "$resultado".
								if($this->resultado = $this->con->banco->Execute($sql))
								{
										
									// Caso a query sql tenha sido executada com sucesso o sistema exibe na tela a mensagem de sucesso.
									echo "<h4 class='alerta'> O registro foi alterado com sucesso.</h4>";
											
									return true;	
											
								}
								else 
								{
										
									// Caso a query sql não tenha sido executada com sucesso o sistema exibe na tela mensafem de problemas.
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
		
		// Conta o número de registros da tabela fornecedor.
		function total_registros_avaliacoes() {
			
			// Armazena a query sql na variável "$sql".
			$sql = "select count(*) as TOTAL from tbl_avaliacoes where sta_codigo = '1'";

			// Armazena o resultado da execução da query sql na variável "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na variável "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execução da query armazena na variável TOTAL.
			return $this->registros->TOTAL;	
				
		}
		
		// Função utilizada para listar as especialidades na combo list do arquivo "avaliacoes_form.php".
		function listar_especialidades() {
		
			// Variável que será utilizada para retornar as cidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Variável utilizada para armazenar a query sql que será executada.
			$sql = "select * from tbl_especialidades order by esp_nome";
			
			// Variável criada para armazenar o resultado da execução da query sql existente dentro da variável "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do código é utilizada para verificar em qual especialidade o chamado foi cadastrado.
			// Este laço traz a especialidade já armazenada no banco de dados para aquele chamado. Alteração do registro do chamado.
			// Este laço está sendo utilizado para quando o usuário estiver realizando uma alteração no cadastro de chamado, no campo de especialidade.
			// Laço de repetição usado para receber todos os registros existentes na tabela.
			// A variável "$regcid" recebe todos os resultados referentes a execução da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Variável criada para armazenar o registro que ficara setado para "selected". Por enquanto será vazia.
				$selecionado = '';
				
				// Verifica se o registro de especialidade selecionado pelo usuário é igual ao registro existente na tabela. Se for executa o código abaixo.
				if(@$this->registros->ESP_CODIGO == @$regcid->ESP_CODIGO) {
				
					// Aramazena na variável "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				$esp_nome = $regcid->ESP_NOME; 
				
				$esp_nome = ucwords(mb_strtolower($esp_nome, 'UTF-8'));
				
				// Está parte do código é utilizada para listar todas as especialidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta variável armazena a lista de cidades existentes na tabela de cidades. 
				// Isto é feito atavés da montagem de um html que será aramazenado na variável "$retorna" para ser exibido na tela do usuário.
				$retorna = $retorna.'<option value="'.$regcid->ESP_CODIGO.'"'.$selecionado.'>'.$esp_nome.'</option>';
								
			}
			
			// Retorna o valor existente dentro da variável "$retorna" que será exibido na tela. Monta os "<option>" do HTML.
			return $retorna;

		}
		
		// Função utilizada para listar as unidades na combo list do arquivo "avaliacoes_form.php".
		function listar_unidades() {
		
			// Variável que será utilizada para retornar as unidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Variável utilizada para armazenar a query sql que será executada.
			$sql = "select * from tbl_solicitantes order by und_nome";
			
			// Variável criada para armazenar o resultado da execução da query sql existente dentro da variável "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do código é utilizada para verificar em qual unidade o chamado foi cadastrado.
			// Este laço traz a unidade já armazenada no banco de dados para aquele chamado. Alteração do registro do chamado.
			// Este laço está sendo utilizado para quando o usuário estiver realizando uma alteração no cadastro de chamado, no campo de unidade.
			// Laço de repetição usado para receber todos os registros existentes na tabela.
			// A variável "$regcid" recebe todos os resultados referentes a execução da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Variável criada para armazenar o registro que ficara setado para "selected". Por enquanto será vazia.
				$selecionado = '';
				
				// Verifica se o registro de especialidade selecionado pelo usuário é igual ao registro existente na tabela. Se for executa o código abaixo.
				if(@$this->registros->UND_CODIGO == @$regcid->UND_CODIGO) {
				
					// Aramazena na variável "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				$und_nome = $regcid->UND_NOME; 
				
				$und_nome = ucwords(mb_strtolower($und_nome, 'UTF-8'));
				
				// Está parte do código é utilizada para listar todas as unidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta variável armazena a lista de unidades existentes na tabela de cidades. 
				// Isto é feito atavés da montagem de um html que será aramazenado na variável "$retorna" para ser exibido na tela do usuário.
				$retorna = $retorna.'<option value="'.$regcid->UND_CODIGO.'"'.$selecionado.'>'.$und_nome.'</option>';
								
			}
			
			// Retorna o valor existente dentro da variável "$retorna" que será exibido na tela. Monta os "<option>" do HTML.
			return $retorna;

		}
		
}
	
?>