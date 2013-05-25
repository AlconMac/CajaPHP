<?php
/**********************************
 * Sirve para reeemplazar ? po una cadena
 **********************************/
class _Cadenas{
    private $textoCadena;
    private $arrayIndex=array();
    
    function __construct($textoCadena=null) {
        $this->textoCadena = $textoCadena;
    }    
        
    public function setString($index,$valor,$scape=false)
    {
        if($scape)
	 $this->arrayIndex[$index]=sprintf('%s',$valor);
	else
          $this->arrayIndex[$index]=$valor;
    }
    //
    public function setInt($index,$valor,$scape=false)
    {
        if($scape)
            $this->arrayIndex[$index]=sprintf('%d',(int)$valor);
	else
            $this->arrayIndex[$index]=$valor;			
    }
    //
    public function getCadenaToString(){
        $arrayCadena=  explode("?", $this->textoCadena);        
        if(count($arrayCadena)>0)
        {
            $cadenaOut="";
            for($u=0;$u<count($arrayCadena);$u++){
                if(isset($this->arrayIndex[$u])){          
                  $cadenaOut.=$arrayCadena[$u]." ".$this->arrayIndex[$u];
                }else{
                  $cadenaOut.=$arrayCadena[$u];  
                }
            }
             return $cadenaOut;  
        }else{
              return $this->textoCadena; 
        }
         
    }
    
    //Eliminar codigos html
    public static function getScapeString($txt)
    {
        //$buscar_html = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_SPECIAL_CHARS);
        //$buscar_url = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_ENCODED);
        return strip_tags(htmlspecialchars(addslashes($txt)));
    }

}

?>
