<?php
/****************************
 * CLASE PARA MANEJAR LAS VISTAS Y LAS PLANTILLAS
 *****************************/
include_once 'ControlMVC/PaginasRolesControl.php';
class Vista extends PaginasRolesControl
   {          
    private $visibleTopBoton;    
    //contructor
    function __construct($visibleTopBottom=true)
    {
        //Si deseamos mostrar la plantilla SUPERIOR
        $this->visibleTopBoton=$visibleTopBottom;
       
        
    }
    
    //Plantilla Top
    private function top()
    {	
        parent::menu_top($this->visibleTopBoton);	
    }
    
    //Plantilla Bottom
    private function bottom(){
	   if($this->visibleTopBoton===true)
  	      parent::menu_bottom();
	   else
	      return null;
   }    
    
    //Mostrar la Vista
    public function ver($nombre, $vars = array())
    {//nombre:nombreDeLaPagina,vars:incluye las variables 
      
      //$data=array();
      //Añadimos el los resultados de la clase Config.php.
      $config = Instancia::singleton();
      $path = $config->get('VistaCarpeta') . $nombre;
      //Verificamos si existe el archivo de la pagina
      if (!file_exists($path))
      {
        self::top(); 
         $pag_n=$nombre.' - 404 not found';
         include_once($config->get('VistaCarpeta')."errores/paginavistaError.php");
        self::bottom();
	return false;
      }
      
      //Si hay variables para asignar, las pasamos una a una.
      if(is_array($vars))
      {
	 foreach ($vars as $key => $value)
	 {
            $$key = $value;
         }
      } 
      
      //Si todo esta correcto cargamos la vista y su plantilla
        self::top();
	  include_once($path);//Incluimos el archivo.php
	self::bottom();
    }   	
}
?>