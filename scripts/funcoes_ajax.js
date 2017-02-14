// JavaScript Document
function extraiScript(texto){
	// inicializa o inicio ><
	var ini = 0;
	// loop enquanto achar um script
	while (ini!=-1){
		// procura uma tag de script
		ini = texto.indexOf('<script', ini);
		// se encontrar
		if (ini >=0){
			// define o inicio para depois do fechamento dessa tag
			ini = texto.indexOf('>', ini) + 1;
			// procura o final do script
			var fim = texto.indexOf('</script>', ini);
			// extrai apenas o script
			codigo = texto.substring(ini,fim);
			// executa o script
			eval(codigo);
		}
	}
}

function carregandoAjax(url, parametros){
			
	new Ajax.Request(url, {

		encoding: 'windows-1252',
        
		method: 'POST',
        
		parameters: parametros,
 
        onSuccess: function(transport) {
        
			$('conteudo_ajax').innerHTML = transport.responseText;
			
			extraiScript(transport.responseText);
									
        }
            
	});
        
}

function formSubmit(form, action){
	
    fields = $(form).serialize().toQueryParams()
	
    carregandoAjax(action, fields)
		
}
