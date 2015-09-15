<?php
namespace app\modules\EditorPaginas\components\htmlview;

use yii\base\Widget;
use yii;
use yii\db\Query;
use yii\helpers\Url;

class HtmlView extends Widget {
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
	
//atributos de formato salida
	public $FPagina1="<div class='panel panel-gral'><div class='panel-heading'><";
	public $FPagina2="></div><div class='panel-body' ";
	public $AtributosBody ="";
	public $FPagina22="><p>";
	public $FPagina3="</p></div></div>";
	
	public $DesabilitarEncabezado='0';
	public $MostrarFecha = '1';
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
		$consulta->select('id')->from($this->tabla);
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
			$this->consulta = (new \yii\db\Query())
							->select('*')
							->from('novedades')
							->orderBy(['id'=> SORT_DESC])
							->limit($this->RegistrosPagina)
							->offset(($this->PaginaActual-1)*$this->RegistrosPagina)
							->all();

			$this->CantReg=count($this->consulta);		
		}
	}

	//funcion que crea el un "nuevo articulo" de la pagina
	private function MostrarRegistro($id,$titulo,$cuerpo,$fecha){
		$salida = '<div id="s'.$id.'" class="spoiler">';
			if ($this->SoloTitulo=='0')
			{
				$expandido='0';
				if ($this->RegAbierto==$id) {$expandido='1';}
				$salida.= '<div id="t'.$id.'" data-expandido="'.$expandido.'" class="textoNot">'.$cuerpo.$this->ContExtraBody.'</div>';			
			}
			$salida.='<div id="'.$id.'" class="PrevVisualArti">';
			$salida.= $titulo;
			if ($this->RedirigePag=='0'){
				$salida.= '<div id="b'.$id.'" class="btn btn-default botAmpliarNot" title="Ver artículo">Ver</div>';
			} else {
				$salida.= '<a href="'.$this->Urlpag.'/1/'.$this->RegistrosPagina.'/'.$id.'">
						<div class="btn btn-default botAmpliarNot" title="Ver artículo">Ver
						</div></a>';
			}
			if ($this->MostrarFecha=='1') {
				$salida.= '<div class="contFecha">'.$fecha.'</div>';
			}	
		$salida.= '</div></div>';
		return $salida;
	}

	//funcion para crear el encabezado
	private function Encabezado(){
		$salida='
			<div class="panel panel-gral">
  				<div class="panel-heading">
    				<'.$this->EtiquetaTitulo.' class="'.
						$this->ClaseTitulo.'">'.$this->TituloSeccion.'</'.$this->EtiquetaTitulo.'>'.
				'</div>
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
							<h5>Pagina actual: '.$this->PaginaActual.' / '.($this->LimitePaginas+1).'</h5> 
							<a href="'.$this->PrePag().'"> Anterior </a> 
							<a href="'.$this->SigPag().'"> Siguiente </a> 
						</div> 
					<div class="col-md-4 col-lg-4"> 
					<div class="suscribe" >
						<a href="'.Url::to(['/suscriptor/suscribe'], true).'">Suscribite vía mail y recibí nuestras novedades!</a>
						</div> 
					</div> 
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
			$mostrar.= $this->MostrarRegistro($data['id'],$data[$this->CampoTitulo],$data[$this->CampoCuerpo],$data['fecha']);
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
