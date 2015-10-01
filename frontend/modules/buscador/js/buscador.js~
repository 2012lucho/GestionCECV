const RutaWeb="http://localhost/cecv/frontend/web/index.php";
const PeticionT="/rtodo"; //parte ruta peticion elementos sin filtrar
const PeticionB="/rbusca"; //parte ruta peticion elementos filtrados

function CreaVista(data,Elemento,n){
	data = JSON.parse(data);		
	var clase='';
	for (item=0;item<data.length;item++){
		if (data[item]["CantidadDisponible"]!=0) {clase="NoCero";} else {clase="NCero";}
		$('#'+Elemento+n).append(
			'<div class="RegistroLib">'
			+'<div class="TituloLib">'+data[item]["Nombre"]+'</div>'
			+'<div class="AutorLib"><b>Autor: </b>'+data[item]["Autor"]+'</div>'
			+'<div class="DescripcionLib"><b>Descripción: </b>'+data[item]["Descripcion"]+'</div>'
			+'<div class="CantidadLib"><b>Cantidad disponible: <div class="'+clase+'">'+data[item]["CantidadDisponible"]+'</div></b></div>'
			+'</div>');
	}
}

//n es el numero de buscador
function InicializarBuscador(Elemento,n,Titulo){
	//Armamos el encabezado del buscador	
	$('#'+Elemento).html("<div class='bEncab"+n+" bEncab col-xs-12'><div class='Btit col-xs-8'>"+Titulo+"</div></div>");
	//agregamos el control de buscqueda del encabezado
	$('.bEncab'+n).append("<div class='buscalib col-xs-4'>"
		+"<input type='text' id='ebusca' value='Busqueda'>"
		+" <input id='BBusca' class='BInB CB' type='button' value='Ir'>"
		+" <input id='BBusca' class='BOrd CB' type='button' value='&dArr;'>"	
		+" <input id='BBusca' class='BOra CB' type='button' value='&uArr;'>"	
		+"</div>");
	//Definimos lacaja donde mostrar los resultados
	$('#'+Elemento).append("<div id='"+Elemento+n+"'></div>");
	//Pedimos todos los datos y armamos la vista
	$.get(RutaWeb+PeticionT,function (data) {		
		CreaVista(data,Elemento,n);
	});	
	//Definimos los eventos para los controles de busqueda
	$('#ebusca').on('input', function() { // si se modifica el contenido del campo de busqueda
			
	});
	
	$('#BBusca').on('click', function() { // si se apreta el boton de busqueda
		//se vacia el html de la caja que muestra los resultados
		$('#'+Elemento+n).html("");		
		// se piden los resultados al servidor
		$.get(RutaWeb+PeticionB,{TB:encodeURIComponent($('#ebusca').val())},function (data) {		
			CreaVista(data,Elemento,n)
		});			
	});
	$('#ebusca').on('click', function() { $('#ebusca').val(''); });
}

$(document).ready(function () {
	InicializarBuscador('CatalogoLib',1,'Catálogo de libros');	
});