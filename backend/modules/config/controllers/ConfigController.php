<?php

namespace app\modules\config\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ConfigController extends Controller
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

    public function actionIndex(){
		return $this->render('index.php');    
    }
    
	// "Action" quepermite guardar las opciones de configuración     
	public function actionGuardaOp(){
		
		return "1";	
	}    
}
