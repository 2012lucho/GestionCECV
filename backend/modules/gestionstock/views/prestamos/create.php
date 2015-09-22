<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\gestionstock\models\prestamos */

$this->title = 'Create Prestamos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
