const IdSelecLibro='BuscaLib';
const IdSelecEstud='BuscaEstu';
const IdSelecPrest='InfoEstud';

var r;
var CanSelLib=1;

const PeticionPre='/apresta';
const PeticionDev='/adevol';

const PetExitosa='1';
const MensPetExit="Préstamo cargado correctamente";
const MensDebExit="Devolución cargada correctamente";
const MensSeleccionar="Tiene que seleccionar al menos un estudiante y un libro";
const MensUsrSusExit="Estudiante suspendido, no se puede cargar el préstamo";
const MensSelecPresta="Se debe seleccionar un número de préstamo";

const ColorAlerta='#fdd';
const ColorExito='#dfd';

function InicializarBuscadores() {
		InicializarBuscador({
							id:IdSelecLibro,n:1,Tit:'Catálogo de libros',Tabla:'Stock',
							CampoB:'Nombre',CampoId:'idStock',RWeb:r,CantR:5,
							Condiciones:'',							
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
							MaxCantEleSele:CanSelLib,//maxima cantidad de elementos seleccionables
							Alto:'300px', // definir altura fija de la caja
							Resaltar:{ //Especificamos el campo, condicion y color para resaltar
								campo:'',
								cfondo:'',//color resaltado, fondo
								condicion:'',
								valor:'', //valor con el que comparar el campo
								mensaje:'',//mensaje a incluir si se resalta por ej "Suspendido"
							}, 
							TextoDef:'Nombre', //texto por defecto del campo de busqueda
						}
						);	
		InicializarBuscador(
						{
							id:IdSelecEstud,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
							CampoB:'NombreyApellido',CampoId:'IdUser',RWeb:r,CantR:5,
							Condiciones:'',							
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
							Resaltar:{ //Especificamos el campo, condicion y color para resaltar
								campo:'Suspendido',
								cfondo:'#fcc',//color resaltado, fondo
								condicion:'=',
								valor:'1', //valor con el que comparar el campo
								mensaje:'<b class="rojo">Suspendido</b>',//mensaje a incluir si se resalta por ej "Suspendido"
							}, 
							TextoDef:'Nombre', //texto por defecto del campo de busqueda
						}			
						);	
	}

$(document).ready(function(){
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	CanSelLib=$("#parametros").attr('data-CantLibSel');
	
	//Evento del botón nuevo préstamo
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
				data = JSON.parse(data);
				if (data["codigo"] == PetExitosa){
					$('#Notific > .mensaje').html(data["detalles"]);
					$('#Notific > .mensaje').css('background',data["color"]);
					//reestablecemos los buscadores
	    			InicializarBuscadores();	
				} else {
					if (data["codigo"] == 2){
						$('#Notific > .mensaje').html(data["detalles"]);
						$('#Notific > .mensaje').css('background',data["color"]);
						//reestablecemos los buscadores
	    				InicializarBuscadores();
					}
				}
			});	
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
	});
	
	//Inicializamos controles de búsqueda
	InicializarBuscadores();	
});