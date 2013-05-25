<?php
/******************************
 *EJECUTA UNA CLASE Y SU METODO 
 *******************************/
$clase=(isset($_GET["ctr"]))?(string)trim($_GET["ctr"])."Control":"";
$metodo=(isset($_GET["met"]))?(string)trim($_GET["met"]):"index";
if($clase!="" && $metodo!=""){
   if(file_exists("ControlMVC/".$clase.".php")){ 
       include_once "ControlMVC/".$clase.'.php';  
    if(method_exists($clase, $metodo))
        $clase::$metodo();    
   }
}   
?>
