const IdSelecLibro='BuscaLib';
const IdSelecEstud='BuscaEstu';
const IdSelecPrest='InfoEstud';

const r="/cecv/backend/web/index.php";
const PeticionPre='/apresta';
const PeticionDev='/adevol';

const PetExitosa='1';
const MensPetExit="Préstamo cargado correctamente";
const MensSeleccionar="Tiene que seleccionar al menos un estudiante y un libro";
const MensSelecPresta="Se debe seleccionar un número de préstamo";

const ColorAlerta='#fdd';
const ColorExito='#dfd';

function BuscaIdPresta(){
}

$(document).ready(function(){
	//Inicializamos control donde se muestra info delos estudiantes
	//InicInfoEstu();
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
				if (data == PetExitosa){
					$('#Notific > .mensaje').html(MensPetExit);
					$('#Notific > .mensaje').css('background',ColorExito);
				}
			});
			//reestablecemos los buscadores
	    	InicializarBuscadores();		
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
	});
	
	$('#CancelPrestamo').click(function () {
		//se cargan los parametros
		var ArPres=$('#'+IdSelecPrest).data('Arreglo-Val');
		//se comprueba que se hayan seleccionado estudiante y libro
		if (ArPres.length>0){
			ArPres=JSON.stringify(ArPres);
			//se hace la petición
			$.get(r+PeticionDev,{P:ArPres},function (data) {		
				//Se anuncia el resultado
				//data = JSON.parse(data);
				//alert(data);
			});
			//reestablecemos los buscadores
	    	InicializarBuscadores();
		} else {
			$('#Notific > .mensaje').html(MensSelecPresta);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
	});
	//Inicializamos controles de búsqueda
	InicializarBuscadores();	
	function InicializarBuscadores() {
		InicializarBuscador({
							id:IdSelecPrest,n:3,Tit:'Préstamos pendientes',Tabla:'Prestamos',
							CampoB:'idPresta',CampoId:'idPresta',RWeb:r,CantR:5,
							FuncionControl:'', //función que se ejecuta al activar el checkbox
							FuncionControlD:'',//función que se ejecuta al desactivar el checkbox
							Action:"/lpresta",						
						},
						[
							//campos, 1 Nombre campo, 2 Alias
							["idPresta","Número de préstamo"],
							["Nombre","Libro"],
							["NombreyApellido","Estudiante"],
							["FechaPresta","Fecha retiro"],
							["FechaDebT","Plazo de devolución"],
						],
						{
							Control:'checkbox',//control
							MaxCantEleSele:'3',//maxima cantidad de elementos seleccionables
							Alto:'300px', // definir altura fija de la caja
							TextoDef:'Número de préstamo', //texto pr defecto del campo de busqueda
						}
						);			
		InicializarBuscador({
							id:IdSelecLibro,n:1,Tit:'Catálogo de libros',Tabla:'Stock',
							CampoB:'Nombre',CampoId:'idStock',RWeb:r,CantR:5,
							FuncionControl:'', //función que se ejecuta al activar el checkbox
							FuncionControlD:'',//función que se ejecuta al desactivar el checkbox
							Action:"/rbusca",						
						},
						[
							//campos, 1 Nombre campo, 2 Alias
							["Nombre","Nombre"],
							["Descripcion","Descripción"],
							["Autor","Autor"],
							["CantidadDisponible","Cantidad Disponible"],
						],
						{
							Control:'checkbox',//control
							MaxCantEleSele:'2',//maxima cantidad de elementos seleccionables
							Alto:'300px', // definir altura fija de la caja
							TextoDef:'Nombre', //texto por defecto del campo de busqueda
						}
						);	
		InicializarBuscador(
						{
							id:IdSelecEstud,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
							CampoB:'NombreyApellido',CampoId:'IdUser',RWeb:r,CantR:5,
							FuncionControl:'',//FuncionControl:MostrarInfo,//función que se ejecuta al activar el checkbox
							FuncionControlD:'',//FuncionControlD:InicInfoEstu,//función que se ejecuta al desactivar el checkbox
							Action:"/rbusca",						
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
							TextoDef:'Nombre', //texto por defecto del campo de busqueda
						}			
						);	
	}
});