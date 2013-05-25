//javascript de inicio
$(document).ready(function(e) {
  $('#contsubmenug').animate({height:"hide",opacity:"hide"},"hide");  
  var idmenuac='';
  $(".botonesMenuPrincipal>li").each(function(index, element) {
	 var id=$(this).find("a").attr("id");	
	 //$(this).removeClass('activo');  								
	 $(this).click(function(){
		 
		var contBodyGMenu=document.getElementsByTagName('body').item(0);		
		if(document.getElementById("dvfondomenuprincipal"))
			contBodyGMenu.removeChild(document.getElementById("dvfondomenuprincipal")); 
		if(idmenuac==id){
			$('#contsubmenug').animate({height:"hide",opacity:"hide"},"hide");			
			//$(this).removeClass('activo');  				
			idmenuac='';
		   return false;
		}else{
			 //$(this).addClass('activo');  	
			idmenuac=id;
		}										


			  var divfm=document.createElement('div');
				divfm.id='dvfondomenuprincipal';
				divfm.style.backgroundColor="#FFF";
				divfm.style.position="absolute";			
				divfm.style.height='100%';
				divfm.style.width='100%';
				divfm.style.top='151px';
				divfm.style.left='0px';				
				divfm.style.filter='alpha(opacity=80)';
				divfm.style.MozOpacity='.80';
				divfm.style.opacity='.80';		
				divfm.style.zIndex='4';	
				divfm.innerHTML='<div style="text-align:center;padding:10px;" class="txtStyleAd1">Cargando...<br/><img src="fileproject/img/sistema/precarga_ajax.gif" alt="icoPrecarga"/></div>';		  
			    contBodyGMenu.appendChild(divfm);

		$("#contsubmenug").html('');//Limpiamos el menu	
		$.get("configoptionsmenu.atn", function (xml) 
		{
			var hmtlMenu='<div id="menuSubOPciones">'; 
			if($(xml).find("subm_"+id).find('option').length==0){
				document.location.href=_Url();
				return false;
			}
			
			$(xml).find("subm_"+id).find('option').each(function()
		    {                                   
				var name = $(this).find('name').text();
				var ctr = $(this).find('ctr').text();
				var met = $(this).find('met').text();
				var icono = $(this).find('icono').text();
				var title = $(this).find('title').text();
					
				if($(this).attr('group') && $(this).attr('group')=='1'){
					hmtlMenu+='<fieldset style="clear:both"><legend>'+$(this).attr('text')+'</legend>';
				}
				
				hmtlMenu+='<div class="boxBotonSubMenu">'
					if(met && met!=""){
						hmtlMenu+='<a href="'+_Url(ctr,met)+'" title="'+title+'">';
					}else{
						hmtlMenu+='<a href="'+_Url(ctr)+'" title="'+title+'">';
					}
						hmtlMenu+='<img src="'+icono+'" width="48" height="48" alt="'+title+'" border="0" /><br />';
						hmtlMenu+='<span>';
						hmtlMenu+=name;
						hmtlMenu+='</span>';
						hmtlMenu+='</a>';					
					
				hmtlMenu+=' </div>';

				if($(this).attr('group') && $(this).attr('group')=='0'){
					hmtlMenu+='</fieldset>';								
				}
					
			});
				hmtlMenu+='</div>';
				
				
				$("#contsubmenug").html(hmtlMenu);
					
			});
			

			  $('#contsubmenug').animate({height:"hide",opacity:"hide"},"hide",function(){
				   $('#contsubmenug').animate({height:"show",opacity:"show"},"show");
			  });
						
		 });   
    });
	
	
	
	
	
	///Title
	$(".cssTitle").each(function (index){		
				if($(this).attr("title")!="")
				{
					var ObjTip=new tipsALCON();
					var nuncaracter=$(this).attr("title").length;
					var anchoT=nuncaracter*8;
					if(nuncaracter>30)
					   anchoT=anchoT-60;
					   
					ObjTip.iniTipsAlcon(this,{
					   plantilla:"P_ALCON2",	
					   textBody:$(this).attr("title"),
					   ancho:anchoT,
					   efectoTips:300			  
					 });
				}
	});	
	
	///Nuúmero máximo de caracteres de un texarea
	$(".cssMaxLength").each(function(index, element) {
        var cantMax=$(this).attr("maxlength");		
		var contenido_textarea="";
		$(this).keyup(function(e){	
			if ($(this).val().length<=cantMax)
				contenido_textarea = $(this).val();
			else
				$(this).val(contenido_textarea);						
        });
		//
		$(this).keydown(function(e){
			if ($(this).val().length<=cantMax)
				contenido_textarea = $(this).val();
			else
				$(this).val(contenido_textarea);						
		});
    });
});