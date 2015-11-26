<?php

namespace app\modules\gestionstock\controllers;

use Yii;

use common\models\stock;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseJson;

//cargamos el modelo de configuración
use common\models\Config;
/**
 * StockController implements the CRUD actions for stock model.
 */
class StockController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'infolib'=>['post'],
                   // 'nuevolib'=>['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $Config=new Config(['conf'=>'DirWeb']);
		$Rweb=$Config->Valor();
        return $this->render('modstock', [
            'Rweb'=>$Rweb,
        ]);
    }
	//"action" para crear un nuevo libro
	public function actionNuevolib(){
		$model = new stock();  
		
        $model->Nombre=urldecode($_REQUEST['Nombre']);
        $model->Descripcion=urldecode($_REQUEST["Descripcion"]);
		$model->Autor=urldecode($_REQUEST["Autor"]);
		$model->Cantidad=urldecode($_REQUEST["Cantidad"]);
		$model->CantidadDisponible=$model->Cantidad;
        $model->save();
        return '1';
	}    
    
    //"action" para eliminar un libro
    public function actionElilib(){
		$model = stock::findOne($_REQUEST["id"]);
		$model->delete();return '1';   
    }
    
	//"action" para modificar un libro
	public function actionEditalib(){
		$model = stock::findOne($_REQUEST["id"]);
        $model->Nombre=urldecode($_REQUEST["Nombre"]);
        $model->Descripcion=urldecode($_REQUEST["Descripcion"]);
		$model->Autor=urldecode($_REQUEST["Autor"]);
		$model->Cantidad=urldecode($_REQUEST["Cantidad"]);
		$model->CantidadDisponible=$model->Cantidad;
        $model->save(false);
        return '1';
	}   
    
    //"action" para devolver informacion sobre un libro determinado
    public function actionInfolib(){
		//carga de parametros
		$lib=urldecode($_POST["id"]); 
		$model=stock::findOne($lib);
		//terminamos
		return BaseJson::encode($model);
	}

}