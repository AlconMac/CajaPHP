<?php
//Entidad - TIPO_COMPROBANTE
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Tipo_comprobante implements thisClass { 
	 private $idcomp; 
	 private $nombre; 

 
	public function setIdcomp($idcomp)
	{
		$this->idcomp=$idcomp;
	}
 
	public function getIdcomp()
	{
		return $this->idcomp;
	}
 
	public function setNombre($nombre)
	{
		$this->nombre=$nombre;
	}
 
	public function getNombre()
	{
		return $this->nombre;
	}
 } 
?>