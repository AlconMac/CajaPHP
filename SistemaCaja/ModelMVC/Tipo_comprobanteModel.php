<?php
//Modelo - TIPO_COMPROBANTE
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 
 include_once 'lib/_ArrayList.php';
class Tipo_comprobanteModel { 

 	 //Sql 
 	public static function Sql(Tipo_comprobante $oTipo_comprobante=null)
	{
		 $sql="select idcomp,nombre from tipo_comprobante";
		 return strtolower($sql);		
	}
 	 //Guardar 
 	public static function Guardar(Tipo_comprobante $oTipo_comprobante)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("insert into tipo_comprobante(idcomp,nombre)
					  values(?,?)");
	    
	 	$tpd->setInt(0,$oTipo_comprobante->getIdcomp());
	 	$tpd->setString(1,$oTipo_comprobante->getNombre());

		$rs=$conec->Execute($tpd);
		return $rs;   
	}
 	 //Buscar 
 	public static function Buscar(Tipo_comprobante $oTipo_comprobante)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idcomp,nombre from tipo_comprobante where idcomp=?");
	 	$tpd->setInt(0,$oTipo_comprobante->getIdcomp());

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$rowD=$conec->fetchArray($rs);
				$oTipo_comprobanteOut=new Tipo_comprobante();
	 	 	 	$oTipo_comprobanteOut->setIdcomp($rowD['idcomp']);
	 	 	 	$oTipo_comprobanteOut->setNombre($rowD['nombre']);
		
				return $oTipo_comprobanteOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 	 //Actualizar 
 	public static function Actualizar(Tipo_comprobante $oTipo_comprobante)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("update tipo_comprobante set nombre=? where idcomp=?");
	 	$tpd->setString(0,$oTipo_comprobante->getNombre());
	 	$tpd->setInt(1,$oTipo_comprobante->getIdcomp());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Eliminar 
 	public static function Eliminar(Tipo_comprobante $oTipo_comprobante)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("delete from tipo_comprobante where idcomp=?");
	 	$tpd->setInt(0,$oTipo_comprobante->getIdcomp());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Listar 
 	public static function Listar(Tipo_comprobante $oTipo_comprobante=null)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idcomp,nombre from tipo_comprobante");

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$lisRow=$conec->fetchEach($rs);
				$lisArray=new _ArrayList();
				foreach($lisRow as $rowD){
					$oTipo_comprobanteOut=new Tipo_comprobante();
	 	 	 	$oTipo_comprobanteOut->setIdcomp($rowD['idcomp']);
	 	 	 	$oTipo_comprobanteOut->setNombre($rowD['nombre']);

				  	$lisArray->add($oTipo_comprobanteOut);	
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