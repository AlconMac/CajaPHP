<?php 
 //Formulario : TIPO_MONEDA 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Tipomoneda.js"></script>

<div  class="tituloPag">
	<strong>TIPO_MONEDA</strong>
	<span></span>
</div>

<div id="localizador"><a href="?">Inicio</a> > <a href="<?php echo _Url::_getURL('tipo_moneda');?>">Listas</a> > Form</div>

<?php if (!empty($textAlerta)) { ?>
	<div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
<?php } ?>	
	
<div id="dv_cont_body_t">
<form action="<?php echo _Url::_getURL('tipo_moneda','guardar');?>" method="post" name="formTipomoneda" class="formulariosA1" id="formTipomoneda">

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
	 	<label for="txtiniciales">Iniciales:</label><input name="txtiniciales" id="txtiniciales" type="text" value="<?php echo $objForm->getIniciales();?>" />
	 	</td>
	 </tr>
</table>
</fieldset>
<div style="text-align:right; margin-top:5px;">
<input name="cmdcanceltipomoneda" type="button" class="BotonStan1 paddingCmd" id="cmdcanceltipomoneda" value="CANCELAR" onclick="jsTipomonedaLimpiar()" />
<input name="cmdregitipomoneda" type="button" class="BotonStan2 paddingCmd" id="cmdregitipomoneda" value="GUARDAR" onclick="jsTipomonedaGuardar()" />
</div>
</form>
</div>
