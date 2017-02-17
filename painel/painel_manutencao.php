<?php

	class painel_manutencao {
		
		// Vari�veis globais.
		var $resultado;
		var $registros;
		
		// M�todo construtor. Estabelece a conex�o.
		function painel_manutencao() {
		
			// Instancia uma nova conex�o a partir da vari�vel "$con" existente no arquivo "conecta.php".
			$this->con = new conexao_mysql();	
			
		}
		
		// Lista as fornecedors.
		function listar_painel() {
																						
					// Armazena a query sql na vari�vel "$sql".
					$sql = "select 
									 c.cha_codigo
									,date_format(c.cha_data_abertura, '%d/%m') as cha_data_abertura
									,date_format(c.cha_data_abertura, '%H:%i') as cha_hora_abertura
									,time_format(timediff(now(), c.cha_data_abertura), '%H:%i:%s') as tempo
									,case 
										  when time_format(timediff(now(), c.cha_data_abertura), '%H:%i:%s') <= '00:05:00' then 'green'
										  when time_format(timediff(now(), c.cha_data_abertura), '%H:%i:%s') >  '00:05:00' and time_format(timediff(now(), c.cha_data_abertura), '%H:%i') <=  '00:15:00'  then 'blue'
										  when time_format(timediff(now(), c.cha_data_abertura), '%H:%i:%s') >  '00:15:00' then 'red'
									 end  as cor_tempo
									,c.cha_paciente 
									,e.esp_nome
									,u.und_nome
									,s.sta_descricao
									,case u.und_nome
										when 'Sala de Reanimacao' then 'red'
									end as cor_unidade								
							from 
									tbl_avaliacoes c 
									inner join tbl_especialidades 	e	 on (c.esp_codigo = e.esp_codigo)
									inner join tbl_solicitantes     u	 on (c.und_codigo = u.und_codigo)
									inner join tbl_status		    s	 on (c.sta_codigo = s.sta_codigo)
							where	
									s.sta_id = 'P'
							order by 
									2 desc, 1 desc";
			
					// Armazena o resultado da execu��o da query sql na vari�vel "$resultado".
					$this->resultado = $this->con->banco->Execute($sql);
																								

		}			
						
}
	
?>