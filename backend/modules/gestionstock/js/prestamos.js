const IdSelecLibro='BuscaLib';
const IdSelecEstud='BuscaEstu';
const r="/cecv/backend/web/index.php";
const PeticionPre='';

$(document).ready(function(){
	//Inicializamos controles de carga de información
	$('#NuevoPrestamo').click(function () {
		//se hace la peticion
		/*$.get(Rweb+PeticionPre,{TB:Termino, O:Orden, D:$('#'+Elemento).data('Desplaza'), C:RegistrosPag, T:Tabla, CB:CampoB},function (data) {		
			data = JSON.parse(data);
			MostrarInfoRes(data,n,RegistrosPag,Elemento);
			data = data["ResBusca"];			
			CreaVista(data,Elemento,n,CamposM,Vista,Cindice);
		});		*/
	});
	$('#CancelPrestamo').click(function () {
	});
	//Inicializamos controles de búsqueda	
	InicializarBuscador({
							id:IdSelecLibro,n:1,Tit:'Catálogo de libros',Tabla:'Stock',
							CampoB:'Nombre',CampoId:'Codigo',RWeb:r,CantR:5,
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
							MaxCantEleSele:'2',//maxima cantidad de elementos seleccionables
							Alto:'300px', // definir altura fija de la caja
						}
						);	
	InicializarBuscador(
						{
							id:IdSelecEstud,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
							CampoB:'NombreyApellido',CampoId:'IdUser',RWeb:r,CantR:5,
						},						
						[
							["NombreyApellido","Nombre"], //campos, 1 Nombre campo, 2 Alias
							["DNI","DNI"],
							["Email","Correo electrónico"],
							["Telefono","Teléfono"],
						],
						{
							Control:'checkbox', //control asociado con registro
							MaxCantEleSele:'1',//maxima cantidad de elementos seleccionables
							Alto:'300px',
						}			
						);	
});