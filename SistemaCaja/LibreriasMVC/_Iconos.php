<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of _Iconos
 *
 * @author Luis
 */
class _Iconos {
    private $extencion;

    public static function getExtencionArchivo($archivo){
        $extension = explode(".",$archivo); 
        $ext = count($extension)-1;       
        return $extension[$ext];        
    }
    
    //Icon
    public static function getIconoImg($archivo) {        
        $extension = self::getExtencionArchivo($archivo);
        $img='';
        switch (strtolower($extension))
        {
          case 'doc':
              $img='icoWord.png';
            break;
          case 'docx':
              $img='icoWord.png';
            break;
          case 'xls':
              $img='icoExcel.png';
            break;
          case 'xlsx':
              $img='icoExcel.png';
            break;
          case 'ppt':
              $img='icoPowerPoint.png';
            break;
          case 'pptx':
              $img='icoPowerPoint.png';
            break;
          case 'pdf':
              $img='icoPDF.png';
            break;
          case 'rar':
              $img='icoRar.png';
            break;
          case 'zip':
              $img='icoRar.png';
            break;
          case 'jpeg':
              $img='icoImagen.png';
            break;
          case 'jpg':
              $img='icoImagen.png';
            break;
          case 'gif':
              $img='icoImagen.png';
            break;
          case 'png':
              $img='icoImagen.png';
            break;        
          case 'bmp':
              $img='icoImagen.png';
            break;                
          default :
              $img='icoText.png';
            break;        
              
        }
        return $img;
    }
}

?>
