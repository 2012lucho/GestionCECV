<?php

namespace app\modules\gestiondatos\controllers;

//cargamos el modelo de la tabla prestamos para poder ver si el usuario tiene prestamos adeudados antes de poder eliminarlo
use common\models\prestamos;

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
                   'nuevo' => ['post'],
                   'suspend' => ['post'],
                   'infoest' => ['post'],
                ],
            ],
        ];
    }

    /**

     */
    public function actionIndex()
    {

		    $model=new datosuser();
		    $rango=User::findOne(Yii::$app->user->id)->Rango(['0']);
        return $this->render('index', [
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
      if($model->save()==1) { //si se pudo guardar correctamente
	      $resultado["codigo"]="1";
			$resultado["detalles"]="Registro exitoso";
		  	return BaseJson::encode($resultado);
      } else {   //si no se pudo guardar
      	$resultado["codigo"]="3";
      	$resultado["detalles"]=$model->StringListaErrores("Revise el campo ","<br>");
      	return BaseJson::encode($resultado);
      }
	}

   /**
    crear un estudiante nuevo
     */
    public function actionNuevo()
    {
        $NA=urldecode($_REQUEST["NombreyApellido"]);
		  $DU=urldecode($_REQUEST["DNI"]);
		  $EM=urldecode($_REQUEST["Email"]);
		  $TL=urldecode($_REQUEST["Telefono"]);

		  //verificamos que se hayan completado todos los campos
		  if ($NA != '' && $DU !='' && $EM !='' && $TL !=''){
				$model = new datosuser();
				$model->NombreyApellido=$NA;
        		$model->DNI=$DU;
		  		$model->Email=$EM;
		  		$model->Telefono=$TL;

		  		if($model->save()==1) { // si se guardó correctamente
					$resultado["codigo"]="1";
					$resultado["detalles"]="Registro exitoso";
		  			return BaseJson::encode($resultado);
		  		} else {  //si hubo errores
		  			$resultado["codigo"]="3";
      			$resultado["detalles"]=$model->StringListaErrores("Revise el campo ","<br>");
      			return BaseJson::encode($resultado);
		  		}
		  } else {
				$resultado["codigo"]="2";
				$resultado["detalles"]="Se deben completar todos los campos";
		  		return BaseJson::encode($resultado); // si no se completaron todos los campos
		  }
		  return "nada!";
    }


    /**
     "Action" para borrar un estudiante
     */
    public function actionDelete()
    {
    	$id=urldecode($_POST['id']);
		$m=datosuser::findOne($id)->getPrestamos()->where(['=','FechaDeb','0000-00-00']);
		//verificamos que no tenga prestamos adeudados
		if ($m->count() == 0) {
        	$m=datosuser::findOne($id)->delete();return '1';
		}	else {return '4';}

    }
}
