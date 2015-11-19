const IdHistPresta='HistorialPresta';
var r;

$(document).ready(function(){
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	$('#Todos').click(function () {
		InicBusca(['']);
	});
	
	$('#Adeudados').click(function () {
		InicBusca(['FechaDeb=0000-00-00']);
	});
	
	$('#Vencidos').click(function () { //agregar comprobación de vencimiento
		InicBusca(['FechaDeb=0000-00-00 && DATE(FechaDebT) < DATE("'+$('#parametros').attr('data-fecha')+'")']);//+);
	});	
	InicBusca(['']);
	
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
				["idUser","Estudiante"],
				["IdStock","Libro"],
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
				TextoDef:'Número de préstamo', //texto por defecto del campo de busqueda
			}			
		);
	}
});
