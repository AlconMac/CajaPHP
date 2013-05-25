<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//Se ejecuta cuando el Controlador ó el Metodo no existan
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ATN</title>
<link rel="shortcut icon" href="fileproject/icono/favicon_at.ico" />
<link href="fileproject/css/cssGlobal.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="width:35%; margin:20px auto; clear:both; padding:10px;">
      <div style="padding:8px;">
      <img src="fileproject/img/sistema/logos/at_1.gif" width="231" height="77" /> 
     </div>
       <div class="txtSinDato">
         <h1>Página no encontrada</h1>
       </div>
  <div class="txtStyleAd2">
    <p>
         La página que buscas no existe, probablemente el enlace que usaste es erróneo, intenta ubicarlo en la página principal.
       </p>
       <p class="txtStyleAd3">
          <?php echo $error;?>
       </p>
     </div>
       
     <div class="linkStyle2">
        <a href="<?php echo $dominioweb;?>"> VOLVER A LA PÁGINA PRINCIPAL</a>
     </div>
  </div>
</body>
</html>
