<?php
//Modelo - USUARIO
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 
 include_once 'conec/conexion_db.php';
class UsuarioModel{
 	 //Sql 
 	public static function Sql(Usuario $oUsuario=null)
	{
		 $sql="select idusu,nombres,apellidos,usu,clave,estado from usuario";
		 return strtolower($sql);		
	}
 	 //Guardar 
 	public static function Guardar(Usuario $oUsuario)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("insert into usuario(idusu,nombres,apellidos,usu,clave,estado)
					  values(?,?,?,?,?,?)");
	    
	 	$tpd->setInt(0,$oUsuario->getIdusu());
	 	$tpd->setString(1,$oUsuario->getNombres());
	 	$tpd->setString(2,$oUsuario->getApellidos());
	 	$tpd->setString(3,$oUsuario->getUsu());
	 	$tpd->setInt(4,$oUsuario->getClave());
	 	$tpd->setInt(5,$oUsuario->getEstado());

		$rs=$conec->Execute($tpd);
		return $rs;   
	}
 	 //Buscar 
 	public static function Buscar(Usuario $oUsuario)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idusu,nombres,apellidos,usu,clave,estado from usuario where idusu=?");
	 	$tpd->setInt(0,$oUsuario->getIdusu());

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$rowD=$conec->fetchArray($rs);
				$oUsuarioOut=new Usuario();
	 	 	 	$oUsuarioOut->setIdusu($rowD['idusu']);
	 	 	 	$oUsuarioOut->setNombres($rowD['nombres']);
	 	 	 	$oUsuarioOut->setApellidos($rowD['apellidos']);
	 	 	 	$oUsuarioOut->setUsu($rowD['usu']);
	 	 	 	$oUsuarioOut->setClave($rowD['clave']);
	 	 	 	$oUsuarioOut->setEstado($rowD['estado']);
		
				return $oUsuarioOut;
			}else{
				return false;
			}
		}else{
		  return false;   
		}
	}
 	 //Actualizar 
 	public static function Actualizar(Usuario $oUsuario)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("update usuario set nombres=?,apellidos=?,usu=?,clave=?,estado=? where idusu=?");
	 	$tpd->setString(0,$oUsuario->getNombres());
	 	$tpd->setString(1,$oUsuario->getApellidos());
	 	$tpd->setString(2,$oUsuario->getUsu());
	 	$tpd->setInt(3,$oUsuario->getClave());
	 	$tpd->setInt(4,$oUsuario->getEstado());
	 	$tpd->setInt(5,$oUsuario->getIdusu());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Eliminar 
 	public static function Eliminar(Usuario $oUsuario)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("delete from usuario where idusu=?");
	 	$tpd->setInt(0,$oUsuario->getIdusu());

		$rs=$conec->Execute($tpd);
		return $rs; 
	}
 	 //Listar 
 	public static function Listar(Usuario $oUsuario=null)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("select idusu,nombres,apellidos,usu,clave,estado from usuario");

		$rs=$conec->Execute($tpd);
		if($rs){
		    if($conec->nrows($rs)>0){
				$lisRow=$conec->fetchEach($rs);
				$lisArray=new _ArrayList();
				foreach($lisRow as $rowD){
					$oUsuarioOut=new Usuario();
	 	 	 	$oUsuarioOut->setIdusu($rowD['idusu']);
	 	 	 	$oUsuarioOut->setNombres($rowD['nombres']);
	 	 	 	$oUsuarioOut->setApellidos($rowD['apellidos']);
	 	 	 	$oUsuarioOut->setUsu($rowD['usu']);
	 	 	 	$oUsuarioOut->setClave($rowD['clave']);
	 	 	 	$oUsuarioOut->setEstado($rowD['estado']);

				  	$lisArray->add($oUsuarioOut);	
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
        
 	//Acceso Login
        /**
         * 
         * @param Usuario $oUsuario
         * @return \Usuario
         */
 	public static function Login(Usuario $oUsuario)
	{
		$conec=conexion_db::getInstance();
		$tpd=$conec->prepare("call PRD_LOGIN(?,?)");	    
	 	$tpd->setString(0,$oUsuario->getUsu());
	 	$tpd->setString(1,$oUsuario->getClave());
		$rs=$conec->Execute($tpd);                
                if($rs){                    
                    if($conec->nrows($rs)>0){
                        $row=$conec->fetchArray($rs);                        
                        $oUsuarioOut=new Usuario();
                        $oUsuarioOut->setIdusu($row['idusu']);
                        $oUsuarioOut->setApellidos($row['apellidos']);
                        $oUsuarioOut->setNombres($row['nombres']);
                        return $oUsuarioOut;
                    }else{
                       return new Usuario();
                    }
                }else{
		  return new Usuario();
                }
	}        
 } 
?>