<?php
namespace app\widgets\htmlview;

use yii\base\Widget;
use yii;
use yii\db\Query;
use yii\helpers\Url;
use app\widgets\htmlvbusca;

class HtmlView extends Widget {
//Campo de busqueda	
	public $TBusqueda;
//atributos de seleccion de la informacion
	public $devolver;
	public $RegistrosPagina;
	public $TituloSeccion;
	public $EtiquetaTitulo;
	public $PaginaActual;
	public $ClaseTitulo;
	public $Urlpag;
	public $tabla;
	public $registro;
	public $RegAbierto;
	public $CampoIndice = 'id';
	
//atributos de formato salida
	public $FPagina1="<div class='panel panel-gral'><div class='panel-heading'><";
	public $FPagina2="></div><div class='panel-body' ";
	public $AtributosBody ="";
	public $FPagina22="><p>";
	public $FPagina3="</p></div></div>";
	
	public $DesabilitarEncabezado='0';
	//public $MostrarFecha = '1';
	public $ContExtraBody = '';
	public $RedirigePag = '0';
	public $SoloTitulo = '0';
	
	public $Modelo ='';
	public $CampoTitulo;
	public $CampoCuerpo;
	
	private $consulta;
	private $CantReg;
	private $LimitePaginas;
	private $UltimoReg;
	private $cantTotal;

	private function CantidadTotalRegistros(){
		$consulta = new Query;
		$consulta->select($this->CampoIndice)->from($this->tabla);
		$consulta = $consulta->all();		
		return count($consulta);	
	}

	public function init(){
		parent::init();
	if ($this->Modelo == '') 
		{		
			$this->cantTotal = $this->CantidadTotalRegistros();
			//calculamos la cantidad de paginas que tendremos		
			if ($this->RegistrosPagina != 0){		
				$this->LimitePaginas = floor($this->cantTotal/$this->RegistrosPagina);
			}
			//validacion de parametros
			if ($this->PaginaActual<1){$this->PaginaActual=1;}
			//base de datos
			//se seleccionan las publicaciones
			if ($this->TBusqueda !=''){
				$this->consulta = (new \yii\db\Query())
							->select('*')
							->from($this->tabla)
							->where(['like','Nombre','%'.$this->TBusqueda.'%',false])
							->orderBy([$this->CampoIndice=> SORT_DESC])
							->limit($this->RegistrosPagina)
							->offset(($this->PaginaActual-1)*$this->RegistrosPagina)
							->all();
			} else {
				$this->consulta = (new \yii\db\Query())
							->select('*')
							->from($this->tabla)
							->orderBy([$this->CampoIndice=> SORT_DESC])
							->limit($this->RegistrosPagina)
							->offset(($this->PaginaActual-1)*$this->RegistrosPagina)
							->all();
			}
			$this->CantReg=count($this->consulta);		
		}
	}

	//funcion que crea el un "nuevo articulo" de la pagina
	private function MostrarRegistro($id,$titulo,$cuerpo,$autor,$cantDis){
		$salida = '<div class="RegistroLib">';
			$salida.='<div class="TituloLib">'.$titulo.'</div>';
			
			if ($this->RedirigePag=='0'){
				$salida.= '';
			} else {
				$salida.= '<a href="'.$this->Urlpag.'/1/'.$this->RegistrosPagina.'/'.$id.'">
						</a>';
			}				
			if ($this->SoloTitulo=='0')
			{
				if($autor!=''){$salida.= '<div class="AutorLib"><b>Autor: </b>'.$autor.'</div>';}
				$salida.= '<div class="DescripcionLib"><b>Descripción: </b>'.$cuerpo.$this->ContExtraBody.'</div>';			
				$salida.= '<div class="CantidadLib"><b>Cantidad disponible: </b>'.$cantDis.'</div>';			
			}
		$salida.= '</div>';
		return $salida;
	}

	//funcion para crear el encabezado
	private function Encabezado(){
		$salida='
			<div class="panel panel-gral">
  				<div class="panel-heading row">
    				<'.$this->EtiquetaTitulo.' class="col-xs-8 '.
						$this->ClaseTitulo.'">'.$this->TituloSeccion.'</'.$this->EtiquetaTitulo.'>'.
				'<div class="buscalib col-xs-4"> 
					<input type="text" id="ebusca" value="Busqueda"> <a id="lbusca"><input type="button" value="Ir"></a>
				</div>
				</div>
    		<div class="panel-body">';
  		return $salida;
	}

	//funcion para armar la url del link para pagina anterior 
	private function PrePag(){
		if ($this->PaginaActual<=1){$pagina = '1';} else
		{ $pagina = $this->PaginaActual-1; }
		return $this->Urlpag.'/'.$pagina.'/'.$this->RegistrosPagina;	
	}

	//funcion para armar la url del link para pagina siguiente
	private function SigPag(){
		if ($this->PaginaActual>$this->LimitePaginas)
		{
			$pagina = $this->LimitePaginas;
		} else { 
			$pagina = $this->PaginaActual+1; 
		}
		return $this->Urlpag.'/'.$pagina.'/'.$this->RegistrosPagina;
	}

	//funcion para crear el pie de pagina
	
	private function Pie(){ 
		$salida='</div> 
				<div class="panel-footer"> 
					<div class="row"> 
						<div class="col-md-8 col-lg-8"> 
							Pagina actual: '.$this->PaginaActual.' / '.($this->LimitePaginas+1).' 
							<a class="enlaceLib" href="'.$this->PrePag().'"> Anterior </a> 
							<a class="enlaceLib" href="'.$this->SigPag().'"> Siguiente </a> 
						</div> 
					<div class="col-md-4 col-lg-4"> 
					
				</div> 
				</div> 
				</div>'; 
		return $salida; 
	}

	//función que crea la pagina con los articulos, aca se haria lña paginacion 
	//en caso de que corresponda
	private function CrearPagina($datos,$RegistrosPagina){
		$mostrar='';
			
		if ($this->DesabilitarEncabezado=="0")
		{
			$mostrar.= $this->Encabezado();
		}
		foreach ($datos as $data){
			$mostrar.= $this->MostrarRegistro($data[$this->CampoIndice],$data[$this->CampoTitulo],$data[$this->CampoCuerpo],$data['Autor'],$data['CantidadDisponible']);
    	}
		unset($data);
		if ($this->DesabilitarEncabezado=="0")
		{
			$mostrar.= $this->Pie();
		}
			
		return $mostrar;
	}
 
	public function run() {
    	if ($this->Modelo == '') {
    		return $this->CrearPagina($this->consulta,$this->RegistrosPagina);
    	} else
    	{
    		return $this->FPagina1.$this->EtiquetaTitulo.'>'.$this->Modelo->titulo.'</'.
    				$this->EtiquetaTitulo.$this->FPagina2.$this->AtributosBody.$this->FPagina22.
    				$this->Modelo->cuerpo.$this->FPagina3;
    	}
	}
 
}
?>
