const IdHistPresta='HistorialPresta';
const ColorAlerta='#fdd';
const ColorExit='#dfd';
const ColorDeuda="#ddb";
const MensTodos="Mostrando todos los préstamos: Vencidos|Devueltos|Pendientes";
const MensPendiente="Mostrando préstamos Pendientes";
const MensVencido="Mostrando todos los préstamos Vencidos";
var r;

$(document).ready(function(){
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	$('#Todos').click(function () {
		InicBusca(['']);
		$('#Notific > .mensaje').html(MensTodos);
		$('#Notific > .mensaje').addClass('bg-success');
		$('#Notific > .mensaje').removeClass('bg-danger bg-primary');
	});
	
	$('#Adeudados').click(function () {
		InicBusca(['FechaDeb=0000-00-00']);
		$('#Notific > .mensaje').html(MensPendiente);
		$('#Notific > .mensaje').addClass('bg-primary');
		$('#Notific > .mensaje').removeClass('bg-success bg-danger');
	});
	
	$('#Vencidos').click(function () { //agregar comprobación de vencimiento
		InicBusca(['FechaDeb=0000-00-00 && DATE(FechaDebT) < DATE("'+$('#parametros').attr('data-fecha')+'")']);
		$('#Notific > .mensaje').html(MensVencido);
		$('#Notific > .mensaje').addClass('bg-danger');
		$('#Notific > .mensaje').removeClass('bg-success bg-warning bg-primary');
	});	
	InicBusca(['FechaDeb=0000-00-00 && DATE(FechaDebT) < DATE("'+$('#parametros').attr('data-fecha')+'")']);
	$('#Notific > .mensaje').html(MensVencido);
	$('#Notific > .mensaje').addClass('bg-danger');
	$('#Notific > .mensaje').removeClass('bg-success bg-primary');
	
	function InicBusca(Filtro) {
		InicializarBuscador(
			{
				id:IdHistPresta,n:2,Tit:'Historial de préstamos',Tabla:'Prestamos',
				CampoB:'idPresta',CampoId:'idPresta',RWeb:r,CantR:5,
				Condiciones:Filtro,							
				FuncionControl:'',//BuscaIdPresta,//función que se ejecuta al activar el checkbox
				FuncionControlD:'',//BlancIdPresta,//función que se ejecuta al desactivar el checkbox
				Action:"/lpresta",						
			},						
			[
				["idPresta","Número de préstamo"], //campos, 1 Nombre campo, 2 Alias
				["NombreyApellido","Estudiante"],
				["Nombre","Libro"],
				["FechaPresta","Fecha retiro"],
				["FechaDebT","Plazo devolución"],
				["FechaDeb","Fecha devolución"],
			],
			{
				Control:'', //control asociado con registro
				MaxCantEleSele:'1',//maxima cantidad de elementos seleccionables
				Alto:'300px',
				Resaltar:{ //Especificamos el campo, condicion y color para resaltar
					campo:'',
					cfondo:'',//color resaltado, fondo
					condicion:'',
					valor:'', //valor con el que comparar el campo
					mensaje:'',//mensaje a incluir si se resalta por ej "Suspendido"
				}, 
				TextoDef:"Número de préstamo", //texto por defecto del campo de busqueda
			}			
		);
	}
});
