/**********************************************************************
Nombre         : AlertALCON
Versión        : 1.0
Autor          : Luis ALCON 
Fecha Creacion : 10-07-2012 Lima - Perú
Fecha Modific. : 10-07-2012 , Lima - Perú
Descripcion    : Simula un alerta
**********************************************************************/
var ContAlertAlcon=0;
AlertALCON=function(params)
{
	    function param_default(pname, def){ if(params){ if (typeof params[pname] == "undefined") {params[pname] = def;}}};
	    function param_default_botonesPrincipal(pname, def){ if(params){ if (typeof params["botonPrincipal"][pname] == "undefined") {params["botonPrincipal"][pname] = def;}}};
	    function param_default_botonesSecundaria(pname, def){ if(params){ if (typeof params["botonSecundario"][pname] == "undefined") {params["botonSecundario"][pname] = def;}}};		
		//function param_default_ajax(pname, def){ if(params){ if (typeof params["ajax_parametro"][pname] == "undefined") {params["ajax_parametro"][pname] = def;}}};
	
		//Parametro por defecto
		param_default("fondo",true);//Si estara activo el fondo general
		param_default("colorFondo","#FFF");//Color del fondo general
		param_default("id","alert_alcon_1");//id para identificacion		
		param_default("botonCerrar",false);//Si estara activo el boton cerrar en la parte superior
		param_default("precarga","Cargando...");//Contenido de la precarga
		param_default("resetear",false);//Para reiciar el contenido del POPUP
		param_default("efectoJquery",false);//Efecto de JQUERY	
		param_default("nCapa","150");//Numero de capa del css z-index
		param_default("opacidad",60);//Opacidad
		param_default("ancho",400);//Ancho
		param_default("alto",90);//Alto
		param_default("unidadMedida","px");//Unidad de medida 
		param_default("tipoPosicion","fixed");//Tipo de posicion del css
		param_default("radioEsquinas","8");//radio de las esquinas, redondear
		param_default("target","this");//uso del target,
		param_default("fondoAlertColor","#474747");//Color del fondo del alert
		param_default("bordeAlertColor","#a3a3a3");//Color del borde ALERT
		param_default("tipo","alerta");//Tipo de Alert, error,alerta,bien,pregunta
				
		param_default("tituloBody",null);//Texto para el contenido, esto solo funciona si no se usa de ajax para llamar a otra pagina
		param_default("textBody","Escriba el descripción del Proceso");//Texto para el contenido, esto solo funciona si no se usa de ajax para llamar a otra pagina
		param_default("posicionTop","30%");//Posicion por defecto de la ventana central
		
		//Botones		
		param_default("botonPrincipal",{});//BP
		param_default("botonSecundario",{});//BS 
		
		//Propiedades de los Botones
		param_default_botonesPrincipal("visible",false);
		param_default_botonesPrincipal("text","Aceptar");
		param_default_botonesPrincipal("eventoClick",null);
		param_default_botonesPrincipal("cerrarDefault",true);//Se cierra la ventana por defecto, despues de ejecutar el evento

		param_default_botonesSecundaria("visible",false);
		param_default_botonesSecundaria("text","Cancelar");
		param_default_botonesSecundaria("eventoClick",null);
		param_default_botonesSecundaria("cerrarDefault",true);//Se cierra la ventana por defecto, despues de ejecutar el evento
		
		//Ajax Para cargar el contenido	
		//param_default("ajax",true);//Uso de ajax	
		//param_default("ajax_parametro",{});//Parametros para el uso de AJAX
		//Parametros del AJAX
		//param_default_ajax("ajaxJQUERY",true);//Si se usara el AJAX DE JQUERY
		//param_default_ajax("type","post");
		//param_default_ajax("url",null);
		//param_default_ajax("dataType","html");
		//param_default_ajax("data",null);
		//param_default_ajax("success",null);
		/**********************************
		Validaciones
		***********************************/
		if((params.ajax==true) && params.ajax_parametro.url==""){
			alert("Falta indicar la dirección de la pagina de destino!");
			return false;
		}
 		
		if(params.target=="this") var target="";		  
	    else var target=params.target+".";
		
		
		if(params.tituloBody==null){
			var UrlGenAlert=document.location.href;
			UrlGenAlert=UrlGenAlert.split("?");
			if(UrlGenAlert[0].length<45)
			{
			   params.tituloBody=UrlGenAlert[0];
			}else{
			  params.tituloBody=UrlGenAlert[0].substr(0,45)+"...";	
			}
		}
		
		
		
		/**********************************
		Creamos los div FLOTANTES
		***********************************/
		var idContenedorGeneral='ContenedorGeneralAlertALCON_'+params.id;
		var idContenedorAlertGeneral='ContenedorAlertGeneralAlertALCON_'+params.id;	
		var idContenedorAlertTitle='ContenedorAlertTitleALCON_'+params.id;	
					
		var bodyCont=eval(""+target+"document.getElementsByTagName('body').item(0)");//div general
		
		var NomDivAlertALCON={};
		    NomDivAlertALCON["ContenedorGeneralAlertALCON"]=idContenedorGeneral;
			NomDivAlertALCON["ContenedorAlertGenALCON"]=idContenedorAlertGeneral;
			NomDivAlertALCON["ContenedorGlobal"]="body";
			NomDivAlertALCON["target"]=target;		
		
		
		
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
				bodyCont.appendChild(divFon);
				/**/
			}else{
				if(eval(""+target+"document.getElementById('"+idContenedorGeneral+"')")){
					eval(""+target+"document.getElementById('"+idContenedorGeneral+"').style.display='block'");
				 }
			}
			
			ContAlertAlcon=0;
			
			//Div Alert
			if(!eval(""+target+"document.getElementById('"+idContenedorAlertGeneral+"')"))
			{		
				  var divAlertGeneral=eval(""+target+"document.createElement('div')");
					  divAlertGeneral.id=idContenedorAlertGeneral;				 
					  divAlertGeneral.style.position=params.tipoPosicion;
					  divAlertGeneral.style.backgroundColor=params.fondoAlertColor;
					  divAlertGeneral.style.padding="8px";
					  divAlertGeneral.style.zIndex=Number(params.nCapa + 2);			  
					  divAlertGeneral.style.minHeight=(Number(params.alto) - 20) + String(params.unidadMedida);
					  divAlertGeneral.style.width=(Number(params.ancho) - 20) + String(params.unidadMedida);
					  divAlertGeneral.style.top=params.posicionTop;
					  divAlertGeneral.style.border=params.bordeAlertColor+" solid 3px";					  
					  divAlertGeneral.style.left='50%';					 
					  if(params.efectoJquery==true) divAlertGeneral.style.display='none';
					  divAlertGeneral.style.marginLeft='-'+ Number((params.ancho/2) - 10)+String(params.unidadMedida);
					  divAlertGeneral.style.marginTop='-'+ Number((params.alto/2) - 10) +String(params.unidadMedida);
					  divAlertGeneral.style.MozBorderRadius=params.radioEsquinas+String(params.unidadMedida);
					  divAlertGeneral.style.KhtmlBorderRadius=params.radioEsquinas+String(params.unidadMedida);
					  divAlertGeneral.style.WebkitBorderRadius=params.radioEsquinas+String(params.unidadMedida);
					  divAlertGeneral.style.borderRadius=params.radioEsquinas+String(params.unidadMedida);
					  	  
					  bodyCont.appendChild(divAlertGeneral);
					
				
				  //Div contenedor TITLE
					var divTopPagC=eval(""+target+"document.createElement('div')");
					  divTopPagC.id=idContenedorAlertTitle;
					  divTopPagC.style.height="20px";
  					  divTopPagC.style.overflow="hidden";		
					  divTopPagC.style.borderBottom=params.bordeAlertColor+" solid 1px";
					  divTopPagC.innerHTML='<table width="'+(params.ancho - 22)+'" border="0" cellpadding="0" cellspacing="0"><tr><td id="td_title_text_aler_alcon"></td><td id="td_title_ico_aler_alcon" align="right"></td></tr></table>';
					  divAlertGeneral.appendChild(divTopPagC);		
					
					//Txt Title 
					var divTopTxtTitlePagC=eval(""+target+"document.createElement('div')");
					  divTopTxtTitlePagC.id="idAlertTxtTilteTopl";
					  divTopTxtTitlePagC.style.color='#fff';
					  divTopTxtTitlePagC.style.fontFamily='Arial';		 
				      divTopTxtTitlePagC.style.fontWeight='bold';					   
					  divTopTxtTitlePagC.style.fontSize='14px';
					  divTopTxtTitlePagC.style.float="left";
					  divTopTxtTitlePagC.innerHTML=params.tituloBody;
					  document.getElementById("td_title_text_aler_alcon").appendChild(divTopTxtTitlePagC);	
					  
					//Boton Cerrar
					if(params.botonCerrar==true)
					{
						var divTopCerrarPagC=eval(""+target+"document.createElement('div')");
						  divTopCerrarPagC.id="idAlertCerrarTopl";
						  divTopCerrarPagC.style.color='#fff';
						  divTopCerrarPagC.style.fontFamily='Verdana, Geneva, sans-serif';		 
						  divTopCerrarPagC.style.fontWeight='bold';					   
						  divTopCerrarPagC.style.fontSize='14px';
						  divTopCerrarPagC.style.float="right";
						  divTopCerrarPagC.style.cursor="pointer";
						  divTopCerrarPagC.innerHTML='x';
						  if (divTopCerrarPagC.addEventListener){
							divTopCerrarPagC.addEventListener('click',function(event){CerrarAlertALCON(NomDivAlertALCON)}, false);
						  } else if (divTopCerrarPagC.attachEvent){
							divTopCerrarPagC.attachEvent('onclick', function(event){CerrarAlertALCON(NomDivAlertALCON)});
						  }
						  document.getElementById("td_title_ico_aler_alcon").appendChild(divTopCerrarPagC);		
					}
	  
					  
					  
					  
				   //Div Contenido Tex Body	  			
					   var divContBodyAlert=eval(''+target+'document.createElement("div")');
						  divContBodyAlert.id="divIdConteGeneralAlertALCON";
						  divContBodyAlert.style.clear="both";
						  divContBodyAlert.style.minHeight="50px";
						  divContBodyAlert.style.padding="10px";
						  divContBodyAlert.innerHTML='<table border="0" cellpadding="0" cellspacing="0"><tr><td id="td_icono_aler_alcon" valign="top"></td><td id="td_body_aler_alcon" valign="top"></td></tr></table>';
						  divAlertGeneral.appendChild(divContBodyAlert);				
					
				   //Div Contenido Icono
					   var divContBodyIconoAlert=eval(''+target+'document.createElement("div")');
						  divContBodyIconoAlert.id="divIconoAlertALCON";
						  divContBodyIconoAlert.style.height="66px";//Tamaño icono
						  divContBodyIconoAlert.style.width="62px";//Tamaño icono
						  divContBodyIconoAlert.style.backgroundImage=getIcono(params.tipo);
						  divContBodyIconoAlert.style.backgroundRepeat="no-repeat";
						  divContBodyIconoAlert.style.float="left";
						  divContBodyIconoAlert.style.marginRight="7px";
						  document.getElementById("td_icono_aler_alcon").appendChild(divContBodyIconoAlert);
				   	
				   //Div Contenido Texto
					   var divContBodyTextContAlert=eval(''+target+'document.createElement("div")');
						  divContBodyTextContAlert.id="divTextConteAlertALCON";
						  divContBodyTextContAlert.style.color='#fff';
					  	  divContBodyTextContAlert.style.fontFamily='Arial';
						  divContBodyTextContAlert.style.paddingTop="10px";
					      divContBodyTextContAlert.style.fontSize='14px';						  
						  divContBodyTextContAlert.style.float="left";
						  divContBodyTextContAlert.style.width=String(Number(params.ancho) - 110)+String(params.unidadMedida);
						  divContBodyTextContAlert.innerHTML=params.textBody;						  
						  document.getElementById("td_body_aler_alcon").appendChild(divContBodyTextContAlert);	



					
					
					//Div Contenido Botones  			
					   var divContBootonesAlert=eval(''+target+'document.createElement("div")');
						  divContBootonesAlert.id="idConteBotonesAlertALCON";
						  divContBootonesAlert.style.paddingTop="5px";
						  divContBootonesAlert.style.clear="both";
						  divContBootonesAlert.innerHTML='<table align="right" border="0" cellpadding="0" cellspacing="0"><tr><td id="td_cmd_aceptar"></td><td id="td_cmd_cancelar"></td></tr></table>';
						  divAlertGeneral.appendChild(divContBootonesAlert);				


					//Div BotonAceptar  
					 if(params.botonPrincipal.visible==true)
					 {			
					   var divContBootoneCancelarAlert=eval(''+target+'document.createElement("div")');
						  divContBootoneCancelarAlert.id="idConteBotonesAlertCancelarALCON";
						  divContBootoneCancelarAlert.style.paddingTop="5px";divContBootoneCancelarAlert.style.paddingBottom="5px";
						  divContBootoneCancelarAlert.style.paddingRight="15px";divContBootoneCancelarAlert.style.paddingLeft="15px";						  
						  divContBootoneCancelarAlert.style.cursor="pointer";
						  divContBootoneCancelarAlert.style.MozBorderRadius="4px";
						  divContBootoneCancelarAlert.style.KhtmlBorderRadius="4px";
						  divContBootoneCancelarAlert.style.WebkitBorderRadius="4px";
						  divContBootoneCancelarAlert.style.borderRadius="4px";						 
						  divContBootoneCancelarAlert.style.backgroundColor="#ffffff";	
						  divContBootoneCancelarAlert.style.border="#010101 solid 1px";
						  divContBootoneCancelarAlert.innerHTML=params.botonPrincipal.text;	
						  divContBootoneCancelarAlert.style.color='#010101';
						  divContBootoneCancelarAlert.style.fontFamily='Arial';		 				
						  divContBootoneCancelarAlert.style.fontSize='14px';						  
						  divContBootoneCancelarAlert.style.float="right";  

						     if (divContBootoneCancelarAlert.addEventListener){
								divContBootoneCancelarAlert.addEventListener('click',function(event){
									if(params.botonPrincipal.eventoClick==null)
										CerrarAlertALCON(NomDivAlertALCON);
									else{
										params.botonPrincipal.eventoClick();
										if(params.botonPrincipal.cerrarDefault==true)										
										  CerrarAlertALCON(NomDivAlertALCON);										
									}
									  
								 }, false);
							  } else if (divContBootoneCancelarAlert.attachEvent){
								divContBootoneCancelarAlert.attachEvent('onclick', function(event){
									if(params.botonPrincipal.eventoClick==null)
										CerrarAlertALCON(NomDivAlertALCON);
									else{
									  params.botonPrincipal.eventoClick();
										if(params.botonPrincipal.cerrarDefault==true)										
										  CerrarAlertALCON(NomDivAlertALCON);										
									  
									}
									
								});
							  }
							  
						   document.getElementById("td_cmd_aceptar").appendChild(divContBootoneCancelarAlert);
					 }
						  
					//Div BotonCancelar 
					if(params.botonSecundario.visible==true)
					 { 			
					   var divContBootoneAceptarAlert=eval(''+target+'document.createElement("div")');
						  divContBootoneAceptarAlert.id="idConteBotonesAlertAceptarALCON";
						  divContBootoneAceptarAlert.style.backgroundColor="#0e0e0e";
						  divContBootoneAceptarAlert.style.border="#656565 solid 1px";
						  divContBootoneAceptarAlert.style.paddingTop="5px";divContBootoneAceptarAlert.style.paddingBottom="5px";
						  divContBootoneAceptarAlert.style.paddingRight="15px";divContBootoneAceptarAlert.style.paddingLeft="15px";						  
						  divContBootoneAceptarAlert.style.cursor="pointer";
						  divContBootoneAceptarAlert.style.MozBorderRadius="4px";
						  divContBootoneAceptarAlert.style.KhtmlBorderRadius="4px";
						  divContBootoneAceptarAlert.style.WebkitBorderRadius="4px";
						  divContBootoneAceptarAlert.style.borderRadius="4px";
						  divContBootoneAceptarAlert.style.marginLeft="4px";
						  divContBootoneAceptarAlert.style.float="left";	
						  divContBootoneAceptarAlert.innerHTML=params.botonSecundario.text;
						  divContBootoneAceptarAlert.style.color='#fff';
						  divContBootoneAceptarAlert.style.fontFamily='Arial';		 				
						  divContBootoneAceptarAlert.style.fontSize='14px';		
						  
						     if (divContBootoneAceptarAlert.addEventListener){
								divContBootoneAceptarAlert.addEventListener('click',function(event){
									if(params.botonSecundario.eventoClick==null)
										CerrarAlertALCON(NomDivAlertALCON);
									else{
										params.botonSecundario.eventoClick();
										if(params.botonSecundario.cerrarDefault==true)										
										  CerrarAlertALCON(NomDivAlertALCON);
									}
									  
								 }, false);
							  } else if (divContBootoneAceptarAlert.attachEvent){
								divContBootoneAceptarAlert.attachEvent('onclick', function(event){
									if(params.botonSecundario.eventoClick==null)
										CerrarAlertALCON(NomDivAlertALCON);
									else{
									  params.botonSecundario.eventoClick();
										if(params.botonSecundario.cerrarDefault==true)										
										  	CerrarAlertALCON(NomDivAlertALCON);

									}
									
								});
							  }						  
						  				  	  
						  document.getElementById("td_cmd_cancelar").appendChild(divContBootoneAceptarAlert);
					 }
						  
		}else{
			eval(""+target+"document.getElementById('"+idContenedorAlertGeneral+"').style.display='block'");
		}	
		
		
		 
		 /**************************************
			 FUNCIONES
		 ****************************************/
		 
		 //Cerrar 
		 function CerrarAlertALCON(NomDivAlertALCON)
		 {
				ContAlertAlcon++;
					var bodyCont=eval(""+NomDivAlertALCON.target+"document.getElementsByTagName('"+NomDivAlertALCON.ContenedorGlobal+"').item(0)");					
						if(eval(""+NomDivAlertALCON.target+"document.getElementById('"+NomDivAlertALCON.ContenedorAlertGenALCON+"')"))
						{
							if(ContAlertAlcon==1){
							  bodyCont.removeChild(eval(""+NomDivAlertALCON.target+"document.getElementById('"+NomDivAlertALCON.ContenedorAlertGenALCON+"')"));
							  ContAlertAlcon=1;
							}
						}
						//
						if(eval(""+NomDivAlertALCON.target+"document.getElementById('"+NomDivAlertALCON.ContenedorGeneralAlertALCON+"')"))
						{
						  if(ContAlertAlcon==1){
							   bodyCont.removeChild(eval(""+NomDivAlertALCON.target+"document.getElementById('"+NomDivAlertALCON.ContenedorGeneralAlertALCON+"')"));
							   ContAlertAlcon=1;												
						  }
						}
								 
		 }
		 
		 
		 		 
		 //Tipo de Icono
		 function getIcono(tipo){
			 
			 var ImgAlert='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';
			 
			 
			 var imgError='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';
			 
			 var imgOk='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';
			 
			 var imgPregunta='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';
			 
			 var ImgReturn="";
			 if(tipo=='alerta')
			 {
				 ImgReturn='url(data:image/png;base64,'+ImgAlert+')';
			 }else if(tipo=='error'){
				 ImgReturn='url(data:image/png;base64,'+imgError+')';
			 }else if(tipo=='bien'){
				 ImgReturn='url(data:image/png;base64,'+imgOk+')';
			 }else if(tipo=='pregunta'){
				 ImgReturn='url(data:image/png;base64,'+imgPregunta+')';
			 }
			 return ImgReturn;
		 }		
		
}