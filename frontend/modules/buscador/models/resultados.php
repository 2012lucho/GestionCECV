<?php
	namespace app\modules\buscador\models;

	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	
	class resultados extends Model
	{
		public $modelo=''; //modelo de tabla de base de datos
		
		public function Resultados(){
			return $this->modelo;
		}
	}
