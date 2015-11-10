<?php

namespace app\modules\buscador\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\stock;
use common\models\stockar;

use app\modules\buscador\models\Busqueda;

use yii\helpers\BaseJson;

class BuscadorController extends Controller
{
	public function behaviors() //configuracion de cross origin, lo agregue pero no se bien como es la cosa
	{
    	return [
        	'corsFilter' => [
            	'class' => \yii\filters\Cors::className(),
        	],
    	];
	}	
	
	//devolver los resultados que coinciden con el termino de busqueda
    public function actionResultb()
    { 
		 $Model = new Busqueda(['TBusqueda' => urldecode($_REQUEST["TB"]),
		                    'OrdenResu' => urldecode($_REQUEST["O"]),
		                    'Desplaza' => urldecode($_REQUEST["D"]),
		                    'CantReg' => urldecode($_REQUEST["C"]),
							'Tabla' => urldecode($_REQUEST["T"]),
							'CamposB'=> urldecode($_REQUEST["CB"]),
							]); 
		 return BaseJson::encode($Model->Resultados());
    }
}
