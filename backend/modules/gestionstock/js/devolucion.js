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

//esta función se llama como un "callback" de la de busqueda al
//apretar los checkbox del buscador de estudiantes
function BuscaIdPresta(Id){
	var IDUser=Id.data('Arreglo-Val')[0];
	//Actualizamos el arreglo de filtros
	InicBuscaPresta(['FechaDeb IS NULL && Prestamos.idUser='+IDUser]);
}
//esta función es llamada comon un "callback" de la busqueda al
//desabilitar el checkbox
function BlancIdPresta(){
	InicBuscaPresta(['FechaDeb IS NULL']);
}

function InicializarBuscadores() {
		InicBuscaPresta(['FechaDeb IS NULL']);

		InicializarBuscador(
						{
							id:IdSelecEstud,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
							CampoB:'NombreyApellido',CampoId:'IdUser',RWeb:r,CantR:5,
							Condiciones:'',
							FuncionControl:BuscaIdPresta,//FuncionControl:MostrarInfo,//función que se ejecuta al activar el checkbox
							FuncionControlD:BlancIdPresta,//FuncionControlD:InicInfoEstu,//función que se ejecuta al desactivar el checkbox
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
								campo:'',
								cfondo:'',//color resaltado, fondo
								condicion:'',
								valor:'', //valor con el que comparar el campo
								mensaje:'',//mensaje a incluir si se resalta por ej "Suspendido"
							},
							TextoDef:'Nombre', //texto por defecto del campo de busqueda
						}
						);
	}
	function InicBuscaPresta(Condicion){
		console.log(r);
			InicializarBuscador({
							id:IdSelecPrest,n:3,Tit:'Préstamos pendientes',Tabla:'Prestamos',
							CampoB:'idPresta',CampoId:'idPresta',RWeb:r,CantR:5,
							Condiciones:Condicion,
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
							Resaltar:{ //Especificamos el campo, condicion y color para resaltar
								campo:'',
								cfondo:'',//color resaltado, fondo
								condicion:'',
								valor:'', //valor con el que comparar el campo
								mensaje:'',//mensaje a incluir si se resalta por ej "Suspendido"
							},
							TextoDef:'Número de préstamo', //texto pr defecto del campo de busqueda
						}
			);
		}

$(document).ready(function(){
	r="../index.php";
	CanSelLib=$("#parametros").attr('data-CantLibSel');
	//Inicializamos control donde se muestra info delos estudiantes
	//InicInfoEstu();
	//Inicializamos controles de carga de información

	$('#CancelPrestamo').click(function () {
		//se cargan los parametros
		var ArPres=$('#'+IdSelecPrest).data('Arreglo-Val');
		//se comprueba que se hayan seleccionado estudiante y libro
		if (ArPres.length>0){
			ArPres=JSON.stringify(ArPres);
			//se hace la petición
			$.get(r+PeticionDev,{P:ArPres},function (data) {
				if (data == PetExitosa){
					$('#Notific > .mensaje').html(MensDebExit);
					$('#Notific > .mensaje').css('background',ColorExito);
					//reestablecemos los buscadores
	    			InicializarBuscadores();
				}
			});
		} else {
			$('#Notific > .mensaje').html(MensSelecPresta);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
	});
	//Inicializamos controles de búsqueda
	InicializarBuscadores();
});
