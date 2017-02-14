<?php

	// Importa o "solicitantes_manutenção.php".
	require('solicitantes_manutencao.php');
	
	// Instanciando a função "solicitantes" e armazenando dentro da variável "$oquefazer".
	$oquefazer = new solicitantes_manutencao();
	
	// A variável "$acao" recebe o valor "acao" passado na url como parâmetro.
	$acao = $_REQUEST['acao'];
		
	// Verifica se o valor de "acao" é igual a "listar".
	if($acao == 'listar') {
		
		// Variável recebe o valor do input pesquisa.
		@$filtro = $_REQUEST['pesquisa'];
					
		// Executa a função "listar_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
		$oquefazer->listar_solicitantes();			
		
		// Após a execução da função "listar_solicitantes" chame o "solicitantes_lista.php".
		require('solicitantes_lista.php');
		
	// Verifica se o valor de "acao" é igual a "excluir".	
	} else if($acao == 'excluir') {
		
				// Executa a função "excluir_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->excluir_solicitantes();
				
				// Executa a função "listar_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->listar_solicitantes();
				
				// Após a execução da função "listar_solicitantes" chame o "solicitantes_lista.php".				
				require('solicitantes_lista.php');
	
	} else if($acao == 'excluir_todos') {
		
				// Executa a função "excluir_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->excluir_todos_solicitantes();
				
				// Executa a função "listar_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->listar_solicitantes();
				
				// Após a execução da função "listar_solicitantes" chame o "solicitantes_lista.php".				
				require('solicitantes_lista.php');
								
	// Verifica se o valor de "acao" é igual a "incluir".		
	} else if($acao == 'incluir') {
		
				// Chama o "fornecedor_form.php".
				require('solicitantes_form.php');
				
			
	// Verifica se o valor da "acao" é igual a "gravar_incluir_solicitantes".
	} else if($acao == 'gravar_incluir_solicitantes') {
		
				// Executa a função "gravar_incluir_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->gravar_incluir_solicitantes();
				
				// Executa a função "listar_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->listar_solicitantes(); 
														
				// Após a execução da função "listar_solicitantes" chame o "solicitantes_lista.php".				
				require('solicitantes_lista.php');
				
	// Verifica se o valor da "acao" é igual a "alterar".
	} else if($acao == 'alterar') {
		
				// Executa a função "listar_alterar_solicitantes" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->listar_alterar_solicitantes();
				
				// Após a execução da função "listar_solicitantes" chame o "solicitantes_form.php".				
				require('solicitantes_form.php');
			
	// Verifica se o valor da "acao" é igual a "gravar_alterar_solicitantes".
	} else if($acao == 'gravar_alterar_solicitantes') {
		
				// Executa a função "gravar_alterar_fornecedor" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->gravar_alterar_solicitantes();
				
				// Executa a função "listar_fornecedor" existente dentro do arquivo "solicitantes_manutencao.php".
				$oquefazer->listar_solicitantes();
				
				// Após a execução da função "listar_solicitantes" chame o "solicitantes_lista.php".				
				require('solicitantes_lista.php');
				
	}
	
?>