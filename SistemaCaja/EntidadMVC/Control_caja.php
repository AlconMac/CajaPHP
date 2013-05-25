<?php
//Entidad - CONTROL_CAJA
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Control_caja implements thisClass { 
	 private $idccaja; 
	 private $idcomp; 
	 private $idmone; 
	 private $idoperacion; 
	 private $iddec; 
	 private $idusu; 
	 private $num_comprobante; 
	 private $importe; 
	 private $cantidad; 
	 private $observacion; 
	 private $fecha_regi; 
	 private $fecha_modi; 
	 private $estado; 
         private $fecha;
         private $fechag;
         private $descripcion;
         
         public function getFechag() {
             return $this->fechag;
         }

         public function setFechag($fechag) {
             $this->fechag = $fechag;
         }

                  
         public function getDescripcion() {
             return $this->descripcion;
         }

         public function setDescripcion($descripcion) {
             $this->descripcion = $descripcion;
         }

         
         public function getFecha() {
             return $this->fecha;
         }

         public function setFecha($fecha) {
             $this->fecha = $fecha;
         }

         	public function setIdccaja($idccaja)
	{
		$this->idccaja=$idccaja;
	}
 
	public function getIdccaja()
	{
		return $this->idccaja;
	}
 
	public function setIdcomp($idcomp)
	{
		$this->idcomp=$idcomp;
	}
 
	public function getIdcomp()
	{
		return $this->idcomp;
	}
 
	public function setIdmone($idmone)
	{
		$this->idmone=$idmone;
	}
 
	public function getIdmone()
	{
		return $this->idmone;
	}
 
	public function setIdoperacion($idoperacion)
	{
		$this->idoperacion=$idoperacion;
	}
 
	public function getIdoperacion()
	{
		return $this->idoperacion;
	}
 
	public function setIddec($iddec)
	{
		$this->iddec=$iddec;
	}
 
	public function getIddec()
	{
		return $this->iddec;
	}
 
	public function setIdusu($idusu)
	{
		$this->idusu=$idusu;
	}
 
	public function getIdusu()
	{
		return $this->idusu;
	}
 
	public function setNum_comprobante($num_comprobante)
	{
		$this->num_comprobante=$num_comprobante;
	}
 
	public function getNum_comprobante()
	{
		return $this->num_comprobante;
	}
 
	public function setImporte($importe)
	{
		$this->importe=$importe;
	}
 
	public function getImporte()
	{
		return $this->importe;
	}
 
	public function setCantidad($cantidad)
	{
		$this->cantidad=$cantidad;
	}
 
	public function getCantidad()
	{
		return $this->cantidad;
	}
 
	public function setObservacion($observacion)
	{
		$this->observacion=$observacion;
	}
 
	public function getObservacion()
	{
		return $this->observacion;
	}
 
	public function setFecha_regi($fecha_regi)
	{
		$this->fecha_regi=$fecha_regi;
	}
 
	public function getFecha_regi()
	{
		return $this->fecha_regi;
	}
 
	public function setFecha_modi($fecha_modi)
	{
		$this->fecha_modi=$fecha_modi;
	}
 
	public function getFecha_modi()
	{
		return $this->fecha_modi;
	}
 
	public function setEstado($estado)
	{
		$this->estado=$estado;
	}
 
	public function getEstado()
	{
		return $this->estado;
	}
 } 
?>