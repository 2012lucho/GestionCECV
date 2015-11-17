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
    
    //"Action" que se utiliza para ingresar la devolución del prestamo
    public function actionAdevol(){
    	//Obtenemos la fecha actual
		$timezone = new \DateTimeZone('America/Argentina/Buenos_Aires');
    	$fecha = new \DateTime('now', $timezone); 
    	//Leemos los parametros		
		$Presta=BaseJson::decode(urldecode($_REQUEST["P"]));
		//ingresamos cada uno de los libros en la base de datos
		for($c=0;$c<sizeof($Presta);$c++){
			//Recorremos el listado de prestamos
			$Pres=prestamos::findOne($Presta[$c]);
			//ingresamos la fecha de devolución
			$Pres->FechaDeb=$fecha->format('Y-m-d');
			$Pres->save();
			//actualizamos la cantidad de libros disponibles
			$Stock=stock::findOne($Pres->IdStock);
			$Stock->CantidadDisponible+=1;
			$Stock->save();
		}
		return '1';
    }
    //Action que devuelve la lista de prestamos
    public function actionLpresta(){
    	$ResBusca =[];
    	
    	$TBusqueda = urldecode($_REQUEST["TB"]);
		$OrdenResu = urldecode($_REQUEST["O"]);
		$Desplaza= urldecode($_REQUEST["D"]);
		$CantReg= urldecode($_REQUEST["C"]);
		//$Tabla = urldecode($_REQUEST["T"]);
		//$CamposB = urldecode($_REQUEST["CB"]);

    	$Consulta = (new \yii\db\Query())
			->select('idPresta,NombreyApellido,Nombre,FechaPresta,FechaDebT')
			->from('Prestamos')
			->leftJoin('DatosUser','Prestamos.idUser=DatosUser.IdUser') //establecemos las relaciones
			->leftJoin('Stock','Prestamos.IdStock=Stock.idStock');
		
		$CantTot=$Consulta->count();
		$Consulta = $Consulta->offset($Desplaza)->limit($CantReg)->all();
		 	
		$ResBusca['ResBusca'] = $Consulta;
		$ResBusca['CantTot'] = $CantTot;
		return BaseJson::encode($ResBusca);
    }
  /*  public function actionNn(){
		$m = new datosuser();		
		$m = $m::findOne(2);
		$c = $m->getPrestamos()->all();
		return BaseJson::encode($c);    
    }*/
}