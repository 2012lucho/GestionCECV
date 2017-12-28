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
                    'nuevolib'=>['post'],
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
        $rango=User::findOne(Yii::$app->user->id)->Rango(['0']);
        return $this->render('modstock', [
            'Rango'=>$rango,
        ]);
    }
	//"action" para crear un nuevo libro
	public function actionNuevolib(){

		$No=urldecode($_REQUEST['Nombre']);
		$Ds=urldecode($_REQUEST["Descripcion"]);
		$Au=urldecode($_REQUEST["Autor"]);
		$Ca=urldecode($_REQUEST["Cantidad"]);
		//verificamos que se hayan completado todos los campos
		if ($No!='' && $Ds!='' && $Au!='' && $Ca!=''){
			$model = new stock();
      	$model->Nombre=$No;
      	$model->Descripcion=$Ds;
			$model->Autor=$Au;
			$model->Cantidad=$Ca;
			$model->CantidadDisponible=$model->Cantidad;
      	if($model->save()){ //si se puede guardar el registro
      		$resultado["codigo"]="1";
				$resultado["detalles"]="Registro exitoso";
		  		return BaseJson::encode($resultado);
      	} else { // si el registro no se puede guardar
      		$resultado["codigo"]="3";
      		$resultado["detalles"]=$model->StringListaErrores("Revise el campo ","<br>");
      		return BaseJson::encode($resultado);
      	}
		} else { //si faltan datos
			$resultado["codigo"]="2";
			$resultado["detalles"]="Se deben completar todos los campos";
		  	return BaseJson::encode($resultado); // si no se completaron todos los campos

		}

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
		if($model->Cantidad>=0 && $model->CantidadDisponible>=0) {
       	if($model->save()){ //si se puede guardar el registro
      		$resultado["codigo"]="1";
				$resultado["detalles"]="Registro exitoso";
		  		return BaseJson::encode($resultado);
      	} else { // si el registro no se puede guardar
      		$resultado["codigo"]="3";
      		$resultado["detalles"]=$model->StringListaErrores("Revise el campo ","<br>");
      		return BaseJson::encode($resultado);
      	}
      } else {
			$resultado["codigo"]="3";
			$resultado["detalles"]="La cantidad de libros disponibles no puede ser menor a cero";
		  	return BaseJson::encode($resultado);
      } //no se admiten cantidades negativas de libros
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
