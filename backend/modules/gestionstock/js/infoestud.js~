const PrestaPend="/lpresta";

//inicializamos control de muestra de informacion estudiante
function InicInfoEstu(){
	var Id='InfoEstud';
	var ContHtml='';//variable que contendrá el codigo html del control
	ContHtml="<div id='InfEstEnc' class='bEncab col-xs-12'><div class='Btit col-xs-12'>Préstamos pendientes</div></div>";
	ContHtml+="<div class='col-xs-12'><p> </p></div>";	
	ContHtml+="<div id='InfoM' class='col-xs-12 cajares'></div>";
	//Creamos la estructura del control		
	$("#"+Id).html(ContHtml);
	//seteamos la altura del contrl
	$("#InfoM").css('height','300px');
	$("#InfEstEnc").css('height','50px');
}
	
function MostrarInfo(Elemento){
	$.get(r+PrestaPend,{E:JSON.stringify(Elemento.data('Arreglo-Val'))},function (data) {		
		InicInfoEstu('InfoEstud');		
		data = JSON.parse(data);
		for (item=0;item<data.length;item++){
			var vista='';
			
			vista+='<div><b>Id Prestamo: </b>'+data[item]['idPresta']+'</div>';
			vista+='<div><b>Nombre Libro: </b>'+data[item]['IdStock']+'</div>';
			vista+='<div><b>Fecha retiro: </b>'+data[item]['FechaPresta']+'</div>';	
			// creamos registro 
			$('#InfoM').append('<div class="RB col-xs-12"><div class="col-xs-11">'+vista+'</div>');		
		}
	});		
}
