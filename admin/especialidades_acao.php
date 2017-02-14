<?php

	// Importa o "especialidades_manutenção.php".
	require('especialidades_manutencao.php');
	
	// Instanciando a função "especialidades" e armazenando dentro da variável "$oquefazer".
	$oquefazer = new especialidades_manutencao();
	
	// A variável "$acao" recebe o valor "acao" passado na url como parâmetro.
	$acao = $_REQUEST['acao'];
		
	// Verifica se o valor de "acao" é igual a "listar".
	if($acao == 'listar') {
		
		// Variável recebe o valor do input pesquisa.
		@$filtro = $_REQUEST['pesquisa'];
					
		// Executa a função "listar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
		$oquefazer->listar_especialidades();			
		
		// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".
		require('especialidades_lista.php');
		
	// Verifica se o valor de "acao" é igual a "excluir".	
	} else if($acao == 'excluir') {
		
				// Executa a função "excluir_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->excluir_especialidades();
				
				// Executa a função "listar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_especialidades();
				
				// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".				
				require('especialidades_lista.php');
	
	} else if($acao == 'excluir_todos') {
		
				// Executa a função "excluir_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->excluir_todos_especialidades();
				
				// Executa a função "listar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_especialidades();
				
				// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".				
				require('especialidades_lista.php');
								
	// Verifica se o valor de "acao" é igual a "incluir".		
	} else if($acao == 'incluir') {
		
				// Chama o "fornecedor_form.php".
				require('especialidades_form.php');
				
			
	// Verifica se o valor da "acao" é igual a "gravar_incluir_especialidades".
	} else if($acao == 'gravar_incluir_especialidades') {
		
				// Executa a função "gravar_incluir_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->gravar_incluir_especialidades();
				
				// Executa a função "listar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_especialidades(); 
														
				// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".				
				require('especialidades_lista.php');
				
	// Verifica se o valor da "acao" é igual a "alterar".
	} else if($acao == 'alterar') {
		
				// Executa a função "listar_alterar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_alterar_especialidades();
				
				// Após a execução da função "listar_especialidades" chame o "especialidades_form.php".				
				require('especialidades_form.php');
			
	// Verifica se o valor da "acao" é igual a "gravar_alterar_especialidades".
	} else if($acao == 'gravar_alterar_especialidades') {
		
				// Executa a função "gravar_alterar_fornecedor" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->gravar_alterar_especialidades();
				
				// Executa a função "listar_fornecedor" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_especialidades();
				
				// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".				
				require('especialidades_lista.php');
				
	}
	
?>