<?php
//Entidad - USUARIO
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //E-mail: lalcantata@gmail.com 
 //Lima - Perú 
include_once 'ModelMVC/interface/thisClass.php';
class Usuario implements thisClass { 
	 private $idusu; 
	 private $nombres; 
	 private $apellidos; 
	 private $usu; 
	 private $clave; 
	 private $estado; 

 
	public function setIdusu($idusu)
	{
		$this->idusu=$idusu;
	}
 
	public function getIdusu()
	{
		return $this->idusu;
	}
 
	public function setNombres($nombres)
	{
		$this->nombres=$nombres;
	}
 
	public function getNombres()
	{
		return $this->nombres;
	}
 
	public function setApellidos($apellidos)
	{
		$this->apellidos=$apellidos;
	}
 
	public function getApellidos()
	{
		return $this->apellidos;
	}
 
	public function setUsu($usu)
	{
		$this->usu=$usu;
	}
 
	public function getUsu()
	{
		return $this->usu;
	}
 
	public function setClave($clave)
	{
		$this->clave=$clave;
	}
 
	public function getClave()
	{
		return $this->clave;
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