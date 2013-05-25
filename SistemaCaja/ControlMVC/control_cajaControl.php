<?php
//Controlodor - CONTROL_CAJA
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 

include_once 'LibreriasMVC/_Form.php';
include_once 'LibreriasMVC/_Crifrado.php';
include_once 'ModelMVC/_QueryModel.php';
include_once 'EntidadMVC/Control_caja.php';
include_once 'ModelMVC/Control_cajaModel.php';			
include_once 'EntidadMVC/Tipo_comprobante.php';
include_once 'EntidadMVC/Tipo_descripcion.php';
include_once 'EntidadMVC/Tipo_moneda.php';
include_once 'EntidadMVC/Tipo_operacion.php';
include_once 'ModelMVC/Tipo_comprobanteModel.php';
include_once 'ModelMVC/Tipo_descripcionModel.php';
include_once 'ModelMVC/Tipo_monedaModel.php';
include_once 'ModelMVC/Tipo_operacionModel.php';

class control_cajaControl extends _Form { 

 	
	public function __construct()
    {
    	$this->view = new Vista();
    }		
	   
 	
	//Control Index
	public function index($textAlerta=null,$whereBusqueda=null){ 
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        //
        //$oControl_caja=new Control_caja();
        $sql=  Control_cajaModel::Sql(null,$whereBusqueda);
        $pag=(isset($_GET['pag']))?$_GET['pag']:1;
        $queryPg=new _QueryModel($pag);
        $queryPg->query($sql,20);//se mostrara de 10 en 10 registros           
        $listObjeto=$queryPg->ArrayListObjeto(new Control_caja);
        $data['lista']=$listObjeto;
        $data['nregistros']=$queryPg->getRows();
        $data['nregistrostotal']=$queryPg->getRowsAll();
        
        $data['pagSiguiente']=$queryPg->getPageNext('?ctr=control_caja&pag=');
        $data['pagAnterior']=$queryPg->getPagePrevious('?ctr=control_caja&pag=');
        $data['paginacion']=$queryPg->getPageGroup('?ctr=control_caja&pag=',3, 'paginacion');
        //
	$this->view->ver('control_cajaListar.php',$data);	
	}
		
 	
	//Formulario
    public function form($textAlerta=null){
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        $data['updateix']=  self::idUpdateWrite();
        if(self::idUpdate()!=null){
        	$oControl_caja=new Control_caja();
            $oControl_caja->setIdccaja(self::idUpdate());
            $objForm= Control_cajaModel::Buscar($oControl_caja);               
        }else{               
        	$objForm=new Control_caja(); 
        }
        
          $data['objForm']=$objForm;
          
          $data['ListTipoComprobate']=  Tipo_comprobanteModel::Listar();
          $data['ListTipoMoneda']= Tipo_monedaModel::Listar();
          $data['ListTipoOperacion']= Tipo_operacionModel::Listar();
          $data['ListTipoDescripcion']= Tipo_descripcionModel::Listar();
          
	  $this->view->ver('form/control_cajaForm.php',$data);	               
     }
		
 	
	//Control Guardar 
 	public function guardar(){
		 
 	 	$idcomp=(self::POST('txtidcomp'))?self::ScapeString($_POST['txtidcomp']):'';
 	 	$idmone=(self::POST('txtidmone'))?self::ScapeString($_POST['txtidmone']):'';
 	 	$idoperacion=(self::POST('txtidoperacion'))?self::ScapeString($_POST['txtidoperacion']):'';
 	 	$fecha=(self::POST('txtfecha'))?self::ScapeString($_POST['txtfecha']):'';
 	 	$idusu=  loginControl::idUsuario();
 	 	$numcomprobante=(self::POST('txtnumcomprobante'))?self::ScapeString($_POST['txtnumcomprobante']):'';
 	 	$importe=(self::POST('txtimporte'))?self::ScapeString($_POST['txtimporte']):'';
 	 	$cantidad=(self::POST('txtcantidad'))?self::ScapeString($_POST['txtcantidad']):'';
 	 	$observacion=(self::POST('txtobservacion'))?self::ScapeString($_POST['txtobservacion']):'';
                $descriocion=(self::POST('txtdescripcion'))?self::ScapeString($_POST['txtdescripcion']):'';
                $fecha=  str_replace("/", "-",$fecha);
            //           
           if($idcomp!="")
           {
              if(self::validaToken())
              {
                $oControl_caja=new Control_caja();
 	 	 	 	$oControl_caja->setIdcomp($idcomp);
 	 	 	 	$oControl_caja->setIdmone($idmone);
 	 	 	 	$oControl_caja->setIdoperacion($idoperacion);
                                $oControl_caja->setFecha(date("Y-m-d",  strtotime($fecha)));
 	 	 	 	$oControl_caja->setDescripcion($descriocion);
 	 	 	 	$oControl_caja->setIdusu($idusu);
                                if($numcomprobante=="") $numcomprobante=" ";
 	 	 	 	$oControl_caja->setNum_comprobante($numcomprobante);
 	 	 	 	$oControl_caja->setImporte($importe);
 	 	 	 	$oControl_caja->setCantidad($cantidad);
                                if($observacion=="") $observacion=" ";
 	 	 	 	$oControl_caja->setObservacion($observacion);
                $idUpdate=  _Form::validaIdUpdate();
                if($idUpdate!=null){
                   $id=$idUpdate; // _Crifrado::desencriptar($idUpdate, 'formControl_cajaUpdate');
                   if(is_numeric($id)){
                       $oControl_caja->setIdccaja($id);
                        if(Control_cajaModel::Actualizar($oControl_caja)){
                            $textAlerta='Datos actualizados correctamente'; 
                        }else{
                            $textAlerta='Error al intentar actualizar los datos'; 
                        }                       
                   }else{
                       $textAlerta='Error al intentar actualizar los datos!';
                   }
                }else{
                    if(Control_cajaModel::Guardar($oControl_caja)){
                        $textAlerta='Datos guardados correctamente'; 
                    }else{
                        $textAlerta='Erro al guardar los datos'; 
                    }
                }
                
                $this->form($textAlerta);
              }else{
                $this->form();  
              }
           }else{
               $this->form();
           }
	}
		
 	
        //Control Eliminar 
 	 public function eliminar(){
            $id=  self::idDelete();
            if($id!=null && is_numeric($id))
            {
                $oControl_caja=new Control_caja();
                $oControl_caja->setIdccaja($id);
                if(Control_cajaModel::Eliminar($oControl_caja))
                    $textAlerta='Datos borrados correctamente';
                else
                    $textAlerta='Erro al intentar borrar los datos';
                
                $this->index($textAlerta);
            }else{
                $id=  explode(",", $id);
                if(count($id)){
                    $rr=0;
                    foreach($id as $ix=>$c){
                        $oControl_caja=new Control_caja();
                        $oControl_caja->setIdccaja($c);
                        if(!Control_cajaModel::Eliminar($oControl_caja))
                             $rr++;
                    }
                    
                    if($rr==0)
                        $textAlerta='Datos borrados correctamente';
                    else
                        $textAlerta='Erro al intentar borrar los datos';
                    
                    $this->index($textAlerta);
                }  else {
                    $this->index();
                }
                
            }
            
	}
		
 	
	//Control Buscar 
 	 public function buscar()
        {
             $idFiltro=(isset($_GET['tipofind']))?(int)$_GET['tipofind']:0;
             $txtFiltro=(isset($_GET['txtfind']))?(string)$_GET['txtfind']:'';
             if($idFiltro>0)
             {
                 $oCampos= Control_cajaModel::Campos();
                 $campoFiltro=$oCampos[$idFiltro];
                 if($idFiltro===1)#si es fecha
                 {
                     $txtFiltro=  str_replace ("/","-",$txtFiltro);
                     $txtFiltro=date("Y-m-d",  strtotime($txtFiltro));
                 }   
                     
                 if(trim($txtFiltro)!="")
                    $this->index(null," and ".$campoFiltro." like '%".tipo_datos::getScapeString($txtFiltro)."%'");
                 else
                    $this->index(null," and ".$campoFiltro." = '' or ".$campoFiltro." = null"); 
             }else{
                $this->index();
             }
	}
		
 	
       //Exportar
        public function exportar() {
            header("Expires: Mon, 12 Oct 2012 05:00:00 GMT"); 
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT"); 
            header("Cache-Control: no-cache, must-revalidate"); 
            header("Pragma: no-cache"); 
            header("Content-type: application/x-msexcel"); 
            header("Content-Disposition: attachment; filename=Control_caja.xls" ); 
            header("Content-Description: PHP/INTERBASE Generated Data" ); 
            header("Expires: 0");        
            
            $oControl_caja=new Control_caja();
            $sql=  Control_cajaModel::Sql($oControl_caja);            
            $queryPg=new _QueryModel();
            $queryPg->query($sql);    
            $listObjeto=$queryPg->fetchEach();
            
            $columnas=$queryPg->fetchFields();
            $columnasExport='';
            foreach($columnas as $cam){
                $columnasExport.=$cam->name."\t ";
            }
            $columnasExport.="\n";
            echo $columnasExport;//Nombre de las Columnas
            
            $data="";           
            foreach($listObjeto as $roU){                
                foreach($columnas as $cam)
                    $data.="".$roU[$cam->name]."\t ";
                $data.="\n ";                
                echo $data;//Fila de los datos
                $data="";
            }
            
        }
	
        
        /**
         * Objeto Tipo Comprobante
         * @param type $idcomp
         * @return \Tipo_comprobante
         */
        public static function oComprobante($idcomp) {
           $oTipo_comprobante=new Tipo_comprobante();
           $oTipo_comprobante->setIdcomp($idcomp);
           $oComprobanteOut=Tipo_comprobanteModel::Buscar($oTipo_comprobante);
           if($oComprobanteOut)
                return $oComprobanteOut;
           else
               return new Tipo_comprobante ();
        }
        
        /**
         * Objeto Tipo Moneda
         * @param type $idmone
         * @return \Tipo_moneda
         */
        public static function oMoneda($idmone) {
           $oTipoMoneda=new Tipo_moneda();
           $oTipoMoneda->setIdmone($idmone);
           $oMonedaOut=  Tipo_monedaModel::Buscar($oTipoMoneda);
           if($oMonedaOut)
                return $oMonedaOut;
           else
               return new Tipo_moneda ();
        }        
        
        /**
         * Objeto Tipo Operacion
         * @param type $idopr
         * @return \Tipo_operacion
         */
        public static function oOperacion($idopr) {
           $oTipoOperacion=new Tipo_operacion();
           $oTipoOperacion->setIdoperacion($idopr);
           $oTipoOperacionOut= Tipo_operacionModel::Buscar($oTipoOperacion);
           if($oTipoOperacionOut)
                return $oTipoOperacionOut;
           else
               return new Tipo_operacion();
        }                
        
        /**
         * Objeto Descripcion
         * @param type $iddec
         * @return \Tipo_descripcion
         */
        public static function oDescripcion($iddec) {
           $oDescripcion=new Tipo_descripcion();
           $oDescripcion->setIddec($iddec);
           $oDescripcionOut= Tipo_descripcionModel::Buscar($oDescripcion);
           if($oDescripcionOut)
                return $oDescripcionOut;
           else
               return new Tipo_descripcion();
        }                        
 } 
?>