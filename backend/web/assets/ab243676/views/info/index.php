<?php

	//importamos el módulo del "buscador"
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

	use app\modules\gestiondatos\DatosAsset;DatosAsset::register($this); 
	$this->title = 'Estudiantes, Información de contacto';
?>
<div class="oculto" id="parametros" data-rweb="<?= $Rweb; ?>"></div>
<div class="site-presta row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-8">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-4 botonera" >
			<input id='Agregar' class='btn btn-success btn-xs' value='Agregar' type='button'>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' type='button'>
			<input id='Suspender' class='btn btn-warning btn-xs' value='Suspender' type='button'>
			<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' type='button'>		
		</div>	
	</div>	
	<div class="col-xs-12 pad">
		<div id="InfoEstudiantes" class="bus"></div>
	</div>
</div>