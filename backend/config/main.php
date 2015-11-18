<?php
//dfdfdfdf
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	 'gestionuser' => [
            'class' => 'app\modules\gestionuser\gestionuser',
         ],
         'gestionstock' => [
            'class' => 'app\modules\gestionstock\gestionstock',
         ],
         'gestiondatos' => [
            'class' => 'app\modules\gestiondatos\gestiondatos',
         ],
         'config' => [
            'class' => 'app\modules\config\config',
         ],
         'buscador' => [
            'class' => 'app\modules\buscador\buscador',
         ],
       ],
    'components' => [
    	  'urlManager' => [
    	  	'enablePrettyUrl' => true,
            'showScriptName' => true,
            'enableStrictParsing' => false,
            'rules' => [
                	 [
						'pattern' => 'stock',
						'route' => 'gestionstock/stock/index',		
					 ],
					 [
						'pattern' => 'npresta', //action para cargar la vista desde donde crear nuevos prestamos
						'route' => 'gestionstock/prestamos/nuevo',		
					 ],
					 [
						'pattern' => 'apresta',//action para cargar un prestamo en la base de datos
						'route' => 'gestionstock/prestamos/apresta',		
					 ],
					 [
						'pattern' => 'adevol',//action para cargar la devolución de un préstamo
						'route' => 'gestionstock/prestamos/adevol',		
					 ],
					 [
						'pattern' => 'lpresta',//action para devolver el listado de prestamos del usuario
						'route' => 'gestionstock/prestamos/lpresta',		
					 ],
					 [
						'pattern' => 'eliestu',//action para eliminar estudiante
						'route' => 'gestiondatos/info/delete',		
					 ],
					 [
						'pattern' => 'suspend',//action para suspender estudiante
						'route' => 'gestiondatos/info/suspend',		
					 ],
					 [
						'pattern' => 'nuevoest',//action para agregar estudiante
						'route' => 'gestiondatos/info/nuevo',		
					 ],
					 [
						'pattern' => 'editarest',//action para modificar estudiante
						'route' => 'gestiondatos/info/editar',		
					 ],
					 [
						'pattern' => 'infoest',//action para obtener info de un estudiante
						'route' => 'gestiondatos/info/infoest',		
					 ],
					 [
						'pattern' => 'guardaop',//action guardar configuracion
						'route' => 'config/config/guardaop',		
					 ],
					 [
						'pattern' => 'users',
						'route' => 'gestionuser/users/index',		
					 ],
					 [
						'pattern' => 'datos',
						'route' => 'gestiondatos/info/index',		
					 ],
					 [
						'pattern' => 'conf',
						'route' => 'config/config/index',		
					 ],
					 [
						'pattern' => 'rbusca',
						'route' => 'buscador/buscador/resultb',	
					 ],
				],
    	  ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
        	'class' => 'yii\i18n\Formatter',
        	'nullDisplay' => 'No definido',
    	],
    ],
    'params' => $params,
];
