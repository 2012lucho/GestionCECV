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
	//devolver los resultados que coinciden con el termino de busqueda
    public function actionResultb()
    { 
		 //entrada de parametros		 
		 $TBusqueda=urldecode($_REQUEST["TB"]);	
		 $OrdenResu=urldecode($_REQUEST["O"]); // n=no ordenado a=ascendente d=descendente
		 //$Desplaza=urldecode($_REQUEST["D"]); // desplazamiento
		 //$CantReg=urldecode($_REQUEST["C"]); // cantidad de registros a devolver
		 
		 $Resultado=[];	
		 $Model = new stock();
		 $Model = $Model::find() //se busca
		 	->where(['like','Nombre','%'.$TBusqueda.'%',false]);
		 if ($OrdenResu != "n"){ //se ordena
		 	if ($OrdenResu == "d"){ $Model = $Model->orderBy(['Nombre'=>SORT_DESC]);} else {
		 	if ($OrdenResu == "a"){ $Model = $Model->orderBy(['Nombre'=>SORT_ASC]);}
		 	}		 
		 }
		 
		 $Resultado["ResBusca"] = $Model-> all();
		 $Resultado["CantTot"] = $Model->count();
    	 return BaseJson::encode($Resultado);
    }
    
	//devolver todos los resultados
	public function actionResultt()
	{
		//entrada de parametros
		$Desplaza=urldecode($_REQUEST["D"]); // desplazamiento
        $CantReg=urldecode($_REQUEST["C"]); // cantidad de registros a devolver
		 
		$Resultado=[];
		$Model = new stock();
		$Model = $Model::find();
		$Resultado["CantTot"] = $Model->count();
		$Resultado["ResBusca"] = $Model->all();
		return BaseJson::encode($Resultado);
	}
}
