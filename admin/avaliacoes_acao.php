<?php

	// Importa o "avaliacoes_manutenção.php".
	require('avaliacoes_manutencao.php');
	
	// Instanciando a função "avaliacoes" e armazenando dentro da variável "$oquefazer".
	$oquefazer = new avaliacoes_manutencao();
	
	// A variável "$acao" recebe o valor "acao" passado na url como parâmetro.
	$acao = $_REQUEST['acao'];
		
	// Verifica se o valor de "acao" é igual a "listar".
	if($acao == 'listar') {
		
		// Variável recebe o valor do input pesquisa.
		@$filtro = $_REQUEST['pesquisa'];
					
		// Executa a função "listar_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
		$oquefazer->listar_avaliacoes();			
		
		// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_lista.php".
		require('avaliacoes_lista.php');
		
	// Verifica se o valor de "acao" é igual a "excluir".	
	} else if($acao == 'incluir') {
		
				// Chama o "fornecedor_form.php".
				require('avaliacoes_form.php');
				
			
	// Verifica se o valor da "acao" é igual a "gravar_incluir_avaliacoes".
	} else if($acao == 'gravar_incluir_avaliacoes') {
		
				// Executa a função "gravar_incluir_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->gravar_incluir_avaliacoes();
				
				// Executa a função "listar_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->listar_avaliacoes(); 
														
				// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_lista.php".				
				require('avaliacoes_lista.php');
				
	// Verifica se o valor da "acao" é igual a "alterar".
	} else if($acao == 'alterar') {
		
				// Executa a função "listar_alterar_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->listar_alterar_avaliacoes();
				
				// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_form.php".				
				require('avaliacoes_form.php');
				
	// Verifica se o valor da "acao" é igual a "alterar".
	} else if($acao == 'atender') {
		
				// Executa a função "atender_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->atender_avaliacoes();
				
				// Executa a função "listar_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->listar_avaliacoes(); 
				
				// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_form.php".				
				require('avaliacoes_lista.php');		

	} else if($acao == 'cancelar') {
		
				// Executa a função "atender_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->cancelar_avaliacoes();
				
				// Executa a função "listar_avaliacoes" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->listar_avaliacoes(); 
				
				// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_form.php".				
				require('avaliacoes_lista.php');							
			
	// Verifica se o valor da "acao" é igual a "gravar_alterar_avaliacoes".
	} else if($acao == 'gravar_alterar_avaliacoes') {
		
				// Executa a função "gravar_alterar_fornecedor" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->gravar_alterar_avaliacoes();
				
				// Executa a função "listar_fornecedor" existente dentro do arquivo "avaliacoes_manutencao.php".
				$oquefazer->listar_avaliacoes();
				
				// Após a execução da função "listar_avaliacoes" chame o "avaliacoes_lista.php".				
				require('avaliacoes_lista.php');
				
	}
	
?>