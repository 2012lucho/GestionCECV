<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Nueva cuenta de Usuario';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Complete los siguientes campos para crear una cuenta de usuario:</p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'rango')->dropDownList(["0"=>"Administrador","1"=>"Operador"]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Agregar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
