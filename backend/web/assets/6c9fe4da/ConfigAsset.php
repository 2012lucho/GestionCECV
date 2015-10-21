<?php

namespace app\modules\config;

use yii\web\AssetBundle;

class ConfigAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/config';
    public $css = [
        //'css/site.css',
    ];
    public $js = [
    	'js/config.js',
    ];
    public $depends = [
       'backend\assets\AppAsset',
    ];
}
