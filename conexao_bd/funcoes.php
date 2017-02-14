<?php

	// Fução utilizada para tratar os erros que receber um "$erro_numero" como parâmetro.
	function tratar_erros($erro_numero) 
	{
		
		$mensagem_erro = " ";
		
		switch($erro_numero) 
		{
			
			case 1045: $mensagem_erro = "O usuário ou senha são inválidos. Por favor, verifique e tente novamente."; break;
			
			case 1146: $mensagem_erro = "Essa tabela não existe."; break;
			
			default: $mensagem_erro = "Erro não identificado."; break;	
			
		}
		
		return $mensagem_erro;
		
	}
	
	// Função usada para exibir uma mensagem ao incluir, alterar ou excluir um registro.
	function alerta($mensagem)
	{
				
		// Exibe na tela a mensagem.
		echo "<script> alert('".$mensagem."'); </script>";
				
	}
				
	// Caso a usuário e/ou senha estejam incorretos, volta para a página anterior.
	function voltar() {
				
		// Função existente no javascript utilizada para voltar a página anterior.
		echo '<script>history.back();</script>';
		
			
	}
	
	// Caso a usuário e/ou senha estejam corretos, direcionar para uma determinada url que será passado pela variável "$para_url". 
	function direcionar($para_url) {
			
		// Função existente no javascript utilizada para direcionar para uma determinada url.
		echo '<script>window.location="'.$para_url.'";</script>';
		
	}
	
	// Função utilizada para evitar ataques por SQL Injection. Recebe parâmetros passados pelo POST.
	function anti_sql_injection($str) {
		
		// Verifica se o valor passado não é numérico utilizando a função "is_numeric()" do PHP. Se não for numérico executa o código abaixo.
		if(!is_numeric($str)) {
			
			// A diretiva "get_magic_quotes_gpc()" acrescenta barras invertidas antes de aspas simples.
			// A função "stripslashes()" é utilizada para remover as barras invertidas.
			/* Verifica se a diretiva "get_magic_quotes_gpc()" está ativa. Se estiver usamos a função "stripslashes()" para remover as barras invertidas. Se não 		
			   estiver ativa continua com o valor original passado pelo usuário.
			*/ 
			$str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
			
			/* As funções "mysql_real_escape_string()" e "mysql_escape_string()" escapam os caracteres especiais como aspas simples e duplas antes de enviar para o 
			   banco de dados.
			*/
			// Verifica se existe a função "mysql_real_escape_string()". Se exisitr usamos ela. Se não existir usamos a função "mysql_escape_string()".
			$str = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($str) : mysql_escape_string($str);
			
		}
		
		// Retorna a variável "$str".
		return $str;	
	
	}

	
?>
	
