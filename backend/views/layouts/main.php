<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/icocecv.png" type="image/x-icon" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
    NavBar::begin([
        'brandLabel' =>  Html::img('@web/img/logo.png', ['alt'=>'Vino Para el Cambio']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'cont-logo-enc navbar-inverse navbar-fixed-top ',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Ingresar', 'url' => ['/site/login']];
    } else {
    	$menuItems[] = ['label' => 'Historial préstamos', 'url' => 'historial'];
    	$menuItems[] = ['label' => 'Prestar', 'url' => ['/npresta']];
    	$menuItems[] = ['label' => 'Ingresar devolución', 'url' => ['/ingresadevol']];
    	$menuItems[] = ['label' => 'Estudiantes', 'url' => ['/datos']];
    	$menuItems[] = ['label' => 'Libros', 'url' => ['/stock']];

    	if (User::findOne(Yii::$app->user->id)->Rango(['0'])){   //el rango cero es el admin
    		$menuItems[] = ['label' => 'Cuentas de Usuario', 'url' => ['/users']];
    		$menuItems[] = ['label' => 'Configuración', 'url' => ['/conf']];
		}
    	$menuItems[] = ['label' => 'Salir (' . Yii::$app->user->identity->username . ')','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'main-menu navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">Desarrollado por <a href="http://www.coodesoft.com.ar">Coodesoft</a> </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
