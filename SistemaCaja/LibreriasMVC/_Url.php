<?php
/*************************
 *CLASE PARA MAJENAR EL SEO y poder cambiar la extension de las paginas
 ejemplo: 
  original : inico.php 
  cambiado : inicio.atn
 
 Esto trabaja con el archivo .htaccess
 Autor: ALCON
 lalcantata@gmail.com
 Lima Perú 
 **************************/
final class _Url {
  
    public static function _getURL($ctr,$met=null,$vars=array())
   {
       $url='?ctr='.$ctr;
       if(!empty($met))
          $url.='&met='.$met;
       
       if(is_array($vars)){
         foreach ($vars as $key => $value)
	 {
            $url.='&'.$key.'='.$value;//
         }
       }
       //
       $config = Instancia::singleton();
       //$paraXML=array("&"=>'&amp;');
       //foreach($paraXML as $ix=>$val)
        //$url=  str_replace ($ix, $val, $url);           
       return $config->get('DominioWeb').'inicio.jn'.$url;
   }
//Almacenamos en una COOKIES la direccion web que nos permitira volver a la pagina donde iniciamos   
   public static function setUrlParametroActivo() {
       $_SESSION['urlactivo']=$_SERVER['QUERY_STRING'];
       //setcookie("urlactivo", $_SERVER['QUERY_STRING']); 
       //echo $_SERVER['QUERY_STRING'].'::'.$_SESSION['urlactivo'];
   }

   public static function getUrlParametroActivo($resulArray=false,$dataBorrar=array()) {
            $info=array();
            parse_str($_SESSION['urlactivo'],$info);
            if(isset($info['ctr'])) unset($info['ctr']);
            //if(isset($info['met'])) unset($info['met']);
            if(isset($info['idelim'])) unset($info['idelim']);  
            if(is_array($dataBorrar)){
                foreach($dataBorrar as $ro=>$b)
                     if(isset($info[$b])) unset($info[$b]);  
            }
            if($resulArray==true)
                return $info;
            else{
               $params=http_build_query($info);
               return $params;
            }
   }
   
   
   //Url XML
 public static function _getURLXML($url)
   { 
     $config = Instancia::singleton();
     return $config->get('DominioWeb').'inicio.jn?'.$url;
   }
   
   //
   public static function _getDomicioWeb() {
       $config = Instancia::singleton();
       return $config->get('DominioWeb');
   }
}

?>
