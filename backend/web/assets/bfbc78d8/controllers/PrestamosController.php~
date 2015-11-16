<?php

namespace app\modules\gestionstock\controllers;

use Yii;
use common\models\prestamos;
use common\models\prestamosb;

//cargamos el modelo de configuración
use common\models\Configuracion;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\stock;
use common\models\datosuser;

use yii\helpers\BaseJson;//borrar?
/**
 * PrestamosController implements the CRUD actions for prestamos model.
 */
class PrestamosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionNuevo() //no borrar
    {
        $searchModel = new prestamosb();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //función que retorna valores de configuraciones ingresadas, pasándole como parámetro el id de la configuración
    protected function ValorConfiguracion($id) //tal vez debería pasarse al modelo //mas adelante
    {
        if (($model = Configuracion::findOne($id)) !== null) {
            return $model->valor;
        } else {
            return "";
        }
    }
    //"Action" que se utiliza para agregar un nuevo préstamo a la base de datos
    public function actionApresta()
    {
    	//Buscamos en la configuracion la cantidad de dias de duraci{on del prestamo
    	$DiasPresta=$this->ValorConfiguracion('TPrestaLibro');
		//Leemos los parametros		
		$Libros=BaseJson::decode(urldecode($_REQUEST["L"]));
		$Estud=BaseJson::decode(urldecode($_REQUEST["E"])); 
		//Obtenemos la fecha actual
		$timezone = new \DateTimeZone('America/Argentina/Buenos_Aires');
    	$date = new \DateTime('now', $timezone); 
    	$FDebT = new \DateTime('now', $timezone); 
    	$FDebT->modify('+'.$DiasPresta.' day');
		//Creamos un registro por cada libro prestado
		for($c=0;$c<sizeof($Libros);$c++){
			$Modelo=new prestamos();
			$Modelo->idUser=$Estud[0];	
			$Modelo->IdStock=$Libros[$c];
			$Modelo->FechaDebT=$FDebT->format('Y-m-d');
			$Modelo->FechaDeb='0000-00-00';
			$Modelo->FechaPresta=$date->format('Y-m-d');	 
			$Modelo->save();
		}
		return "1"; //aca se debe debolver un arreglo con el resultado del ingreso de datos
    }
  /*  public function actionNn(){
		$m = new datosuser();		
		$m = $m::findOne(2);
		$c = $m->getPrestamos()->all();
		return BaseJson::encode($c);    
    }*/

    /**
     * Displays a single prestamos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new prestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   /* public function actionCreate()
    {
        $model = new prestamos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPresta]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }/
	
    /**
     * Updates an existing prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPresta]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing prestamos model.
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
     * Finds the prestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return prestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = prestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
