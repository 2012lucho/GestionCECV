<?php

use app\modules\config\ConfigAsset;
ConfigAsset::register($this);

use app\modules\config\widgets\ControlesConf;

$this->title = 'Configuración general';
?>
<div class="oculto" id="parametros"></div>
<div class="stock-index row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-10">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>
		</div>
		<div class="col-md-2 botonera" >
			<input id='GuardaOpcio' class='btn btn-success btn-xs' value='Guardar' type='button'>
		</div>
	</div>
	<div class="col-xs-12" id="VentanaConfig">
		<?=  ControlesConf::widget(['idconf'=>'VentanaConfig']); ?>
	</div>
</div>
