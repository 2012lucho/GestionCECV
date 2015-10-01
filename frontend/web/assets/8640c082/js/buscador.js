const RutaWeb="http://localhost/cecv/frontend/web/index.php";
const PeticionT="/rtodo"; //parte ruta peticion elementos sin filtrar
const PeticionB="/rbusca"; //parte ruta peticion elementos filtrados

const NoOrdeanado="n";
const Ascendente="a";
const Descendente="d";

function CreaVista(data,Elemento,n){
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

function MostrarInfoRes(data,n){
	var cant = data["CantTot"];
	$('#InfoResult'+n).html("Resultados: "+cant);
}

function Busqueda(Elemento,n,Orden){
	//se vacia el html de la caja que muestra los resultados
	$('#'+Elemento+n).html("");		
	// se piden los resultados al servidor
	$.get(RutaWeb+PeticionB,{TB:encodeURIComponent($('#ebusca').val()), O:Orden},function (data) {		
		data = JSON.parse(data);
		MostrarInfoRes(data,n);
		data = data["ResBusca"];			
		CreaVista(data,Elemento,n)
	});		
}

//n es el numero de buscador
function InicializarBuscador(Elemento,n,Titulo){
	//Armamos el encabezado del buscador	
	$('#'+Elemento).html("<div class='bEncab"+n+" bEncab col-xs-12'><div class='Btit col-xs-8'>"+Titulo+"</div></div>");
	//agregamos el control de buscqueda del encabezado
	$('.bEncab'+n).append("<div class='buscalib col-xs-4'>"
		+"<input type='text' id='ebusca' value='Busqueda por título'>"
		+" <input id='BBusca' class='CB' type='button' value='Ir'>"
		+" <input id='BOrdD' class='CB' type='button' value='&dArr;'>"	
		+" <input id='BOrdA' class='CB' type='button' value='&uArr;'>"	
		+"</div>");
	//Definimos la caja donde mostrar la informacion sobre resultado de busqueda
	$('#'+Elemento).append("<div class='col-xs-12'>"
		+"<p id='InfoResult"+n+"'></p>"
		+"</div>");
	//Definimos lacaja donde mostrar los resultados
	$('#'+Elemento).append("<div id='"+Elemento+n+"'></div>");
	//Pedimos todos los datos y armamos la vista
	$.get(RutaWeb+PeticionT,function (data) {		
		data = JSON.parse(data);
		MostrarInfoRes(data,n)
		data = data["ResBusca"];
		CreaVista(data,Elemento,n);
	});	
	//Definimos los eventos para los controles de busqueda
	$('#ebusca').on('input', function() { // si se modifica el contenido del campo de busqueda
			
	});
	
	$('#BBusca').on('click', function() { // si se apreta el boton de busqueda
		Busqueda(Elemento,n,NoOrdeanado);	
	});
	
	$('#BOrdA').on('click', function() { // si se apreta el boton ordenar ascendente
		Busqueda(Elemento,n,Ascendente);	
	});
	
	$('#BOrdD').on('click', function() { // si se apreta el boton ordenar descendente
		Busqueda(Elemento,n,Descendente);	
	});
	
	$('#ebusca').on('click', function() { $('#ebusca').val(''); });
}

$(document).ready(function () {
	InicializarBuscador('CatalogoLib',1,'Catálogo de libros');	
});