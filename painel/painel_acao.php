<?php

	// Importa o "painel_manutenção.php".
	require('painel_manutencao.php');
	
	// Instanciando a função "painel" e armazenando dentro da variável "$oquefazer".
	$oquefazer = new painel_manutencao();
	
	// A variável "$acao" recebe o valor "acao" passado na url como parâmetro.
	$acao = $_REQUEST['acao'];
		
	// Verifica se o valor de "acao" é igual a "listar".
	if($acao == 'listar') {
		
					
		// Executa a função "listar_chamados" existente dentro do arquivo "painel_manutencao.php".
		$oquefazer->listar_painel();			
		
		// Após a execução da função "listar_chamados" chame o "painel_lista.php".
		require('painel_lista.php');
		
	} 
	
?>