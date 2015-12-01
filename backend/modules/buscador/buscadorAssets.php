<?php

namespace app\modules\buscador;

use yii\web\AssetBundle;

class buscadorAssets extends AssetBundle
{
    public $sourcePath = '@app/modules/buscador';
    public $css = [
    	'css/buscador.css',
    ];
    public $js = [
    	'js/mustache.min.js',
		'js/buscador.js',
	];
    
}
