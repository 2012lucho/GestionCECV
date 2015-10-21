<?php
	$this->title = 'Catálogo de libros';
	
	use app\assets\CatalogAsset;
	CatalogAsset::register($this);	
	
	//Se importa el complemento del "Buscador"
	use app\modules\buscador\buscador;
	use app\modules\buscador\buscadorAssets;
	buscadorAssets::register($this);
?>

<div id="CatalogoLib" class="col-xs-12"></div>




