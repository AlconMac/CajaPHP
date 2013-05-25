
<?php
interface encender{
    public function uno();
    public function dos();
}

class carro implements encender{
    public function dos() {
        return 'Apaga Carro';
    }

    public function uno() {
        return 'Enciende Carro';
    }
}

class tren implements encender{
    public function dos() {
        return 'Apaga Tren';
    }

    public function uno() {
        return 'Enciende Tren';
    }
}

class j{
   public static function uno(encender $o){         
         $oClase=new $o();
         $oLisMeto=get_class_methods($oClase);
         foreach ($oLisMeto as $row){
           echo $row."<br/>";
         }       
   }
}

j::uno(new tren());

include_once 'ConfigMVC/config.ini.php';
include_once 'LibreriasMVC/BodyController.php';
BodyController::body();
?>