<?php 
 //Listar : USUARIO 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Usuario.js"></script>

<div  class="tituloPag">
	<strong>USUARIO</strong>
	<span></span>
</div>

<div id="localizador"><a href="?">Inicio</a> > Listar</div>

<?php if (!empty($textAlerta)) { ?>
	<div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
<?php } ?>	
	<div id="GrillaList">

  <div class="GrillaMenu">
    <div style="float:left;">
      <?php echo $paginacion;?>
    </div>
     
     <div style="float:right">
        <a href="<?php echo _Url::_getURL('usuario','form');?>" class="BotonStan2">Agregar</a>
        <a href="javascript:void(0);" class="BotonStan1" onclick="ShowHide('dvUsuarioBuscar',true)">Buscar</a>
        <a href="<?php echo _Url::_getURL('usuario','exportar');?>" class="BotonStan1"> <img src="fileproject/img/sistema/iconosTipoArchivos/excelExport.png" width="10" height="10"/> Exportar </a>    
    </div>
  </div>	
	

  <div id="dvUsuarioBuscar" style="display:none; text-align:right">
    <form name="formUsuarioBuscar" id="formUsuarioBuscar" method="post" action="" onsubmit="return false;">
         <select name="lstTipoBusquedaUsuario" id="lstTipoBusquedaUsuario">
           <option value="">-Seleccione -</option>
           <option value="1">Por Nombre id</option>
         </select>
         <input type="text" name="txtUsuariob" id="txtUsuariob" onkeydown="jsUsuarioBuscarKey(event,'<?php echo _Url::_getURL('usuario','buscar');?>')" />
     </form>
  </div>	
	
<div class="GrillaTable">
<table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td height="30" width="13" align="center" style="background-color:#E5E5E5" class="titu" >&nbsp;</td>
<td height="30" width="106" align="center" style="background-color:#E5E5E5" class="titu" ><strong>nombres</strong></td>
<td height="30" width="106" align="center" style="background-color:#E5E5E5" class="titu" ><strong>apellidos</strong></td>
<td height="30" width="106" align="center" style="background-color:#E5E5E5" class="titu" ><strong>usu</strong></td>
<td height="30" width="106" align="center" style="background-color:#E5E5E5" class="titu" ><strong>clave</strong></td>
<td height="30" width="106" align="center" style="background-color:#E5E5E5" class="titu" ><strong>estado</strong></td>
<td colspan="2" align="center" style="background-color:#E5E5E5" class="titu"><strong>ACCION</strong></td>
</tr>

	<?php
     $ite=1;   
      foreach($lista as $rowd)
      {/*TT*/
    ?>
	
<tr>
<td height="36" align="center" valign="middle" class="titu" style="background-color:#E5E5E5;"><?php echo $ite;?></td>
<td align="center" valign="middle" class="textCont"><?php echo $rowd->getNombres();?></td>
<td align="center" valign="middle" class="textCont"><?php echo $rowd->getApellidos();?></td>
<td align="center" valign="middle" class="textCont"><?php echo $rowd->getUsu();?></td>
<td align="center" valign="middle" class="textCont"><?php echo $rowd->getClave();?></td>
<td align="center" valign="middle" class="textCont"><?php echo $rowd->getEstado();?></td>

      <td width="30" align="center" valign="middle" title="Modificar">
          <a href="<?php echo _Url::_getURL('usuario','form',array('idmodi'=>$rowd->getIdusu()));?>">
            <img src="fileproject/img/sistema/formularios/icoModi.gif" width="19" height="17" title="Modificar" border="0"/>
          </a>
      </td>				
				

		<td width="40" align="center" valign="middle">
      		<a href="javascript:void(0);" onclick="jsUsuarioEliminar('<?php echo _Url::_getURL('usuario','eliminar',array('idelim'=>$rowd->getIdusu()));?>')">
                <img src="fileproject/img/sistema/formularios/icoDele.gif" width="18" height="18" title="Borrar" border="0" />
             </a>
      </td>
      
</tr>

    <?php  
	  ++$ite;
   }/*TT*/
	?>
	
</table>
</div>
</div>