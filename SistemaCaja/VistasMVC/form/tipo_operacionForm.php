<?php 
 //Formulario : TIPO_OPERACION 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Tipooperacion.js"></script>

<div  class="tituloPag">
	<strong>TIPO_OPERACION</strong>
	<span></span>
</div>

<div id="localizador"><a href="?">Inicio</a> > <a href="<?php echo _Url::_getURL('tipo_operacion');?>">Listas</a> > Form</div>

<?php if (!empty($textAlerta)) { ?>
	<div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
<?php } ?>	
	
<div id="dv_cont_body_t">
<form action="<?php echo _Url::_getURL('tipo_operacion','guardar');?>" method="post" name="formTipooperacion" class="formulariosA1" id="formTipooperacion">

	<?php
	  echo $token;
	  echo $updateix;
	?>	
	
<fieldset>
<legend>Datos</legend>
<table width="685" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
	 	<td>
	 	<label for="txtnombre">Nombre:</label><input name="txtnombre" id="txtnombre" type="text" value="<?php echo $objForm->getNombre();?>" />
	 	</td>
	 	<td>
	 	</td>
	 </tr>
</table>
</fieldset>
<div style="text-align:right; margin-top:5px;">
<input name="cmdcanceltipooperacion" type="button" class="BotonStan1 paddingCmd" id="cmdcanceltipooperacion" value="CANCELAR" onclick="jsTipooperacionLimpiar()" />
<input name="cmdregitipooperacion" type="button" class="BotonStan2 paddingCmd" id="cmdregitipooperacion" value="GUARDAR" onclick="jsTipooperacionGuardar()" />
</div>
</form>
</div>
