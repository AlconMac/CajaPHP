/**********************************************************************
Nombre         : PluginALCON
Versión        : 1.0
Autor          : Luis ALCON 
Fecha Creacion : 10-07-2012 Lima - Perú
Fecha Modific. : 10-07-2012 , Lima - Perú
Descripcion    : Se encarga de incluir los diferentes plugins, desde un mismo archivo
**********************************************************************/
var ContPopUpAlcon=0;
PopupALCON=function(params){
		function param_default(pname, def){ if(params){ if (typeof params[pname] == "undefined") {params[pname] = def;}}};
		function param_default_ajax(pname, def){ if(params){ if (typeof params["ajax_parametro"][pname] == "undefined") {params["ajax_parametro"][pname] = def;}}};
		//Parametro por defecto
		param_default("fondo",true);//Si estara activo el fondo general
		param_default("id","popup_alcon_1");//id para identificacion		
		param_default("bordeTransparente",true);//Si el borde sera transparente
		param_default("botonCerrar",false);//Si estara activo el boton cerrar en la parte superior
		param_default("CerrarFondo",false);//Opcion para cerrar la ventana cuando se hace click en el fondo del general
		param_default("precarga","Loading...");//Contenido de la precarga
		param_default("resetear",false);//Para reiciar el contenido del POPUP
		param_default("efectoJquery",false);//Efecto de JQUERY	
		param_default("colorFondo","#FFF");//Color del fondo general
		param_default("nCapa","100");//Numero de capa del css z-index	
		param_default("opacidad",60);//Opacidad
		param_default("opacidadBorde",60);//Opacidad del borde
		param_default("colorBorde","#000");//Color del Borde			
		param_default("ancho",500);//Ancho							
		param_default("alto",400);//alto
		param_default("unidadMedida","px");//Unidad de medida 
		param_default("tipoPosicion","fixed");//Tipo de posicion del css
		param_default("radioEsquinas","7");//radio de las esquinas, redondear
		param_default("target","this");//uso del target,
		param_default("fondoPaginaColor","#FFF");//Color del fondo del contenedor de la pagina
		param_default("txtBody","");//Texto para el contenido, esto solo funciona si no se usa de ajax para llamar a otra pagina
		param_default("posicionTop","50%");//Posicion por defecto de la ventana central
		
		//Ajax Para cargar el contenido	
		param_default("ajax",true);//Uso de ajax	
		param_default("ajax_parametro",{});//Parametros para el uso de AJAX
		//Parametros del AJAX
		param_default_ajax("ajaxJQUERY",true);//Si se usara el AJAX DE JQUERY
		param_default_ajax("type","post");
		param_default_ajax("url",null);
		param_default_ajax("dataType","html");
		param_default_ajax("data",null);
		param_default_ajax("success",null);
		param_default_ajax("retornarData",false);		
		/**********************************
		Validaciones
		***********************************/
		if((params.ajax) && params.ajax_parametro.url==""){
			alert("Falta indicar la dirección de la pagina de destino!");
			return false;
		}
		if(params.resetear==true) ;
 		
		if(params.target=="this") var target="";		  
	    else var target=params.target+".";
		
		/**********************************
		Creamos los div FLOTANTES
		***********************************/
		var idContenedorGeneral='ContenedorGeneralPopupALCON_'+params.id;
		var idBordePopup='BordePopupALCON_'+params.id;
		var idConteneorContenidoPopup='ContenedorContenidoPopupALCON_'+params.id;
		var ContenedorBotonCerrarPopup='ContenedorBotonCerrarPopupALCON_'+params.id;
		var BotonCerrarGPopup='BotonCerrarGPopupALCON_'+params.id;
		var BotonCerrarPopup='BotonCerrarPopupALCON_'+params.id;
		
		var bodyCont=eval(""+target+"document.getElementsByTagName('body').item(0)");//div general
		
		var NomDivPopupALCON={};
		    NomDivPopupALCON["ContenedorGeneralPopupALCON"]=idContenedorGeneral;
			NomDivPopupALCON["BordePopupALCON"]=idBordePopup;
			NomDivPopupALCON["ContenedorContenidoPopupALCON"]=idConteneorContenidoPopup;
			NomDivPopupALCON["ContenedorBotonCerrarPopupALCON"]=ContenedorBotonCerrarPopup;
			NomDivPopupALCON["BotonCerrarGPopupALCON"]=BotonCerrarGPopup;
			NomDivPopupALCON["BotonCerrarPopupALCON"]=BotonCerrarPopup;
			NomDivPopupALCON["ContenedorGlobal"]="body";
			NomDivPopupALCON["target"]=target;

		//Div Fondo General
		if(!eval(""+target+"document.getElementById('"+idContenedorGeneral+"')") && params.fondo==true){
				var divFon = eval(''+target+'document.createElement("div")');
				divFon.id=idContenedorGeneral;
				divFon.style.backgroundColor=params.colorFondo;
				divFon.style.position=params.tipoPosicion;			
				divFon.style.height='100%';
				divFon.style.width='100%';
				divFon.style.top='0px';
				divFon.style.left='0px';
				if(params.efectoJquery==true) divFon.style.display='none';
				divFon.style.filter='alpha(opacity='+params.opacidad+')';
				divFon.style.MozOpacity='.'+params.opacidad;
				divFon.style.opacity='.'+params.opacidad;		
				divFon.style.zIndex=params.nCapa;
				if(params.CerrarFondo==true)
				{	
					if (divFon.addEventListener){
						divFon.addEventListener('click',function(event){
							   if(params.efectoJquery==true)
							     CerrarPopupEfectoALCON(NomDivPopupALCON);
								else  
							     CerrarPopupALCON(NomDivPopupALCON);
						}, false);
					 } else if (divFon.attachEvent){
						divFon.attachEvent('onclick', function(event){
							   if(params.efectoJquery==true)
							     CerrarPopupEfectoALCON(NomDivPopupALCON);
								else  
							     CerrarPopupALCON(NomDivPopupALCON);
						});
					 }
				}
				bodyCont.appendChild(divFon);
				/**/
			}else{
				if(eval(""+target+"document.getElementById('"+idContenedorGeneral+"')")){
					eval(""+target+"document.getElementById('"+idContenedorGeneral+"').style.display='block'");
				 }
			}
			
			//Div Borde
			if(!eval(""+target+"document.getElementById('"+idBordePopup+"')") && params.bordeTransparente==true){
				var divBorde=eval(''+target+'document.createElement("div")');
				divBorde.id=idBordePopup;
				divBorde.style.backgroundColor=params.colorBorde;				
				divBorde.style.position=params.tipoPosicion;		
				divBorde.style.height=params.alto+String(params.unidadMedida);
				divBorde.style.width=params.ancho+String(params.unidadMedida);
				divBorde.style.top=params.posicionTop;
				divBorde.style.left='50%';
				if(params.efectoJquery==true) divBorde.style.display='none';
				divBorde.style.marginLeft='-'+ (params.ancho/2) +String(params.unidadMedida);
				divBorde.style.marginTop='-'+ (params.alto/2) +String(params.unidadMedida);		
				divBorde.style.filter='alpha(opacity='+params.opacidadBorde+')';
				divBorde.style.MozOpacity='.'+params.opacidadBorde;
				divBorde.style.opacity='.'+params.opacidadBorde;
				
				divBorde.style.MozBorderRadius=params.radioEsquinas+String(params.unidadMedida);
				divBorde.style.KhtmlBorderRadius=params.radioEsquinas+String(params.unidadMedida);
				divBorde.style.WebkitBorderRadius=params.radioEsquinas+String(params.unidadMedida);
				divBorde.style.borderRadius=params.radioEsquinas+String(params.unidadMedida);
				divBorde.style.zIndex=params.nCapa + 1;		
				bodyCont.appendChild(divBorde);
				
			}else{	 
				 if(eval(""+target+"document.getElementById('"+idBordePopup+"')")){
					 eval(""+target+"document.getElementById('"+idBordePopup+"').style.display='block'");
				 }
			}	
			
			
			//Div Contenedor del resultado
			if(!eval(""+target+"document.getElementById('"+idConteneorContenidoPopup+"')"))
			{		
				  var divPagC=eval(""+target+"document.createElement('div')");
					  divPagC.id=idConteneorContenidoPopup;				 
					  divPagC.style.position=params.tipoPosicion;
					  divPagC.style.backgroundColor=params.fondoPaginaColor;
					  divPagC.style.zIndex=Number(params.nCapa + 2);			  
					  divPagC.style.height=(Number(params.alto) - 20) + String(params.unidadMedida);
					  divPagC.style.width=(Number(params.ancho) - 20) + String(params.unidadMedida);
					  divPagC.style.top=params.posicionTop;
					  divPagC.style.left='50%';					 
					  if(params.efectoJquery==true) divPagC.style.display='none';					  
					  divPagC.style.overflow='auto';
						divPagC.style.marginLeft='-'+ Number((params.ancho/2) - 10)+String(params.unidadMedida);
						divPagC.style.marginTop='-'+ Number((params.alto/2) - 10) +String(params.unidadMedida);		  
					  bodyCont.appendChild(divPagC);

					
					//Boton Cerrar
			   		if(params.botonCerrar==true)
					{
				  //Div contenedor total para el boton cerrar 
					var divTopPagC=eval(""+target+"document.createElement('div')");
					  divTopPagC.id=ContenedorBotonCerrarPopup;								
					  divTopPagC.style.position=params.tipoPosicion;			  
					  divTopPagC.style.zIndex=Number(params.nCapa + 2);						    
					  divTopPagC.style.height="1px";
					  divTopPagC.style.width=(Number(params.ancho) - 20) + String(params.unidadMedida);
					  divTopPagC.style.top=params.posicionTop;					  
					  divTopPagC.style.left='50%';
					  if(params.efectoJquery==true) divTopPagC.style.display='none';					  
					  divTopPagC.style.marginLeft='-'+ Number((params.ancho/2) - 10)+String(params.unidadMedida);
					  divTopPagC.style.marginTop='-'+ Number((params.alto/2) - 10) +String(params.unidadMedida);			
									  
					  				  
					  bodyCont.appendChild(divTopPagC);		
					  
				   //Div segundo contenedor total para el boton cerrar 	  			
					   var divContCerrar=eval(''+target+'document.createElement("div")');
						  divContCerrar.id=BotonCerrarGPopup;
						  divContCerrar.style.position='relative';
						  divContCerrar.style.height="1px";
						  divContCerrar.style.right='0px';
					      divContCerrar.style.top='0px';						  
						  divTopPagC.appendChild(divContCerrar);
						  
				  //Div boton cerrar
					  var divCerrar=eval(''+target+'document.createElement("div")');
					  divCerrar.id=BotonCerrarPopup; 
					  divCerrar.style.fontFamily='Verdana, Geneva, sans-serif';		 
					  divCerrar.style.fontWeight='bold';
					  divCerrar.style.cursor='pointer';
					  divCerrar.style.height='18px';
					  divCerrar.style.width='14px';		  
					  divCerrar.style.backgroundColor=params.colorBorde;
						divCerrar.style.filter='alpha(opacity='+params.opacidadBorde+')';
						divCerrar.style.MozOpacity='.'+params.opacidadBorde;
						divCerrar.style.opacity='.'+params.opacidadBorde;
						
						divCerrar.style.MozBorderRadiusBottomLeft=params.radioEsquinas+String(params.unidadMedida);
						divCerrar.style.KhtmlBorderRadiusBottomLeft=params.radioEsquinas+String(params.unidadMedida);
						divCerrar.style.WebkitBorderRadiusBottomLeft=params.radioEsquinas+String(params.unidadMedida);
						divCerrar.style.borderBottomLeftRadius=params.radioEsquinas+String(params.unidadMedida);
						
					  
					  divCerrar.style.right='0px';
					  divCerrar.style.top='0px';
					  divCerrar.style.position='absolute';
					  divCerrar.style.color='#fff';
					  divCerrar.align="right";
					  divCerrar.style.zIndex=params.nCapa + 200;
					  divCerrar.style.fontSize='12px';		  
					  divCerrar.title='Cerrar';
					  divCerrar.innerHTML='X';  
						if (divCerrar.addEventListener){
							divCerrar.addEventListener('click',function(event){ 
							   if(params.efectoJquery==true)
							     CerrarPopupEfectoALCON(NomDivPopupALCON);
								else  
							     CerrarPopupALCON(NomDivPopupALCON);
							}, false);
						} else if (divCerrar.attachEvent){
							divCerrar.attachEvent('onclick', function(event){
							   if(params.efectoJquery==true)
							     CerrarPopupEfectoALCON(NomDivPopupALCON);
								else  
							     CerrarPopupALCON(NomDivPopupALCON);
							});
						}		  
					 divContCerrar.appendChild(divCerrar);//se agrega dentro del div BORDE
				 }
				 /****** FIN BOTON CERRAR *******************/
				 
				 ContPopUpAlcon=0;//Evento Iniciado
				 //Abrimos con efecto
				if(params.efectoJquery==true) AbrirPopupEfectoALCON(NomDivPopupALCON);
		}else{
			eval(""+target+"document.getElementById('"+ContenedorBotonCerrarPopup+"').style.display='block'");
		}			
			
			//Cargamos el contenido
			CargarContenidoPopupALCON(params.ajax,params.txtBody,params.ajax_parametro,NomDivPopupALCON);
			
			
			
			/**************************************
			 FUNCIONES
			****************************************/		
			function CerrarPopupALCON(NomDivPopupALCON){
					var bodyCont=eval(""+NomDivPopupALCON.target+"document.getElementsByTagName('"+NomDivPopupALCON.ContenedorGlobal+"').item(0)");					
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON+"')")) bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON+"')"));
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')")) bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')"));						
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.BordePopupALCON+"')")) bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.BordePopupALCON+"')"));
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorGeneralPopupALCON+"')")) bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorGeneralPopupALCON+"')"));
						return false;
			}
			//Cerrar con efecto JQUERY
			function CerrarPopupEfectoALCON(NomDivPopupALCON)
			{
				ContPopUpAlcon++;
					var bodyCont=eval(""+NomDivPopupALCON.target+"document.getElementsByTagName('"+NomDivPopupALCON.ContenedorGlobal+"').item(0)");					
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON+"')"))
						{
						  if(ContPopUpAlcon==1){	
						     $("#"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON,eval(""+NomDivPopupALCON.target+"window.document")).fadeOut(800,function(){
							   bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON+"')"));
							   ContPopUpAlcon=1;
							 });
						  }
						}
						//
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')"))
						{
						  if(ContPopUpAlcon==1){							  	
							$("#"+NomDivPopupALCON.ContenedorContenidoPopupALCON,eval(""+NomDivPopupALCON.target+"window.document")).fadeOut(800,function(){
							   bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')"));
							   ContPopUpAlcon=1;
							});						
						  }
						}
						//						
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.BordePopupALCON+"')"))
						{
						  if(ContPopUpAlcon==1){							  	
							$("#"+NomDivPopupALCON.BordePopupALCON,eval(""+NomDivPopupALCON.target+"window.document")).fadeOut(800,function(){
								bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.BordePopupALCON+"')"));
								ContPopUpAlcon=1;
							});
						  }
						}
						//						
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorGeneralPopupALCON+"')"))
						{
						  if(ContPopUpAlcon==1){								
							$("#"+NomDivPopupALCON.ContenedorGeneralPopupALCON,eval(""+NomDivPopupALCON.target+"window.document")).fadeOut(800,function(){
								bodyCont.removeChild(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorGeneralPopupALCON+"')"));
								ContPopUpAlcon=1;
							});
						  }
						}
			}
			//
			//Abrir con efecto JQUERY
			function AbrirPopupEfectoALCON(NomDivPopupALCON)
			{
					var bodyCont=eval(""+NomDivPopupALCON.target+"document.getElementsByTagName('"+NomDivPopupALCON.ContenedorGlobal+"').item(0)");
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorGeneralPopupALCON+"')"))
						{
							$("#"+NomDivPopupALCON.ContenedorGeneralPopupALCON,eval(""+NomDivPopupALCON.target+"window.document")).fadeIn(800);							
						}
						//	
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.BordePopupALCON+"')"))
						{
							$("#"+NomDivPopupALCON.BordePopupALCON, eval(""+NomDivPopupALCON.target+"window.document")).fadeIn(800);
						}
						//
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')"))
						{
							$("#"+NomDivPopupALCON.ContenedorContenidoPopupALCON, eval(""+NomDivPopupALCON.target+"window.document")).fadeIn(800);							
						}
						//						
						if(eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON+"')"))
						{
						   $("#"+NomDivPopupALCON.ContenedorBotonCerrarPopupALCON, eval(""+NomDivPopupALCON.target+"window.document")).fadeIn(800);
						}
						//
			}	
			
			//Cargar del contenid a traves de AJAX
			function CargarContenidoPopupALCON(UsoAjax,txtContenidoSinAjax,parametrosAjax,NomDivPopupALCON){
					if(UsoAjax==true)
					{
						  if(parametrosAjax.ajaxJQUERY==true)
						  {//Usamos el AJAX de JQUERY
						     eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')").innerHTML='<div style="font-family:Arial, Helvetica, sans-serif; color:#666; font-size:14px; padding:8px;">Loading...</div>';
							 
								$.ajax({
									beforeSend:function(){					  

									},
									type:parametrosAjax.type,
									url:parametrosAjax.url,				 
									dataType:parametrosAjax.dataType,
									data:parametrosAjax.data,
									success:function(data){	
									   if(parametrosAjax.success==null)
									   {
										   eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')").innerHTML=String(data);
									   }else{
										     if(parametrosAjax.retornarData==true){
										       parametrosAjax.success(data);
											 }else{
												eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')").innerHTML=String(data);												 
											    parametrosAjax.success();
											 }
										}
									},
									error:function(eror){
										eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"')").innerHTML='<div style="font-family:Arial, Helvetica, sans-serif; color:#666; font-size:14px; padding:8px;">Lo sentimos, ocurrio un error,vuelva a intentarlo otra vez.</div>';
									}
								});	  
						 }else
						 {//Usamos el AJAX tradicional
								//var divContenido=eval(""+target+"document.getElementById('divContePagT')");
//								var ajax=objetoAjax();
//								divContenido.innerHTML='Loading...';
//								ajax.open("POST", urlPag,true);
//								ajax.onreadystatechange=function(){
//										if (ajax.readyState==4){
//											if(ajax.status==200){
//												divContenido.innerHTML=ajax.responseText;
//												if(fn){
//													fn();						
//												}
//											}else if(ajax.status==404){
//												   divContenido.innerHTML = "<div style='font-family:Arial; margin-top:5px; color:#666;' align='center'>LA DIRECCION URL, NO EXISTE</div>";
//											}else{
//												   divContenido.innerHTML= "<div style='font-family:Arial; margin-top:5px; color:#666;' align='center'>Ups! ocurrio un error, intentelo nuevamente</div>";//ajax.status
//											}
//										}else{
//											divContenido.innerHTML="<div style='font-family:Arial; margin-top:5px; color:#666;' align='center'>"+precarga+"</div>";
//									
//										}
//								}	
//								ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//								ajax.send(urlVariables+"fh="+fh);							
					   }
					}else{
						eval(""+NomDivPopupALCON.target+"document.getElementById('"+NomDivPopupALCON.ContenedorContenidoPopupALCON+"').innerHTML='"+txtContenidoSinAjax+"'");
					}				
			}
}

//
function CerrarPopupALCON(txtIdCont)
{
	var resulTxt="BotonCerrarPopupALCON_popup_alcon_1";
	if(txtIdCont && txtIdCont!="")
	     resulTxt=txtIdCont;
		 
   	$('#'+resulTxt,window.parent.document).trigger('click'); 
}