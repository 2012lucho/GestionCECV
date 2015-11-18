const IdHistPresta='InfoEstudiantes';
const r="/cecv/backend/web/index.php";

$(document).ready(function(){
	InicializarBuscador(
		{
			id:IdHistPresta,n:2,Tit:'Estudiantes',Tabla:'DatosUser',
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
			Control:'', //control asociado con registro
			MaxCantEleSele:'1',//maxima cantidad de elementos seleccionables
			Alto:'300px',
			TextoDef:'Nombre', //texto por defecto del campo de busqueda
		}			
	);
});