const IdBusLibro='InfoStock';
var r;

const MensCamposRec="Se deben completar todos los campos";
const MensSeleccionar="Tiene que seleccionar un libro";
const MensEliExit="Libro eliminado correctamente";
const MensEstAgre="Registro exitoso";
const ColorAlerta='#fdd';
const ColorExit='#dfd';

const PeticionEli='/elilib';
const PeticionInf='/infolib';
const PeticionNus='/nuevolib';
const PeticionEdi='/editalib';

const CreaLib="1";
const ModiLib="2";

$(document).ready(function(){
	//eventos y funciones del formulario
	function InicForm(){
		$('#Nombre').val("");
		$('#Descripcion').val("");
		$('#Autor').val("");
		$('#Cantidad').val("");
		$('#CantidadAAgregar').val("0");
	}

	function CreaNuevo() {
		$.post(r+PeticionInf,{id:ID},function (data) {
			data = JSON.parse(data);
			$('#Nombre').val(data['Nombre']);
			$('#Descripcion').val(data['Descripcion']);
			$('#Autor').val(data['Autor']);
			$('#Cantidad').val(data['Cantidad']);
		});
	}

	function Actualizar(ID) {
		$.post(r+PeticionInf,{id:ID},function (data) {
			data = JSON.parse(data);
			$('#Nombre').val(data['Nombre']);
			$('#Descripcion').val(data['Descripcion']);
			$('#Autor').val(data['Autor']);
			$('#Cantidad').val(data['Cantidad']);
		});
	}

	$('#Aceptar').click(function () {
		if($('#ingInf').data('peticion')==CreaLib){
			$.post(r+PeticionNus,{
				Nombre:$('#Nombre').val(),
				Descripcion:$('#Descripcion').val(),
				Autor:$('#Autor').val(),
				Cantidad:$('#Cantidad').val()},
				function (data) {
					//Se anuncia el resultado de la petición
					data = JSON.parse(data);
					switch(data["codigo"]) {
						case "1": //si la carga fue exitosa
							$('#Notific > .mensaje').html(data["detalles"]);
							$('#Notific > .mensaje').css('background',ColorExit);
							BorrayEscondeFormulario();
							IniBusLib();
							break;
						case "2": //si no se completaron todos los campos
							$('#Notific > .mensaje').html(data["detalles"]);
							$('#Notific > .mensaje').css('background',ColorAlerta);
							break;
						case "3": //si hubo un error al guardar
							$('#Notific > .mensaje').html(data["detalles"]);
							$('#Notific > .mensaje').css('background',ColorAlerta);
							break;
					}
			});
		} else {
			if($('#ingInf').data('peticion')==ModiLib){
				var ArLib=$('#'+IdBusLibro).data('Arreglo-Val');
				$.post(r+PeticionEdi,{
					id:ArLib[0],
					Nombre:$('#Nombre').val(),
					Descripcion:$('#Descripcion').val(),
					Autor:$('#Autor').val(),
					Cantidad:$('#Cantidad').val(),
					CantidadAAgregar:$('#CantidadAAgregar').val(),
					},
					function (data) {
						//Se anuncia el resultado de la petición
						data = JSON.parse(data);
						switch(data["codigo"]) {
							case "1": //si la carga fue exitosa
								$('#Notific > .mensaje').html(data["detalles"]);
								$('#Notific > .mensaje').css('background',ColorExit);
								BorrayEscondeFormulario();
								IniBusLib();
								break;
							case "3": //si hubo un error al guardar
								$('#Notific > .mensaje').html(data["detalles"]);
								$('#Notific > .mensaje').css('background',ColorAlerta);
								break;
						}
					});
			}
		}

	});

	function BorrayEscondeFormulario(){
		InicForm();
		$('#ingInf').css('display','none');
		$('#cont-input-cantidad').css('display','none');
		$('#cont-mod-cantidad').css('display','none');
	}

	//eventos botonera
	$('#Agregar').click(function () {
		$('#ingInf').css('display','block');
		$('#ingInf').data('peticion',CreaLib);
		$('#cont-input-cantidad').css('display','block');
		$('#cont-mod-cantidad').css('display','none');
		InicForm();
		IniBusLib();
	});
	$('#Modificar').click(function () {
		var ArLib=$('#'+IdBusLibro).data('Arreglo-Val');
		if (ArLib.length>0){
			$('#ingInf').css('display','block');
			$('#ingInf').data('peticion',ModiLib);
			Actualizar(ArLib[0]);
			$('#cont-input-cantidad').css('display','none');
			$('#cont-mod-cantidad').css('display','block');
			//$('#Notific > .mensaje').html('Si se ingresa un número negativo en la casil');
			//$('#Notific > .mensaje').css('background',ColorExito);
			//
			//IniBusEst();
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}

	});

	$('#Eliminar').click(function () {
		var ArLib=$('#'+IdBusLibro).data('Arreglo-Val');
		if (ArLib.length>0){
			$.get(r+PeticionEli,{id:ArLib[0]},function (data) {
				//Se anuncia el resultado
				//data = JSON.parse(data);
				if (data == 1){
					$('#Notific > .mensaje').html(MensEliExit);
					$('#Notific > .mensaje').css('background',ColorExit);
					//reestablecemos los buscadores
	    			IniBusLib();
				}
			});
		} else {
			$('#Notific > .mensaje').html(MensSeleccionar);
			$('#Notific > .mensaje').css('background',ColorAlerta);
		}

	});

	InicForm();

	r="../index.php";
	IniBusLib();
	function IniBusLib(){
		InicializarBuscador(
			{
				id:IdBusLibro,n:2,Tit:'Catálogo',Tabla:'Stock',
				CampoB:'Nombre',CampoId:'idStock',RWeb:r,CantR:5,
				Condiciones:'',
				FuncionControl:'',//BuscaIdPresta,//función que se ejecuta al activar el checkbox
				FuncionControlD:'',//BlancIdPresta,//función que se ejecuta al desactivar el checkbox
				Action:"/rbusca",
			},
			[
				["idStock","Número de libro"], //campos, 1 Nombre campo, 2 Alias
				["Nombre","Nombre"],
				["Autor","Autor"],
				["Cantidad","Cantidad"],
				["CantidadDisponible","Cantidad disponible"],
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
