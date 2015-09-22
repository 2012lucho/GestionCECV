<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gestiondatos\models\datosuserb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datosuser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdUser') ?>

    <?= $form->field($model, 'NombreyApellido') ?>

    <?= $form->field($model, 'DNI') ?>

    <?= $form->field($model, 'Email') ?>

    <?= $form->field($model, 'Telefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
