<?php

namespace app\modules\gestiondatos\controllers;

use yii\web\Controller;

class DatosController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
