<?php
/*************************
 *CLASE PARA CARGAR ARCHIVOS AL SERVIDOR
 Autor: ALCON
 lalcantata@gmail.com
 Lima Perú 
 **************************/

class _LoadFiles{
  private $error;  
  private $name;//
  private $type;//
  private $size;//
  private $tmp_name;//
  private $codigoArchivo;
  private $tipoArchivo;
  private $extencionArchivo;
  private $nombreArchivo;
  private $rutaDestino;
  
  public function getRutaDestino() {
      return $this->rutaDestino;
  }

  public function setRutaDestino($rutaDestino) {
      $this->rutaDestino = $rutaDestino;
  }

    
  public function getError() {
      return $this->error;
  }

  public function setError($error) {
      $this->error = $error;
  }

  public function getName() {
      return $this->name;
  }

  public function setName($name) {
      $this->name = $name;
  }

  public function getType() {
      return $this->type;
  }

  public function setType($type) {
      $this->type = $type;
  }

  public function getSize() {
      return $this->size;
  }

  public function setSize($size) {
      $this->size = $size;
  }

  public function getTmp_name() {
      return $this->tmp_name;
  }

  public function setTmp_name($tmp_name) {
      $this->tmp_name = $tmp_name;
  }

  //Nombre generado automaticamente para el archivo
  public function getCodigoArchivo($codigoArchivo=5) {
     $fecha= date("Ymd");
     srand((double)microtime()*rand(1000000,9999999)); 
     $arrChar=array(); 
     $uId=$codigoArchivo; 
        for($i=65;$i<90;$i++){ 
            array_push($arrChar,chr($i)); 
            array_push($arrChar,strtolower(chr($i))); 
	} 
			
	for($i=48;$i<57;$i++){ 
            array_push($arrChar,chr($i)); 
	} 
	
        for($i=0;$i<$codigoArchivo;$i++){ 
            $uId.=$arrChar[rand(0,count($arrChar))]; 
	} 
        
        return $this->codigoArchivo = $fecha.$codigoArchivo;
  }
  
  //Para saber el tipo de archivo
  public function getTipoArchivo() {
         switch (strtolower($this->getExtencionArchivo())){
           case 'jpg':
               $tipoArchivo="imagen";
               break;
           case 'jpeg':
               $tipoArchivo="imagen";
               break;           
           case 'gif':
               $tipoArchivo="imagen";
               break;
           case 'png':
               $tipoArchivo="imagen";
               break;           
           case 'doc':
               $tipoArchivo="documento";
               break;
           case 'docx':
               $tipoArchivo="documento";
               break;           
           case 'xlsx':
               $tipoArchivo="documento";
               break;
           case 'ppt':
               $tipoArchivo="documento";
               break;                      
           case 'xlsx':
               $tipoArchivo="documento";
               break;
           case 'ppt':
              $tipoArchivo="documento"; 
               break;                      
           case 'pptx':
               $tipoArchivo="documento";
               break;
           case 'pdf':
               $tipoArchivo="documento";
               break;                                 
           case 'mp3':
               $tipoArchivo="audio";
               break;
           case 'rar':
               $tipoArchivo="comprimido";
               break;                                            
           case 'zip':
               $tipoArchivo="comprimido";
               break;                                                       
           case 'flv':
               $tipoArchivo="video";
               break;                                                       
           case 'swf':
               $tipoArchivo="video";
               break;                                                                  
        }        
      return $this->tipoArchivo = $tipoArchivo;
  }
  //ver la extension del archivo
  public function getExtencionArchivo() {
      return $this->extencionArchivo;
  }
  //extraer la extension del archivo
  public function setExtencionArchivo($archivo) {
      $extension = explode(".",$archivo); 
      $ext = count($extension)-1;       
      $this->extencionArchivo = $extension[$ext];
  }

  public function getNombreArchivo() {
      return $this->nombreArchivo;
  }

  public function setNombreArchivo($nombreArchivo)
  {       
      $this->setExtencionArchivo($this->getName());
      $this->nombreArchivo = $nombreArchivo.$this->getCodigoArchivo().".".$this->getExtencionArchivo();
  }

  /*********************************
   * Para cargar el archivo al servidor
   *********************************/
   public function LoadFile(_LoadFiles $oLoadFile,$BajarCalidadImg=false){  	 
         if(file_exists($oLoadFile->getRutaDestino()))
         {//Verificamos si la ruta para guardar el archivo existe             
             if (is_uploaded_file($oLoadFile->getTmp_name()))
             {//Verifica el origen del archivo
                $rutaImagen=$oLoadFile->getRutaDestino().$oLoadFile->getNombreArchivo();                
                if(move_uploaded_file($oLoadFile->getTmp_name(),$rutaImagen))
                {//Cargamos el archivo
                    if($oLoadFile->getTipoArchivo()=="imagen" && $BajarCalidadImg==true)
                    {//Si es Imagen , bajamos el peso y tamaño                       
                       $ext = $oLoadFile->getExtencionArchivo();                       
                       switch (strtolower($ext)){
                         case 'jpg':
                             $image = ImageCreateFromJPEG($rutaImagen); 
                             break;
                         case 'jpeg':
                             $image = ImageCreateFromJPEG($rutaImagen); 
                             break;
                         case 'gif':
                            $image = ImageCreateFromGIF($rutaImagen); 
                             break;
                         case 'png':
                             $image = ImageCreateFromPNG($rutaImagen); 
                             break;
                       }
                       $imgFue=  getimagesize($rutaImagen);
                       $width =  $imgFue[0];//ancho 
                       $height = $imgFue[1];//alto 
                       if($width>500){
                            $nueva_anchura = 500; // Definimos el tamaño a 100 px 
                            $nueva_altura = ($nueva_anchura * $height) / $width ; // tamaño proporcional 
                            if (function_exists("imagecreatetruecolor"))                        
                                $thumb = ImageCreateTrueColor($nueva_anchura, $nueva_altura);//Color Real 

                            //En caso de no encontrar la funcion, la saca en calidad media 
                            if (!$thumb) $thumb = ImageCreate($nueva_anchura, $nueva_altura); 

                            ImageCopyResized($thumb, $image, 0, 0, 0, 0, $nueva_anchura, $nueva_altura, $width, $height); 
                            ImageJPEG($thumb,$rutaImagen,100);
                            imagedestroy($image); 
                       }
		  }
                  return true;
		}else{
                    $this->setError("Ocurrio un error al intentar cargar el archivo");
                    return false;
		}					   
            }else{
                $this->setError("El origen del archivo no es valido");
                return false;
            }  
	}else{
            $this->setError("La ruta de destino no existe");
	  return false;
	}
   }   
  
}
?>