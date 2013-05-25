<?php
//Entidad - TIPO_MONEDA
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Tipo_moneda implements thisClass { 
	 private $idmone; 
	 private $nombre; 
	 private $iniciales; 

 
	public function setIdmone($idmone)
	{
		$this->idmone=$idmone;
	}
 
	public function getIdmone()
	{
		return $this->idmone;
	}
 
	public function setNombre($nombre)
	{
		$this->nombre=$nombre;
	}
 
	public function getNombre()
	{
		return $this->nombre;
	}
 
	public function setIniciales($iniciales)
	{
		$this->iniciales=$iniciales;
	}
 
	public function getIniciales()
	{
		return $this->iniciales;
	}
 } 
?>