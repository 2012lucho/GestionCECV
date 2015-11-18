var RutaWeb;

$(document).ready(function () {
	RutaWeb=$("#parametros").attr('data-rweb')+"/frontend/web/index.php";
	InicializarBuscador('CatalogoLib',1,'Catálogo de libros','Stock');	
});