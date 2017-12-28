<?php
namespace frontend\controllers;

use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

//cargamos el modelo de configuración
use common\models\Config;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'catalogo';

    public function behaviors()
    {
        return [
        	/*'corsFilter' => [
            	'class' => \yii\filters\Cors::className(),
            	'cors' => [
					//'Origin'=>['http://localhost'],
            	],
        	],*/
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        /*'actions' => ['about'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function() {
                        	return User::Rango(['0']);
                        },*/
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionCatalogo()
    {
    		return $this->render('catalogo');
    }
}
