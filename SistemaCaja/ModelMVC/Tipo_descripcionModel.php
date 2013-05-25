<?php
//Modelo - TIPO_DESCRIPCION
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 
class Tipo_descripcionModel { 

 	 //Sql 
 	public static function Sql(Tipo_descripcion $oTipo_descripcion=null)
	{
		 $sql="select iddec,descripcion,fecha_regi from tipo_descripcion";
		 return strtolower($sql);		
	}
 	 //Guardar 
 	public static function Guardar(Tipo_descripcion $oTipo_descripcion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("insert into tipo_descripcion(iddec,descripcion,fecha_regi)
					  values(?,?,?)");
	    
	 	$tpd->setInt(0,$oTipo_descripcion->getIddec());
	 	$tpd->setString(1,$oTipo_descripcion->getDescripcion());
	 	$tpd->setDateTime(2,$oTipo_descripcion->getFecha_regi());

		$rs=$conec->Execute($tpd);
		return $rs;   
	}
 	 //Buscar 
 	public static function Buscar(Tipo_descripcion $oTipo_descripcion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select iddec,descripcion,fecha_regi from tipo_descripcion where iddec=?");
	 	$tpd->setInt(0,$oTipo_descripcion->getIddec());

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$rowD=$conec->fetchArray($rs);
				$oTipo_descripcionOut=new Tipo_descripcion();
	 	 	 	$oTipo_descripcionOut->setIddec($rowD['iddec']);
	 	 	 	$oTipo_descripcionOut->setDescripcion($rowD['descripcion']);
	 	 	 	$oTipo_descripcionOut->setFecha_regi($rowD['fecha_regi']);
		
				return $oTipo_descripcionOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 	 //Actualizar 
 	public static function Actualizar(Tipo_descripcion $oTipo_descripcion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("update tipo_descripcion set descripcion=?,fecha_regi=? where iddec=?");
	 	$tpd->setString(0,$oTipo_descripcion->getDescripcion());
	 	$tpd->setDateTime(1,$oTipo_descripcion->getFecha_regi());
	 	$tpd->setInt(2,$oTipo_descripcion->getIddec());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Eliminar 
 	public static function Eliminar(Tipo_descripcion $oTipo_descripcion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("delete from tipo_descripcion where iddec=?");
	 	$tpd->setInt(0,$oTipo_descripcion->getIddec());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Listar 
 	public static function Listar(Tipo_descripcion $oTipo_descripcion=null)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select iddec,descripcion,fecha_regi from tipo_descripcion");

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$lisRow=$conec->fetchEach($rs);
				$lisArray=new _ArrayList();
				foreach($lisRow as $rowD){
					$oTipo_descripcionOut=new Tipo_descripcion();
	 	 	 	$oTipo_descripcionOut->setIddec($rowD['iddec']);
	 	 	 	$oTipo_descripcionOut->setDescripcion($rowD['descripcion']);
	 	 	 	$oTipo_descripcionOut->setFecha_regi($rowD['fecha_regi']);

				  	$lisArray->add($oTipo_descripcionOut);	
				}
				 $lisOut=$lisArray->iterator();
				 $lisArray->clear();
				return $lisOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 } 
?>