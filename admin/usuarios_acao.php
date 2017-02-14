<?php

	// Importa o "usuarios_manutenção.php".
	require('usuarios_manutencao.php');

	// Instanciando a função "usuarios_manutencao" e armazenando dentro da variável "$oquefazer".
	$oquefazer = new usuarios_manutencao();
	
	// A variável "$acao" recebe o valor "acao" passado na url como parâmetro.
	$acao = $_REQUEST['acao'];
		
	// Verifica se o valor de "acao" é igual a "listar".
	if($acao == 'listar') {
		
		// Variável recebe o valor do input pesquisa.
		@$filtro = $_REQUEST['pesquisa'];
					
		// Executa a função "listar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
		$oquefazer->listar_usuarios();			
		
		// Após a execução da função "listar_usuarios" chame o "usuarios_lista.php".
		require('usuarios_lista.php');
		
	// Verifica se o valor de "acao" é igual a "excluir".	
	} else if($acao == 'excluir') {
		
				// Executa a função "excluir_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->excluir_usuarios();
				
				// Executa a função "listar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->listar_usuarios();
				
				// Após a execução da função "listar_usuarios" chame o "usuarios_lista.php".				
				require('usuarios_lista.php');
				
	}else if($acao == 'excluir_todos') {
		
				// Executa a função "excluir_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->excluir_todos_usuarios();
				
				// Executa a função "listar_especialidades" existente dentro do arquivo "especialidades_manutencao.php".
				$oquefazer->listar_usuarios();
				
				// Após a execução da função "listar_especialidades" chame o "especialidades_lista.php".				
				require('usuarios_lista.php');
				
	// Verifica se o valor de "acao" é igual a "incluir".		
	} else if($acao == 'incluir') {
		
				// Chama o "usuarios_form.php".
				require('usuarios_form.php');
				
			
	// Verifica se o valor da "acao" é igual a "gravar_incluir_usuarios".
	} else if($acao == 'gravar_incluir_usuarios') {
		
				// Executa a função "gravar_incluir_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->gravar_incluir_usuarios();
				
				// Executa a função "listar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->listar_usuarios();
				
				// Após a execução da função "listar_usuarios" chame o "usuarios_lista.php".				
				require('usuarios_lista.php');
			
	// Verifica se o valor da "acao" é igual a "alterar".
	} else if($acao == 'alterar') {
		
				// Executa a função "listar_alterar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->listar_alterar_usuarios();
				
				// Após a execução da função "listar_usuarios" chame o "usuarios_form.php".				
				require('usuarios_editar_form.php');
			
	// Verifica se o valor da "acao" é igual a "gravar_alterar_usuarios".
	} else if($acao == 'gravar_alterar_usuarios') {
		
				// Executa a função "gravar_alterar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->gravar_alterar_usuarios();
				
				// Executa a função "listar_usuarios" existente dentro do arquivo "usuarios_manutencao.php".
				$oquefazer->listar_usuarios();
				
				// Após a execução da função "listar_usuarios" chame o "usuarios_lista.php".				
				require('usuarios_lista.php');
			
		
	}

?>