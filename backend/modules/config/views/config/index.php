<?php

use app\modules\config\ConfigAsset;
ConfigAsset::register($this);

use app\modules\config\widgets\ControlesConf;

$this->title = 'Configuración general';
?>
<div class="stock-index">
	<div class="col-xs-12"> <h3>Opciones generales de configuración</h3></div>
	<div class="col-xs-12" id="VentanaConfig">
		<?=  ControlesConf::widget(['idconf'=>'VentanaConfig']); ?>
	</div>
</div>
