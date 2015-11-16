<?php

namespace app\modules\gestionstock;

use yii\web\AssetBundle;

class PrestaAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/gestionstock';
    public $css = [
        'css/stock.css',
    ];
    public $js = [
    	'js/prestamos.js',
    	'js/infoestud.js',
    ];
    public $depends = [
       'backend\assets\AppAsset',
    ];
}
