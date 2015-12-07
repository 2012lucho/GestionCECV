<?php

namespace common\models;

class Validacion extends \yii\db\ActiveRecord
{
	//función para retornar errores en la carga de información de los modelos
	public function StringListaErrores($mensaje,$separador){
		$errores=$this->getErrors();
		$salida='';
		//armamos la salida de acuerdo a los errores encontrados
		$claves=array_keys($errores);					
		for($c=0;$c<sizeof($claves);$c++) {
			$salida.=$mensaje.$this->attributeLabels()[$claves[$c]].$separador;
		}  	
		return $salida;		
	}
}
	