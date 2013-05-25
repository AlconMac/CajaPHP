<?php
//Listar : CONTROL_CAJA 
//Autor : ALCON 
//fecha 2012-12-29 
//Lima - Perú 
?>
<script language="javascript" type="text/javascript" src="fileproject/js/js_form/ControlcajaReporte.js"></script>

<div  class="tituloPag">
    <strong>REPORTE</strong>
</div>


<div style="height:95%; width:100%;">

    <div style="width:100%;float:left;height:95%;">
        <section id="bBodyCont">
            <div class="bContendorMenuGrilla">             
                <div class="cbtp"><img src="fileproject/img/body/grilla/icoAcualizar.gif" onclick="javascript:document.location.href='<?php echo _Url::_getURL('control_cajaReportegrafico'); ?>';"></div>

                <div style="float:left; margin-right:23px; display:none;">
                    <div class="cbtp cbtp_sub_menu" id="lstTipoBusquedaControlcaja">
                        <span id="">Buscar</span>
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;">
                            <li><a href="javascript:void(0);" id="1">Fecha</a></li>                                            
                        </ul>
                    </div>                  
                    <input type="text" name="txtControlcajab" id="txtControlcajab" style="margin-top:7px;" size="50" onkeyup="jsControlcajaBuscarKey(event,'<?php echo _Url::_getURL('control_cajaReportegrafico', 'buscar'); ?>')" />
                </div>

                <div style="float:right">
                    <?php
                    $oFecha = control_cajaReportegraficoControl::oFecha();
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
                        <ul class="cbtp_sub_menu_cont" style="width:180px;display:none;z-index:100;">
                            <li><a href="javascript:void(0);" id=""> - Mes - </a></li>                        
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


                    <input type="button" name="cmdbuscarfecha" id="cmdbuscarfecha" class="BotonStan2" value="Filtrar para Reporte" style="margin-top:7px;" onclick="fnlFiltrarFechaGrafico('<?php echo _Url::_getURL('control_cajaReportegrafico', null, array("fechab" => "")); ?>')" />

                </div>

                <div style="clear:both;"></div>                          
            </div>

            <div style="background-color:#FFF; padding:15px; height:100%;"><br />
                <script src="fileproject/js/js_plugin/graficos/highcharts.js"></script>
                <script src="fileproject/js/js_plugin/graficos/modules/exporting.js"></script>
                <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                <script type="text/javascript">
                    var dataJson=eval(<?php echo control_cajaReportegraficoControl::DataGrafico($fechaYear,$fechaMes);?>);
                    fnlGraficoG(dataJson);
                </script>
            </div>


        </section>    
    </div> 





</div>