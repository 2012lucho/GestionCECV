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
						'pattern' => 'npresta',
						'route' => 'gestionstock/prestamos/nuevo',		
					 ],
					 [
						'pattern' => 'presta',//luego sacar
						'route' => 'gestionstock/prestamos/nn',		
					 ],
					 [
						'pattern' => 'users',
						'route' => 'gestionuser/users/index',		
					 ],
					 [
						'pattern' => 'datos',
						'route' => 'gestiondatos/info/index',		
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
