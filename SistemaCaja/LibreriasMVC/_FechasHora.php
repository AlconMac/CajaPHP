<?php
/*************************
 *CLASE PARA MANEJAR EL FORMATO DE LAS FECHAS Y HORAS
 Autor: ALCON
 lalcantata@gmail.com
 Lima Perú 
 **************************/
class _FechasHora{
    private $txtDia;
    private $txtMes;
    private $numDia;
    private $idioma;
    private $year;
    
    function __construct($fecha) {
         $this->txtMes=date('F', strtotime($fecha));
         $this->txtDia=date('w', strtotime($fecha));
         $this->numDia=date('d', strtotime($fecha));         
         $this->year=date('Y', strtotime($fecha));
    }
    
    //Dia text
    public function getDiaText(){      
        switch ($this->txtDia){
            case 1:                
                $txtReturnSPN="Lunes";                
                break;
            case 2:
               $txtReturnSPN="Martes";
                break;
            case 3:
                $txtReturnSPN="Miércoles";
                break;
            case 4:
                $txtReturnSPN="Jueves"; 
                break;
            case 5:
                $txtReturnSPN="Viernes";
                break;
            case 6:
                $txtReturnSPN="Sábado";
                break;
            case 0:
                $txtReturnSPN="Domingo";
                break;
        }
        return $txtReturnSPN;
    }
    //
    public function getDiaNum(){
        return $this->numDia;
    }
    public function getYear(){
        return $this->year;
    }    
    //Mes Tex    
    public function getMesTex(){        
        $txtReturn="";
            switch ($this->txtMes){
                case "January":
                $txtReturn="Enero";
                    break;
                case "February":
                $txtReturn="Febrero";
                    break;
                case "March":
                    $txtReturn="Marzo";
                    break;
                case "April":
                    $txtReturn="Abril"; 
                    break;
                case "May":
                    $txtReturn="Mayo";
                    break;
                case "June":
                    $txtReturn="Junio"; 
                    break;
                case "July":
                    $txtReturn="Julio";
                    break;
                case "August":
                    $txtReturn="Agosto";
                    break;
                case "September":
                    $txtReturn="Septiembre";
                    break;
                case "October":
                    $txtReturn="October";
                    break;
                case "November":
                    $txtReturn="Noviembre";
                    break;            
                case "December":
                    $txtReturn="Diciembre";
                    break;                        
            }            
           return $txtReturn;
       
    }    
    
}

?>