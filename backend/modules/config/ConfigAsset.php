<?php

namespace app\modules\config;

use yii\web\AssetBundle;


class ConfigAsset extends AssetBundle
{
    public $basePath = 'app/modules/config';
    //public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
    ];
    public $js = [
    	'js/config.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
