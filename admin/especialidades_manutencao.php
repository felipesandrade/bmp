<?php

	class especialidades_manutencao {
		
		// Variáveis globais.
		var $resultado;
		var $registros;
		
		// Método construtor. Estabelece a conexão.
		function especialidades_manutencao() {
		
			// Instancia uma nova conexão a partir da variável "$con_ora" existente no arquivo "conecta.php".
			$this->con_ora = new conexao_ora();	
			
			//$this->con = new conexao_mysql();	
			
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
					
					// A variável "$filtro_pac_prontuario" recebe o valor do parâmetro "pac_prontuario" passado pela url.
					@$filtro_pac_prontuario = $_REQUEST['pac_prontuario'];
										
					// Verifica se a variável é igual a vazio.
					if($filtro_pac_prontuario == '')
					{
						
						// Atribui o valor "vazio" a variável "$filtrar_por_prontuario".
						$filtrar_pac_prontuario = '';
						
					}
					else
					{
						// Atribui o valor "filtrar_pac_prontuario" a variável "$filtrar_pac_prontuario".
						$filtrar_pac_prontuario = $filtro_pac_prontuario;
						
					} 
					
					@$filtro_pac_nome = ucwords(mb_strtoupper($_REQUEST['pac_nome'], 'UTF-8'));
					
					//@$filtro_pac_nome = $_REQUEST['pac_nome'];
					

					if($filtro_pac_nome == '')
					{
						

						$filtrar_pac_nome = '';
						
					}
					else
					{

						$filtrar_pac_nome = $filtro_pac_nome;
						
					} 
					
					@$filtro_pac_clinica = $_REQUEST['pac_clinica'];

					if($filtro_pac_clinica == '')
					{
						
						$filtrar_pac_clinica = '1';
						
					}
					else
					{

						$filtrar_pac_clinica = $filtro_pac_clinica;
						
					} 
										
				    $sql = "SELECT
								   T1.IDUNID
								  ,T1.NOMEUNIDADE
								  ,T1.IDLEITO
								  ,T1.TIPO_LEITO
								  ,T1.NOMELEITO
								  ,T1.STATUSOCUPACAO
								  ,T1.NRPRONTUARI
								  ,T1.NOMEPACIENTE
								  ,T1.SEXO
								  ,T1.NASCIMENTO
								  ,T1.IDADEPACIENTE
								  ,T1.IDADMISSAO
								  ,T1.DATAINTERNACAO
								  ,T1.DIASINTERNADO
								  ,T1.CODIGOPROCEDIMENTO
								  ,T1.DESCPROCEDIMENTO
								  ,T1.TIPO
								  ,T1.CID
								  ,T1.CID_DESCRIPTION
							FROM	
							(SELECT
									sys002.sys002_unit_id                                                                                                                       AS IDUNID
								   ,sys002.sys002_name                                                                                                                          AS NOMEUNIDADE
								   ,adt005.adt005_bed_id                                                                                                                        AS IDLEITO
								   ,CASE ADT005.ADT005_AUXILIAR
										 WHEN 'F' THEN 'NORMAL'
										 WHEN 'T' THEN 'AUXILIAR'
										 ELSE 'NÃO SEI'
									END                                                                                                                                         AS TIPO_LEITO  
								   ,replace(substr(adt005.adt005_bed_code,1,40),'-','')                                                                                         AS NOMELEITO
								   ,decode(adt005.adt005_status,
											'O',
											'Ocupado',
											'R',
											'Reservado',
											'L',
											'Livre',
											'B',
											'Bloqueado')                                                                                                                       AS STATUSOCUPACAO
								   ,TO_CHAR(eir001.eir001_patient_code)                                                                                                        AS NRPRONTUARI
								   ,TO_CHAR(eir001.eir001_name)                                                                                                                AS NOMEPACIENTE
								   ,TO_CHAR(decode(eir001.eir001_sex, 'F', 'F', 'M', 'M'))                                                                                     AS SEXO
								   ,eir001.eir001_birthdate                                                                                                                    AS NASCIMENTO
								   ,TO_CHAR(trunc(months_between(SYSDATE, eir001.eir001_birthdate) / 12))                                                                      AS IDADEPACIENTE
								   ,TO_CHAR(adt001.adt001_admission_id)                                                                                                        AS IDADMISSAO
								   ,adt001.adt001_admission_date                                                                                                               AS DATAINTERNACAO
								   ,TO_CHAR(ROUND(sysdate - adt001.adt001_admission_date, 0))                                                                                  AS DIASINTERNADO
								   ,TO_CHAR(fn_concatena('select 
																adm031.adm031_code
														  from 
																adt003_admission_cpt adt003
																left join adm031_institution_cpt adm031 on adm031.adm031_institution_cpt_id = adt003.adm031_institution_cpt_id
																inner join sus010_cpt_registry sus010 on sus010.adm031_institution_cpt_id = adm031.adm031_institution_cpt_id
																inner join sus009_registry sus009 on sus009.sus009_registry_id = sus010.sus009_registry_id
														  where 
																sus009.sus009_registry_id = (select 
																								  min(sus009.sus009_registry_id) sus009_registry_id
																							 from 
																								  adt003_admission_cpt adt003
																								  left join adm031_institution_cpt adm031 on adm031.adm031_institution_cpt_id = adt003.adm031_institution_cpt_id
																								  inner join sus010_cpt_registry sus010 on sus010.adm031_institution_cpt_id = adm031.adm031_institution_cpt_id
																								  inner join sus009_registry sus009 on sus009.sus009_registry_id = sus010.sus009_registry_id
																							 where 
																								  adt003.adt001_admission_id = ' || adt001.adt001_admission_id || '
																								  and sus009.sus009_code in (''03'', ''04''))
																								  and adt003.adt001_admission_id = ' || adt001.adt001_admission_id))                AS CODIGOPROCEDIMENTO       
								   ,TO_CHAR(fn_concatena('select 
																adm031.adm031_description
														  from 
																adt003_admission_cpt adt003
																left join adm031_institution_cpt adm031 on adm031.adm031_institution_cpt_id = adt003.adm031_institution_cpt_id
																inner join sus010_cpt_registry sus010 on sus010.adm031_institution_cpt_id = adm031.adm031_institution_cpt_id
																inner join sus009_registry sus009 on sus009.sus009_registry_id = sus010.sus009_registry_id
														  where 
																sus009.sus009_registry_id = (select 
																								  min(sus009.sus009_registry_id) sus009_registry_id
																							 from 
																								  adt003_admission_cpt adt003
																								  left join adm031_institution_cpt adm031 on adm031.adm031_institution_cpt_id = adt003.adm031_institution_cpt_id
																								  inner join sus010_cpt_registry sus010 on sus010.adm031_institution_cpt_id = adm031.adm031_institution_cpt_id
																								  inner join sus009_registry sus009 on sus009.sus009_registry_id = sus010.sus009_registry_id
																							 where 
																								  adt003.adt001_admission_id = ' || adt001.adt001_admission_id || '
																								  and sus009.sus009_code in (''03'', ''04''))
																								  and adt003.adt001_admission_id = ' || adt001.adt001_admission_id))               AS DESCPROCEDIMENTO
								   ,TO_CHAR(TRIM(ADT024.ADT024_DESCRIPTION))                                                                                                       AS TIPO
								   ,TO_CHAR(fn_concatena('select 
																sys100.SYS100_CODE 
														  from 
																sys100_cid sys100
																inner join adt009_admission_cid adt009 on adt009.adt001_admission_id = ' || adt001.adt001_admission_id || ' 
																and adt009.sys100_cid_id = sys100.sys100_cid_id'))                                                                 AS CID
								   ,TO_CHAR(fn_concatena('select 
																sys100.sys100_description 
														  from 
																sys100_cid sys100
																inner join adt009_admission_cid adt009 on adt009.adt001_admission_id = ' || adt001.adt001_admission_id || '
																and adt009.sys100_cid_id = sys100.sys100_cid_id'))                                                                 AS CID_DESCRIPTION       
											  
							from   
								  adt005_bed adt005
								  inner join adt004_bedroom adt004 on adt004.adt004_bedroom_id = adt005.adt004_bedroom_id
								  left join sys002_unit sys002 on sys002.sys002_unit_id = adt005.sys002_unit_id
								  inner join sus013_unit_hospital sus013 on sus013.sys002_unit_id = sys002.sys002_unit_id
								  inner join sys027_hospital sys027 on sys027.sys027_hospital_id = sus013.sys027_hospital_id
								  left join adt001_admission adt001 on adt001.adt005_bed_id = adt005.adt005_bed_id and adt005.sys002_unit_id = sys002.sys002_unit_id and adt001.adt001_admission_id not in (select adt001_admission_id from adt021_discharge) AND adt001.adt001_discharge_date is null
								  left join eir001_patient eir001 on eir001.eir001_mpi = adt001.eir001_mpi
								  INNER JOIN adt024_clinical_type adt024 on adt001.adt024_clinical_type_id = adt024.adt024_clinical_type_id
							where 
								  adt001.adt001_admission_id not in (select adt001_admission_id from adt021_discharge)
								  and sys027.sys027_hospital_id = 1
								  and sys002.sys002_enabled = 'T'
								  and adt005.adt005_enabled = 'T'
								  and adt004.adt004_enabled = 'T' 
								  and ((sys002.sys002_unit_id in (".$filtrar_pac_clinica.")) or ('F' = 'T'))
								  and (('F' = 'T') or (adt005.adt005_auxiliar = 'F' or (adt005.adt005_auxiliar = 'T' and adt005.adt005_status = 'O')))
								  and (('F' = 'F') or (sys002.sys003_unit_category_id in (2, 8)))
							 
							UNION ALL
							 
							select 
							   --sys027.sys027_description                                                                                                                     AS NOMEHOSPITAL
							   --,sys027.sys027_hospital_id                                                                                                                    AS IDHOSP
								  sys002.sys002_unit_id                                                                                                                        AS IDUNID
								 ,sys002.sys002_name                                                                                                                           AS NOMEUNIDADE
								 ,adt005.adt005_bed_id                                                                                                                         AS IDLEITO
								 ,CASE ADT005.ADT005_AUXILIAR
									   WHEN 'F' THEN 'NORMAL'
									   WHEN 'T' THEN 'AUXILIAR'
									   ELSE 'NÃO SEI'
								  END                                                                                                                                          AS TIPO_LEITO
								 ,replace(substr(adt005.adt005_bed_code,1,6),'-','')                                                                                           AS NOMELEITO
								 ,decode(adt005.adt005_status,
										  'O',
										  'Ocupado',
										  'R',
										  'Reservado',
										  'L',
										  'Livre',
										  'B',
										  'Bloqueado')                                                                                                                         AS STATUSOCUPACAO
								  ,TO_CHAR('')                                                                                                                                 AS NRPRONTUARI
								  ,TO_CHAR('')                                                                                                                                 AS NOMEPACIENTE
								  ,TO_CHAR('')                                                                                                                                 AS SEXO
								  ,null                                                                                                                                        AS NASCIMENTO
								  ,TO_CHAR('')                                                                                                                                 AS IDADEPACIENTE
								  ,TO_CHAR('')                                                                                                                                 AS IDADMISSAO
								  ,null                                                                                                                                        AS DATAINTERNACAO
								  ,TO_CHAR('')                                                                                                                                 AS DIASINTERNADO
								  ,TO_CHAR('')                                                                                                                                 AS CODIGOPROCEDIMENTO
								  ,TO_CHAR('')                                                                                                                                 AS DESCPROCEDIMENTO
								  ,TO_CHAR('')                                                                                                                                 AS TIPO
								  ,TO_CHAR('')                                                                                                                                 AS CID
								  ,TO_CHAR('')                                                                                                                                 AS CID_DESCRIPTION
							FROM  
								  adt005_bed adt005
								  inner join adt004_bedroom adt004 on adt004.adt004_bedroom_id = adt005.adt004_bedroom_id
								  left join sys002_unit sys002 on sys002.sys002_unit_id = adt005.sys002_unit_id
								  inner join sus013_unit_hospital sus013 on sus013.sys002_unit_id = sys002.sys002_unit_id
								  inner join sys027_hospital sys027 on sys027.sys027_hospital_id = sus013.sys027_hospital_id
								  left join adt001_admission adt001 on adt005.adt005_bed_id = adt001.adt005_bed_id and adt001.adt001_admission_id is null and adt001.adt001_discharge_date is null
							where 
								  sys027.sys027_hospital_id = 1
								  and adt005.adt005_status in ('R','L','B')
								  and sys002.sys002_enabled = 'T'
								  and adt005.adt005_enabled = 'T'
								  and adt004.adt004_enabled = 'T' 
								  and ((sys002.sys002_unit_id in (".$filtrar_pac_clinica.")) or ('F' = 'T'))
								  and (('F' = 'T') or (adt005.adt005_auxiliar = 'F' or (adt005.adt005_auxiliar = 'T' and adt005.adt005_status = 'O')))
								  and (('F' = 'F') or (sys002.sys003_unit_category_id in (2, 8)))
							order by 
								   NOMEPACIENTE) T1
							WHERE
								   T1.NRPRONTUARI 				LIKE '%".$filtrar_pac_prontuario."%'
								   AND UPPER(T1.NOMEPACIENTE) 	LIKE '%".$filtrar_pac_nome."%'";
			
					// Armazena o resultado da execução da query sql na variável "$resultado".
					$this->resultado = $this->con_ora->banco_ora->execute($sql);
					
		}
			
		// Excluir as fornecedors.
		/*function excluir_especialidades() {
			
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
									
	}*/
	
}
	
?>