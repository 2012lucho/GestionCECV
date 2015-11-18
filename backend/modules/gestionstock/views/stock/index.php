<?php

	//importamos el módulo del "buscador"
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

	use app\modules\gestionstock\StockAsset;StockAsset::register($this); 

	$this->title = 'Catálogo';
?>
<div class="oculto" id="parametros" data-rweb="<?= $Rweb; ?>"></div>
<div class="site-presta row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-9">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-3 botonera" >
			<input id='Agregar' class='btn btn-success btn-xs' value='Agregar' type='button'>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' type='button'>
			<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' type='button'>		
		</div>	
	</div>	
	<div class="col-xs-12 pad">
		<div id="InfoStock" class="bus"></div>
	</div>
</div>