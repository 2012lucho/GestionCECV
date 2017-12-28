<?php

//importamos el módulo del "buscador"
use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

//importamos los assets de la página
use app\modules\gestionstock\DevuelveAsset;DevuelveAsset::register($this);

$this->title = 'Área de administración - Ingresar devolución';
?>
<div class="oculto" id="parametros" data-CantLibSel="<?= $CantLib; ?>"></div>
<div class="site-presta row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-10">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>
		</div>
		<div class="col-md-2" >
			<input id='CancelPrestamo' class='btn btn-success btn-xs boto' value='Ingresar devolución' type='button'>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="col-md-6 col-xs-12 pad">
			<div id="BuscaEstu" class="bus"></div>
		</div>
		<div class="col-md-6 col-xs-12 pad">
			<div id="InfoEstud" class="bus"></div>
		</div>
	</div>
</div>

<div class="prestamos-index" id="Historial"></div>
