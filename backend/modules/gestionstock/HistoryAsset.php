<?php

namespace app\modules\gestionstock;

use yii\web\AssetBundle;

class HistoryAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/gestionstock';
    public $css = [
        'css/stock.css',
    ];
    public $js = [
    	'js/historial.js',
    ];
    public $depends = [
       'backend\assets\AppAsset',
    ];
}
