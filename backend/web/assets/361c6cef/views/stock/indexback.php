<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gestionstock\models\stockbusca */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catálogo';
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar artículo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idStock',
            'Codigo',
            'Nombre',
            'Descripcion',
            'Autor',
            // 'Cantidad',
            // 'CantidadDisponible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
