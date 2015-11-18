<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gestiondatos\models\datosuser */

$this->title = $model->IdUser;
$this->params['breadcrumbs'][] = ['label' => 'Datosusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datosuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IdUser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IdUser], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdUser',
            'NombreyApellido',
            'DNI',
            'Email:email',
            'Telefono',
        ],
    ]) ?>

</div>
