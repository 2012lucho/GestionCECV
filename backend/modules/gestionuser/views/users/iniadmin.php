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
			<a href="<?= $Rweb; ?>/backend/web/index.php/gestionuser/users/create"><input class='btn btn-success btn-xs' value='Agregar' type='button'></a>
			<input id='Modificar' class='btn btn-info btn-xs' value='Modificar' type='button'>
			<input id='Eliminar' class='btn btn-danger btn-xs' value='Eliminar' type='button'>		
		</div>	
	</div>
	
	<div class="col-xs-12 ingresoInfo" id="ingInf">
		<div class="col-md-1"></div>		
		<div class="col-md-3">
			<div><p><b>Código de usuario: </b></p>
				<input type="text" id="id" disabled="disabled">
			</div>
			<div><p><b>Nombre: </b></p>
				<input type="text" id="username">
			</div>
    	</div>
		<div class="col-md-3">    		
			<div><p><b>Correo electrónico: </b></p>
				<input type="text" id="email">
			</div>
			<div><p><b>Rango: </b></p>
				<SELECT id="rango" SIZE="1">
   				<OPTION VALUE="0">Administrador</OPTION>
   				<OPTION VALUE="1">Operador</OPTION>
				</SELECT>
			</div>		
    	</div>
    	<div class="col-md-3">
    		<div><p><b>Contraseña:</b></p>
				<input type="password" id="contrasenia">	
    		</div>
    		<div><p><b>Confirmar contraseña:</b></p>
				<input type="password" id="contrasenia-conf">	
    		</div>
    	</div>
    	<div class="col-md-2">
    		<input id='Aceptar' class='btn btn-success btn-xs' value='Aceptar' type='button'>
        </div>
	</div>	
	
	<div class="col-xs-12 pad">
		<div id="InfoUser" class="bus"></div>
	</div>
</div>
