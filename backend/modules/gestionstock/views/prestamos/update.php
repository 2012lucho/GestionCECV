<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gestionstock\models\prestamos */

$this->title = 'Update Prestamos: ' . ' ' . $model->idPresta;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPresta, 'url' => ['view', 'id' => $model->idPresta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestamos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
