const IdBusUsr='InfoUser';
var r;

const MensSeleccionar="Tiene que seleccionar un usuario";
const MensEliExit="Usuario eliminado correctamente";
const MensEstAgre="Registro exitoso";
const ColorAlerta='#fdd';
const ColorExit='#dfd';

const PeticionEli='/elilib';
const PeticionInf='/infousr';
const PeticionEdi='/editausr';

const CreaLib="1";
const ModiLib="2";

$(document).ready(function(){
	//eventos y funciones del formulario
	function InicForm(){
		$('#id').val("");
		$('#username').val("");
		$('#email').val("");
		$('#rango').val("");
	}	
	//id	username 	email 	rango 	 	
	function CreaNuevo() {
		$.post(r+PeticionInf,{id:ID},function (data) {
			data = JSON.parse(data);
			$('#id').val(data['id']);
			$('#username').val(data['username']);
			$('#email').val(data['email']);
			$('#rango').val(data['rango']);
		});
	}
	
	function Actualizar(ID) {
		$.post(r+PeticionInf,{id:ID},function (data) {
			data = JSON.parse(data);
			$('#id').val(data['id']);
			$('#username').val(data['username']);
			$('#email').val(data['email']);
			$('#rango').val(data['rango']);
		});
	}	
	
	$('#Aceptar').click(function () {
		if($('#ingInf').data('peticion')==ModiLib){
			var ArLib=$('#'+IdBusUsr).data('Arreglo-Val');
			$.post(r+PeticionEdi,{
				id:ArLib[0],
				username:$('#username').val(),
				email:$('#email').val(),
				rango:$('#rango').val()},
				function (data) {
					if (data==1){
						$('#Notific > .mensaje').html(MensEstAgre);
						$('#Notific > .mensaje').css('background',ColorExit);
						IniBusLib();
					} else {
						if (data==3){
							$('#Notific > .mensaje').html('El rango solo puede ser 0 (Administrador) o 1 (Operador)');
							$('#Notific > .mensaje').css('background',ColorExit);
							IniBusLib();
						}
					}
				});
		}		
		
		InicForm();
		$('#ingInf').css('display','none');
	});
	//eventos botonera	
	$('#Modificar').click(function () {
		var ArLib=$('#'+IdBusUsr).data('Arreglo-Val');
		if (ArLib.length>0){		
			$('#ingInf').css('display','block');	
			$('#ingInf').data('peticion',ModiLib);	
			
			Actualizar(ArLib[0]);
			//
			//IniBusEst();		
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}		
				
	});
	
	$('#Eliminar').click(function () {
		var ArLib=$('#'+IdBusUsr).data('Arreglo-Val');
		if (ArLib.length>0){
			$.get(r+PeticionEli,{id:ArLib[0]},function (data) {		
				//Se anuncia el resultado
				//data = JSON.parse(data);
				if (data == PetExitosa){
					$('#Notific > .mensaje').html(MensEliExit);
					$('#Notific > .mensaje').css('background',ColorExito);
					//reestablecemos los buscadores
	    			IniBusLib();	
				}
			});
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}
				
	});	
	
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	IniBusLib();
	function IniBusLib(){	
		InicializarBuscador(
			{
				id:IdBusUsr,n:2,Tit:'Usuarios registrados',Tabla:'user',
				CampoB:'username',CampoId:'id',RWeb:r,CantR:5,
				Condiciones:'',							
				FuncionControl:'',//BuscaIdPresta,//función que se ejecuta al activar el checkbox
				FuncionControlD:'',//BlancIdPresta,//función que se ejecuta al desactivar el checkbox
				Action:"/rbusca",						
			},						
			[ 	 	  	 	 	 //id	username 	email 	rango 	 	
				["id","Número de usuario"], //campos, 1 Nombre campo, 2 Alias
				["username","Nombre"],
				["email","Correo electrónico"],
				["rango","Rango"],
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
});