const IdSelecLibro='BuscaLib';
const IdSelecEstud='BuscaEstu';
const r="/cecv/backend/web/index.php";
const PeticionPre='/apresta';
const PeticionDev='/adevol';

const PetExitosa='1';
const MensPetExit="Préstamo cargado correctamente";
const MensSeleccionar="Tiene que seleccionar al menos un estudiante y un libro";

$(document).ready(function(){
		
	//Inicializamos controles de carga de información
	$('#NuevoPrestamo').click(function () {
		var ArLib=$('#'+IdSelecLibro).data('Arreglo-Val');
		var ArEst=$('#'+IdSelecEstud).data('Arreglo-Val');
		//se comprueba que se hayan seleccionado estudiante y libro
		if (ArLib.length>0&&ArEst>0){
			//se hace la peticion
			ArLib=JSON.stringify(ArLib);
			ArEst=JSON.stringify(ArEst);
			$.get(r+PeticionPre,{L:ArLib,E:ArEst},function (data) {		
				//Se anuncia el resultado
				//data = JSON.parse(data);
				if (data == PetExitosa){alert(MensPetExit);}
			});
			//reestablecemos los buscadores
	    	InicializarBuscadores();		
		} else {
			alert(MensSeleccionar);		
		}
	});
	
	$('#CancelPrestamo').click(function () {
		//se hace la petición
		$.get(r+PeticionDev,{L:ArLib,E:ArEst},function (data) {		
			//Se anuncia el resultado
			//data = JSON.parse(data);
			//alert(data);
		});
	    //reestablecemos los buscadores
	    InicializarBuscadores();
	});
	//Inicializamos controles de búsqueda
	InicializarBuscadores();	
	function InicializarBuscadores() {
		InicializarBuscador({
							id:IdSelecLibro,n:1,Tit:'Catálogo de libros',Tabla:'Stock',
							CampoB:'Nombre',CampoId:'idStock',RWeb:r,CantR:5,
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
	}
});