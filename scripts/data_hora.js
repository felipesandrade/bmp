function startTime() {
	var today = new Date();
	var dia = today.getDate();
	if(dia < 10){
		dia = '0'+dia				
	}
	var mesCompleto = new Array();
		mesCompleto[0]= "Janeiro";
		mesCompleto[1]= "Fevereiro";
		mesCompleto[2]= "Março";
		mesCompleto[3]= "Abril";
		mesCompleto[4]= "Maio";
		mesCompleto[5]= "Junho";
		mesCompleto[6]= "Julho";
		mesCompleto[7]= "Agosto";
		mesCompleto[8]= "Setembro";
		mesCompleto[9]= "Outubro";
		mesCompleto[10]= "Novembro";
		mesCompleto[11]= "Dezembro";
	var mes = mesCompleto[today.getMonth()];
	var ano = today.getFullYear();
	var h = today.getHours();
	if(h < 10){
		h = '0'+h		
	}
	var m = today.getMinutes();
	var s = today.getSeconds();
	// add a zero in front of numbers<10
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById('hora').innerHTML=h+":"+m+":"+s;
	document.getElementById('data').innerHTML=dia+" de "+mes+" de "+ano;
	t = setTimeout('startTime()', 500);
}

function checkTime(i){
				 
	if (i < 10) {

		i = "0" + i;
				 
	}
					 
	return i;
			 
}