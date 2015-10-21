<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gestiondatos\models\datosuser */

$this->title = 'Actualizar datos: ' . ' ' . $model->IdUser;

?>
<div class="datosuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
