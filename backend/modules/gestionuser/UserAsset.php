<?php

namespace app\modules\gestionuser;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/gestionuser';
    public $css = [
    	'css/User.css',
    ];
    public $js = [
    	'js/InfoUser.js',
    ];
    public $depends = [
       'backend\assets\AppAsset',
    ];
}
