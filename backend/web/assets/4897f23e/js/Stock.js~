const IdHistPresta='InfoStock';
var r;

$(document).ready(function(){
	r=$("#parametros").attr('data-rweb')+"/backend/web/index.php";
	InicializarBuscador(
		{
			id:IdHistPresta,n:2,Tit:'Catálogo',Tabla:'Stock',
			CampoB:'Nombre',CampoId:'idStock',RWeb:r,CantR:5,
			Condiciones:'',							
			FuncionControl:'',//BuscaIdPresta,//función que se ejecuta al activar el checkbox
			FuncionControlD:'',//BlancIdPresta,//función que se ejecuta al desactivar el checkbox
			Action:"/rbusca",						
		},						
		[ 	 	  	 	 	 	 	
			["idStock","Número de libro"], //campos, 1 Nombre campo, 2 Alias
			["Codigo","Codigo"],
			["Nombre","Nombre"],
			["Autor","Autor"],
			["Cantidad","Cantidad"],
			["CantidadDisponible","Cantidad disponible"],
		],
		{
			Control:'checkbox', //control asociado con registro
			MaxCantEleSele:'1',//maxima cantidad de elementos seleccionables
			Alto:'300px',
			TextoDef:'Nombre', //texto por defecto del campo de busqueda
		}			
	);
});