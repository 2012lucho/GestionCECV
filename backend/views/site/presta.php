<?php
	//importamos el módulo del "buscador"
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

	use backend\assets\IndexAsset;IndexAsset::register($this);

	$this->title = 'Área de administración - Historial Prestamos';	
?>
<div class="oculto" id="parametros" data-fecha="<?= $fecha; ?>"></div>
<div class="site-presta row">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-9">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-3 botonera" >
			<input id='Todos' class='btn btn-success btn-xs' value='Todos' type='button'>
			<input id='Adeudados' class='btn btn-info btn-xs' value='Adeudados' type='button'>
			<input id='Vencidos' class='btn btn-danger btn-xs' value='Vencidos' type='button'>		
		</div>	
	</div>		
	<div class="col-xs-12 pad">
		<div id="HistorialPresta" class="bus"></div>
	</div>
</div>
