<?php

	//importamos el módulo del "buscador"
	use app\modules\buscador\IngresoDatos;
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);
	
	//importamos el módulo de ingreso de información
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	use app\modules\gestiondatos\DatosAsset;DatosAsset::register($this); 
	$this->title = 'Estudiantes, Información de contacto';
?>
<div class="oculto" id="parametros" data-rweb="<?= $Rweb; ?>"></div>
<div class="site-presta row">

	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-7">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-5 botonera" >
			<input id='Agregar' class='btn btn-success btn-xs' value='Agregar' <?php if (!$rango){echo "disabled='disabled'";} ?> type='button'>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' <?php if (!$rango){echo "disabled='disabled'";} ?> type='button'>
			<input id='Suspender' class='btn btn-warning btn-xs' value='Suspender' type='button'>
			<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' <?php if (!$rango){echo "disabled='disabled'";} ?> type='button'>		
					
		</div>	
	</div>	
	
	<div class="col-xs-12 ingresoInfo" id="ingInf">
		<div class="col-md-5">
			<div><b>Nombre y apellido: </b><input type="text" id="NombreyApellido"></div>
			<div><b>DNI: </b><input type="text" id="DNI"></div>
    	</div>
		<div class="col-md-5">    		
			<div><b>Correo electrónico: </b><input type="text" id="Email"></div>
			<div><b>Número de teléfono: </b><input type="text" id="Telefono"></div>
    	</div>
    	<div class="col-md-2">
    		<input id='Aceptar' class='btn btn-success btn-xs' value='Aceptar' type='button'>
        </div>
	</div>	
	
	<div class="col-xs-12 pad">
		<div id="InfoEstudiantes" class="bus"></div>
	</div>
</div>