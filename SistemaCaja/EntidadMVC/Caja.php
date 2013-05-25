<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caja
 *
 * @author Luis
 */
class Caja {
   private $fecha;
   private $monto;
   private $idcomp;
   private $idoperacion;
   public function getIdcomp() {
       return $this->idcomp;
   }

   public function setIdcomp($idcomp) {
       $this->idcomp = $idcomp;
   }

   public function getIdoperacion() {
       return $this->idoperacion;
   }

   public function setIdoperacion($idoperacion) {
       $this->idoperacion = $idoperacion;
   }

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
