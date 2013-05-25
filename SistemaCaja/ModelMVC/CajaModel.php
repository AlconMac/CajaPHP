<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaModel
 *
 * @author Luis
 */
class CajaModel {

    //Sql 
    public static function Sql(Caja $oCaja = null) {
        $sql = "select fecha,monto from caja";
        return strtolower($sql);
    }

    //Guardar 
    public static function Guardar(Caja $oCaja) {
        return true;
    }

    //Buscar 
    public static function Buscar(Caja $oCaja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select fecha,monto from caja where fecha=?");
        $tpd->setDate(0, $oCaja->getFecha());

        $rs = $conec->Execute($tpd);
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $rowD = $conec->fetchArray($rs);
                $oCajaOut = new Caja();
                $oCajaOut->setFecha($rowD['fecha']);
                $oCajaOut->setMonto($rowD['monto']);

                return $oTipo_comprobanteOut;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Actualizar 
    public static function Actualizar(Tipo_comprobante $oTipo_comprobante) {
        return true;
    }

    //Eliminar 
    public static function Eliminar(Tipo_comprobante $oTipo_comprobante) {
        return true;
    }

    //Listar 
    public static function Listar(Caja $oCaja = null) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select fecha,montofrom caja");

        $rs = $conec->Execute($tpd);
        if ($rs) {
            if ($conec->nrows($rs) > 0) {
                $lisRow = $conec->fetchEach($rs);
                $lisArray = new _ArrayList();
                foreach ($lisRow as $rowD) {
                    $oCajaOut = new Caja();
                    $oCajaOut->setFecha($rowD['fecha']);
                    $oCajaOut->setMonto($rowD['monto']);
                    $lisArray->add($oCajaOut);
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

    
    //Buscar reporte
    /**
     * 
     * @param Caja $oCaja
     * @return \Caja
     */
    public static function BuscarTipoComprobante(Caja $oCaja) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select c.fecha,c.monto from caja c 
            where c.idcomp=? and c.idoperacion=? and c.fecha like ?");//call PRD_REPORTE_CAJA_TIPOCOMPR(?,?,?)
        $tpd->setInt(0,$oCaja->getIdcomp());
        $tpd->setInt(1,$oCaja->getIdoperacion());
        $tpd->setDate(2,$oCaja->getFecha());
        $rs = $conec->Execute($tpd);        
        if ($rs) {
            if ($conec->nrows($rs) > 0) {                
                $rowD = $conec->fetchArray($rs);
                $oCajaOut = new Caja();
                $oCajaOut->setFecha($rowD['fecha']);
                $oCajaOut->setMonto($rowD['monto']);                
                return $oCajaOut;
            } else {
                return new Caja();
            }
        } else {
            return new Caja();
        }
    }
    

    
    
}

?>
