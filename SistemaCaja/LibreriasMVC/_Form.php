<?php
/***********************************************
 * AYUDA MENEJAR LOS FORMULARIOS Y EVITAR LOS XSS
 ***********************************************/
class _Form {
   
   //Validar el id para modificar
   public static function idDelete($campo=null)
   {       
       if(isset($_GET['idelim'])){
           return $_GET['idelim'];
       }else{
           return null;
       }
   }
   
   /*********************************************
   * Id modi: para modificar los datos del formulario 
   **********************************************/    
   public static function idUpdate($campo=null)
   {       
       if(isset($_GET['idmodi']) && is_numeric($_GET['idmodi'])){
           return $_GET['idmodi'];
       }else{
           return null;
       }
   } 
   public static function idUpdateWrite($campo=null)
   {       
       if(isset($_GET['idmodi'])){
           return '<input type="hidden" name="txtformmodi" id="txtformmodi" value="'.$_GET['idmodi'].'"/>';
       }else{
           return '';
       }
   }
   
   public static function validaIdUpdate($campo=null){
      if(isset($_POST['txtformmodi']) && trim($_POST['txtformmodi'])!=""){
          return $_POST['txtformmodi'];
      }else{
          return null;
      }
   }
   
   /*********************************************
   * Token: 
   **********************************************/
   public static function validaToken() {
       if(isset($_SESSION['token']) && (string)$_SESSION['token']===(string)$_POST['txttoken'])
          return true;
       else
          return false;
   }
   //
   public static function TokenWrite()
   {
     $token = sha1(uniqid(rand(), true));
     $_SESSION['token'] = $token;       
     return '<input type="hidden" name="txttoken" id="txttoken" value="'.$token.'"/>';
   } 
  /*********************************************
   * Validar los GET Y POST
   **********************************************/    
   public static function GET($txt)
   {
       return (isset($_GET[$txt]))?$_GET[$txt]:false; 
   } 
   //
   public static function POST($txt)
   {
       return (isset($_POST[$txt]))?$_POST[$txt]:false; 
   }    
  /*********************************************
   * Validar formularios por su tipo de entrada
   **********************************************/
  //Email
  public static function Email($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_EMAIL);
  }
  
  //String
  public static function String($txt)
  {
    return filter_var($txt,FILTER_SANITIZE_STRING);
  }
  
  //Numeros enteros
  public static function Int($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_INT);
  }
  
  //Flotantes
  public static function Float($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_FLOAT);
  }
  
  //URL
  public static function Url($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_EMAIL);
  }
  
  //Boolean
  public static function Boolean($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_BOOLEAN);
  }
  
  //Ip
  public static function IP($txt)
  {
    return filter_var($txt,FILTER_VALIDATE_IP);
  }
  
  //Eliminar codigos html
  public static function ScapeString($txt)
  {
        //$buscar_html = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_SPECIAL_CHARS);
        //$buscar_url = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_ENCODED);
        return strip_tags(htmlspecialchars(addslashes($txt)));
  }  
}

?>
