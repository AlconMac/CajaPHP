<?php
class tipo_datos{
	 private $arrayIndex=array();//
	/***********************************
    * TIPO DE VARIABLES
    *************************************/
    public function setString($index,$valor){
	    if($valor!="")
	    {
    	  $valor=htmlentities($valor, ENT_QUOTES,'utf-8');
	      $this->arrayIndex[$index]=sprintf('%s',"'$valor'");
	    }else{
    		$this->arrayIndex[$index]='null';
        }
    }
    //
    public function setInt($index,$valor,$null=false){
        if($null===true)
           $this->arrayIndex[$index]=  is_numeric($valor)?(int)$valor:'null';
        else
           $this->arrayIndex[$index]=sprintf('%d',(int)$valor); 
    }
    //
    public function setFloat($index,$valor){
        $this->arrayIndex[$index]=sprintf('%f',(float)$valor);        
    }
    //
    public function setDouble($index,$valor){
        $this->arrayIndex[$index]=(double)$valor;        
    }
    //
    public function setBoolean($index,$valor){
        $this->arrayIndex[$index]=(boolean)$valor;        
    }
    //
    public function setDate($index,$valor){
        $this->arrayIndex[$index]="'".date('Y-m-d',strtotime($valor))."'";        
    }
    //
    public function setDateTime($index,$valor){
        $this->arrayIndex[$index]="'".date('Y-m-d H:i:s',strtotime($valor))."'";        
    }
    //
    public function setTime($index,$valor){
        $this->arrayIndex[$index]="'".date('H:i:s',strtotime($valor))."'";        
    }
	//
	public function getIndexArrayAll(){
        return $this->arrayIndex;  
    }

  //PARA ESCAPAR LAS INYECCIONES SQL Y PASARLO COMO AL FORMADO HTML
	public static function getScapeString($text)
	{
		$text=trim(stripslashes($text));
		return $text=htmlentities($text, ENT_QUOTES,'utf-8');	
	}

}
?>