<?php
//Formulario : CONTROL_CAJA 
//Autor : ALCON 
//fecha 2012-12-29 
//Lima - Perú 
?>


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Controlcaja.js"></script>
 <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script  src="fileproject/js/js_plugin/jquery-ui.js"></script>
<div  class="tituloPag">
    <strong>CONTROL CAJA</strong>
</div>




<div style="height:95%;">

    <div id="bMenuLeftG">
        <ul>
            <li>
                <a href="<?php echo _Url::_getURL('control_caja'); ?>" title="Volver">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoVolver.gif);">
                </a>
            </li>
            <li>
                <a title="Nuevo" href="<?php echo _Url::_getURL('control_caja', 'form'); ?>" id="acmd_modi">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoNuevo.gif);">
                </a>
            </li>
            <li>
                <a title="Guardar" href="javascript:void(0);" onclick="jsControlcajaGuardar();">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoGuardar.gif);">
                </a>
            </li>                  
        </ul>
    </div>




    <div style="width:92%;float:left;height:90%;">
        <section id="bBodyCont">
            <div class="bContendorMenuGrilla">
                <div style="clear:both; height:10px;">
					<?php if (!empty($textAlerta)) { ?>
                        <div id="div_mensaje" class="mensajes-procesos" align="center"><?php echo $textAlerta;?></div>
                    <?php } ?>	                
                </div>                          
            </div>

            <article style="background-color:#FFF; height:106%;">
                <form action="<?php echo _Url::_getURL('control_caja', 'guardar'); ?>" method="post" name="formControlcaja" class="formulariosA1" id="formControlcaja">

                    <?php
                    echo $token;
                    echo $updateix;
                    ?>	

                    <fieldset style="border:none;">
                        <legend>Datos</legend>
                        <table width="685" border="0" align="center" cellpadding="2" cellspacing="2">
                            <tr>
                                <td><label for="txtfecha">Fecha:</label><input name="txtfecha" id="txtfecha" type="date" value="<?php if($objForm->getFecha()!=""){echo $objForm->getFecha();}else{echo date("Y-m-d");} ?>" /></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtidoperacion">Operación:</label>
                                    <select name="txtidoperacion" id="txtidoperacion">
                                        <?php
                                        if ($ListTipoOperacion) {
                                            foreach ($ListTipoOperacion as $row) {
                                                ?>
                                                <option value="<?php echo $row->getIdoperacion(); ?>" <?php if($objForm->getIdoperacion()==$row->getIdoperacion()) {?>selected="selected" <?php }?>><?php echo $row->getNombre(); ?></option>           
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php //echo $objForm->getIdoperacion();?> 

                                </td>
                                <td>
                                    <label for="txtidmone">Moneda :</label>
                                    <select name="txtidmone" id="txtidmone">
                                        <?php
                                        if ($ListTipoMoneda) {
                                            foreach ($ListTipoMoneda as $row) {
                                                ?>
                                                <option value="<?php echo $row->getIdmone(); ?>"><?php echo $row->getNombre(); ?></option>           
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php //echo $objForm->getIdmone();?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtidcomp">Comprobante:</label>
                                    <select name="txtidcomp" id="txtidcomp">
                                        <?php
                                        if ($ListTipoComprobate) {
                                            foreach ($ListTipoComprobate as $row) {
                                                ?>
                                                <option value="<?php echo $row->getIdcomp();?>" <?php if($objForm->getIdcomp()==$row->getIdcomp()) {?>selected="selected" <?php }?>><?php echo $row->getNombre(); ?></option>           
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>        
                                </td>
                                <td>
                                    <label for="txtnumcomprobante">Nº Comp :</label>
                                    <input name="txtnumcomprobante" id="txtnumcomprobante" type="text" value="<?php echo $objForm->getNum_comprobante(); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtcantidad">Cantidad:</label><input name="txtcantidad" id="txtcantidad" type="text" value="<?php echo $objForm->getCantidad(); ?>" />
                                </td>
                                <td>
                                    <label for="txtimporte">Importe:</label><input name="txtimporte" id="txtimporte" type="text" value="<?php echo $objForm->getImporte(); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="txtdescripcion">Descripción:</label>
<?php 
 $oDescripciong=control_cajaControl::oDescripcion($objForm->getIddec()); 
?>
                                    <input name="txtdescripcion" id="txtdescripcion" type="text" value="<?php echo $oDescripciong->getDescripcion();?>" style="width:98%" />
<?php
 $arrayDATA=array();
	if ($ListTipoDescripcion) {
    	foreach ($ListTipoDescripcion as $row) {
			$arrayDATA[]=$row->getDescripcion();
        }
   }
   $datad=json_encode($arrayDATA);
?>

<script>
var dataAutoC=eval(<?php echo $datad;?>);
$( "#txtdescripcion" ).autocomplete({
    source: dataAutoC
});
</script>                                    
                                    </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="txtobservacion">Observacion:</label><input name="txtobservacion" id="txtobservacion" type="text" value="<?php echo $objForm->getObservacion(); ?>" style="width:98%"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                   
                </form>            
            </article>            





        </section>    
    </div> 





</div>