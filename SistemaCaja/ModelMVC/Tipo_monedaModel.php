<?php
//Modelo - TIPO_MONEDA
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 
class Tipo_monedaModel { 

 	 //Sql 
 	public static function Sql(Tipo_moneda $oTipo_moneda=null)
	{
		 $sql="select idmone,nombre,iniciales from tipo_moneda";
		 return strtolower($sql);		
	}
 	 //Guardar 
 	public static function Guardar(Tipo_moneda $oTipo_moneda)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("insert into tipo_moneda(idmone,nombre,iniciales)
					  values(?,?,?)");
	    
	 	$tpd->setInt(0,$oTipo_moneda->getIdmone());
	 	$tpd->setString(1,$oTipo_moneda->getNombre());
	 	$tpd->setString(2,$oTipo_moneda->getIniciales());

		$rs=$conec->Execute($tpd);
		return $rs;   
	}
 	 //Buscar 
 	public static function Buscar(Tipo_moneda $oTipo_moneda)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idmone,nombre,iniciales from tipo_moneda where idmone=?");
	 	$tpd->setInt(0,$oTipo_moneda->getIdmone());

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$rowD=$conec->fetchArray($rs);
				$oTipo_monedaOut=new Tipo_moneda();
	 	 	 	$oTipo_monedaOut->setIdmone($rowD['idmone']);
	 	 	 	$oTipo_monedaOut->setNombre($rowD['nombre']);
	 	 	 	$oTipo_monedaOut->setIniciales($rowD['iniciales']);
		
				return $oTipo_monedaOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 	 //Actualizar 
 	public static function Actualizar(Tipo_moneda $oTipo_moneda)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("update tipo_moneda set nombre=?,iniciales=? where idmone=?");
	 	$tpd->setString(0,$oTipo_moneda->getNombre());
	 	$tpd->setString(1,$oTipo_moneda->getIniciales());
	 	$tpd->setInt(2,$oTipo_moneda->getIdmone());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Eliminar 
 	public static function Eliminar(Tipo_moneda $oTipo_moneda)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("delete from tipo_moneda where idmone=?");
	 	$tpd->setInt(0,$oTipo_moneda->getIdmone());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Listar 
 	public static function Listar(Tipo_moneda $oTipo_moneda=null)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idmone,nombre,iniciales from tipo_moneda");

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$lisRow=$conec->fetchEach($rs);
				$lisArray=new _ArrayList();
				foreach($lisRow as $rowD){
					$oTipo_monedaOut=new Tipo_moneda();
	 	 	 	$oTipo_monedaOut->setIdmone($rowD['idmone']);
	 	 	 	$oTipo_monedaOut->setNombre($rowD['nombre']);
	 	 	 	$oTipo_monedaOut->setIniciales($rowD['iniciales']);

				  	$lisArray->add($oTipo_monedaOut);	
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