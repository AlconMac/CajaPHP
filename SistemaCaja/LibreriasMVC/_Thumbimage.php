<?php 
/*************************
 *CLASE PARA MANEJAR EL TAMAÑO DE LAS IMAGENES
 Autor: ALCON
 lalcantata@gmail.com
 Lima Perú 
 **************************/

if(!isset($_GET['h']) || !is_numeric($_GET['h']) || !isset($_GET['w']) || !is_numeric($_GET['w']) || !isset($_GET['tip'])){exit();}
/***********************************
THUMBIMAGE - IMAGENES
************************************/
class _Thumbimage{
        private $img;
	function __construct($imgfile){
		$this->img["format"]=ereg_replace(".*\.(.*)$","\\1",$imgfile);//formato de la imagen
		$this->img["format"]=strtoupper($this->img["format"]);
		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			$this->img["format"]="JPEG";                        
			$this->img["src"] = ImageCreateFromJPEG ($imgfile);
		} elseif ($this->img["format"]=="PNG") {
			$this->img["format"]="PNG";
			$this->img["src"] = ImageCreateFromPNG ($imgfile);
		} elseif ($this->img["format"]=="GIF") {
			$this->img["format"]="GIF";
			$this->img["src"] = ImageCreateFromGIF ($imgfile);
		} elseif ($this->img["format"]=="WBMP") {
			$this->img["format"]="WBMP";
			$this->img["src"] = ImageCreateFromWBMP ($imgfile);
		} else {
			$this->img["msg"]='ARCHIVO NO ADMITIDO';
			exit();
		}
                              
		@$this->img["lebar"] = imagesx($this->img["src"]);
		@$this->img["tinggi"] = imagesy($this->img["src"]);
		$this->img["quality"]=75;
	}
		function size_height($size=100){
			$this->img["tinggi_thumb"]=$size;
			@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
		}
		function ancho(){
		  return $this->img["tinggi_thumb"].' :: '.$this->img["lebar_thumb"];
		}

		function size_width($size=100){
			$this->img["lebar_thumb"]=$size;
			@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
		}

		function size_auto($size=100){
				if ($this->img["lebar"]>=$this->img["tinggi"]) {
					$this->img["lebar_thumb"]=$size;
					@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
				} else {
					$this->img["tinggi_thumb"]=$size;
					@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
				}
		}

		function jpeg_quality($quality=75){
			$this->img["quality"]=$quality;
		}

		function ver_imagen(){
                    header("Content-Type: image/".$this->img["format"]);                    
                    $this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);                    
                    imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);
                    if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG")
                    {                        
                        imageJPEG($this->img["des"],"",$this->img["quality"]);
                    } elseif ($this->img["format"]=="PNG") {
                        imagePNG($this->img["des"]);
                    } elseif ($this->img["format"]=="GIF") {
                        imageGIF($this->img["des"]);
                    } elseif ($this->img["format"]=="WBMP") {
                        imageWBMP($this->img["des"]);
                    }
		}
		function guardar($save=""){
				if (empty($save)) $save=strtolower("./thumb.".$this->img["format"]);
				$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
					@imagecopyresampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);
				if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
					imageJPEG($this->img["des"],"$save",$this->img["quality"]);
				} elseif ($this->img["format"]=="PNG") {
					imagePNG($this->img["des"],"$save");
				} elseif ($this->img["format"]=="GIF") {
					imageGIF($this->img["des"],"$save");
				} elseif ($this->img["format"]=="WBMP") {
					imageWBMP($this->img["des"],"$save");
				}
	    }
		function CloseImg(){
		 unset($this->img);
		}
}

/*******************************************************
VARIABLES
********************************************************/
$altura = $_GET['h']; //180; 
$hmax    = $_GET['w']; //180; 
$tipo    = $_GET['tip'];
$rut     = $_GET['rut'];
$foto     = $_GET['foto'];
$err     = (isset($_GET['err']) && $_GET['err']!="")?$_GET['err']:1;
$tipoThumbimage=(isset($_GET['tpth']) && $_GET['tpth']==='h')?$_GET['tpth']:'w';//para saber en que modo se creara la imagen por ancho ó altura
$calidadImagen=(isset($_GET['calid']) && is_numeric($_GET['calid']))?$_GET['calid']:95;//calidad de la imagen a generar
$sImagen=''; 
switch($tipo)
{//tipo de imagen para la plantilla
case 'ps': # personas	
	$sImagen = $rut.basename($foto); 
	if((int)$err===0)
		$sImagen = "sexM.gif";
	break;
case 'instituciones': # instituciones(eess,microredes,comunidades)
	$sImagen = $rut.basename($foto); 
	if((int)$err===0)
		$sImagen = "siluetaImgIE.gif";
	break;
case 'fotos': # fotos
	$sImagen = $rut.basename($foto); 
	if((int)$err===0)
		$sImagen = "siluetaImg.gif";
	break;
}

if(isset($_GET['gt']) && (int)$_GET['gt']===1)
{//general
  $sImagen = $rut; 
}

if($tipoThumbimage==='w'){
	$nombre = $sImagen;
	$datos = getimagesize($nombre); 
	if($datos[2]==1){$img = @imagecreatefromgif($nombre);} 
	if($datos[2]==2){$img = @imagecreatefromjpeg($nombre);} 
	if($datos[2]==3){$img = @imagecreatefrompng($nombre);} 
	$ratio = ($datos[0] / $altura); 
	$altura_ = ($datos[1] / $ratio); 
	if($altura_>$hmax){$altura2=$hmax*$altura/$altura_;$altura_=$hmax;$altura=$altura2;}
	$thumb = imagecreatetruecolor($altura,$altura_); 
	imagecopyresampled($thumb, $img, 0, 0, 0, 0, $altura, $altura_, $datos[0], $datos[1]);
	if($datos[2]==1){header("Content-type: image/gif"); imagegif($thumb);} 
	if($datos[2]==2){header("Content-type: image/jpeg");imagejpeg($thumb);} 
	if($datos[2]==3){header("Content-type: image/png");imagepng($thumb); } 
	imagedestroy($thumb); 

}else if($tipoThumbimage==='h'){	
	$img_ve=new _Thumbimage($sImagen);        
	$img_ve->size_height($altura);
	$img_ve->jpeg_quality($calidadImagen);
	$img_ve->ver_imagen();
//        $nombre = $sImagen;
//	$datos = getimagesize($nombre); 
//	if($datos[2]==1){$img = @imagecreatefromgif($nombre);} 
//	if($datos[2]==2){$img = @imagecreatefromjpeg($nombre);} 
//	if($datos[2]==3){$img = @imagecreatefrompng($nombre);} 
//	$ratio = ($datos[0] / $altura); 
//	$altura_ = ($datos[1] / $ratio); 
//	if($altura_>$hmax){$altura2=$hmax*$altura/$altura_;$altura_=$hmax;$altura=$altura2;}
//	$thumb = imagecreatetruecolor($altura,$altura_); 
//	imagecopyresampled($thumb, $img, 0, 0, 0, 0, $altura, $altura_, $datos[0], $datos[1]);
//	if($datos[2]==1){header("Content-type: image/gif"); imagegif($thumb);} 
//	if($datos[2]==2){header("Content-type: image/jpeg");imagejpeg($thumb);} 
//	if($datos[2]==3){header("Content-type: image/png");imagepng($thumb); } 
//	imagedestroy($thumb);     
}
?>