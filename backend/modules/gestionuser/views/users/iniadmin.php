<?php

	//importamos el módulo del "buscador"
	use app\modules\buscador\buscadorAssets;buscadorAssets::register($this);

	use app\modules\gestionuser\UserAsset;UserAsset::register($this);

	$this->title = 'Gestion de usuarios';
?>
<div class="oculto" id="parametros" data-rweb="<?= $Rweb; ?>"></div>
<div class="user-index">
	<div  class="col-xs-12" id="bot-presta">
		<div id="Notific" class="Notific col-md-9">
			<p>Área de notificaciones</p>
			<div class="mensaje"></div>		
		</div>	
		<div class="col-md-3 botonera" >
			<a href="/GestionCECV/backend/web/index.php/gestionuser/users/create"><input class='btn btn-success btn-xs' value='Agregar' type='button'></a>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' type='button'>
			<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' type='button'>		
		</div>	
	</div>
	
	<div class="col-xs-12 ingresoInfo" id="ingInf">
		<div class="col-md-5">
			<div><b>Código de usuario: </b><input type="text" id="id"></div>
			<div><b>Nombre: </b><input type="text" id="username"></div>
    	</div>
		<div class="col-md-5">    		
			<div><b>Correo electrónico: </b><input type="text" id="email"></div>
			<div><b>Rango: </b><input type="text" id="rango"></div>
    	</div>
    	<div class="col-md-2">
    		<input id='Aceptar' class='btn btn-success btn-xs' value='Aceptar' type='button'>
        </div>
	</div>	
	
	<div class="col-xs-12 pad">
		<div id="InfoUser" class="bus"></div>
	</div>
</div>