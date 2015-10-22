const PeticionB="/rbusca"; //parte ruta peticion elementos filtrados

const NoOrdeanado="n";
const Ascendente="a";
const Descendente="d";

var Desplaza=0; //Se usa para seguir trayendo registros a la vista
var Orden=NoOrdeanado;   //Almacena el ordenamiento que hay ahora
var CantidadT=0;       //almacena la cantidad de registros totales
var Termino="";        //almacena el termino de busqueda

function ValoresDef(){
	Desplaza=0; 
	Orden=NoOrdeanado;  
	CantidadT=0;
}

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

function MostrarInfoRes(data,n,RegistrosPag){
	var mostrando=Desplaza+RegistrosPag;
	if (mostrando>CantidadT && CantidadT!=0){mostrando=CantidadT;}
	$('#InfoResult'+n).html("Resultados: "+mostrando+" de "+data["CantTot"]);
	CantidadT=data["CantTot"];
}

function ActualizaResultados(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb){
	//se actualizan la variable de desplazamiento y se procede a pedir datos si hay mas para pedir
	if (Desplaza+RegistrosPag <= CantidadT){ 
		Desplaza+=RegistrosPag;
		//se piden los demas datos
		$.get(Rweb+PeticionB,{TB:Termino, O:Orden, D:Desplaza, C:RegistrosPag, T:Tabla, CB:CampoB},function (data) {		
			data = JSON.parse(data);
			MostrarInfoRes(data,n,RegistrosPag);
			data = data["ResBusca"];			
			CreaVista(data,Elemento,n)
		});		
	}
}

function Busqueda(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb){
	//se vacia el html de la caja que muestra los resultados
	$('#'+Elemento+n).html("");		
	// se piden los resultados al servidor
	$.get(Rweb+PeticionB,{TB:Termino, O:Orden, D:Desplaza, C:RegistrosPag, T:Tabla, CB:CampoB},function (data) {		
		data = JSON.parse(data);
		MostrarInfoRes(data,n,RegistrosPag);
		data = data["ResBusca"];			
		CreaVista(data,Elemento,n)
	});		
}

//n es el numero de buscador
function InicializarBuscador(Elemento,n,Titulo,Tabla,CampoB,Rweb,RegistrosPag){
	//Armamos el encabezado del buscador	
	$('#'+Elemento).html("<div class='bEncab"+n+" bEncab col-xs-12'><div class='Btit col-xs-8'>"+Titulo+"</div></div>");
	//agregamos el control de buscqueda del encabezado
	$('.bEncab'+n).append("<div class='buscalib col-xs-4'>"
		+"<input type='text' id='ebusca' value='Busqueda por título'>"
		+" <input id='BBusca' class='btn btn-default btn-xs' type='button' value='Ir'>"
		+" <input id='BOrdD' class='btn btn-default btn-xs' type='button' value='&dArr;'>"	
		+" <input id='BOrdA' class='btn btn-default btn-xs' type='button' value='&uArr;'>"	
		+"</div>");
	//Definimos la caja donde mostrar la informacion sobre resultado de busqueda
	$('#'+Elemento).append("<div class='col-xs-12'>"
		+"<p id='InfoResult"+n+"'></p>"
		+"</div>");
	//Definimos lacaja donde mostrar los resultados y la caja donde mostrar el "boton mas resultados"
	$('#'+Elemento).append("<div id='"+Elemento+n+"'></div>"
		+"<div class='col-xs-12 bFoot'>"
		+"<input id='BBuscaMas"+n+"' class='btn btn-default btn-xs' type='button' value='Más resultados'></div>");
	//Pedimos todos los datos y armamos la vista
	ValoresDef();	
	Busqueda(Elemento,n,NoOrdeanado,"",Tabla,CampoB,RegistrosPag,Rweb);
	
	//Definimos los eventos para los controles de busqueda
	$('#ebusca').on('input',function(){ //cuando se modifica el control de busqueda se cambian los terminos
		Termino=encodeURIComponent($('#ebusca').val());
	});	
	
	$('#BBuscaMas'+n).on('click', function() { // si se apreta el boton de busqueda
		ActualizaResultados(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb);
	});
	
	$('#BBusca').on('click', function() { // si se apreta el boton de busqueda
		ValoresDef();Orden=NoOrdeanado;		
		Busqueda(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb);
	});
	
	$('#BOrdA').on('click', function() { // si se apreta el boton ordenar ascendente
		ValoresDef();Orden=Ascendente;
		Busqueda(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb);	
	});
	
	$('#BOrdD').on('click', function() { // si se apreta el boton ordenar descendente
		ValoresDef();Orden=Descendente;
		Busqueda(Elemento,n,Descendente,Termino,Tabla,CampoB,RegistrosPag,Rweb);
	});
	
	$('#ebusca').on('click', function() { $('#ebusca').val(''); }); //si se hace click
}
