<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>MiniMarketing</title>
<base href="http://localhost/SistemaCaja/" />
<link rel="shortcut icon" href="fileproject/icono/favicon_at.ico" />
<link href="fileproject/css/cssForm.css" rel="stylesheet" type="text/css" />
<link href="fileproject/css/cssGlobal.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->	
<script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/AlertALCON.js"></script>
<script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="fileproject/js/js_plugin/UtilitariosALCON.js"></script>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Login.js"></script>
</head>
<body>
<article id="dv_login">
  <div class="loginForm">
     <form name="frmlogin" id="frmlogin" action="" method="post" autocomplete="off">
       <label for="txtuser">Usuario : </label><input name="txtuser" type="text" id="txtuser" maxlength="40" />
         <hr />
       <label for="txtclave">Contraseña : </label><input name="txtclave" type="password" id="txtclave" maxlength="20" />
       <hr />
       <div style="text-align:right">
       <input name="cmdlimpiar" type="button" class="BotonStan1 paddingCmd3" id="cmdlimpiar" value="Limpiar" />
       <input name="cmdingresar" type="button" class="BotonStan3 paddingCmd3" id="cmdingresar" value="Ingresar" />       
       </div>
     </form>
    </div>
</article>
<?php
if(isset($_GET['err']) && (int)$_GET['err']===1){
?>
  <script language="javascript" type="text/javascript">fnl_login_error();</script>
<?php
}
?>
</body>
</html>