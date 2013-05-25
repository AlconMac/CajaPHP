<?php
/******************************************
 * CLASE PARA EJECUTAR CUALQUIER "CLASE" Y SU METODO DEL SISTEMA
 * Para esto cumple algunas reglas
 *******************************************/
class BodyController
{    
    //
    public static function body()
    {
        $errorBody="";
        $data=array();
      //Añadimos la carpeta de objetos 
	include_once('LibreriasMVC/Instancia.php'); //Metodo de Instancia
	include_once('LibreriasMVC/Vista.php'); //Para visualizar las VISTAS validadas
	include_once('LibreriasMVC/Config.php'); //Configuracion del RUTAS MVC	
	include_once 'LibreriasMVC/_Url.php';//Para manejar el SEO
        //
        include_once 'ControlMVC/loginControl.php';//Para validar si el usuario esta "logueado"
        //
        
        //Validamos las variables tipo GET
	if(isset($_GET['ctr']) && $_GET['ctr']!="")
        {//ctr=nombre de la clase
            $controlNombre = $_GET['ctr'] . 'Control';	
	}else{
      	    $controlNombre = "inicioControl";	
	}      
	
        //Ahora para su metodo oClase->index
        if(! empty($_GET['met']))
	{//ctr=nombre del metodo
            $metodNombre = $_GET['met'];
        }else
	{
            $metodNombre = "index";//index por defecto
	}
        
        //Entonces la clase tendria esta forma
            //Archivo donde se encuesta la clase
        $controladoresArchivo = $config->get('ControlCarpeta') . $controlNombre . '.php';
	
        //Añadimos el archivo de clase solicitada		
	if(is_file($controladoresArchivo))
	{//si el archivo es correcto loo incluimos
            include_once($controladoresArchivo);
	}else{
	   $vist=new Vista(false);
           $errorBody.='El controlador no existe - 404 not found';
           $config->set('error',$errorBody);
           $data['error']=$errorBody;
           $data['dominioweb']=$config->get('DominioWeb');           
           $vist->ver('errores/paginanoencontradaError.php',$data);
	   return false;
	}
	
        //Comprovamos si existe la clase y sus metodo
	 if (is_callable(array($controlNombre, $metodNombre)) == false)
         {//Si existe llamamos a la vista
            $vist=new Vista(false);
            $errorBody.=$controlNombre.'->'.$metodNombre.' no identificado Error : '.E_USER_NOTICE;
            $config->set('error',$errorBody);
            $data['error']=$errorBody;
            $data['dominioweb']=$config->get('DominioWeb');            
            $vist->ver('errores/paginanoencontradaError.php',$data);	
            return false;	
	}
	
        //Si todo esta bien, creamos una instancia del controlador y llamamos a su metodo
	$controller = new $controlNombre();
	$controller->$metodNombre();
     }
}
?>