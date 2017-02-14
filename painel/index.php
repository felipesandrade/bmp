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

		Última atualização: 02/12/2016 as 08:00

		Descrição: sistema desenvolvido com a finalidade de gerenciar a fila de atendimentos dos médicos. 
            
		-->
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		
        <!-- Responsável por exibir um ícone na barra de título do navegador. -->        
		<link type="image/vnd.microsoft.icon" href="../imagens/favicon.ico" rel="shortcut icon"></link>
		
		<link type="text/css" rel="stylesheet" href="../style/css.css" media="all" />
        
        <link type="text/css" rel="stylesheet"  href="../scripts/jqueryui/css/dot-luv/jquery-ui-1.8.16.custom.css" media="screen"  />
                
        <title> Painel Web - SIGAM </title>
        
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
		
		<!-- Exibe Data e Hora -->
		<script type="text/javascript" src="../scripts/data_hora.js" charset="utf-8"></script>
		
		<!-- Tocar Audio -->
		<script type="text/javascript" src="../scripts/audio_play.js" charset="utf-8"></script>
		
		<script language="javascript" type="text/javascript"> carregandoAjax('verifica_acao_ajax.php', {tabela: 'painel', acao: 'listar' }); </script>
		
		<!-- Realiza o reload da página de 10 em 10 segundos utilizando Ajax -->	
		<script language="javascript" type="text/javascript"> setInterval("carregandoAjax('verifica_acao_ajax.php', {tabela: 'painel', acao: 'listar' })", 5000); </script>
		
		<!-- Realiza o reload da página de 10 em 10 segundos utilizando Ajax -->	
		<script language="javascript" type="text/javascript"> setInterval("play()", 100000); </script>
				           
    <!-- Fim Head. -->    
	</head>

	<body class="site-html" onload="startTime(); play();">
	
		<header class="logo">
		
			<img alt="Início" src="../imagens/logo.png"></img>
								
			<h2>Sistema Gerenciador de Avaliações Médicas - SIGAM</h2>

			<h2>Instituto Dr. José Frota</h2>
									
		</header>
		
		<div id="hora"></div>
			
		<div id="data"></div>
				
		<audio id="audio">	
		
			<source src="../som/dim.wav" type="audio/wav" />
		
		</audio>
		
        <!-- Inicio do conteúdo. -->
        <div class="corpo"> 

				
   																																
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
