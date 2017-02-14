<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../style/css.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../scripts/funcoes.js" charset="utf-8"> </script>

<script language="javascript" type="text/javascript" src="../scripts/prototype.js" charset="utf-8"> </script>
        
<script language="javascript" type="text/javascript" src="../scripts/funcoes_ajax.js" charset="utf-8"> </script>

<title> Sistema Gerenciador de Avaliações Médicas - SIGAM </title>

</head>

<body class="site-html">

	<header class="logo">
			
		<img alt="Início" src="../imagens/logo.png"></img>

		<h2>Instituto Dr. José Frota</h2>
		
		<div id="sistema">Sistema Gerenciador de Avaliações Médicas - SIGAM</div>

	</header>
	

	<form id="form_login" name="form_login" method="post" action="login_validacao.php">
	

	<div class="tela_login"> 
	
		<table>	

		<tr>
		
			<td ><label id="alerta_login"></label></td>

		</tr>		
			
		<tr>
		
			<td><label id="usuario">Usuário:</label></td>
		
		<tr>
			  
		<tr>
		
			<td><input name="usu_login" type="text" id="usu_login" maxlength="20" class="login" /> </td>
		
		</tr>
		
		<tr>
		
			<td><label id="senha">Senha:</label></td>
		
		</tr>
		
		<tr>
		
			<td><input name="usu_senha" type="password" id="usu_senha" maxlength="8" class="senha" /></td>
		
		</tr>
		
		<tr>
		
			<td><input type="submit" name="botao_acessar" id="logar" class="logar" value="Logar" onclick="return validar_login()" /></td>
		
		<tr>
		
		</table>
				  
	</div>
			
	</form>

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

</body>

</html>