<?php

namespace app\modules\EditorPaginas\components\htmlview;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class htmlviewAssets extends AssetBundle
{
    public $sourcePath = '@app/modules/EditorPaginas/components/htmlview';
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
