<?php

namespace app\modules\gestionstock\controllers;

use Yii;
use common\models\prestamos;

//cargamos el modelo de configuración
use common\models\Config;

use app\models\datosuser;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\stock;

use yii\helpers\BaseJson;
/**
 * PrestamosController implements the CRUD actions for prestamos model.
 */
class PrestamosController extends Controller
{
    public function behaviors()
    {
        return [
        		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['nuevo', 'ingresadevol', 'apresta', 'adevol', 'lpresta'],
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
	//"Action" que se encarga de mostrar la página de carga de prestamos 
    public function actionNuevo() 
    {
    	$Config=new Config(['conf'=>'DirWeb']);
		$Rweb=$Config->Valor();
		$Config=new Config(['conf'=>'CantLibSel']);
		$CantLib=$Config->Valor();
        return $this->render('IngresaPrestamo', [
            'Rweb'=>$Rweb,
            'CantLib'=>$CantLib,
        ]);
    }
    
    //"Action" que se encarga de mostrar la página de carga de devoluciones
    public function actionIngresadevol() 
    {
    	$Config=new Config(['conf'=>'DirWeb']);
		$Rweb=$Config->Valor();
		$Config=new Config(['conf'=>'CantLibSel']);
		$CantLib=$Config->Valor();
        return $this->render('IngresaDevolucion', [
            'Rweb'=>$Rweb,
            'CantLib'=>$CantLib,
        ]);
    }
    
    //"Action" que se utiliza para agregar un nuevo préstamo a la base de datos
    public function actionApresta()
    {
    	//resultado de la petición
    	$resultado=[];
    	//Buscamos en la configuracion la cantidad de dias de duraci{on del prestamo
    	$Config=new Config(['conf'=>'TPrestaLibro']);
		$DiasPresta=$Config->Valor();
		//Leemos los parametros		
		$Libros=BaseJson::decode(urldecode($_REQUEST["L"]));
		$Estud=BaseJson::decode(urldecode($_REQUEST["E"])); 
		//buscamos el estudiante
		$Me=datosuser::findOne($Estud[0]);
		$Suspen=$Me->Suspendido;
		//comprobamos que el estudiante no este susendido
		if ($Suspen==1){
			return "2"; //no se puede cargar
		} else {
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
		$CampoBusqueda= urldecode($_REQUEST["CB"]);
		$Condicion=BaseJson::decode(urldecode($_REQUEST["CO"]));//condiciones para el where

    	$Consulta = (new \yii\db\Query())
			->select('idPresta,NombreyApellido,Nombre,FechaPresta,FechaDebT,FechaDeb')
			->from('Prestamos')
			->innerJoin('DatosUser','Prestamos.idUser=DatosUser.IdUser') //establecemos las relaciones
			->where(['like',$CampoBusqueda,'%'.$TBusqueda.'%',false])
			->innerJoin('Stock','Prestamos.IdStock=Stock.idStock');
			
			//->where(['FechaDeb'=>'0000-00-00']);		
			
		//aplicamos todos los where necesarios a la consulta
		//for($c=0;$c<sizeof($Condicion);$c++){
			$Consulta->andWhere($Condicion[0]);
		//}				
		
		if ($OrdenResu != "n"){ //se ordena
	 		if ($OrdenResu == "d"){ 
	 			$Consulta = $Consulta->orderBy(['idPresta'=>SORT_DESC]);
	 		} else {
	 			if ($OrdenResu == "a"){ 
	 				$Consulta = $Consulta->orderBy(['idPresta'=>SORT_ASC]);
	 			}
	 		}		 
	 	}				
		
		$CantTot=$Consulta->count();
		$Consulta = $Consulta->offset($Desplaza)->limit($CantReg)->all();
		 	
		$ResBusca['ResBusca'] = $Consulta;
		$ResBusca['CantTot'] = $CantTot;
		return BaseJson::encode($ResBusca);
    }
}
