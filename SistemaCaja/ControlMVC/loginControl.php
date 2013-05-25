<?php
/********************************
 * CONTROLADOR PARA EL LOGIN
 *********************************/
include_once 'EntidadMVC/Usuario.php';
include_once 'ModelMVC/UsuarioModel.php';
include_once 'LibreriasMVC/_Cadenas.php';
include_once 'LibreriasMVC/_Crifrado.php';
class loginControl {
    //Contructor
    public function __construct() {
      $this->view = new Vista(false);
    }
    
    //Carga el Formulario del LOGIN
    public function index() {
        self::acceso();
        $this->view->ver('login.php');  
    }
    
    //Validar el Login
    public static function acceso(){
       if(isset($_POST['txtuser']) && isset($_POST['txtclave']))
       {
          $oUsuario=new Usuario();
          $oUsuario->setUsu(_Cadenas::getScapeString($_POST['txtuser']));
          $oUsuario->setClave(_Cadenas::getScapeString($_POST['txtclave']));
          $oUsuAcceso=UsuarioModel::Login($oUsuario);
          if((int)$oUsuAcceso->getIdusu()>0)
           {            
              $_SESSION['jn']=array('ux'=>_Crifrado::encriptar($oUsuAcceso->getIdusu(),'ux'),
                                    "empleado"=>$oUsuAcceso->getNombres()." ".$oUsuAcceso->getApellidos());
              header('location:'._Url::_getURL('inicio'));
          }else{
              $dataVa=array();
              $dataVa['err']=1;
              header('location:'._Url::_getURL('login',null,$dataVa));
          }
       }else{
           return null;
       }
    }
    
    //Salir del sistema
    public static function outlogin() {
        unset($_SESSION['jn']['ux']);        
        unset($_SESSION['jn']['empleado']);
        session_destroy();
        header('location:'._Url::_getURL('login'));
    }
    
    
    //get Id Usuario desencriptado
    public static function idUsuario()
    {       
       if(isset($_SESSION['jn']['ux'])){
           $idu=(int)_Crifrado::desencriptar($_SESSION['jn']['ux'],'ux');
           if($idu>0)
              return $idu;
           else
              return 0; 
       }else{
           return 0;
       }
    }
    
   
    //get Nombre Empleado
    public static function NombreEmpleado()
    {       
       if(isset($_SESSION['jn']['empleado'])){
           return $_SESSION['jn']['empleado'];
       }else{
           return '';
       }
    }      
       
}

?>
