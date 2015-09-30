const RutaWeb="http://localhost/cecv/frontend/web/index.php";
const PeticionT="/rtodo";

//n es el numero de buscador
function InicializarBuscador(Elemento,n,Titulo){
	//Armamos el encabezado del buscador	
	$('#'+Elemento).html("<div class='bEncab"+n+" bEncab col-xs-12'><div class='Btit col-xs-8'>"+Titulo+"</div></div>");
	//agregamos el control de buscqueda del encabezado
	$('.bEncab'+n).append("<div class='buscalib col-xs-4'><input type='text' id='ebusca' value='Busqueda'> <a id='lbusca'><input type='button' value='Ir'></a></div>");
	//Definimos lacaja donde mostrar los resultados
	$('#'+Elemento).append("<div id='"+Elemento+n+"'></div>");
	//Pedimos todos los datos y armamos la vista
	$.get(RutaWeb+PeticionT,function (data) {		
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
	});	
	//Definimos los eventos
}

$(document).ready(function () {
	InicializarBuscador('CatalogoLib',1,'Catálogo de libros');	
	
	$('#ebusca').on('input', function() {
		$('#lbusca').attr('href','http://localhost/cecv/frontend/web/index.php/busca/'+encodeURIComponent($('#ebusca').val()));
	});
	$('#ebusca').on('click', function() {
		$('#ebusca').val('')		
	});
});