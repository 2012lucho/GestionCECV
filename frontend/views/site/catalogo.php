<?php
	use app\widgets\htmlview\htmlview;
	use app\widgets\htmlview\htmlviewAssets;
	htmlviewAssets::register($this);
	$this->title = 'Catálogo de libros';
?>

<?= HtmlView::widget([
	'RegistrosPagina' => $paginacion,
	'TituloSeccion' => 'Catálogo de libros',
	'EtiquetaTitulo' => 'div',
	'ClaseTitulo' => 'TitCat',
	'TBusqueda' => $TBusqueda,
	'PaginaActual' => $pagina,
	'tabla' => 'Stock',
	'Urlpag' => $rutaweb.'/index.php/catalogo',
	'registro' => 'todos',
	'CampoTitulo' => 'Nombre',
	'CampoCuerpo' => 'Descripcion',
	'RegAbierto' => $RegAbierto,
	'CampoIndice'=> 'idStock',
]);?>