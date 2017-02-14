<?php
		
	// Importa o "conecta.php".
	require('../conexao_bd/conecta.php');
						
	// Variável tabela recebe o valor passado na url como parâmetro. O "@" é utilizado para remover mensagens de erro do PHP.
	@$tabela = $_REQUEST['tabela'];
	@$acao = $_REQUEST['acao'];
					
	// Verifica se a variável "$tabela" é igual a "especialidades".			
	if($tabela == "especialidades") {
				
		// Se for verdadeiro executa "especialidades_acao.php".
		require('especialidades_acao.php');	
						
	// Verifica se a variável "$tabela" é igual a "unidades".
	} else if($tabela == "solicitantes") {
				
		// Se for verdadeiro executa "unidades_acao.php".
		require('solicitantes_acao.php');
				
	// Verifica se a variável "$tabela" é igual a "usuarios".		
	} else if($tabela == "usuarios") {
				
		// Se for verdadeiro executa "usuarios_acao.php".
		require('usuarios_acao.php');
		
	// Verifica se a variável "$tabela" é igual a "avaliacoes".	
	} else if($tabela == "avaliacoes") {
				
		// Se for verdadeiro executa "chamados_acao.php".
		require('avaliacoes_acao.php');	
	
	// Verifica se a variável "$tabela" é igual a "painel".	
	} else if($tabela == "painel") {
				
		// Se for verdadeiro executa "painel_acao.php".
		require('painel_acao.php');	
		
	// Se não executa o código abaixo.
	} else {
			
		// Executa "principal.php".
		require('principal.php');
			
	}
			
?>