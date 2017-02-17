<?php

	// Chama a função sessao() e inicia.
	session_start();
			
	// Verifica se existe valor para a variável. Se não existir executa o código abaixo.
	if(!@$_SESSION['sessao_codigo_usuarios']){
	
		// Importa o arquivo "funcoes.php".
		require('../conexao_bd/funcoes.php');
		
		// Chama a função direcionar() e retorna para url "login_form.php".
		direcionar('login_form.php');
		
		// Sai.
		exit;
	
	// Se não executa o código abaixo.	
	} else {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" >

	<head>
    
		<!--

		Desenvolvedor: Felipe Viana
		
		Contato: (85) 98808.4593
		
		E-mail: felipes.andrade@gmail.com
		
		Título: Sistema de Gerenciamento de Filas - SGF

		Versão: 1.0
		
		Data: 15/11/2016 as 08:00

		Última atualização: 29/12/2016 as 08:00

		Descrição: sistema desenvolvido com a finalidade de gerenciar a fila de atendimentos dos médicos. 
            
		-->
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />                                     
        
        <!-- Responsável por exibir um ícone na barra de título do navegador. -->        
		<link type="image/vnd.microsoft.icon" href="../imagens/favicon.ico" rel="shortcut icon"></link>
		
		<link type="text/css" rel="stylesheet" href="../style/css.css" media="all" />
        
        <link type="text/css" rel="stylesheet"  href="../scripts/jqueryui/css/dot-luv/jquery-ui-1.8.16.custom.css" media="screen"  />
                
        <title> Sistema de Registro de Boletim Médico do Paciente </title>
        
        <script language="javascript" type="text/javascript" src="../scripts/jqueryui/js/jquery-1.6.2.min.js"> </script>
        
		<script type='text/javascript'>

			jQuery.noConflict();
            
		</script>
                                      
        <script language="javascript" type="text/javascript" src="../scripts/jqueryui/js/jquery-ui-1.8.16.custom.min.js"> </script>
                                                           
        <script language="javascript" type="text/javascript" src="../scripts/funcoes.js" charset="utf-8"> </script>
                
        
        <!-- Responsável por resolver problemas no menu drop down no Internet Explorer 6. -->
		<script language="javascript" type="text/javascript" src="../scripts/menu.js"> </script>
          
                
        <script language="javascript" type="text/javascript" src="../scripts/prototype.js" charset="utf-8"> </script>
        
        <script language="javascript" type="text/javascript" src="../scripts/funcoes_ajax.js" charset="utf-8"> </script>
                                                                                                    
    <!-- Fim Head. -->    
	</head>

	<body class="site-html">
	
		<header class="logo">
		
			<img alt="Início" src="../imagens/logo.png"></img>

			<h2>Instituto Dr. José Frota</h2>
			
			<div id="sistema">Sistema de Registro de Boletim Médico do Paciente</div>

		</header>
		        
        <!-- Inicio do conteúdo. -->
        <div class="corpo">
        
			<!-- Exibe background na parte superior do conteudo da página. -->
		
        
        <!-- Exibe o menu na parte esquerda da página. -->			
			<ul>	
			
				<li> <a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'principal' });" class="active" title="Home" alt="Home"> Home </a> </li>
												
				<li class="dropdown">
				
					<a href="javascript:void(0)" title="Cadastros" alt="Cadastros" class="dropbtn"> Cadastros </a> 
					
					<div class="dropdown-content">
				
						<a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'listar' });" title="Cadastrar Especialidades" alt="Cadastrar Especialidades"> Pacientes </a>
												
						<a href="#"  onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'usuarios', acao: 'listar' });"  title="Cadastrar Usuários" alt="Cadastrar Usuários"> Usuários </a>
				
					</div>

				</li>			
												
				<li> <a href="#" onclick="carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'listar' });" title="Gerenciar Avaliações" alt="Gerenciar Avaliações"> Gerenciar Avaliações </a> </li>
						
				<li> <a href="#" onclick="carregandoAjax('logoff.php');" title="Sair" alt="Sair"> Sair </a> </li>
			
			</ul>	
							
		</div>
        <!-- Responsável por exibir o conteúdo do site sem a necessidade do refresh/reload (Ajax). -->                           
        <div id="conteudo_ajax">
		        
        	<?php
		 	
			// Executa "principal.php".
			require('principal.php');
							
			?>
        
        </div>
                                   
        <!-- Responsável por exibir a imagem e o texto no radapé da página. -->                                  
      <div class="rodape">
	  
			<footer>

				<br>

				Instituto Dr. José Frota - Rua Barão do Rio Branco, 1816 - Centro - CEP: 60.025-061 - Fortaleza - CE

				<br>
				Geral: (85) 3255.5000 / Ouvidoria: (85) 3255.5166 / Serviço Social: (85) 3255.5037

				<br>

				<br>

			</footer>
        
            
      	<!-- Fim Div Rodapé. -->   
		</div>
         
        <!-- Fim Div Conteúdo. -->   
    	</div>
            
    <!-- Fim Body. -->   
	</body>

</html>

<?php
	
	// Fecha o else da sessão.
	}

?>
