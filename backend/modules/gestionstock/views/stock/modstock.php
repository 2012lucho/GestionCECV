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
			<input id='Agregar' class='btn btn-success btn-xs' value='Nuevo' <?php if (!$Rango){echo "disabled='disabled'";} ?> type='button'>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' <?php if (!$Rango){echo "disabled='disabled'";} ?> type='button'>
			<?php 
				if ($Rango){
					echo "<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' type='button'>";				
				} else {
					echo "<input class='btn btn-danger btn-xs' value='Eliminar' type='button' disabled='disabled'>";
				}
			?>		
		</div>	
	</div>	
	
	<div class="col-xs-12 ingresoInfo" id="ingInf">
		<div class="col-md-5">
			<div><b>Nombre: </b><input type="text" id="Nombre" class="form-control"></div>
			<div><b>Descripción: </b><TEXTAREA rows="2" type="text" id="Descripcion" class="form-control"></TEXTAREA></div>
    	</div>
		<div class="col-md-5">    		
			<div><b>Autor: </b><input type="text" id="Autor" class="form-control"></div>
			<div id="cont-input-cantidad"><b>Cantidad: </b><input type="text" id="Cantidad" class="form-control"></div>
			<div id="cont-mod-cantidad"><b>Ingresar cantidad a agregar: </b><input type="text" id="CantidadAAgregar" class="form-control"></div>
    	</div>
    	<div class="col-md-2">
    		<input id='Aceptar' class='btn btn-success btn-xs' value='Aceptar' type='button'>
        </div>
	</div>	
	
	<div class="col-xs-12 pad">
		<div id="InfoStock" class="bus"></div>
	</div>
</div>