<?php
	namespace app\modules\buscador\models;

	use yii\base\Model;
	use yii\helpers\BaseJson;
	
	class Busqueda extends Model
	{
		//Parametros que se deben recibir a través de una petición al controlador
		public $TBusqueda;
		public $Desplaza;
		public $OrdenResu;
		public $CantReg;
		public $Tabla;
		public $Filtros;		
		//Parámetros necesarios para la búsqueda $TBusqueda y: 		
		public $CamposB;
		public $CamposO; //Se mira el campo 'x' para ordenar
		//Parámetros que se usaran para la salida
		public $CantTot; // se almacenará la cantidad total de registros		
		
		public $ResBusca;	
		
		public function Resultados(){
			$this->CamposO=$this->CamposB; //Por ahora son iguales	
			
//consulta que funciona
// select idPresta,NombreyApellido from Prestamos left join DatosUser on Prestamos.idUser=DatosUser.IdUser			
		
//otra consulta que funciona
// select idPresta,Nombre from Prestamos left join Stock on Prestamos.IdStock=Stock.idStock		
			$filtro=BaseJson::decode($this->Filtros);
			$Consulta = (new \yii\db\Query())
						->select('*')
						->from($this->Tabla)
						->where(['like',$this->CamposB,'%'.$this->TBusqueda.'%',false]);
			
			$Consulta->andWhere($filtro);

			if ($this->OrdenResu != "n"){ //se ordena
		 		if ($this->OrdenResu == "d"){ 
		 			$Consulta = $Consulta->orderBy([$this->CamposO=>SORT_DESC]);
		 		} else {
		 			if ($this->OrdenResu == "a"){ 
		 				$Consulta = $Consulta->orderBy([$this->CamposO=>SORT_ASC]);
		 			}
		 		}		 
		 	}
		 	
		 	$this->CantTot=$Consulta->count();
		 	$Consulta = $Consulta->offset($this->Desplaza)->limit($this->CantReg)->all();
		 	
		 	$this->ResBusca = $Consulta;
			return $this->toArray(['CantTot','ResBusca']);
		}
	}
