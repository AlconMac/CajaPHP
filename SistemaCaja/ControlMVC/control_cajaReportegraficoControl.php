<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of control_cajaReportegraficoControl
 *
 * @author Luis
 */
include_once 'ModelMVC/Control_cajaModel.php';
include_once 'EntidadMVC/Control_caja.php';

class control_cajaReportegraficoControl {

    public function __construct() {
        $this->view = new Vista();
    }

    public function index() {
        $data = array();
        $fechaa = self::oFecha();
        $data["fechaYear"] = $fechaa->year;
        $data["fechaMes"] = $fechaa->mes;

        ;

        $this->view->ver("control_cajaReporteGrafico.php", $data);
    }

    /**
     * 
     * @return type
     */
    public static function DataGrafico($year, $mes = null) {
        $lisData = null;
        $ListaDetalleC = array();
        $ingreso = array();
        $salida = array();
        $categoria = array();
        $titulo="Control de Caja";
        $subtitulo="";
        $PorYear=true;
        
        
        if ($mes != ""){
            $lisData = Control_cajaModel::ListaCajaReporte(null, $year, $mes);  
            $subtitulo=$year."/".$mes;
            $PorYear=false;
        }else{
            $lisData = Control_cajaModel::ListaCajaReporte(null, $year, null);
            $subtitulo=$year;
        }


        if ($lisData) {
            $fechag = '';
            foreach ($lisData as $row) {
                if ($fechag != $row->getFechag()) {
                    $fechag = $row->getFechag();
                    if($PorYear)
                        $categoria[]=date("M",  strtotime($row->getFecha()));
                    else
                       $categoria[]=date("d",  strtotime($row->getFecha())); 
                }

                if ($row->getIdoperacion() == 1)#Ingresos
                    $ingreso[] = $row->getImporte();
                else if ($row->getIdoperacion() == 2)#Salidas
                    $salida[] = $row->getImporte();
            }
        }
        
        $arrayData = array(
            "titulo" => $titulo,
            "subtitulo" => $subtitulo,
            "categorias" => $categoria,
            "ingresos" => $ingreso,
            "salidas" => $salida
        );
        return json_encode($arrayData);
    }

    /**
     * 
     * @return string
     */
    public static function Fecha() {
        return (isset($_GET['fechab']) && is_string($_GET['fechab'])) ? date("Y-m", strtotime($_GET['fechab'])) : date("Y-m-d");
    }

    /**
     * 
     * @return type
     */
    public static function oFecha() {
        $fecha = (isset($_GET['fechab']) && is_string($_GET['fechab'])) ? $_GET['fechab'] : date("Y-m");
        $fecha = explode("-", $fecha);
        return (object) array("year" => $fecha[0], "mes" => $fecha[1]);
    }

}

?>
