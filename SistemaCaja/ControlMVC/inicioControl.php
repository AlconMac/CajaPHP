<?php
/*******************************
 * INICIO DE LA PAGINA
 ********************************/
class inicioControl {
    public function __construct() {
      $this->view = new Vista();
    }
    //pagina INDEX
    public function index()
    {
        $this->view->ver('index.php');
    } 
    
    
}

?>
