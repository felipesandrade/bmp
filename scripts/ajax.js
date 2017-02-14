// Responsável pelo carregamento das páginas do site sem a necessidade de reload/refresh.

<!--
$(document).ready(

 function()

  {

	// Carregamos o conteúdo da home quando a página é carregada, ou seja, passamos a página que deve ser carregada ao abrir o site

	$("#conteudo_ajax").load("principal.php?p=historia_casa");

	// Ao clicar em algum link, o contúdo principal é modificado

	// de acordo como valor do atributo "href" de "A"

	$('a').click(

                 function()

	      {

		  var olink = $(this).attr("href");

		  $.ajax(

		  {

		  // Especificamos o método que queremos utilizar

			method: "get",

			// Especificamos o arquivo que vai processar a solicitação

			url: "principal.php",

			// A QUERY STRING contendo os dados necessários

			data: "p=" + olink,

			// O que deve acontecer antes de ser enviado

			beforeSend: function(){

			  // Mostra a mensagem de carregando

			  $("#carregando").show("fast");

			},

			// O que deve acontecer quando o processo estiver completo

			complete: function(){

			  // Oculta a mensagem carregando

			  $("#carregando").hide("slow");

			},

			// Se houve sucesso vamos carregar o resultado para o argumento

			// "conteúdo" para utilizá-lo onde desejarmos

			success: function(conteudo_ajax){

			  // Muda o html do div de acordo com o que foi carregado

			  $("#conteudo_ajax").html(conteudo_ajax);

			}

		  }

		);

	    // Cancela o efeito do atributo href

		return false;

	  }

	);

  }

 );
 
//-->