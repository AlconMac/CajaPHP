<?php
/**CONEXION A LA BASE DE DATOS***/
include_once 'tipo_datos.php';
final class conexion_db{
    private $conex;
    private $sql_;
    private $sqlString;
    private $filas;
    private $num_filas;
    private $ultimo_id;
    private $num_filas_affected;   
    private $error;
    private static $_instance;   
   
    //Por defecto Conecta
    private function __construct(){        
        self::conectar();
    }
    
   //Conectar
    private function conectar(){       
       try{
           $this->conex = mysqli_connect('localhost','root','');
            if($this->conex){
                if(!mysqli_select_db($this->conex,'sistemacaja'))
                   {
                   throw new Exception(mysqli_error($this->conex));
                }else{
                  mysqli_query($this->conex,"SET NAMES 'utf8'"); 
		}
            }else
               self::setError("NO SE PUDO CONECTAR CON LA BASE DE DATOS");
        }catch(Exception $e){
	      self::setError($e->getMessage());
              return false;           
        }
   }    
    //Almacenamos los errores
    public function setError($error){
        $this->error=$error;
    } 
    //Obtenemos los errores
    public function getError(){
	  return stripslashes($this->error);
    }
	
    //No clone
    private function __clone(){ } 
   
    //Instanciar la Base de datos
    public static function getInstance(){ 
      if (!(self::$_instance instanceof self)){ 
         self::$_instance=new self(); 
      } 
      return self::$_instance;
    }
   //Iniciamos Transsaccion
   public function OpenTransactions($autocommit=false){
      mysqli_autocommit($this->conex,$autocommit);//mysqli_query($this->conex,'BEGIN;');
   }
   //Rollback 
   public function Rollback(){	     
      mysqli_rollback($this->conex);//mysqli_query($this->conex,'rollback;');
   }
   //Commit
   public function Commit(){
      mysqli_commit($this->conex);//mysqli_query($this->conex,'commit');
      
   }
   
   //prepare
   public function prepare($sql){
       $this->sqlString=$sql;       
       return new tipo_datos();     
   }
   //Ejecutar la sentencia SQL, verificando los tipos de variable
    public function Execute(tipo_datos $oTipo_datos=null){        
        $cadenaOut=$this->sqlString;
        $arrayCadena=  explode("?",$cadenaOut);        
        if(count($arrayCadena)>0 && $oTipo_datos!=null)
        {//Para recorrer los tipos de variables para escapar las inyecciones sql
            $cadenaOut="";
	    $arrayIndexAll=$oTipo_datos->getIndexArrayAll();//todos los array
            for($u=0;$u<count($arrayCadena);$u++)
			{
                if(isset($arrayIndexAll[$u])){                    
                    $cadenaOut.=$arrayCadena[$u]." ".$arrayIndexAll[$u];
                }else{
                   
                    $cadenaOut.=$arrayCadena[$u];  
                }
             }             
             unset($arrayIndexAll);//Eliminamos el array que se uso por cada QUERY
         }//fin recorrido de los tipos de variable  
		
        
         $this->sqlString=$cadenaOut;         
         $e=null;
         try{
            $this->sql_= mysqli_query($this->conex,$cadenaOut);            
            if(!$this->sql_){                
                throw new Exception(mysqli_error($this->conex));
             }else{
                return $this->sql_;
             }
         }catch(Exception $e){
            self::setError(mysqli_error($this->conex));
            return false;
         }         
    }
    //Ver la sentencia sql
    public function SqlToString() {
       return (string)$this->sqlString; 
    }
    
    //Resultados tipo fetchArray
    public function fetchArray($sql){
        try{
            if($sql){
		return mysqli_fetch_array($sql, MYSQL_ASSOC);
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){
             self::setError($e->getMessage());
	     return false;
        }
    }
    //Resultado tipo Objeto
    public static function fetchObject($sql) {
        try{
            if($sql){
		return mysqli_fetch_object($sql);
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){
             self::setError($e->getMessage());
	     return false;
        }        
    }
    
    //Resultados tipo fetchEach
    public function fetchEach($sql){
	    $arrayResu= array();		
        try{
            if($sql){
		while($row = mysqli_fetch_array($sql,MYSQL_ASSOC)){
		  array_push($arrayResu,$row);
		}
		return $arrayResu;		
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){
             self::setError($e->getMessage());
	     return false;
        }
    }
    //Resultados en Numeros
    public function fetchNum($sql){
        try{
            if($sql){
                $this->filas = mysqli_fetch_array($sql, MYSQL_NUM);
                return $this->filas;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){
             self::setError($e->getMessage());
	     return false;
        }
    }
    //Resultado, nuero de filas
    public function nrows($sql){ 
        try{
            if($sql){
                $this->num_filas = mysqli_num_rows($sql);
                return $this->num_filas;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){
            self::setError($e->getMessage());
            return false;
        }
    }
    //Resultado numero de Columnas
    public function nFields($sql){
        
        try{
            if($sql){
                $this->num_filas = mysqli_num_fields($sql);
                return $this->num_filas;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){            
            self::setError($e->getMessage());
	    return false;
        }
    }
    //lista de columnas
    public function fetchFields($sql){
        
        try{
            if($sql){                
                $this->num_filas = mysqli_fetch_fields($sql);
                return $this->num_filas;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){            
            self::setError($e->getMessage());
	    return false;
        }
    } 
    
    //Resultado Filas Afectadas
    public function nrows_affected(){
        try{
            $this->num_filas_affected = mysqli_affected_rows($this->conex);
            if($this->num_filas_affected)
             {
                return $this->num_filas_affected;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){            
            self::setError($e->getMessage());
	    return false;
        }
    }	
    //Extrae el ultimo Id pk de la Tabla (numero autogenerado)
    public function insertid(){        
        try{
            if($this->sql_){
                $this->ultimo_id = mysqli_insert_id($this->conex);
                return $this->ultimo_id;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){            
           self::setError($e->getMessage());
	   return false;
        }
    }
    //Limpia cache de los resultados    
    public function free_result($sql){        
        try{
            if($sql){
                mysqli_free_result($sql);
                return true;
            }else{
                throw new Exception(mysqli_error($this->conex));
            }
        }catch(Exception $e){            
           self::setError($e->getMessage());
           return false;
        }
    }
    //Limpia los caracteres especiales y las inyecciones SQL	
   public function scapeString($text)
   {
	   return mysqli_real_escape_string($this->conex,$text);	
   }
   
   //Destruccion de la clase (cerramos la conexion)
   public function __destruct(){       
        mysqli_close($this->conex);      
   } 
}
?>