<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>MiniMarketing</title>
    <link rel="shortcut icon" href="fileproject/icono/favicon_at.ico" />
    <link href="fileproject/css/cssGlobal.css" rel="stylesheet" type="text/css" />
    <link href="fileproject/css/cssForm.css" rel="stylesheet" type="text/css" />
    <link href="fileproject/css/TinyTipsALCON.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/AlertALCON.js"></script>
    <script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/PopupALCON.js"></script>
    <script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/TinyTipsALCON.js"></script>    
    <script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/jquery-1.4.2.min.js"></script>
    <script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/UtilitariosALCON.js"></script>   
    <script language="javascript" type="text/javascript" src="fileproject/js/js_form/index.js"></script>
</head>

<body>

    <header id="contTop">     
       <div class="logo_e" onClick="document.location.href='?'" style="cursor:pointer;"></div>       
      <nav class="menu_top_min">
		 <span class="txtStyleAd1" style="padding-right:10px; text-align:right; float:left;">
             Bienvenido: <strong><?php echo $empleado;?></strong>
          </span>
           <ul class="lisBoxStyle1" style="float:left;">            
             <li>                 
                 <a href="<?php echo _Url::_getURL('login','outlogin');?>">
                   <img src="fileproject/img/sistema/administrador/icoCerrarSesion.gif" width="24" height="20" hspace="3" vspace="0" border="0" align="absmiddle" />
                   Cerrar Sesión
                </a>
             </li>                          
           </ul>
      </nav> 
 </header>

    
  
<section id="contBodyC">