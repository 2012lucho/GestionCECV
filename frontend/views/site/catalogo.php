<?php
	$this->title = 'Catálogo de libros';
	
	use app\assets\CatalogAsset;CatalogAsset::register($this);
	//Se importa el complemento del "Buscador"
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);
?>
<div class="oculto" id="parametros" data-rweb="<?= $Rweb; ?>"></div>
<div id="CatalogoLib" class="col-xs-12"></div>




