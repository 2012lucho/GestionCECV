const r="/cecv/backend/web/index.php";
const ColorAlerta='#fdd';
const ColorExito='#dfd';
const MensExit="Configuración guardada correctamente";
const Peticion='/guardaop';
$(document).ready(function(){
	$('#GuardaOpcio').click(function () {
		//creamos JSON con los valores de configuración
		var Opcio={cod:[],val:[]};
		$('.conf-C').each(function(index){
			Opcio['cod'].push($(this).attr('id'));
			Opcio['val'].push($(this).val());
		});
		//hacemos petición carga de datos	
		$.get(r+Peticion,{OPC:JSON.stringify(Opcio['cod']),OPV:JSON.stringify(Opcio['val'])},function (data) {		
			//Se anuncia el resultado
			//data = JSON.parse(data);
			if (data == 1){
				$('#Notific > .mensaje').html(MensExit);
				$('#Notific > .mensaje').css('background',ColorExito);	
			}
		});	
	});
});