<?php 
 //Formulario : TIPO_DESCRIPCION 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Tipodescripcion.js"></script>

<div  class="tituloPag">
	<strong>TIPO_DESCRIPCION</strong>
	<span></span>
</div>

<div id="localizador"><a href="?">Inicio</a> > <a href="<?php echo _Url::_getURL('tipo_descripcion');?>">Listas</a> > Form</div>

<?php if (!empty($textAlerta)) { ?>
	<div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
<?php } ?>	
	
<div id="dv_cont_body_t">
<form action="<?php echo _Url::_getURL('tipo_descripcion','guardar');?>" method="post" name="formTipodescripcion" class="formulariosA1" id="formTipodescripcion">

	<?php
	  echo $token;
	  echo $updateix;
	?>	
	
<fieldset>
<legend>Datos</legend>
<table width="685" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
	 	<td>
	 	<label for="txtdescripcion">Descripcion:</label><input name="txtdescripcion" id="txtdescripcion" type="text" value="<?php echo $objForm->getDescripcion();?>" />
	 	</td>
	 	<td>
	 	<label for="txtfecharegi">Fecharegi:</label><input name="txtfecharegi" id="txtfecharegi" type="text" value="<?php echo $objForm->getFecha_regi();?>" />
	 	</td>
	 </tr>
</table>
</fieldset>
<div style="text-align:right; margin-top:5px;">
<input name="cmdcanceltipodescripcion" type="button" class="BotonStan1 paddingCmd" id="cmdcanceltipodescripcion" value="CANCELAR" onclick="jsTipodescripcionLimpiar()" />
<input name="cmdregitipodescripcion" type="button" class="BotonStan2 paddingCmd" id="cmdregitipodescripcion" value="GUARDAR" onclick="jsTipodescripcionGuardar()" />
</div>
</form>
</div>
