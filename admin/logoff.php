<script language="javascript" type="text/javascript" src="../scripts/prototype.js" charset="utf-8"> </script>
        
<script language="javascript" type="text/javascript" src="../scripts/funcoes_ajax.js" charset="utf-8"> </script>

<?php

	// Chama a função sessão e inicia.
	session_start();

	// Apaga as variável de sessão "sessao_codigo_usuario".
	unset($_SESSION['sessao_codigo_operador']);
	
	// Apaga as variável de sessão "sessao_nome_usuario".
	unset($_SESSION['sessao_nome_operador']);
		
	// Destroe a sessão.
	session_destroy();
	
	// Importa o arquivo "funcoes.php".
	require('../conexao_bd/funcoes.php');
	
	// Chama a função direcionar() e direciona para a url passada como parâmetro.
	direcionar('login_form.php');
	
	// Sai.
	exit;

?>