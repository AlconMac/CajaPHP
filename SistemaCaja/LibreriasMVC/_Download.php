<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of _Download
 *
 * @author Luis
 */

class _Download {
	//extraer la extencion del archivo
	public static function extencion($archivo){
	  $extension = explode(".",$archivo); 
      $ext = count($extension)-1;       
      return $extension[$ext];
	}
	
    public static function index() {
      if (!isset($_GET['file']) || empty($_GET['file'])) {
          include_once 'VistasMVC/errores/paginanoencontradaError.php';
      }
      
      $root = "fileproject/archivosDB/";
            $file = basename($_GET['file']);
			$filename =(isset($_GET['filename']) && $_GET['filename']!="")?basename($_GET['filename']):$file;
			if(self::extencion($file)!=self::extencion($filename))
			  $filename=$filename.".".self::extencion($file);
				
            $path = $root.$file;
            $type = '';

            if (is_file($path)) {
                $size = filesize($path);
                if (function_exists('mime_content_type')) {
                    $type = mime_content_type($path);
                } else if (function_exists('finfo_file')) {
                    $info = finfo_open(FILEINFO_MIME);
                    $type = finfo_file($info, $path);
                    finfo_close($info);
                }
                
                if ($type == '') {
                    $type = "application/force-download";
                }
            
            // Definir headers
            header("Content-Type: $type");
            header("Content-Disposition: attachment; filename=".$filename);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $size);
            // Descargar archivo
            readfile($path);
            } else {
              include_once 'VistasMVC/errores/paginanoencontradaError.php';
            }
 
        
    }
}

?>
