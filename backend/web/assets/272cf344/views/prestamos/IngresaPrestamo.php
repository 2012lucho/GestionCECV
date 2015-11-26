<?php

//importamos el módulo del "buscador"
use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

//importamos los assets de la página
use app\modules\gestionstock\PrestaAsset;PrestaAsset::register($this);

$this->title = 'Área de administración - Ingresar nuevo préstamo';
?>
<div class="oculto" id="parametros" data-CantLibSel="<?= $CantLib; ?>" data-rweb="<?= $Rweb; ?>"></div>
<div class="site-presta row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="col-md-10">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-2" >
			<input id='NuevoPrestamo' class='btn btn-info btn-xs boto' value='Ingresar retiro' type='button'>
		</div>	
	</div>
	<div class="col-xs-12">
		<div class="col-md-4 col-xs-12 pad">
			<div id="BuscaEstu" class="bus"></div>
		</div>
		<div class="col-md-4 col-xs-12 pad">
			<div id="InfoEstud" class="bus"></div>
		</div>
		<div class="col-md-4 col-xs-12 pad">
			<div id="BuscaLib" class="bus"></div>
		</div>
	</div>
</div>

<div class="prestamos-index" id="Historial"></div>
