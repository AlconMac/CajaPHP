<?php
//Listar : CONTROL_CAJA 
//Autor : ALCON 
//fecha 2012-12-29 
//Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/ControlcajaReporte.js"></script>

<div  class="tituloPag">
    <strong>CONTROL CAJA</strong>
</div>



<?php
$fecha = control_cajaReporteControl::Fecha();
?>
<div style="height:95%; width:100%;">

    <div style="width:100%;float:left;height:95%;">
        <section id="bBodyCont">
            <div class="bContendorMenuGrilla">             
                <div class="cbtp"><img src="fileproject/img/body/grilla/icoAcualizar.gif" onclick="javascript:document.location.href='<?php echo _Url::_getURL('control_cajaReporte'); ?>';"></div>

                <div style="float:left; margin-right:23px; display:none;">
                    <div class="cbtp cbtp_sub_menu" id="lstTipoBusquedaControlcaja">
                        <span id="">Buscar</span>
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;">
                            <li><a href="javascript:void(0);" id="1">Fecha</a></li>                                            
                        </ul>
                    </div>                  
                    <input type="text" name="txtControlcajab" id="txtControlcajab" style="margin-top:7px;" size="50" onkeyup="jsControlcajaBuscarKey(event,'<?php echo _Url::_getURL('control_cajaReporte', 'buscar'); ?>')" />
                </div>

                <div style="float:right">
                    <?php
                    $oFecha = control_cajaReporteControl::oFecha();
                    ?>
                    <div class="cbtp cbtp_sub_menu" id="lstYear">
                        <span id="">Año</span>
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;">
                            <?php
                            for ($r = 2012; $r <= date("Y"); $r++) {
                                ?>

                                <li>
                                    <?php if ((int) $oFecha->year === $r) { ?><script>fngListSelectActivo('lstYear','<?php echo $r; ?>','<?php echo $r; ?>');</script><?php } ?>
                                    <a href="javascript:void(0);" id="<?php echo $r; ?>"><?php echo $r; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>                  


                    <div class="cbtp cbtp_sub_menu" id="lstMes">
                        <span id="">Mes</span>
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;">
                            <?php
                            $meses = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio"
                                , 8 => "Agosto", 9 => "Setiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
                            foreach ($meses as $ib => $m) {
                                ?>
                                <li>
                                    <?php if ((int) $oFecha->mes === $ib) { ?><script>fngListSelectActivo('lstMes','<?php echo $ib; ?>','<?php echo $m; ?>');</script><?php } ?>
                                    <a href="javascript:void(0);" id="<?php echo $ib; ?>"><?php echo $m; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>                  

                    <div class="cbtp">
                        <span id="">Día</span>
                        <input type="text" name="lstDia" id="lstDia" size="1" style="margin:0px; padding:1px; font-size:11px;" value="<?php echo $oFecha->dia; ?>" />
                    </div>                  


                    <input type="button" name="cmdbuscarfecha" id="cmdbuscarfecha" class="BotonStan2" value="Filtrar para Reporte" style="margin-top:7px;" onclick="fnlFiltrarFecha('<?php echo _Url::_getURL('control_cajaReporte', null, array("fechab" => "")); ?>')" />

                </div>

                <div style="clear:both;"></div>                          
            </div>

            <div style="background-color:#FFF; padding:15px; height:91%; overflow:auto;">
                <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" style="border:#CCC solid 1px;">
                    <tr class="txtStyleAd2">
                        <td height="30" colspan="5" align="center">
                            <strong class="txtStyleAd6"><?php echo date("d/m/Y", strtotime($fecha)); ?></strong>
                        </td>
                    </tr>
                    <tr class="txtStyleAd2">
                        <td width="134" height="30" align="center" bgcolor="#F3F3F3"><strong>Tipo Comprobante</strong></td>
                        <td width="116" align="center" bgcolor="#F3F3F3">&nbsp;</td>
                        <td width="206" align="center" bgcolor="#F3F3F3">&nbsp;</td>
                        <td width="82" align="center" bgcolor="#F3F3F3"><strong>INGRESO</strong></td>
                        <td width="78" align="center" bgcolor="#F3F3F3"><strong>SALIDA</strong></td>
                    </tr>
                    <?php
                    $montoIngreso = 0;
                    $montoSalida = 0;
                    if ($ListTipoComprobate) {
                        foreach ($ListTipoComprobate as $row) {
                            ?>
                            <tr class="txtStyleAd2">
                                <td height="26"><?php echo $row->getNombre(); ?></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>

                                <td class="txtStyleAd2">
                                    <strong>S/.
                                        <?php
                                        $moning = (float) control_cajaReporteControl::BuscarMonto(1, $row->getIdcomp(), $fecha);
                                        echo number_format($moning, 2);
                                        $montoIngreso = $montoIngreso + $moning;
                                        ?>
                                    </strong></td>
                                <td class="txtStyleAd2">
                                    <strong>S/.
                                        <?php
                                        $monsal = (float) control_cajaReporteControl::BuscarMonto(2, $row->getIdcomp(), $fecha);
                                        echo number_format($monsal, 2);
                                        $montoSalida = $montoSalida + $monsal;
                                        ?>                                    
                                    </strong></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td height="29" bgcolor="#F8F8F8"><span class="txtStyleAd4Ok">Total del Dia</span></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($montoIngreso, 2); ?></strong></td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($montoSalida, 2); ?></strong></td>
                    </tr>
                    <tr>
                        <?php 
                        $oSaldo = control_cajaReporteControl::BuscarSaldo($fecha); 
                        $saldoant = $oSaldo->getMonto();
                        $fechaSaldo=($oSaldo->getFecha()!="")?date("d-m-Y", strtotime($oSaldo->getFecha())):"-- -- ----";
                        ?>                    
                        <td height="27">
                        <span class="txtStyleAd4Ok">Saldo Inicial </span><br/>
                        <span class="txtStyleAd2">(<?php echo $fechaSaldo;?>)</span>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($saldoant, 2); ?></strong></td>
                        <td class="txtStyleAd4Ok">&nbsp;</td>
                    </tr>
                    <tr class="txtStyleAd4Err">
                        <td height="28" bgcolor="#F8F8F8"><strong>TOTAL</strong></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Err"><strong>S/.<?php echo $montoTotalIngresoG = number_format($montoIngreso + $saldoant, 2); ?></strong></td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Err">S/.<?php echo $numSalidaTotal = number_format($montoSalida, 2); ?>           
                        </td>
                    </tr>
                    <tr class="txtStyleAd4Err">
                        <td height="27" bgcolor="#F8F8F8"><strong>Saldo</strong></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td colspan="2" align="center" bgcolor="#F8F8F8" class="txtStyleAd4Err">
                            <strong style="font-size:14px;">
                                S/.
                                <?php
                                echo number_format(($montoIngreso + $saldoant) - $montoSalida, 2);
                                ?>
                            </strong></td>
                    </tr>
                </table>

                <br />

                <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" style="border:#CCC solid 1px;">
                    <tr class="txtStyleAd2">
                        <td height="30" colspan="5" align="center">
                            <strong class="txtStyleAd6">Detalle</strong>
                        </td>
                    </tr>
                    <tr class="txtStyleAd2">
                        <td width="134" height="30" align="center" bgcolor="#F3F3F3"><strong>Descripción</strong></td>
                        <td width="116" align="center" bgcolor="#F3F3F3">&nbsp;</td>
                        <td width="206" align="center" bgcolor="#F3F3F3">&nbsp;</td>
                        <td width="82" align="center" bgcolor="#F3F3F3"><strong>INGRESO</strong></td>
                        <td width="78" align="center" bgcolor="#F3F3F3"><strong>SALIDA</strong></td>
                    </tr>
                    <?php
                    $montoIngreso = 0;
                    $montoSalida = 0;
                    $listaDetalleCaja = control_cajaReporteControl::ListaDetalle();
                    if ($listaDetalleCaja) {
                        foreach ($listaDetalleCaja as $row) {
                            ?>
                            <tr class="txtStyleAd2">
                                <td height="26"><?php echo $row['descripcion']; ?></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>

                                <td class="txtStyleAd2">
                                    <strong>S/. 
                                        <?php
                                        $montoDescripcionIngreso = $row['ingreso'];
                                        echo number_format($montoDescripcionIngreso, 2);
                                        $montoIngreso = $montoIngreso + $montoDescripcionIngreso;
                                        ?>
                                    </strong></td>
                                <td class="txtStyleAd2">
                                    <strong>S/. 
                                        <?php
                                        $montoDescripcionSalida = $row['salida'];
                                        echo number_format($montoDescripcionSalida, 2);
                                        $montoSalida = $montoSalida + $montoDescripcionSalida;
                                        ?>
                                    </strong></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td height="29" bgcolor="#F8F8F8"><span class="txtStyleAd4Ok">Total del Dia</span></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($montoIngreso, 2); ?></strong></td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($montoSalida, 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td height="27">                        
                        	<span class="txtStyleAd4Ok">Saldo Inicial </span><br/>
                        	<span class="txtStyleAd2">(<?php echo $fechaSaldo;?>)</span>                        
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>                                             
                        <td class="txtStyleAd4Ok"><strong>S/.<?php echo number_format($saldoant, 2); ?></strong></td>
                        <td class="txtStyleAd4Ok">&nbsp;</td>
                    </tr>
                    <tr class="txtStyleAd4Err">
                        <td height="28" bgcolor="#F8F8F8"><strong>TOTAL</strong></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Err"><strong>S/.<?php echo number_format($saldoant + $montoIngreso, 2); ?></strong></td>
                        <td bgcolor="#F8F8F8" class="txtStyleAd4Err">S/. 
                        <?php echo number_format($montoSalida, 2); ?>          
                        </td>
                    </tr>
                    <tr class="txtStyleAd4Err">
                        <td height="27" bgcolor="#F8F8F8"><strong>Saldo</strong></td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td bgcolor="#F8F8F8">&nbsp;</td>
                        <td colspan="2" align="center" bgcolor="#F8F8F8" class="txtStyleAd4Err">
                            <strong style="font-size:14px;">
                                S/.
								<?php echo number_format(($saldoant + $montoIngreso) - $montoSalida, 2); ?>     
                            </strong></td>
                    </tr>
                </table>


            </div>


        </section>    
    </div> 





</div>