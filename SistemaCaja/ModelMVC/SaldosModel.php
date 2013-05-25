<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaldosModel
 *
 * @author Luis
 */
class SaldosModel {
    /**
     * 
     * @param Saldos $oSaldos
     * @return Saldos
     */
       public static function Buscar(Saldos $oSaldos) {
        $conec = conexion_db::getInstance();
        $tpd = $conec->prepare("select fecha,sum(monto) as monto from saldos 
            where fecha<?  group by fecha order by fecha desc limit 1");//
        $tpd->setDate(0,$oSaldos->getFecha());
        $rs = $conec->Execute($tpd);        
        
        if ($rs) {            
            if ($conec->nrows($rs) > 0) {               
                $rowD = $conec->fetchArray($rs);    					
                $oSaldoOut = new Saldos();
                $oSaldoOut->setFecha($rowD['fecha']);
                $oSaldoOut->setMonto($rowD['monto']);
                return $oSaldoOut;
            } else {
                return new Saldos();
            }
        } else {
            return new Saldos();
        }
    }
}

?>
