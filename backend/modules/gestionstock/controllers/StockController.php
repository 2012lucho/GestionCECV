<?php

namespace app\modules\gestionstock\controllers;

use Yii;

use common\models\stock;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseJson;
use yii\filters\AccessControl;

//cargamos el modelo de configuración
use common\models\Config;

use common\models\User;
/**
 * StockController implements the CRUD actions for stock model.
 */
class StockController extends Controller
{
    public function behaviors()
    {
        return [
        		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'nuevolib', 'elilib', 'editalib', 'infolib'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
			$rango=User::findOne(Yii::$app->user->id)->Rango(['0']);
        return $this->render('modstock', [
            'Rweb'=>$Rweb,
            'Rango'=>$rango,
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
		$model->Cantidad+=urldecode($_REQUEST["CantidadAAgregar"]);
		$model->CantidadDisponible+=urldecode($_REQUEST["CantidadAAgregar"]);
		if($model->Cantidad>0 && $model->CantidadDisponible>=0) {
        $model->save(false);
        return '1';
      } else {return '3';} //no se admiten cantidades negativas de libros
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
