<?php

namespace app\modules\gestionuser\controllers;

//cargamos el modelo de configuración
use common\models\Config;

use Yii;
use common\models\User;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'infousr'=> ['post'],
                    'editausr'=> ['post'],
                ],
            ],
        ];
    }
	//"action" para eliminar un usuario
    public function actionEliusr(){
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
                if (Yii::$app->getUser()->login($user)) {
                    return $this->actionIndex();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

   /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Página inexistente.');
        }
    }
}
