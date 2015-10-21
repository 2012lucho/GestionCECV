<?php

namespace app\modules\buscador\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\stock;
use common\models\stockar;
use app\modules\buscador\models\resultados;

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
		 //entrada de parametros		 
		 $TBusqueda=urldecode($_REQUEST["TB"]);	
		 $OrdenResu=urldecode($_REQUEST["O"]); // n=no ordenado a=ascendente d=descendente
		 $Desplaza=urldecode($_REQUEST["D"]); // desplazamiento
		 $CantReg=urldecode($_REQUEST["C"]); // cantidad de registros a devolver
		 
		 $Resultado=[];	
		 $Model = new stock();
		 $Model = $Model::find() //se busca
		 	->where(['like','Nombre','%'.$TBusqueda.'%',false]); //si no hay termino de busqueda solo quedan los comodines y debuelve toos los resultados
		 if ($OrdenResu != "n"){ //se ordena
		 	if ($OrdenResu == "d"){ $Model = $Model->orderBy(['Nombre'=>SORT_DESC]);} else {
		 	if ($OrdenResu == "a"){ $Model = $Model->orderBy(['Nombre'=>SORT_ASC]);}
		 	}		 
		 }
		 
		 $Resultado["CantTot"] = $Model->count(); //retornamos la cantidad total de registros
		 $Resultado["ResBusca"] = $Model->offset($Desplaza)->limit($CantReg)->all();  //Agregamos los filtros de desplazamiento y cantidad de registros
    	 return BaseJson::encode($Resultado);
    }
}
