<div class="painel">
    
	  <table>
	  
		  <tr class="cabecalho" height="60">  
		 
			<th width="130">Data</th>
			
			<th width="130">Hora</th>
			
			<th width="180">Tempo</th>
			
			<th width="480">Paciente</th>
			
			<th width="430">Especialidade</th>
			
			<th width="430">Solicitante</th>
						
		  </tr>
			
	  <?php
			
			// Pega os registros e armazena na variável "$registros".
			while(@$oquefazer->registros = @$oquefazer->resultado->FetchNextObject()) {
				
		?>
			  
		  <tr id="linhas" class="destaque">   
		  
				<td> <?php echo $oquefazer->registros->CHA_DATA_ABERTURA; ?> </td> 
		  
				<td> <?php echo $oquefazer->registros->CHA_HORA_ABERTURA; ?> </td> 
				
				<td style="color:<?php echo $oquefazer->registros->COR_TEMPO; ?>"> <?php echo $oquefazer->registros->TEMPO; ?> </td> 
				
				<td> <?php $cha_paciente = $oquefazer->registros->CHA_PACIENTE; $cha_paciente = ucwords(mb_strtolower($cha_paciente, 'UTF-8')); echo $cha_paciente; ?> </td> 
			
				<td> <?php $esp_nome = $oquefazer->registros->ESP_NOME; $esp_nome = ucwords(mb_strtolower($esp_nome, 'UTF-8')); echo $esp_nome; ?> </td> 
				
				<td style="color:<?php echo $oquefazer->registros->COR_UNIDADE; ?>"> <?php $und_nome = $oquefazer->registros->UND_NOME; $und_nome = ucwords(mb_strtolower($und_nome, 'UTF-8')); echo $und_nome; ?> </td> 
														 
		  </tr>
		 
	  <?php } ?>
	  
	  </table>
  
  
</div>