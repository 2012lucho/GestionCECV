<?php

namespace app\modules\buscador\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\buscador\models\resultados;

use yii\helpers\BaseJson;

class BuscadorController extends Controller
{
    public function actionResult()
    {
    	 $result="hola";
       return BaseJson::encode($result);
    }

}
