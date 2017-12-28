<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ingresar';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Complete los siguientes campos para ingresar:</p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-xs-12">
          <h4>Datos para realizar prueba como usuario administrador</h4>
          <p>Usuario: "admin"</p>
          <p>Contraseña: "admin123" </p>
          <h4>Datos para realizar prueba como usuario operador</h4>
          <p>Usuario: "operador"</p>
          <p>Contraseña: "operador123" </p>
          <h4>Ir a vista de inventario público</h4>
          <a href="../../../../frontend/web">Sección pública</a>
        </div>
    </div>
</div>
