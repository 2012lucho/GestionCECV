$(document).ready(function(){
	var r ="http://localhost/cecv/backend/web/index.php";
	InicializarBuscador('BuscaLib',1,'Catálogo de libros','Stock','Nombre',r,5,
						[
							["Codigo","Código"], //campos, 1 Nombre campo, 2 Alias
							["Nombre","Nombre"],
							["Descripcion","Descripción"],
							["Autor","Autor"],
							["CantidadDisponible","Cantidad Disponible"],
						]
						);	
	InicializarBuscador('BuscaEstu',2,'Estudiantes','DatosUser','NombreyApellido',r,5,
						[
							["NombreyApellido","Nombre"], //campos, 1 Nombre campo, 2 Alias
							["DNI","DNI"],
							["Email","Correo electrónico"],
							["Telefono","Teléfono"],
						]						
						);	
});