<?php

namespace common\widgets\htmlview;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class htmlviewAssets extends AssetBundle
{
    public $sourcePath = '@common\widgets\htmlview';
    public $css = [
    	'css/htmlview.css',
    ];
    public $js = [
		'js/htmlview.js',
	];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
