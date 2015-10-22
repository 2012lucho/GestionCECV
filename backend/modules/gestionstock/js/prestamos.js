$(document).ready(function(){
	var r ="http://localhost/cecv/backend/web/index.php";
	InicializarBuscador({
							id:'BuscaLib',
							n:1,
							Tit:'Catálogo de libros',
							Tabla:'Stock',
							CampoB:'Nombre',
							RWeb:r,
							CantR:5,
						},
						[
							["Codigo","Código"], //campos, 1 Nombre campo, 2 Alias
							["Nombre","Nombre"],
							["Descripcion","Descripción"],
							["Autor","Autor"],
							["CantidadDisponible","Cantidad Disponible"],
						],
						{
							Control:'checkbox',//control
						}
						);	
	InicializarBuscador(
						{
							id:'BuscaEstu',
							n:2,
							Tit:'Estudiantes',
							Tabla:'DatosUser',
							CampoB:'NombreyApellido',
							RWeb:r,
							CantR:5,
						},						
						[
							["NombreyApellido","Nombre"], //campos, 1 Nombre campo, 2 Alias
							["DNI","DNI"],
							["Email","Correo electrónico"],
							["Telefono","Teléfono"],
						],
						{
							Control:'checkbox',
						}			
						);	
});