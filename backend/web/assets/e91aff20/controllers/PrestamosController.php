<?php

namespace app\modules\gestionstock\controllers;

use Yii;
use common\models\prestamos;

//cargamos el modelo de configuración
use common\models\Configuracion;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\stock;

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
	//"Action" que se encarga de mostrar la página de carga deprestamos y devoluciones
    public function actionNuevo() //no borrar
    {
        return $this->render('PrestayDev');
    }
    
    //función que retorna valores de configuraciones ingresadas, pasándole como parámetro el id de la configuración
    protected function ValorConfiguracion($id) //tal vez debería pasarse al modelo //mas adelante
    {if (($model = Configuracion::findOne($id)) !== null) {return $model->valor;} else {return "";}}
     
     //función que retorna un modelo de la tabla stock de acuerdo 
   // protected function ValorConfiguracion($id) //tal vez debería pasarse al modelo //mas adelante
    //{if (($model = Configuracion::findOne($id)) !== null) {return $model->valor;} else {return "";}}
    
    //"Action" que se utiliza para agregar un nuevo préstamo a la base de datos
    public function actionApresta()
    {
    	//resultado de la petición
    	$resultado=[];
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
			//buscamos en el stock  
			$Stock=stock::findOne($Libros[$c]);
			$Cant=$Stock->CantidadDisponible;
			if($Cant>0){ // comprobamos la cantidad disponible
				//modelo de la tabla de prestamos
				$Presta=new prestamos();
				//Creacion del registro para la tabla de prestamos
				$Presta->idUser=$Estud[0];	
				$Presta->IdStock=$Libros[$c];	
				$Presta->FechaDebT=$FDebT->format('Y-m-d');
				$Presta->FechaDeb='0000-00-00';
				$Presta->FechaPresta=$date->format('Y-m-d');	 
				$Presta->save();
				//actualizamos la cantidad en stock
				$Stock->CantidadDisponible-=1;
				$Stock->save();
			}
		}
		return "1"; //aca se debe debolver un arreglo con el resultado del ingreso de datos
    }
    //"Action" que se utiliza para mostrar los prestamos pendientes del usuario
    public function actionLpresta(){
    	$Presta=new prestamos();
    	//cargamos el parametro
    	$Estudi=BaseJson::decode(urldecode($_REQUEST["E"]));
    	//buscamos los registros de prestamos no devueltos, con fecha de devolución "0000-00-00"
    	$Presta=prestamos::find()
    		->where(['FechaDeb'=> '0000-00-00', 'idUser'=>$Estudi])
    		->orderBy('idPresta')->all();
    	//reemplazamos isstock po el nombre del libro
    	return BaseJson::encode($Presta);
    } 
    //"Action" que se utiliza para ingresar la devolución del prestamo
    public function actionAdevol(){
    
    }
  /*  public function actionNn(){
		$m = new datosuser();		
		$m = $m::findOne(2);
		$c = $m->getPrestamos()->all();
		return BaseJson::encode($c);    
    }*/
}
