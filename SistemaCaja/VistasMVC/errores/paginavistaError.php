<?php
//Solo cuando la pagina de la VISTA no existe
?>
<div style="width:30%; margin:20px auto;">
      <div style="padding:8px;">
      <img src="fileproject/img/sistema/logos/at_1.gif" width="231" height="77" /> 
     </div>
       <div class="txtSinDato">
         <h1>Página no encontrada</h1>
       </div>
  <div class="txtStyleAd2">
    <p>
         La página que buscas no existe, probablemente el enlace que usaste es erróneo, intenta ubicarlo en la página principal.
       </p>
       <p class="txtStyleAd3">
          <?php echo $pag_n;?>
       </p>
     </div>
       
     <div class="linkStyle2">
        <a href="<?php echo $dominioweb;?>"> VOLVER A LA PÁGINA PRINCIPAL</a>
     </div>
  </div>