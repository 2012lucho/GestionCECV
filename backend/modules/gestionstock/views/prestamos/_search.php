<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gestionstock\models\prestamosb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPresta') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'IdStock') ?>

    <?= $form->field($model, 'FechaPresta') ?>

    <?= $form->field($model, 'FechaDebT') ?>

    <?php // echo $form->field($model, 'FechaDeb') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
