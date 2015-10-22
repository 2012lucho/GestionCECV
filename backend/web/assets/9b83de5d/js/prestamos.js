$(document).ready(function(){
	var r ="http://localhost/cecv/backend/web/index.php";
	InicializarBuscador('BuscaEstu',1,'Catálogo de libros','DatosUser','NombreyApellido',r,5
						
						);	
	InicializarBuscador('BuscaLib',1,'Catálogo de libros','Stock','Nombre',r,5
						);	
});