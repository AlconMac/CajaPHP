<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of control_cajaReporteControl
 *
 * @author Luis
 */
include_once 'ModelMVC/Tipo_comprobanteModel.php';
include_once 'ModelMVC/CajaModel.php';
include_once 'ModelMVC/SaldosModel.php';
include_once 'ModelMVC/Control_cajaModel.php';
include_once 'EntidadMVC/Tipo_comprobante.php';
include_once 'EntidadMVC/Caja.php';
include_once 'EntidadMVC/Control_caja.php';
include_once 'EntidadMVC/Saldos.php';

class control_cajaReporteControl {
    public function __construct()
    {
    	$this->view = new Vista();
    }
    
    public function index($textAlerta=null)
    { 
       $data=array(); 
       $data['ListTipoComprobate']=  Tipo_comprobanteModel::Listar();
       $this->view->ver('control_cajaReporte.php',$data);
    }
    
    /**
     * 
     * @param type $idOperacion
     * @param type $idcomprobante
     * @param type $fecha
     * @return float
     */
    public static function BuscarMonto($idOperacion,$idcomprobante,$fecha) {
        $oCaja=new Caja();
        $oCaja->setIdcomp($idcomprobante);
        $oCaja->setIdoperacion($idOperacion);
        $oCaja->setFecha($fecha);
        $oCajaOut=  CajaModel::BuscarTipoComprobante($oCaja);    
        $monto=$oCajaOut->getMonto();
        return $monto;
    }
    
   /**
    * 
    * @param Date $fecha
    * @return Saldos
    */
    public static function BuscarSaldo($fecha) {
        $oSaldos=new Saldos();
        $oSaldos->setFecha($fecha);
        $oSaldosOut= SaldosModel::Buscar($oSaldos);
        return $oSaldosOut;
    }
    
    /**
     * 
     * @return string
     */
    public static function Fecha() {        
        return (isset($_GET['fechab']) && is_string($_GET['fechab']))?date("Y-m-d",strtotime($_GET['fechab'])):date("Y-m-d");
    }
    
    /**
     * 
     * @return type
     */
    public static function oFecha() {
        $fecha=self::Fecha();
        $fecha=  explode("-",$fecha);
        return (object)array("year"=>$fecha[0],"mes"=>$fecha[1],"dia"=>$fecha[2]);
    }
    
    /**
     * 
     * @return array
     */
    public static function ListaDetalle() {
        $oControlCaja=new Control_caja();
        $oControlCaja->setFecha(self::Fecha());
        $ListaDetalle=array();
        $lisDt=  Control_cajaModel::ListaDetalle($oControlCaja);        
        if($lisDt)
        {
            $ingreso=0;
            $salida=0;
            $iddec=0;
            foreach($lisDt as $row){
                if($iddec!=$row->getIddec()){
                    $ingreso=0;
                    $salida=0; 
                    $iddec=$row->getIddec();
                }
                
                if($row->getIdoperacion()==1)#Ingresos
                    $ingreso=$row->getImporte();                    
                else if($row->getIdoperacion()==2)#Salidas
                    $salida=$row->getImporte();
                    
                $ListaDetalle[$row->getIddec()]=array("descripcion"=>$row->getDescripcion(),"ingreso"=>$ingreso,"salida"=>$salida);
                
            }
        }
        return $ListaDetalle;
    }
}

?>
