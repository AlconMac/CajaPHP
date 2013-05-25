<?php
//Modelo - TIPO_OPERACION
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 
class Tipo_operacionModel { 

 	 //Sql 
 	public static function Sql(Tipo_operacion $oTipo_operacion=null)
	{
		 $sql="select idoperacion,nombre from tipo_operacion";
		 return strtolower($sql);		
	}
 	 //Guardar 
 	public static function Guardar(Tipo_operacion $oTipo_operacion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("insert into tipo_operacion(idoperacion,nombre)
					  values(?,?)");
	    
	 	$tpd->setInt(0,$oTipo_operacion->getIdoperacion());
	 	$tpd->setString(1,$oTipo_operacion->getNombre());

		$rs=$conec->Execute($tpd);
		return $rs;   
	}
 	 //Buscar 
 	public static function Buscar(Tipo_operacion $oTipo_operacion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idoperacion,nombre from tipo_operacion where idoperacion=?");
	 	$tpd->setInt(0,$oTipo_operacion->getIdoperacion());

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$rowD=$conec->fetchArray($rs);
				$oTipo_operacionOut=new Tipo_operacion();
	 	 	 	$oTipo_operacionOut->setIdoperacion($rowD['idoperacion']);
	 	 	 	$oTipo_operacionOut->setNombre($rowD['nombre']);
		
				return $oTipo_operacionOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 	 //Actualizar 
 	public static function Actualizar(Tipo_operacion $oTipo_operacion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("update tipo_operacion set nombre=? where idoperacion=?");
	 	$tpd->setString(0,$oTipo_operacion->getNombre());
	 	$tpd->setInt(1,$oTipo_operacion->getIdoperacion());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Eliminar 
 	public static function Eliminar(Tipo_operacion $oTipo_operacion)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("delete from tipo_operacion where idoperacion=?");
	 	$tpd->setInt(0,$oTipo_operacion->getIdoperacion());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Listar 
 	public static function Listar(Tipo_operacion $oTipo_operacion=null)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idoperacion,nombre from tipo_operacion");

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$lisRow=$conec->fetchEach($rs);
				$lisArray=new _ArrayList();
				foreach($lisRow as $rowD){
					$oTipo_operacionOut=new Tipo_operacion();
	 	 	 	$oTipo_operacionOut->setIdoperacion($rowD['idoperacion']);
	 	 	 	$oTipo_operacionOut->setNombre($rowD['nombre']);

				  	$lisArray->add($oTipo_operacionOut);	
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