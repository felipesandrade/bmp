// JavaScript Document

var codigo = " ";

function confirmar_exclusao_especialidades (codigo)
{
	
	if(confirm("Você realmente deseja excluir este registro?"))
	{
		
		carregandoAjax('verifica_acao_ajax.php', {tabela: 'especialidades', acao: 'excluir', codigo: codigo });
						
	}
	
}

function confirmar_exclusao_solicitantes (codigo)
{
	
	if(confirm("Você realmente deseja excluir este registro?"))
	{
	
		carregandoAjax('verifica_acao_ajax.php', {tabela: 'solicitantes', acao: 'excluir', codigo: codigo });
						
	}
	
}

function confirmar_exclusao_usuarios (codigo)
{
	
	if(confirm("Você realmente deseja excluir este registro?"))
	{
	
		carregandoAjax('verifica_acao_ajax.php', {tabela: 'usuarios', acao: 'excluir', codigo: codigo });
						
	}
	
}


function confirmar_atendimento_avaliacoes(codigo)
{
	
	if(confirm("Você realmente deseja confirmar o atendimento?"))
	{
	
		carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'atender', codigo: codigo });
						
	}
	
}

function confirmar_cancelamento_avaliacoes (codigo)
{
	
	if(confirm("Você realmente deseja confirmar o cancelamento?"))
	{
	
		carregandoAjax('verifica_acao_ajax.php', {tabela: 'avaliacoes', acao: 'cancelar', codigo: codigo });
						
	}
	
}

function direcionar_pagina_principal() {

	window.location = ("../index.php");	
	
}

// Função responsável pela seleção dos checkbox.
function seleciona(){
	
	var form = document.form_checked;
	
	for(i=1;i<form.elements.length;i++){
		
		if(form.elements[i].checked == false){
			
			form.elements[i].checked = true;
		
		} else{

			form.elements[i].checked = false;
		}
	
	}
}
	
function validar_especialidade() {
		
		var especialidade = form1.esp_nome.value;
						
		var div = document.getElementById("alerta");
		
		if(especialidade == "" || especialidade == null){
			
			div.innerHTML = "Preencha o campo com o nome da especialidade.";
						
			form1.esp_nome.focus();
			
			return false;		
						
		}
}

function validar_usuario(){
	
		var usuario = form1.usu_nome.value;
		
		var login = form1.usu_login.value;
		
		var senha = form1.usu_senha.value;
				
		var div = document.getElementById("alerta");
	
		if(usuario == "" || usuario == null){
			
			div.innerHTML = "Preencha o campo com o nome do usuário.";
						
			form1.usu_nome.focus();
			
			return false;

		} else if(login == "" || login == null) {
			
			div.innerHTML = "Preencha o campo com o login do usuário.";
			
			form1.usu_login.focus();
			
			return false;
			
		} else if(senha == "" || senha == null) {
		
			div.innerHTML = "Preencha o campo com a senha do usuário.";
			
			form1.usu_senha.focus();
			
			return false;
			
		} 
		
}	

function validar_editar_usuario(){
	
		var usuario = form1.usu_nome.value;
		
		var login = form1.usu_login.value;
						
		var div = document.getElementById("alerta");
	
		if(usuario == "" || usuario == null){
			
			div.innerHTML = "Preencha o campo com o nome do usuário.";
						
			form1.usu_nome.focus();
			
			return false;

		} else if(login == "" || login == null) {
			
			div.innerHTML = "Preencha o campo com o login do usuário.";
			
			form1.usu_login.focus();
			
			return false;
			
		} 
		
}

function validar_solicitantes() {
		
		var solicitantes = form1.und_nome.value;
						
		var div = document.getElementById("alerta");
		
		if(solicitantes == "" || solicitantes == null){
			
			div.innerHTML = "Preencha o campo com o nome do solicitante.";
						
			form1.und_nome.focus();
			
			return false;		
						
		}
}	

function validar_login() {
		
		var login = form_login.usu_login.value;
		
		var senha = form_login.usu_senha.value;
						
		var div = document.getElementById("alerta_login");
		
		if(login == "" || login == null){
			
			div.innerHTML = "Preencha o campo usuário.";
						
			form_login.usu_login.focus();
			
			return false;		
						
		} else if(senha == "" || senha == null) {
			
			div.innerHTML = "Preencha o campo senha.";
			
			form_login.usu_senha.focus();
			
			return false;
			
		} 
}	

function validar_avaliacoes() {
	
		var avaliacoes_pacientes = form_avaliacoes.cha_paciente.value;
		
		var avaliacoes_especialidade = form_avaliacoes.esp_codigo.value;
		
		var avaliacoes_unidades = form_avaliacoes.und_codigo.value;
						
		var div = document.getElementById("alerta");
		
		if(avaliacoes_pacientes == "" || avaliacoes_pacientes == null){
			
			div.innerHTML = "Preencha o campo paciente.";
						
			form_avaliacoes.cha_paciente.focus();
			
			return false;		
		
		} else if(avaliacoes_especialidade == "" || avaliacoes_especialidade == null){
			
			div.innerHTML = "Preencha o campo especialidade.";
						
			form_avaliacoes.esp_codigo.focus();
			
			return false;		
						
		} else if(avaliacoes_unidades == "" || avaliacoes_unidades == null) {
			
			div.innerHTML = "Preencha o campo solicitante.";
			
			form_avaliacoes.und_codigo.focus();
			
			return false;
			
		} 
		
}	


	
		