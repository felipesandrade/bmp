<?php

	class especialidades_manutencao {
		
		// Variáveis globais.
		var $resultado;
		var $registros;
		
		// Método construtor. Estabelece a conexão.
		function especialidades_manutencao() {
		
			// Instancia uma nova conexão a partir da variável "$con" existente no arquivo "conecta.php".
			$this->con = new conexao();	
			
		}
		
		// Lista as fornecedors.
		function listar_especialidades() {			
						
					// A variável "$ordenacao" recebe o valor do parâmetro "ordem" passado pela url.
					@$ordenacao = $_REQUEST['ordem'];
					
					// Verifica se a variável é igual a vazio.
					if($ordenacao == '')
					{
					
						// Atribui o valor "for_nome" a variável "$ordenacao_por".
						$ordenacao = "esp_nome";
						
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
					$sql = "select * from tbl_especialidades where esp_nome like '%".$filtrar_por."%' order by ".$ordenacao;
			
					// Armazena o resultado da execução da query sql na variável "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
		}
			
		// Excluir as fornecedors.
		function excluir_especialidades() {
			
			// Armazena a query sql na variável "$sql". $_REQUEST['codigo'] pega o parâmetro codigo que é passado na url.
			$sql = "delete from tbl_especialidades where esp_codigo in (".$_REQUEST['codigo'].")";
									
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
										
					// Armazena a query sql na variável "$sql". $_REQUEST['codigo'] pega o parâmetro codigo que é passado na url.
					$sql = "delete from tbl_especialidades where esp_codigo in (".implode(',', $arr).")";
					
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
						
		// Incluir as especialidades.
		function gravar_incluir_especialidades() {
			
			if(($_POST['esp_nome']) <> ""){
									
				// Como o "cid_codigo" é um campo numérico é necessário tirar as aspas simples('). Já nos outros casos devemos usar aspas simples p/ indicar uma string.	
				// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
				// Armazena a query sql na variável "$sql". Os $_POST['for_razao_social'] dentre outros pegam os parâmetros passados pelo formulário de acordo com O id.
				$sql = "insert into tbl_especialidades (esp_nome) values (upper('".$_POST['esp_nome']."'))";
				
		
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
			
			}else{
				
				echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";

			}
				
		}
		
		// Alterar as especialidades.
		function listar_alterar_especialidades() {
													
					// Armazena a query sql na variável "$sql".
					$sql = "select * from tbl_especialidades where esp_codigo= ".$_REQUEST['codigo'];

					// Armazena o resultado da execução da query sql na variável "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
					
					// Armazena o resultado na variável "$this->registros". 
					$this->registros = $this->resultado->FetchNextObject();			
												
		}
		
		// Realiza a gravação da alteração na tabela fornecedors.
		function gravar_alterar_especialidades() {

				if($_POST['esp_nome'] <> ""){					
						
					// Como o "cid_codigo" é um campo numérico é necessário tirar as aspas simples('). Já nos outros casos devemos usar aspas simples p/ indicar uma string.		
					// Se as informações estão sendo passadas pelo formulário é mais seguro sempre usar o "POST".
					// Armazena a query sql na variável "$sql". 
					$sql = "update tbl_especialidades set esp_nome= upper('".$_POST['esp_nome']."') where esp_codigo= ".$_POST['codigo'];
																	
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
				
				}else{
					
					echo "<h4 class='alerta'>Campo nome com preenchimento obrigat&oacute;rio.</h4>";					
					
				}				
		}
		
		// Conta o número de registros da tabela fornecedor.
		function total_registros_especialidades() {
			
			// Armazena a query sql na variável "$sql".
			$sql = "select count(*) as TOTAL from tbl_especialidades";

			// Armazena o resultado da execução da query sql na variável "$resultado".
			$this->resultado = $this->con->banco->Execute($sql);
			
			// Armazena o resultado na variável "$this->registros". 
			$this->registros = $this->resultado->FetchNextObject();	
			
			// Retorna o resultado da execução da query armazena na variável TOTAL.
			return $this->registros->TOTAL;	
				
		}
		
		// Função utilizada para listar as cidades na combo list do arquivo "fornecedor_form.php".
		function listar_estados() {
		
			// Variável que será utilizada para retornar as cidades. Por enquanto recebe vazio.
			$retorna = '';
			
			// Variável utilizada para armazenar a query sql que será executada.
			$sql = "select * from tbl_estados order by est_nome";
			
			// Variável criada para armazenar o resultado da execução da query sql existente dentro da variável "$sql".
			$resultado = $this->con->banco->Execute($sql);
									
			// Esta parte do código é utilizada para verificar em qual cidade o fornecedor foi cadastrado.
			// Este laço traz a cidade já armazenada no banco de dados para aquele fornecedor. Alteração do registro do fornecedor.
			// Este laço está sendo utilizado para quando o usuário estiver realizando uma alteração no cadastro de fornecedores, no campo de cidades.
			// Laço de repetição usado para receber todos os registros existentes na tabela.
			// A variável "$regcid" recebe todos os resultados referentes a execução da query sql.
			while($regcid = $resultado->FetchNextObject()) {
				
				// Variável criada para armazenar o registro que ficara setado para "selected". Por enquanto será vazia.
				$selecionado = '';
				
				// Verifica se o registro de cidade selecionado pelo usuário é igual ao registro existente na tabela. Se for executa o código abaixo.
				if(@$this->registros->EST_CODIGO == @$regcid->EST_CODIGO) {
				
					// Aramazena na variável "$selecionado" o valor "selected". 
					$selecionado = 'selected';	
									
				}
				
				// Está parte do código é utilizada para listar todas as cidades do banco de dados.
				// Monta o "<option>" do HTML.
				// Esta variável armazena a lista de cidades existentes na tabela de cidades. 
				// Isto é feito atavés da montagem de um html que será aramazenado na variável "$retorna" para ser exibido na tela do usuário.
				$retorna = $retorna.'<option value="'.$regcid->EST_CODIGO.'"'.$selecionado.'>'.$regcid->EST_NOME.'</option>';
								
			}
			
			// Retorna o valor existente dentro da variável "$retorna" que será exibido na tela. Monta os "<option>" do HTML.
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