<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gestiondatos\models\datosuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datosuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreyApellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DNI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
