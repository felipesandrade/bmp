<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript" type="text/javascript" src="../scripts/prototype.js" charset="utf-8"> </script>
        
<script language="javascript" type="text/javascript" src="../scripts/funcoes_ajax.js" charset="utf-8"> </script>

<?php
	
	/*
		Cuidado com SQL Injection! No campo senha você digita " ' or 1='1 ". A primeira aspa simples significa que vc está fechando a outra aspa simples existente 
		na query sql, portanto a senha fica em branco. O "or" significa ou. Neste caso a senha pode ser em branco ou 1='1. A restrição de acesso falha e o Hacker 
		consegue acessar o sistema com usuário e senha que se quer existem.
		
		No arquivo php.ini existe uma diretiva chamada de "magic_quotes_gpc" que quando ativa faz o scape automatico de caracteres, ou seja, todas as vezes que é 	
		encontrada uma aspa simples ('), automaticamente a diretiva substitui por uma barra invertida (\). Caso essa diretiva esteja desabilitada devemos utilizar o 		"addslashes" para realizar o mesmo procedimento realizado pela diretiva "magic_quotes_gpc".
				
	*/
	
	// Chama a função sessão e inicia.
	session_start();
		
	// Verifica se o usuário e senha foram digitados pelo usuário.
	if(($_POST['usu_login'] != '') && ($_POST['usu_senha'] != '')) {
				
		// Importa a classe conexão necessária para comunicação com banco de dados.
		require ('../conexao_bd/conecta.php');
				
		// Armazena o valor digitado pelo usuário no campo texto e passado pelo "POST" na variável "$texto_login".
		$texto_login = $_POST['usu_login'];
		
		// Armazena na variável "$tamanho_login" o tamanho do texto digitado pelo usuário e armazenado na variável "$texto_login". Utiliza a função "strlen()".
		$tamanho_login = strlen($texto_login);
		
		// Verifica se o login digitado pelo usuário é maior que 15. Se for executa o código abaixo.
		if($tamanho_login > 20) {
			
			// Chama a função "alerta()" existente no arquivo "funcoes.php" e exibe uma mensagem na tela.			
			echo "<label class='alerta_login'>O Usuário não pode ter mais que 20 caracteres.</label>";		

			require ('login_form.php');	
			
			// Sai.
			exit;
			
		}
		
		// Armazena o valor digitado pelo usuário no campo texto e passado pelo "POST" na variável "$texto_senha".
		$texto_senha = $_POST['usu_senha'];
		
		// Armazena na variável "$tamanho_senha" o tamanho do texto digitado pelo usuário e armazenado na variável "$texto_senha". Utiliza a função "strlen()".
		$tamanho_senha = strlen($texto_senha);
		
		// Verifica se a senha digitada pelo usuário é maior que 8. Se for executa o código abaixo.
		if($tamanho_senha > 8) {
			
			// Chama a função "alerta()" existente no arquivo "funcoes.php" e exibe uma mensagem na tela.			
			echo "<label class='alerta_login'>A senha não pode ter mais que 8 caracateres.</label>";		

			require ('login_form.php');	
			
			// Sai.
			exit;
			
		}
		
		// A variável "$texto_login" recebe o valor dela mesmo com a remoção dos espaços. A função "trim()" remove os espaços em brancos no começo e no fim.
		$texto_login = trim($texto_login);
						
		// A variável "$texto_senha" recebe o valor dela mesmo com a remoção dos espaços. A função "trim()" remove os espaços em brancos no começo e no fim.
		$texto_senha = trim($texto_senha);
			
		// A função "anti_sql_injection()" é chamada para tratar as entradas dos usuários.	 
		// A função "addslashes()" é utilizada para substituir aspas simples (') por uma barra invertida (\) evitando SQL Infection.
		// A função "base64_encode()" é utilizada para criptografar a senha do usuário.
		// Armazena a query sql na variável"$sql".
		$sql = "select * from tbl_usuarios where usu_login = '".anti_sql_injection($texto_login)."' and usu_senha = '".sha1(anti_sql_injection($texto_senha))."'";
				
		// Executa a query sql existente na variável "$sql" e armazena na variável "$resultado".
		$resultado = $con->banco->Execute($sql);
		
		// Verifica se existe um próximo registro e armazena na variável "$registro".
		if($registro = $resultado->FetchNextObject()){
			
			// Chama a função alerta() existente dentro do arquivo "funcoes.php" passando o parâmetro em questão.
			// alerta("Usuário Válido!");
			
			// Registrando uma sessão com o nome de "sessao_codigo_usuario".
			@session_register('sessao_codigo_usuarios');
			
			// A sessão que foi registrada e criada vai receber o valor do campo "USU_CODIGO" da tabela "TBL_USUARIO".
			$_SESSION['sessao_codigo_usuarios'] = $registro->USU_CODIGO;
			
			// Registrando uma sessão com o nome de "sessao_nome_usuario".
			@session_register('sessao_nome_usuarios');
			
			// A sessão que foi registrada e criada vai receber o valor do campo "USU_NOME" da tabela "TBL_USUARIO".
			$_SESSION['sessao_nome_usuarios'] = $registro->USU_NOME;
									
			// Chama a função direcionar() existente dentro do arquivo "funcoes.php" passando o parâmetro em questão.
			direcionar('index.php');
			
			// Sai;
			exit;
		
		// Se não existir um próximo registro executa o código abaixo.	
		} else {
			
			// Chama a função alerta() existente dentro do arquivo "funcoes.php" passando o parâmetro em questão.					
			echo "<div class='alerta_login'>Usuário e/ou Senha incorretos.</div>";		

			require ('login_form.php');	
			
			// Sai;	
			exit;
						
		}		
	
	// Se o usuário e senha não foram digitados pelo usuário executa o código abaixo. 			
	} else {
		
		// Importa o arquivo "funcoes.php".
		require('../conexao_bd/funcoes.php');
		
		echo "<div class='alerta_login'>Você não digitou Usuário e/ou Senha.</div>";		

		require ('login_form.php');	
	
		// Sai;
		exit;		
	
	}

?>