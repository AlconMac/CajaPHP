<?php
/*************************************************************
 OBJETO QUE SIRVE PARA COMPAGINAR LAS CONSULTAS Y AGRUPARLAS
 V.5.0
 24 de Julio del 2011
 Modificación : 16/10/2012
/ autor: Luis Alcántara
*************************************************************/
include_once 'conec/conexion_db.php';
include_once 'lib/_ArrayList.php';
class _QueryModel{
      private $consul;
      private $pagina;
      private $error;
        
      public function setError($error){
	$this->error=$error;
      } 		
      
      public function getError(){
	return stripslashes($this->error);
      }	    
	  //
      public function __construct($pag=null)
      {
	 if(!empty($pag) && is_numeric($pag))
            $this->consul['pagi']= $pag; 
         else 
            $this->consul['pagi']= 1; 
      }
      
      //	  	  
     public function query($sql,$can=null)//$sql: Sentencia SQL, $can: para mostrar
     {	
        $error=true;		 
        $conex=  conexion_db::getInstance();
	if(!empty($can) && is_numeric($can))
        {//Para Agrupar la consulta
           $this->consul['tampag'] = $can;
           $this->consul['reg1'] = ($this->consul['pagi'] - 1) * $this->consul['tampag'];
            try{
               $conex->prepare($sql);
               $this->consul['resul']=$conex->Execute();               
	       if(!$this->consul['resul'])
               {//Error                     
                   $this->consul['total']=0;
                   $this->consul['resul_tt']=null;
                   throw new Exception($conex->getError());	  
               }else{
                   $resul=$this->consul['resul'];
                   $this->consul['total'] = $conex->nrows($resul);                    
                   $conex->prepare($sql." LIMIT ".$this->consul['reg1'].",".$this->consul['tampag']."");	
                   $this->consul['resul_tt']=$conex->Execute();
		}
            }catch(Exception $e){
                $this->setError($e->getMessage());
		$error=false;
	    }				  
	}else{	
            try{
                $conex->prepare($sql);
                $this->consul['resul_tt']=$conex->Execute();
		if(!$this->consul['resul_tt']){
                    $this->consul['total']=0;
                    $this->consul['resul_tt']=null;                                                    
                    throw new Exception($conex->getError());	  	  
		}else{	                   
                    $this->consul['total'] = $conex->nrows($this->consul['resul_tt']);	
		}						
            }catch(Exception $e){					   
                $this->setError($e->getMessage());
		$error=false;
            }				
	}		
        $this->consul['canti_mensa']=$conex->nrows($this->consul['resul_tt']);
        $this->conex=$conex;
	return $error;
      }
      
      
      
      public function fetchFields() {
         return $this->conex->fetchFields($this->consul['resul_tt']); 
      }
      
      public function fetchArray() {
         return $this->conex->fetchArray($this->consul['resul_tt']); 
      }
      //
      public function fetchObject() {
         return $this->conex->fetchObject($this->consul['resul_tt']); 
      }      
      //
      public function fetchEach() {
         return $this->conex->fetchEach($this->consul['resul_tt']); 
      } 	  
      //
      public function fetchNum() {
         return $this->conex->fetchNum($this->consul['resul_tt']); 
      } 
      
      //Para retornar como ARRAY LIST por cada OBJETO
      public function ArrayListObjeto(thisClass $objeto)
      {          
          $clase=get_class($objeto);
          $oClase=new $clase();
          $oLisMeto=get_class_methods($oClase);                 
          $lisResul=$this->conex->fetchEach($this->consul['resul_tt']); 
          //
          $ArrayList=new _ArrayList();
          $r=1;
         
          foreach($lisResul as $r){				
              $oClaseObj=new $clase();
              foreach ($oLisMeto as $row){
                $nomCampo=substr($row,3,strlen($row));  
                $nomSetMetodo='set'.$nomCampo;
                if(substr($row,0,3)=='set' && isset($r[strtolower($nomCampo)])){						
						$oClaseObj->$nomSetMetodo($r[strtolower($nomCampo)]);
					 
                }
              }              
              
              $ArrayList->add($oClaseObj);              
          }
          
          $ArrayListaResul=$ArrayList->iterator();
          $ArrayList->clear();
          return $ArrayListaResul;
      }
      
      
      //
      public function getRows(){
	  return $this->consul['canti_mensa'];
      }
      
      public function getRowsAll(){
	  return $this->consul['total'];
      }
      
      public function getPageGroup($enlace,$maxpags,$estilo) {          
          //Para pasar todas las variables activas GET que pasan paginas por pagina
          
            $info=array();
			$urlpa=explode("?",$_SERVER['REQUEST_URI']);
            //parse_str($_SERVER['prepare_STRING'],$info);
			parse_str($urlpa[1],$info);
            if(isset($info['pag'])) unset($info['pag']);
            if(isset($info['idelim'])) unset($info['idelim']);
            if(isset($info['pagprev'])) unset($info['pagprev']);
            if(isset($info['ctr'])) unset($info['ctr']);
            $params=  http_build_query($info);
            if($params!="")
                $enlace=$enlace.'&'.$params.'&pag=';
            else
                $enlace=$enlace.'&pag=';
         
          
          if($this->consul['total']>0)
          {
            $this->pagina['total_paginas'] = ceil($this->consul['total']/$this->consul['tampag']);       
            $this->pagina['anterior'] = $this->consul['pagi'] - 1;       
            $this->pagina['posterior'] = $this->consul['pagi'] + 1;  
            $minimo = $maxpags ? max(1, $this->consul['pagi']-ceil($maxpags/2)): 1;
            $maximo = $maxpags ? min($this->pagina['total_paginas'], $this->consul['pagi']+floor($maxpags/2)): $this->pagina['total_paginas'];
            
            if ($this->consul['pagi'] >1)
            {
                $texto = "<ul id='".$estilo."'><li><a href=\"".$enlace.$this->pagina['anterior']."\">«</a></li>";			
            }else{
		$texto = "<ul id='".$estilo."'><li></li>";//<span>«</span>
            }
            
            if ($minimo!=1){
		$texto.="<li>...</li>";
            }
            
            //
            for ($i=$minimo; $i < $this->consul['pagi']; $i++){
		$texto .= "<li><a href=\"".$enlace.$i."\">".$i."</a></li>";
	    }
            
            $texto .= "<li><strong>".$this->consul['pagi']."</strong></li>";		  
            
            for ($i=$this->consul['pagi']+1; $i<=$maximo; $i++){			 
               $texto .= "<li><a href=\"".$enlace.$i."\">".$i."</a></li>";
            }
            
            if ($maximo!=$this->pagina['total_paginas']){ $texto.="<li>...</li>";}
            
            if ($this->consul['pagi']<$this->pagina['total_paginas']){
		$texto .= "<li><a href=\"".$enlace.$this->pagina['posterior']."\">»</a></li>";
            }else{
		$texto .= "<li></li>";//<span>»</span>
            }
            
            return $texto."</ul>";		  
          }else{
              return null;
          }
	}
        
        //
	public function getPage() {
	   return $this->consul['pagi'];
	}
        //
	public function getPageAll() {
            if(is_numeric($this->consul['total']) && (int)$this->consul['total']>=1 && (int)$this->consul['tampag']>=1){
              return $this->pagina['total_paginas'] = ceil($this->consul['total']/$this->consul['tampag']); 		
	    }else{
                return 0;
	    }
	}
        
        //Pagina Siguiente
        public function getPageNext($enlace=null,$txt=null) {
              $this->pagina['total_paginas'] = ceil($this->consul['total']/$this->consul['tampag']);       
	      $this->pagina['posterior'] = $this->consul['pagi'] + 1;		
	      if ($this->consul['pagi']<$this->pagina['total_paginas']){
                    if(!empty($enlace) && !empty($txt)){
                        $texto= '<a href="'.$enlace.$this->pagina['posterior'].'">SIGUIENTE</a>';
                    }else if(!empty($enlace) && empty($txt)){
                        $texto= $enlace.$this->pagina['posterior'];
                    }else{
                        $texto=$this->pagina['posterior'];
		    }
             }else{
	        $texto= '';
             }
  	    return $texto;
  	}
        
	//Pagina Anterior
   	public function getPagePrevious($enlace=null,$txt=null) {
            $this->pagina['anterior'] = $this->consul['pagi'] - 1; 
            if ($this->consul['pagi']>1){
                    if(!empty($enlace) && !empty($txt)){
                        $texto= '<a href="'.$enlace.$this->pagina['anterior'].'">ANTERIOR</a>';
                    }else if(!empty($enlace) && empty($txt)){
                        $texto= $enlace.$this->pagina['anterior'];
                    }else{
                        $texto=$this->pagina['anterior'];
		    }                  
               
            }else{
                $texto= '';
	    }
            return $texto;
  	}
        
        public function __destruct(){
	  if(isset($this->consul['resul']) && $this->consul['resul']!=""){$this->conex->free_result($this->consul['resul']);}
		if(isset($this->consul['resul_tt']) && $this->consul['resul_tt']!=""){$this->conex->free_result($this->consul['resul_tt']);}
		unset($this->consul);
		unset($this->pagina);
	 } 
}

/*INICIO EJEMPLO*/
	//	$pag=(isset($_GET['pag']) && trim($_GET['pag'])!="")?$_GET['pag']:1;
	//	$prepare=new prepare_($pag);
	//	if($prepare->prepare("select * from eess",10)){
	//		echo $prepare->getResultRows()." de ".$prepare->getResultRowsTotal()." Registros <br />";
	//		echo $prepare->getPagAnterior("?pag=")." :: ".$prepare->getPagSiguiente("?pag=")."<br />";
	//		echo "Pagina Actual :".$prepare->getNumPagina()."  Numero de Paginas ".$prepare->getNumPaginaTotal()."<br/>";
	//		echo $prepare->getPaginacionGrupo("?pag=","5","");
	//		   //CONSULTAS
	//			//foreach($prepare->getFetchEach() as $rod){
	//          while($rod=$prepare->getFetchArray()){	
	//				echo "::".$rod['nombre']."</br>";
	//			}
	//			//REGISTRAS
	//			if($prepare->InsertDB("insert into eess(rnombre) values('juan carlos')")){
	//				echo "Registro :".$prepare->UltimoId();
	//			}else{
	//				echo "Oops! ocurrio un error".$prepare->getError();
	//			}	    
	//	}else{
	//		echo "Oops! ocurrio un error .".$prepare->getError();
	//	}
/*FIN EJEMPLO*/
?>