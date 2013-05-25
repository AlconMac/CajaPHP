<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Saldos
 *
 * @author Luis
 */
class Saldos {
   private $fecha;
   private $monto;
   public function getFecha() {
       return $this->fecha;
   }

   public function setFecha($fecha) {
       $this->fecha = $fecha;
   }

   public function getMonto() {
       return $this->monto;
   }

   public function setMonto($monto) {
       $this->monto = $monto;
   }


}

?>
