<?php
//Entidad - TIPO_DESCRIPCION
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Tipo_descripcion implements thisClass { 
	 private $iddec; 
	 private $descripcion; 
	 private $fecha_regi; 

 
	public function setIddec($iddec)
	{
		$this->iddec=$iddec;
	}
 
	public function getIddec()
	{
		return $this->iddec;
	}
 
	public function setDescripcion($descripcion)
	{
		$this->descripcion=$descripcion;
	}
 
	public function getDescripcion()
	{
		return $this->descripcion;
	}
 
	public function setFecha_regi($fecha_regi)
	{
		$this->fecha_regi=$fecha_regi;
	}
 
	public function getFecha_regi()
	{
		return $this->fecha_regi;
	}
 } 
?>