<?php

namespace app\modules\gestiondatos\controllers;

use Yii;
use app\models\datosuser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseJson;
use yii\filters\AccessControl;
//cargamos el modelo de configuración
use common\models\Config;
use common\models\User;
/**
 * InfoController implements the CRUD actions for datosuser model.
 */
class InfoController extends Controller
{
    public function behaviors()
    {
        return [
        		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'suspend', 'infoest', 'editar', 'nuevo', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
 
     */
    public function actionIndex()
    {
        $Config=new Config(['conf'=>'DirWeb']);
		$Rweb=$Config->Valor();
		$model=new datosuser();
		$rango=User::findOne(Yii::$app->user->id)->Rango(['0']);
        return $this->render('index', [
            'Rweb'=>$Rweb,
            'model'=>$model,
            'rango'=>$rango,
        ]);
    }

	//Ingresar la suspensión de un usuario
	public function actionSuspend()
	{
		//carga de parametros
		$Estud=urldecode($_REQUEST["id"]); 
		//buscamos el estudiante y definimos suspensión en "1", más adelante se podria establecer la suspensión de más de un usuario
		$model=datosuser::findOne($Estud);
		$model->Suspendido=urldecode($_REQUEST["v"]);
		if ($model->Suspendido==1){$s=1;}else{$s=3;}		
		$model->save(false);
		//terminamos
		return $s;
	}
	
	//devolver información de un estudiante
	public function actionInfoest(){
		//carga de parametros
		$Estud=urldecode($_REQUEST["id"]); 
		$model=datosuser::findOne($Estud);
		//terminamos
		return BaseJson::encode($model);
	}

	//"action" modificar datos estudiante
	public function actionEditar(){
		$model = datosuser::findOne($_REQUEST["id"]);
      $model->NombreyApellido=urldecode($_REQUEST["NombreyApellido"]);
      $model->DNI=urldecode($_REQUEST["DNI"]);
		$model->Email=urldecode($_REQUEST["Email"]);
		$model->Telefono=urldecode($_REQUEST["Telefono"]);
      $model->save(false);
      return '1';
	}

    /**
    crear un estudiante nuevo
     */
    public function actionNuevo()
    {
        $model = new datosuser();

        $model->NombreyApellido=urldecode($_REQUEST["NombreyApellido"]);
        $model->DNI=urldecode($_REQUEST["DNI"]);
		$model->Email=urldecode($_REQUEST["Email"]);
		$model->Telefono=urldecode($_REQUEST["Telefono"]);
        $model->save();
        return '1';
    }

    
    /**
     "Action" para borrar un estudiante
     */
    public function actionDelete()
    {
    	$id=urldecode($_REQUEST['id']);
		$m=datosuser::findOne($_REQUEST["id"]);   
		if($m!=''){
        	$m->delete();return '1';}else{return '0';}
        
    }
}
