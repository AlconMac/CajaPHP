<?php

//Modelo - CONTROL_CAJA
//Fecha: 2012-12-29 
//Autor: ALCON 
//Lima - Perú 
include_once 'lib/_ArrayList.php';
class Control_cajaModel {

    //Sql 
    public static function Campos() {
        $caArray = array(1 => "fecha", 2 => "num_comprobante");
        return $caArray;
    }

    //Sql 
    public static function Sql(Control_caja $oControl_caja = null, $whereBusqueda = null) {
        $sql = "select idccaja,idcomp,idmone,fecha,idoperacion,
                     iddec,idusu,num_comprobante,importe,cantidad,observacion,
                     fecha_regi,fecha_modi,estado from control_caja where estado=1 " . $whereBusqueda . " order by fecha desc";
        return strtolower($sql);
    }

    //Guardar 
    public static function Guardar(Control_caja $oControl_caja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("CALL PRD_CONTROL_CAJA_REGI(?,?,?,?,?,?,?,?,?,?)");
        $tpd->setInt(0, $oControl_caja->getIdcomp());
        $tpd->setInt(1, $oControl_caja->getIdmone());
        $tpd->setInt(2, $oControl_caja->getIdoperacion());
        $tpd->setString(3, $oControl_caja->getDescripcion());
        $tpd->setInt(4, $oControl_caja->getIdusu());
        $tpd->setString(5, $oControl_caja->getNum_comprobante());
        $tpd->setDate(6, $oControl_caja->getFecha());
        $tpd->setFloat(7, $oControl_caja->getImporte());
        $tpd->setInt(8, $oControl_caja->getCantidad());
        $tpd->setString(9, $oControl_caja->getObservacion());
        $rs = $conec->Execute($tpd);
        //echo $conec->getError();
        return $rs;
    }

    //Buscar 
    public static function Buscar(Control_caja $oControl_caja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select idccaja,idcomp,idmone,idoperacion,fecha,
            iddec,idusu,num_comprobante,importe,cantidad,observacion,fecha_regi,
            fecha_modi,estado from control_caja where idccaja=?");
        $tpd->setInt(0, $oControl_caja->getIdccaja());

        $rs = $conec->Execute($tpd);
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $rowD = $conec->fetchArray($rs);
                $oControl_cajaOut = new Control_caja();
                $oControl_cajaOut->setIdccaja($rowD['idccaja']);
                $oControl_cajaOut->setIdcomp($rowD['idcomp']);
                $oControl_cajaOut->setIdmone($rowD['idmone']);
                $oControl_cajaOut->setIdoperacion($rowD['idoperacion']);
                $oControl_cajaOut->setIddec($rowD['iddec']);
                $oControl_cajaOut->setIdusu($rowD['idusu']);
                $oControl_cajaOut->setNum_comprobante($rowD['num_comprobante']);
                $oControl_cajaOut->setImporte($rowD['importe']);
                $oControl_cajaOut->setCantidad($rowD['cantidad']);
                $oControl_cajaOut->setFecha($rowD['fecha']);
                $oControl_cajaOut->setObservacion($rowD['observacion']);
                $oControl_cajaOut->setFecha_regi($rowD['fecha_regi']);
                $oControl_cajaOut->setFecha_modi($rowD['fecha_modi']);
                $oControl_cajaOut->setEstado($rowD['estado']);

                return $oControl_cajaOut;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Actualizar 
    public static function Actualizar(Control_caja $oControl_caja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("CALL PRD_CONTROL_CAJA_MODI(?,?,?,?,?,?,?,?,?,?,?)");
        $tpd->setInt(0, $oControl_caja->getIdcomp());
        $tpd->setInt(1, $oControl_caja->getIdmone());
        $tpd->setInt(2, $oControl_caja->getIdoperacion());
        $tpd->setString(3, $oControl_caja->getDescripcion());
        $tpd->setInt(4, $oControl_caja->getIdusu());
        $tpd->setString(5, $oControl_caja->getNum_comprobante());
        $tpd->setDate(6, $oControl_caja->getFecha());
        $tpd->setFloat(7, $oControl_caja->getImporte());
        $tpd->setInt(8, $oControl_caja->getCantidad());
        $tpd->setString(9, $oControl_caja->getObservacion());
        $tpd->setString(10, $oControl_caja->getIdccaja());
        $rs = $conec->Execute($tpd);        
        return $rs;
    }

    //Eliminar 
    public static function Eliminar(Control_caja $oControl_caja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("CALL PRD_CONTROL_CAJA_ELI(?,?)");
        $tpd->setInt(0, $oControl_caja->getIdccaja());
        $tpd->setString(1, 'Eliminado');
        $rs = $conec->Execute($tpd);
        echo $conec->getError();
        return $rs;
    }

    //Listar 
    public static function Listar(Control_caja $oControl_caja = null) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select idccaja,idcomp,idmone,
            idoperacion,iddec,idusu,num_comprobante,importe,cantidad,observacion,
            fecha_regi,fecha_modi,estado from control_caja");

        $rs = $conec->Execute($tpd);
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $lisRow = $conec->fetchEach($rs);
                $lisArray = new _ArrayList();
                foreach ($lisRow as $rowD) {
                    $oControl_cajaOut = new Control_caja();
                    $oControl_cajaOut->setIdccaja($rowD['idccaja']);
                    $oControl_cajaOut->setIdcomp($rowD['idcomp']);
                    $oControl_cajaOut->setIdmone($rowD['idmone']);
                    $oControl_cajaOut->setIdoperacion($rowD['idoperacion']);
                    $oControl_cajaOut->setIddec($rowD['iddec']);
                    $oControl_cajaOut->setIdusu($rowD['idusu']);
                    $oControl_cajaOut->setNum_comprobante($rowD['num_comprobante']);
                    $oControl_cajaOut->setImporte($rowD['importe']);
                    $oControl_cajaOut->setCantidad($rowD['cantidad']);
                    $oControl_cajaOut->setObservacion($rowD['observacion']);
                    $oControl_cajaOut->setFecha_regi($rowD['fecha_regi']);
                    $oControl_cajaOut->setFecha_modi($rowD['fecha_modi']);
                    $oControl_cajaOut->setEstado($rowD['estado']);

                    $lisArray->add($oControl_cajaOut);
                }
                $lisOut = $lisArray->iterator();
                $lisArray->clear();
                return $lisOut;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @param Control_caja $oControlCaja
     * @return \_ArrayList
     */
    public static function ListaDetalle(Control_caja $oControlCaja) {

        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("CALL PRD_REPORTE_DETALLE_CAJA(?)");
        $tpd->setDate(0,$oControlCaja->getFecha());
        $rs = $conec->Execute($tpd);
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $lisRow = $conec->fetchEach($rs);
                $lisArray = new _ArrayList();
                foreach ($lisRow as $rowD) {
                    $oControl_cajaOut = new Control_caja();
                    //$oControl_cajaOut->setIdccaja($rowD['idccaja']);
                    //$oControl_cajaOut->setIdcomp($rowD['idcomp']);
                    //$oControl_cajaOut->setIdmone($rowD['idmone']);
                    $oControl_cajaOut->setIdoperacion($rowD['idoperacion']);
                    $oControl_cajaOut->setIddec($rowD['iddec']);
                    //$oControl_cajaOut->setIdusu($rowD['idusu']);
                    //$oControl_cajaOut->setNum_comprobante($rowD['num_comprobante']);
                    $oControl_cajaOut->setImporte($rowD['importe']);
                    $oControl_cajaOut->setFecha($rowD['fecha']);
                    $oControl_cajaOut->setDescripcion($rowD['descripcion']);
                    //$oControl_cajaOut->setCantidad($rowD['cantidad']);
                    //$oControl_cajaOut->setObservacion($rowD['observacion']);
                    //$oControl_cajaOut->setFecha_regi($rowD['fecha_regi']);
                    //$oControl_cajaOut->setFecha_modi($rowD['fecha_modi']);
                    //$oControl_cajaOut->setEstado($rowD['estado']);

                    $lisArray->add($oControl_cajaOut);
                }
                $lisOut = $lisArray->iterator();
                $lisArray->clear();
                return $lisOut;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
       /**
        * 
        * @param Control_caja $oControlCaja
        * @return boolean
        */
       public static function ListaCajaReporte(Control_caja $oControlCaja=null,$year,$mes=null) {

        $conec = conexion_db::getInstance();
       
        if(!empty($mes)){
            $sql="select  date_format(cc.fecha,'%Y-%m-%d') as fechag,cc.fecha,sum(cc.importe) as importe,cc.idoperacion from 
                                control_caja cc 
                                inner join tipo_descripcion td on td.iddec=cc.iddec
                                where date_format(cc.fecha,'%Y-%m') = '".$year."-".$mes."' 
                                group by cc.fecha,cc.idoperacion";
        }else{
            $sql="select  date_format(cc.fecha,'%Y-%m') as fechag,cc.fecha,sum(cc.importe) as importe,cc.idoperacion from 
                                control_caja cc 
                                inner join tipo_descripcion td on td.iddec=cc.iddec
                                where date_format(cc.fecha,'%Y') = '".$year."' 
                                group by date_format(cc.fecha,'%Y-%m'),cc.idoperacion";            
        }
        
        $conec->prepare($sql);
        $rs = $conec->Execute();
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $lisRow = $conec->fetchEach($rs);
                $lisArray = new _ArrayList();
                foreach ($lisRow as $rowD) {
                    $oControl_cajaOut = new Control_caja();                    
                    $oControl_cajaOut->setIdoperacion($rowD['idoperacion']);
                    $oControl_cajaOut->setIddec($rowD['iddec']);                    
                    $oControl_cajaOut->setImporte($rowD['importe']);
                    $oControl_cajaOut->setFecha($rowD['fecha']);                    
                    $oControl_cajaOut->setFechag($rowD['fechag']);
                    $lisArray->add($oControl_cajaOut);
                }
                $lisOut = $lisArray->iterator();
                $lisArray->clear();
                return $lisOut;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
    
}

?>