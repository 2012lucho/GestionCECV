const MensSeleccionar="Tiene que seleccionar al menos un estudiante";
const MensEliExit="Estudiante eliminado correctamente";
const ColorAlerta='#fdd';
const ColorExito='#dfd';

const IdSelEstud='InfoEstudiantes';
var r;

const PeticionEli='/eliestu';

$(document).ready(function(){
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	$('#Agregar').click(function () {
		IniBusEst();		
	});
	$('#Modificar').click(function () {
		IniBusEst();		
	});
	$('#Suspender').click(function () {
		IniBusEst();		
	});
	$('#Eliminar').click(function () {
		var ArEst=$('#'+IdSelEstud).data('Arreglo-Val');
		if (ArEst.length>0){
			$.get(r+PeticionEli,{id:ArEst[0]},function (data) {		
				//Se anuncia el resultado
				//data = JSON.parse(data);
				if (data == PetExitosa){
					$('#Notific > .mensaje').html(MensEliExit);
					$('#Notific > .mensaje').css('background',ColorExito);
					//reestablecemos los buscadores
	    			IniBusEst();	
				}
			});
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
				
	});
	
	IniBusEst();
	function IniBusEst(){
		InicializarBuscador(
			{
				id:IdSelEstud,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
				CampoB:'NombreyApellido',CampoId:'IdUser',RWeb:r,CantR:5,
				Condiciones:'',							
				FuncionControl:'',//BuscaIdPresta,//función que se ejecuta al activar el checkbox
				FuncionControlD:'',//BlancIdPresta,//función que se ejecuta al desactivar el checkbox
				Action:"/rbusca",						
			},						
			[ 	 	 	
				["IdUser","Número de estudiante"], //campos, 1 Nombre campo, 2 Alias
				["NombreyApellido","Nombre y apellido"],
				["DNI","DNI"],
				["Email","Correo electrónico"],
				["Telefono","Número de teléfono"],
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