<?php
	//use app\widgets\htmlview\htmlview;
	//use app\widgets\htmlview\htmlviewAssets;
	//htmlviewAssets::register($this);
	$this->title = 'Catálogo de libros';
	
	use app\modules\buscador\buscador;
	use app\modules\buscador\buscadorAssets;
	buscadorAssets::register($this);
?>

<div id="CatalogoLib" class="col-xs-12"></div>




