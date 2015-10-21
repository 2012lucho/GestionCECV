<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\datosuser;
use common\models\stock;

//importamos el módulo del "buscador"
use app\modules\buscador\buscador;
use app\modules\buscador\buscadorAssets;
use yii\helpers\ArrayHelper;
buscadorAssets::register($this);

$this->title = 'Prestamos';

?>

<div class="site-presta row">
	<div class="col-md-6">
		<div class="col-xs-12"> Seleccionar estudiante</div>	
		<div></div>
	</div>
	<div class="col-md-6">
		<div class="col-xs-12"> Seleccionar libro</div>
		<div></div>
	</div>
	<div class="col-md-12">
		<input id='NuevoPrestamo' class='btn btn-default btn-xs' value='Ingresar retiro' type='button'>
		<input id='CancelPrestamo' class='btn btn-default btn-xs' value='Ingresar devolución' type='button'>
	</div>
</div>

<div class="prestamos-index">
	
	<h3>Historial de préstamos</h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            	'attribute' => 'idPresta',
        		'label' => 'Préstamo número',
        		'value' => 'idPresta',
    		], 
			[
				'label' => 'Estudiante',
				'filter' => ArrayHelper::map(datosuser::find()->all(),'IdUser','NombreyApellido'),
        		'value' => function($model){
        			$Estudiante = datosuser::findOne($model->idUser);
        			return $Estudiante->NombreyApellido;
        		},
			],  
    		[
    			'attribute' => 'IdStock',//reemplazar
        		'label' => 'Libro',
        		'value' => function($model){
        			$Libro = stock::findOne($model->IdStock);
        			return $Libro->Nombre;
        		},
    		],           
            [
            	'attribute' => 'FechaPresta',
        		'label' => 'Fecha retiro',
        		'value' => 'FechaPresta'
    		],
    		[
				'attribute' => 'FechaDebT',        		
        		'label' => 'Fecha devolución',
        		'value' => 'FechaDebT',
    		],
            [
        		'label' => 'Devuelto el día',
        		'value' => function($model){
        			$fecha = $model->FechaDeb;
					if ($fecha == '0000-00-00'){
						return 'Pendiente';
					}
					return $fecha;					       		
        		},
    		],
    		
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
