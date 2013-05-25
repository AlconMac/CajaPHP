<?php
class SobreCarga
{	
	public static function __callStatic($metodo, $parametros)
	{            
            echo sizeof($parametros);
            if (method_exists(get_class($this), $metodo.sizeof($parametros)))
                   return call_user_func_array(array(get_class($this), $metodo.sizeof($parametros)), $parametros);
                // Si la Funcion no Existe
                throw new Exception('Metodo Desconocido: '.get_class($this).'::'.$metodo);
    }
 
        public static function Param1($a) {
                echo "<br />Param1($a)\n";
        }
        
        public static function Param2($a, $b) {
                echo "<br />Param2($a,$b)\n";
        }
 
        public static function Param3($a, $b, $c) {
                echo "<br />Param3($a,$b,$c)\n";
        }
        public static function Param4($a, $b, $c,$d) {
                echo "<br />Param4($a,$b,$c,$d)\n";
        }
}
 
$o = new SobreCarga();
SobreCarga::Param(4,5);
SobreCarga::Param(4,5,6);
SobreCarga::Param(4,5,6,7);
?>