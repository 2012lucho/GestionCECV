<?php

namespace app\modules\gestionstock;

use yii\web\AssetBundle;

class StockAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/gestionstock';
    public $css = [
    	'css/catalogo.css',
    ];
    public $js = [
    	'js/Stock.js',
    ];
    public $depends = [
       'backend\assets\AppAsset',
    ];
}
