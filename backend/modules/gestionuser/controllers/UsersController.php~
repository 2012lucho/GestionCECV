<?php

namespace app\modules\gestionuser\controllers;

//cargamos el modelo de configuración
use common\models\Config;

use Yii;
use common\models\User;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\userb;

use app\models\SignupForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\BaseJson;


/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    public function behaviors()
    {
        return [
        		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['eliminausr', 'infousr', 'editausr', 'index', 'create'],
                        'allow' => true,
                        //'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'eliminausr' => ['post'],
                    'infousr'=> ['post'],
                    'editausr'=> ['post'],
                ],
            ],
        ];
    }
	//"action" para eliminar un usuario
    public function actionEliminausr(){
		$model = User::findOne($_REQUEST["id"]);
		$model->delete();return '1';   
    }
    	
	//"action" para modificar un usuario
	public function actionEditausr(){
		$model = User::findOne($_REQUEST["id"]);
      $model->username=urldecode($_REQUEST["username"]);
      $model->email=urldecode($_REQUEST["email"]);
      $rango=urldecode($_REQUEST["rango"]);
		if ($rango !=0 && $rango != 1) {
			return '3'; //valor de rango no permitido		
		}	else {
			$model->rango=$rango;
      	$model->save(false);
      	return '1';
		}	
	}   
    
    //"action" para devolver informacion sobre un usuario determinado
    public function actionInfousr(){
		//carga de parametros
		$lib=urldecode($_POST["id"]); 
		$model=User::findOne($lib);
		//terminamos
		return BaseJson::encode($model);
	}

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$Config=new Config(['conf'=>'DirWeb']);
		$Rweb=$Config->Valor();
        return $this->render('iniadmin',['Rweb'=>$Rweb]);
    }

   
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->actionIndex();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
