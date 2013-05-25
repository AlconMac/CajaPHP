<?php
//Entidad - TIPO_OPERACION
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Tipo_operacion implements thisClass { 
	 private $idoperacion; 
	 private $nombre; 

 
	public function setIdoperacion($idoperacion)
	{
		$this->idoperacion=$idoperacion;
	}
 
	public function getIdoperacion()
	{
		return $this->idoperacion;
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