<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaginasRolesControl
 *
 * @author Luis
 */
include_once 'ControlMVC/topControl.php';
class PaginasRolesControl {
   
   function __construct()
   {       
      
   }
   //Menu Superior
   public function menu_top($mostrarTop=true)
   {
       
      $config = Instancia::singleton();
      
      /**************************
       * INI VALIDAMOS SI EXISTE LA SESION PARA MOSTRAR LAS PAGINAS, DE LO CONTRARIO LO REDIRECCIONAMOS AL LOGIN
       ***************************/
      if(loginControl::idUsuario()<=0)
      {//Si no existe la session del usuario lo redireccionamos al LOGIN
          if(!isset($_GET['ctr']) || (string)$_GET['ctr']!='login')
             header ('location:'._Url::_getURL('login'));
      }
      elseif(isset($_GET['ctr']) && (string)$_GET['ctr']==='login')
      {//Si existe la "session" y tratamos de llamar al login, lo redireccionamos al inicio
          header ('location:'._Url::_getURL('inicio'));
      }
      
      /**************************
       * FIN
       ***************************/      
      
     if($mostrarTop===true)//Si es true muestra el menu superior
     {
        $menuList=  topControl::menu();        
        $empleado=  loginControl::NombreEmpleado();
        include_once($config->get('VistaCarpeta')."plantilla/top.php");
     }
          
   }
    
   //Menu Inferior
    public function menu_bottom()
   {
        $config = Instancia::singleton(); 
	include_once($config->get('VistaCarpeta')."plantilla/bottom.php");
	
    }
}

?>
