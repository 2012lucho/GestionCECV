const PeticionB="/rbusca"; //parte ruta peticion elementos filtrados

const NoOrdeanado="n";
const Ascendente="a";
const Descendente="d";

function ValoresDef(Elemento){
	$('#'+Elemento).data('Desplaza',0) 
	$('#'+Elemento).data('Orden',NoOrdeanado);  
	$('#'+Elemento).data('CantidadT',0);
}

function CreaVista(data,Elemento,n,CamposM,V){
	var clase='';
	for (item=0;item<data.length;item++){
		if (data[item]["CantidadDisponible"]!=0) {clase="NoCero";} else {clase="NCero";}
		var vista='';
		
		for (c=0;c<CamposM.length;c++) {
			vista+='<div><b>'+CamposM[c][1]+': </b>'+data[item][CamposM[c][0]];
			vista+='</div>';		
		}
		
		if (V['Control']!=''){
			vista+='</div><div class="col-xs-1"><input type='+V['Control']+'></div>';
		}		
		
		$('#'+Elemento+n).append('<div class="RegistroLib"><div class="col-xs-11">'+vista+'</div>');
	}
}

/*+'<div class="TituloLib">'+data[item]["Nombre"]+'</div>'
			+'<div class="AutorLib"><b>Autor: </b>'+data[item]["Autor"]+'</div>'
			+'<div class="DescripcionLib"><b>Descripción: </b>'+data[item]["Descripcion"]+'</div>'
			+'<div class="CantidadLib"><b>Cantidad disponible: <div class="'+clase+'">'+data[item]["CantidadDisponible"]+'</div></b></div>'
			*/

function MostrarInfoRes(data,n,RegistrosPag,Elemento){
	var mostrando=$('#'+Elemento).data('Desplaza')+RegistrosPag;
	if (mostrando>$('#'+Elemento).data('CantidadT') && $('#'+Elemento).data('CantidadT')!=0){mostrando=$('#'+Elemento).data('CantidadT');}
	$('#InfoResult'+n).html("Resultados: "+mostrando+" de "+data["CantTot"]);
	$('#'+Elemento).data('CantidadT',data["CantTot"]);
}

function ActualizaResultados(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista){
	//se actualizan la variable de desplazamiento y se procede a pedir datos si hay mas para pedir
	if ($('#'+Elemento).data('Desplaza')+RegistrosPag <= $('#'+Elemento).data('CantidadT')){ 
		$('#'+Elemento).data('Desplaza',$('#'+Elemento).data('Desplaza')+RegistrosPag);
		//se piden los demas datos
		$.get(Rweb+PeticionB,{TB:Termino, O:Orden, D:$('#'+Elemento).data('Desplaza'), C:RegistrosPag, T:Tabla, CB:CampoB},function (data) {		
			data = JSON.parse(data);
			MostrarInfoRes(data,n,RegistrosPag,Elemento);
			data = data["ResBusca"];			
			CreaVista(data,Elemento,n,CamposM,Vista);
		});		
	}
}

function Busqueda(Elemento,n,Orden,Termino,Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista){
	//se vacia el html de la caja que muestra los resultados
	$('#'+Elemento+n).html("");		
	// se piden los resultados al servidor
	$.get(Rweb+PeticionB,{TB:Termino, O:Orden, D:$('#'+Elemento).data('Desplaza'), C:RegistrosPag, T:Tabla, CB:CampoB},function (data) {		
		data = JSON.parse(data);
		MostrarInfoRes(data,n,RegistrosPag,Elemento,Vista);
		data = data["ResBusca"];			
		CreaVista(data,Elemento,n,CamposM,Vista);
	});		
}

//n es el numero de buscador
//camposM es el arreglo que se usa para definir los campos que se mostraran en la vista 
function InicializarBuscador(Config,CamposM,Vista){
	//Abrimos la configuracion
	var Elemento=Config['id'];
	var n=Config['n'];
	var Titulo=Config['Tit'];
	var Tabla=Config['Tabla'];
	var CampoB=Config['CampoB'];
	var Rweb=Config['RWeb'];
	var RegistrosPag=Config['CantR'];
	//Definimos los datos basicos de cada buscador
	$('#'+Elemento).data('Desplaza',0);        //Se usa para seguir trayendo registros a la vista
	$('#'+Elemento).data('Orden',NoOrdeanado); //Almacena el ordenamiento que hay ahora
	$('#'+Elemento).data('CantidadT',0);       //almacena la cantidad de registros totales
	$('#'+Elemento).data('Termino','');        //almacena el termino de busqueda
	//Armamos el encabezado del buscador	
	$('#'+Elemento).html("<div class='bEncab"+n+" bEncab col-xs-12'><div class='Btit col-xs-8'>"+Titulo+"</div></div>");
	//agregamos el control de buscqueda del encabezado
	$('.bEncab'+n).append("<div class='buscalib col-md-4 col-xs-6'>"
		+"<input type='text' id='ebusca"+n+"' class='ebusca' value='Busqueda por título'>"
		+" <input id='BBusca"+n+"' class='btn btn-default btn-xs' type='button' value='Ir'>"
		+" <input id='BOrdD"+n+"' class='btn btn-default btn-xs' type='button' value='&dArr;'>"	
		+" <input id='BOrdA"+n+"' class='btn btn-default btn-xs' type='button' value='&uArr;'>"	
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
	ValoresDef(Elemento);	
	Busqueda(Elemento,n,NoOrdeanado,"",Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista);
	
	//Definimos los eventos para los controles de busqueda
	$('#ebusca'+n).on('input',function(){ //cuando se modifica el control de busqueda se cambian los terminos
		$('#'+Elemento).data('Termino',encodeURIComponent($('#ebusca'+n).val()));
	});	
	
	$('#BBuscaMas'+n).on('click', function() { // si se apreta el boton de busqueda
		ActualizaResultados(Elemento,n,$('#'+Elemento).data('Orden'),$('#'+Elemento).data('Termino'),Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista);
	});
	
	$('#BBusca'+n).on('click', function() { // si se apreta el boton de busqueda
		ValoresDef(Elemento);$('#'+Elemento).data('Orden',NoOrdeanado);		
		Busqueda(Elemento,n,$('#'+Elemento).data('Orden'),$('#'+Elemento).data('Termino'),Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista);
	});
	
	$('#BOrdA'+n).on('click', function() { // si se apreta el boton ordenar ascendente
		ValoresDef(Elemento);$('#'+Elemento).data('Orden',Ascendente);
		Busqueda(Elemento,n,$('#'+Elemento).data('Orden'),$('#'+Elemento).data('Termino'),Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista);	
	});
	
	$('#BOrdD'+n).on('click', function() { // si se apreta el boton ordenar descendente
		ValoresDef(Elemento);$('#'+Elemento).data('Orden',Descendente);
		Busqueda(Elemento,n,Descendente,$('#'+Elemento).data('Termino'),Tabla,CampoB,RegistrosPag,Rweb,CamposM,Vista);
	});
	
	$('#ebusca'+n).on('click', function() { $('#ebusca'+n).val(''); }); //si se hace click
}
