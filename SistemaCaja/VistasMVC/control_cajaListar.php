<?php
//Listar : CONTROL_CAJA 
//Autor : ALCON 
//fecha 2012-12-29 
//Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/Controlcaja.js"></script>

<div  class="tituloPag">
    <strong>CONTROL CAJA</strong>
</div>




<div style="height:95%;">

    <div id="bMenuLeftG">
        <ul>
            <li>
                <a href="<?php echo _Url::_getURL('control_caja', 'form'); ?>" title="Nuevo">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoNuevo.gif);">
                </a>
            </li>
            <li>
                <a title="Modificar" href="javascript:void(0);" onclick="jsControlcajaModificar('<?php echo _Url::_getURL('control_caja', 'form', array('idmodi' => '')); ?>');" id="acmd_modi">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoModi.gif);">
                </a>
            </li>
            <li>
                <a title="Borrar" href="javascript:void(0);" onclick="jsControlcajaEliminar('<?php echo _Url::_getURL('control_caja', 'eliminar', array('idelim' => null)); ?>')">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoBorrar.gif);">
                </a>
            </li>     
            <li>
                <a title="Exportar - Excel" href="<?php echo _Url::_getURL('control_caja', 'exportar'); ?>">
                    <img src="fileproject/img/body/menuleft/imgDefacult.gif" style="background-image:url(fileproject/img/body/menuleft/icoExcel.gif);">
                </a>
            </li>          
        </ul>
    </div>




    <div style="width:92%;float:left;height:90%;">
        <section id="bBodyCont">
            <div class="bContendorMenuGrilla">
                <div class="cbtp">
                    <input type="checkbox" name="ckg" id="ckg"/>                    
                </div>
                <div class="cbtp"><img src="fileproject/img/body/grilla/icoAcualizar.gif" onclick="javascript:document.location.href='<?php echo _Url::_getURL('control_caja'); ?>';"></div>

                <div style="float:left; margin-right:23px;">
                    <div class="cbtp cbtp_sub_menu" id="lstTipoBusquedaControlcaja">
                        <span id="">Buscar</span>
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;">
                            <li><a href="javascript:void(0);" id="2">Número Comprobante</a></li>
                            <li><a href="javascript:void(0);" id="1">Fecha</a></li>                                            
                        </ul>
                    </div>                  
                    <input type="text" name="txtControlcajab" id="txtControlcajab" style="margin-top:7px;" size="50" onkeyup="jsControlcajaBuscarKey(event,'<?php echo _Url::_getURL('control_caja','buscar'); ?>')" />
                </div>

                <div style="float:right; margin-right:23px;">
                    <span class="btxt1" style="float:left; margin-top:12px;"><strong><?php echo $nregistros; ?></strong> de <strong><?php echo $nregistrostotal; ?></strong></span>
                    <div class="cbtp cbtp_move_left <?php if ($pagAnterior == "") { ?>cbtp_disabled<?php } ?>" title="Anterior" <?php if ($pagAnterior != "") { ?> onclick="document.location.href='<?php echo $pagAnterior; ?>'" <?php } ?>></div>
                    <div class="cbtp cbtp_move_right <?php if ($pagSiguiente == "") { ?>cbtp_disabled<?php } ?>" title="Siguiente" <?php if ($pagSiguiente != "") { ?> onclick="document.location.href='<?php echo $pagSiguiente; ?>'" <?php } ?>></div>
                </div>

                <div style="clear:both;"></div>                          
            </div>
            <div id="bGrillaG">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <th></th>
                        <th align="center">
                            Comprobante
                        </th>
                        <th align="center">Nº Com</th>
                        <th align="center">Moneda</th>
                        <th align="center">Operación</th>
                        <th align="center">Descripción</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                        <th>Fecha</th>
                    </tr>
                    <?php
                    $ite = 1;
                    foreach ($lista as $rowd) {/* TT */
                        ?>             
                        <tr>
                            <td>
                                <input type="checkbox" name="cki[]" id="cki[]" value="<?php echo $rowd->getIdccaja(); ?>"/>
                                <?php
                                $oComp = control_cajaControl::oComprobante($rowd->getIdcomp());
                                ?>
                            </td>
                            <td><?php echo $oComp->getNombre(); ?></td>
                            <td><?php echo $rowd->getNum_comprobante(); ?></td>
                            <?php
                            $oMoneda = control_cajaControl::oMoneda($rowd->getIdmone());
                            ?>              
                            <td><?php echo $oMoneda->getIniciales(); ?></td>
                            <?php
                            $oOperacion = control_cajaControl::oOperacion($rowd->getIdoperacion());
                            ?>              
                            <td><?php echo $oOperacion->getNombre(); ?></td>
                            <?php
                            $oDescripcion = control_cajaControl::oDescripcion($rowd->getIddec());
                            ?>              
                            <td><?php echo $oDescripcion->getDescripcion(); ?></td>
                            <td><?php echo $rowd->getCantidad(); ?></td>
                            <td><?php echo $rowd->getImporte(); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($rowd->getFecha())); ?></td>
                        </tr>

                        <?php
                        ++$ite;
                    }/* TT */
                    ?>             
                </table>
            </div>
        </section>    
    </div> 





</div>