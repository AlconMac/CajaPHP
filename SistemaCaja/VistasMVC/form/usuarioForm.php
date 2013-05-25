<?php 
 //Formulario : USUARIO 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Usuario.js"></script>

<div  class="tituloPag">
	<strong>USUARIO</strong>
	<span></span>
</div>

<div id="localizador"><a href="?">Inicio</a> > <a href="<?php echo _Url::_getURL('usuario');?>">Listas</a> > Form</div>

<?php if (!empty($textAlerta)) { ?>
	<div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
<?php } ?>	
	
<div id="dv_cont_body_t">
<form action="<?php echo _Url::_getURL('usuario','guardar');?>" method="post" name="formUsuario" class="formulariosA1" id="formUsuario">

	<?php
	  echo $token;
	  echo $updateix;
	?>	
	
<fieldset>
<legend>Datos</legend>
<table width="685" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
	 	<td>
	 	<label for="txtnombres">Nombres:</label><input name="txtnombres" id="txtnombres" type="text" value="<?php echo $objForm->getNombres();?>" />
	 	</td>
	 	<td>
	 	<label for="txtapellidos">Apellidos:</label><input name="txtapellidos" id="txtapellidos" type="text" value="<?php echo $objForm->getApellidos();?>" />
	 	</td>
	 </tr>
	<tr>
	 	<td>
	 	<label for="txtusu">Usu:</label><input name="txtusu" id="txtusu" type="text" value="<?php echo $objForm->getUsu();?>" />
	 	</td>
	 	<td>
	 	<label for="txtclave">Clave:</label><input name="txtclave" id="txtclave" type="text" value="<?php echo $objForm->getClave();?>" />
	 	</td>
	 </tr>
	<tr>
	 	<td>
	 	<label for="txtestado">Estado:</label><input name="txtestado" id="txtestado" type="text" value="<?php echo $objForm->getEstado();?>" />
	 	</td>
	 	<td>
	 	</td>
	 </tr>
</table>
</fieldset>
<div style="text-align:right; margin-top:5px;">
<input name="cmdcancelusuario" type="button" class="BotonStan1 paddingCmd" id="cmdcancelusuario" value="CANCELAR" onclick="jsUsuarioLimpiar()" />
<input name="cmdregiusuario" type="button" class="BotonStan2 paddingCmd" id="cmdregiusuario" value="GUARDAR" onclick="jsUsuarioGuardar()" />
</div>
</form>
</div>
