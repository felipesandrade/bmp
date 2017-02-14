<?php
	
	// Importando a biblioteca ADODB para realizar conexão com banco de dados.
	require('adodb5/adodb.inc.php');
	
	// Importando o arquivo "funcoes.php" responsável pelo tratamento das mensagens de erro.
	require('../conexao_bd/funcoes.php');
	
	class conexao {
		
		var $tipo_banco	= "mysql";				// Banco de Dados. Ex.: Oracle, MSSQL, Postgres, Mysql...
		var $servidor	= "172.30.40.19";			// Local onde o banco de dados está armazenado/localizado.
		var $usuario 	= "root"; 				// Usuário de acesso ao banco de dados.
		var $senha		= "datasus"; 					// Senha de acesso ao banco de dados.	
		var $banco;						 	
		var $nome_banco	= "sgf";	// Nome do banco que será acessado.
		
		function conexao()	{
						
			// Faz a conexão com as bibliotecas do ADODB passando o tipo do banco.
			$this->banco = NewAdoConnection($this->tipo_banco);
			
			$this->banco->dialect = 3; 
						
			// Utilizado para debugar a aplicação durante o desenvolvimento. Trocar o valor para "false" quando o sistema estiver em produçãos.
			$this->banco->debug = false; 
			
			// Estabele a conexão com o banco de dados de acordo com os parâmetros passados.
			$this->banco->Connect($this->servidor, $this->usuario, $this->senha, $this->nome_banco); 
			
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET character_set_connection=utf8');
        	mysql_query('SET character_set_client=utf8');
        	mysql_query('SET character_set_results=utf8');
						
		}
		
	}
	
	// Instanciando a função "conexao()" na variável "$con".
	$con = new conexao();
	
	/*
	
	// Testando conexão com o banco de dados.	
	if($con)
	
		echo "conectou";
		
	else
	
		echo "não conectou";
		
	*/
	

?>