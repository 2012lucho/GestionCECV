<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

//cargamos el modelo de configuración
use common\models\Configuracion;

/**
 * Site controller
 */
class SiteController extends Controller
{
	public $defaultAction = 'presta';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'presta'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	//función que retorna valores de configuraciones ingresadas, pasándole como parámetro el id de la configuración
    protected function ValorConfiguracion($id) //tal vez debería pasarse al modelo //mas adelante
    {if (($model = Configuracion::findOne($id)) !== null) {return $model->valor;} else {return "";}}
     
    public function actionPresta()
    {
    	//Obtenemos la configuración
    	$DiasPresta=$this->ValorConfiguracion('TPrestaLibro'); 
    	//Obtenemos la fecha actual
		$timezone = new \DateTimeZone('America/Argentina/Buenos_Aires');
    	$Fecha = new \DateTime('now', $timezone);
    	$FDebT = new \DateTime('now', $timezone); 
    	$FDebT->modify('+'.$DiasPresta.' day');
        return $this->render('presta',['fecha'=>$Fecha->format('Y-m-d')]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
