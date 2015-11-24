<?php
	namespace common\models;
	use common\models\Configuracion;
	
	use yii\base\Model;
	
	class Config extends Model
	{
		//"cod" de la configuración que se quiere recuperar
		public $conf;
				
		public function Valor(){
			$cod=$this->conf;
			$model = Configuracion::findOne($cod);
			if ($model !== null) 
			{
				return $model->valor;
			} else {
				return "";
			}
		}
			
	}
