/**********************************************************************
Nombre         : TinyTipsALCON
Versión        : 1.0
Autor          : Luis ALCON 
Fecha Creacion : 29-03-2012 Lima - Perú
Fecha Modific. : 18-04-2012 , Lima - Perú, se agrego la plantilla(P_ALCON1,P_ALCON2)
Descripcion    : Uso similar al Title, con la opcion de cargar el contenido dinamicamente, usando AJAX.
			  Usa algunas propiedades de JQUERY	
			  Usa un archivo CSS, donde estan las imagenes de las flechas
CSS de 
referecnia     : .dvl_Tips_G_b{ 
			   background-image:url(img/icoBottomG.gif); 
			   background-repeat:no-repeat; background-position:6px; margin-top:-1px;
			   height:9px;
			  }
                 .dvl_Tips_G_t{
                        background-image:url(img/tooltip/icoTopG.gif);
			background-repeat:no-repeat; background-position:6px; margin-bottom:-1px;
			position:relative; height:9px;
                }
                ...
Ejemplos    : Los diferentes ejemplos estan en la parte inferior del documento 
**********************************************************************/
var ShowHideTipsALCON=1;//
tipsALCON=function(){
  this.iniTipsAlcon=function(obj,params)
  {//obj: Objeto
	function param_default(pname, def){ if(params){ if (typeof params[pname] == "undefined") {params[pname] = def;}}};
	function param_default_ajax(pname, def){ if(params){ if (typeof params["ajax_parametro"][pname] == "undefined") {params["ajax_parametro"][pname] = def;}}};
	//Parametro por defecto
	param_default("und_medida","px");//Unidad de medida de los DIV y demas objetos
	param_default("ancho","300");//Ancho del TIPS-ALCON
	param_default("textBody","");//Texto del contenido
	param_default("textTitle","");//Texto del Titulo
	param_default("posiFlecha","auto");//Posicion de la flecha (indicador)
	param_default("efectoTips",null);//Efecto de JQUERY	
	param_default("ajax",false);//Uso de ajax	
	param_default("ajax_parametro",{});//Parametros para el uso de AJAX
	param_default("evento","onmouse");//Evento para la interaccion del usuario y el TIPS-ALCON
        param_default("plantilla","P_ALCON1");//Diseño del TipsALCON (P_ALCON1,P_ALCON2)
	//Parametros del AJAX
	param_default_ajax("type","post");
	param_default_ajax("url",null);
	param_default_ajax("dataType","html");
	param_default_ajax("data",null);
	param_default_ajax("success",null);
	
	var numActiveClick=1;
	//Interactuamos con los eventos, segun selección del usuario
        var TitleObj=obj.title;
    if(params.evento=="onmouse")
	{//Evento onmouse            
            if (obj.addEventListener){
                
                obj.addEventListener('mouseover',function(event){
                    obj.title="";
                    CreacionTipsAlcon(params);
                        if(params.posiFlecha=="auto")
                            PosicionAuto(obj,params);
			else
                            PosicionManual(obj,params);
							
                        UsoAjax(obj,params);
		}, false);						
		
                obj.addEventListener('mouseout',function(event){
			CerramosTipsAlcon();
                        obj.title=TitleObj;
		}, false);

            } else if (obj.attachEvent){
                    obj.attachEvent('onmouseover', function(event){
                        obj.title="";
                        CreacionTipsAlcon(params);
                        if(params.posiFlecha=="auto")
                            PosicionAuto(obj,params);
                        else
                            PosicionManual(obj,params);
			
			UsoAjax(obj,params);
		    });
                    obj.attachEvent('onmouseout',function(event){
                        obj.title=TitleObj;
                        CerramosTipsAlcon();
                    });						 
					}					
	   }else if(params.evento=="onclick")
	   {//Evento Click
		   numActiveClick=1;		 
					if (obj.addEventListener){					
						obj.addEventListener('click',function(event){	
							if(numActiveClick>1){
							   CerramosTipsAlcon();
							   numActiveClick=1;
							}else{
								numActiveClick++;
								CreacionTipsAlcon(params);
								if(params.posiFlecha=="auto")
								   PosicionAuto(obj,params);
								else
								PosicionManual(obj,params);
								
								UsoAjax(obj,params);
							}							
						}, false);
					} else if (obj.attachEvent){
						obj.attachEvent('onclick', function(event){
							if(numActiveClick>1){
							   CerramosTipsAlcon();
							   numActiveClick=1;
							}else{
								numActiveClick++;
								CreacionTipsAlcon(params);
								if(params.posiFlecha=="auto")
								   PosicionAuto(obj,params);
								else
								   PosicionManual(obj,params);
								
								UsoAjax(obj,params);
							}							
						 });												 
					}	
	   }else{		   
			if(ShowHideTipsALCON>1){
				CerramosTipsAlcon();
				ShowHideTipsALCON=1;
			}else{
				ShowHideTipsALCON++;
				CreacionTipsAlcon(params);
				if(params.posiFlecha=="auto")
					PosicionAuto(obj,params);
				else
					PosicionManual(obj,params);
			}
			UsoAjax(obj,params);				 		   
	   }  
	
	/**********************************************
	FUNCION PARA CARGAR EL CONTENIDO CON AJAX
	***********************************************/
          function UsoAjax(obj,params){
			if(params.ajax==true && document.getElementById("dvg_tips_alcon_g")){
				var DivTipsAlconBody=document.getElementById("dvl_tipsAlcon_body");
				var DivTipsAlconTitle=document.getElementById("dvl_tipsAlcon_title");		
				PosicionAuto(obj,params);//Posicion AUTO
					 $.ajax({
						  beforeSend:function(){					  
							DivTipsAlconTitle.innerHTML="Cargando...";
						  },
						  type:params.ajax_parametro.type,
						  url:params.ajax_parametro.url,				 
						  dataType:params.ajax_parametro.dataType,
						  data:params.ajax_parametro.data,
						  success:function(data){					  
							  params.ajax_parametro.success(DivTipsAlconTitle,DivTipsAlconBody,data);
							  if(params.textTitle!="")
								 DivTipsAlconTitle.innerHTML=params.textTitle;
								 
						  },   
						  error:function(err){
							 DivTipsAlconTitle.innerHTML="Ocurrio un error, intentelo nuevamente";
						 }
					  });	  
			}		
	}
	/**********************************************
	FUNCION PARA REMOVER EL TIPS - ALCON
	***********************************************/
        function CerramosTipsAlcon(){
		  var objContGen=document.getElementsByTagName('body').item(0); 
		  if(document.getElementById("dvg_tips_alcon_g")) objContGen.removeChild(document.getElementById("dvg_tips_alcon_g")); 
	   }
	/**********************************************
	FUNCION PARA CREAR EL TIPS - ALCON
	***********************************************/
       function CreacionTipsAlcon(params){
                var objContGen=document.getElementsByTagName('body').item(0);
                
                var cssFlechaTop;
                var cssFlechaBottom;
                if(params.plantilla=="P_ALCON2")
                {
                    cssFlechaTop="dvl_Tips_c_t";
                    cssFlechaBottom="dvl_Tips_c_b";
                }else{
                    cssFlechaTop="dvl_Tips_G_t";
                    cssFlechaBottom="dvl_Tips_G_b";
                }
                
		//Si existe lo removemos
		if(document.getElementById("dvg_tips_alcon_g")) objContGen.removeChild(document.getElementById("dvg_tips_alcon_g"));
                    //Creamos el Div del TIPS
                    var divCont=document.createElement("div");
                        divCont.id="dvg_tips_alcon_g";
                        divCont.style.width=String(params.ancho)+String(params.und_medida);
			divCont.style.display="none";//Ocultamos el TIPS
			divCont.style.height="auto";		
			divCont.style.position="fixed";
			divCont.style.zIndex=5;
			var htmlCont='';
                            if(params.posiFlecha=="tl" || params.posiFlecha=="tr")//Si la flecha estara en la parte superior
                                htmlCont+=' <div id="dvl_Tips_G_t" class="'+cssFlechaTop+'"></div>';	
                            else
				htmlCont+=' <div id="dvl_Tips_G_t" style="display:none" class="'+cssFlechaTop+'"></div>';	
					  
			    if(params.plantilla=="P_ALCON2")
                               htmlCont+='<div style="background-color:#2b2b2b;">';
                            else
                               htmlCont+='<div style="border:#8c8c8c solid 1px; background-color:#FFF;">';
                           
				if(params.plantilla=="P_ALCON2")
                                    htmlCont+='<div id="dvl_tipsAlcon_body" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF; padding:5px;">';
                                else
                                    htmlCont+='<div  id="dvl_tipsAlcon_body" style="font-family:Verdana, Geneva, sans-serif; color:#333; font-size:12px;padding:5px;">';
                                
                                    if(params.plantilla=="P_ALCON2" && params.ajax==true)                                    
                                       htmlCont+="<strong>Cargando...</strong>";
                                    else
                                       htmlCont+=params.textBody;                                                 
				htmlCont+='</div>';
                                
                                        if(params.plantilla=="P_ALCON1")
                                        {
                                            htmlCont+='<div style="border-top:#cccccc solid 1px; background-color:#f2f2f2; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#383838; padding:7px;" id="dvl_tipsAlcon_title">';
                                            if(params.ajax==true)
                                                    htmlCont+="<strong>Cargando...</strong>";
                                            else
                                                    htmlCont+=params.textTitle;

                                            htmlCont+='</div>';
                                        }
                                htmlCont+='</div>';
				
                                if(params.posiFlecha=="bl" || params.posiFlecha=="br")//Si la flecha estara en la parte inferior	
                                    htmlCont+='<div id="dvl_Tips_G_b" class="'+cssFlechaBottom+'"></div>';
				else
                                    htmlCont+='<div id="dvl_Tips_G_b" style="display:none" class="'+cssFlechaBottom+'"></div>';
						 
			divCont.innerHTML=htmlCont;
		//Añadimos al contenedor General
                objContGen.appendChild(divCont);		
	}
	/**********************************************
	FUNCION PARA LA POSICION AUTOMATICA DEL TIPS - ALCON
	***********************************************/
	function PosicionAuto(obj,params)
	{
		//Posicion del TIPS
		var objTipTips=document.getElementById("dvg_tips_alcon_g");
		var yObj=getDimensionesObjeto(obj).y;     //Posicion Y del objeto
		var xObj=getDimensionesObjeto(obj).x;     //Posicion X del objeto
		var anchoObj=$(obj).width();//getDimensionesObjeto(obj).w; //Ancho del objeto
		var altoObj=$(obj).height();//getDimensionesObjeto(obj).h;  //Alto del objeto
		
	//Si exite el efecto JQUERY para mostrar el TIPS		
	    (params.efectoTips!=null)?$("#dvg_tips_alcon_g").fadeIn(params.efectoTips):objTipTips.style.display="block";
		var anchoWindowGt=getDimensionesObjeto("window").w;//Ancho de la Ventana
		var altoWindowGt=getDimensionesObjeto("window").h;//Alto de la Ventana		
		var anchoTipsT=getDimensionesObjeto(objTipTips).w;//Ancho del Tips
		var altoTipsT=getDimensionesObjeto(objTipTips).h;//Alto del Tips
		var flechaBottom=document.getElementById("dvl_Tips_G_b");
		var flechaTop=document.getElementById("dvl_Tips_G_t");
		var flechaBooleanTop=false;
		//Posicion TOP (Y)
		if((altoWindowGt - yObj)>altoTipsT){			
			if(yObj>altoTipsT){
			   flechaBooleanTop=true;
			   flechaBottom.style.display="block";
			   objTipTips.style.top=(yObj - altoTipsT - 5)+String(params.und_medida);//y			   
			}else{
			   flechaTop.style.display="block";	
			   objTipTips.style.top=(yObj+20)+String(params.und_medida);//y		
			}
		}else{			
			flechaTop.style.display="block";
			objTipTips.style.top=(yObj+anchoObj+20)+String(params.und_medida);//y
			 
		}
		//Posicion Left (X)
		if((anchoWindowGt - xObj)>anchoTipsT){			
			objTipTips.style.left=xObj+String(params.und_medida);//x
			if(flechaBooleanTop){				
				var objFlechaPosi=document.getElementById("dvl_Tips_G_b");
				objFlechaPosi.style.backgroundPosition="5%";//posi flecha				
			}else{
				var objFlechaPosi=document.getElementById("dvl_Tips_G_t");
				objFlechaPosi.style.backgroundPosition="5%";//posi flecha
			}			
		}else{
			objTipTips.style.left=(xObj - anchoTipsT + anchoObj)+String(params.und_medida);//x			
			if(flechaBooleanTop){				
				var objFlechaPosi=document.getElementById("dvl_Tips_G_b");
				objFlechaPosi.style.backgroundPosition="95%";//posi flecha				
			}else{
				var objFlechaPosi=document.getElementById("dvl_Tips_G_t");
				objFlechaPosi.style.backgroundPosition="95%";//posi flecha
			}			
		}			
	}
	/******************************************
	FUNCION PARA LA POSICION MANUAL DEL TIPS - ALCON 
	******************************************/
	function PosicionManual(obj,params)
	{
		//Posicion del TIPS
		var objTipTips=document.getElementById("dvg_tips_alcon_g");
		var yObj=getDimensionesObjeto(obj).y;     //Posicion Y del objeto
		var xObj=getDimensionesObjeto(obj).x;     //Posicion X del objeto
		var anchoObj=$(obj).width();//getDimensionesObjeto(obj).w; //Ancho del objeto
		var altoObj=$(obj).height();//getDimensionesObjeto(obj).h;  //Alto del objeto

		 //Si exitte el efecto JQUERY para mostrar el TIPS
		 if(!objTipTips) return false;
	     (params.efectoTips!=null)?$("#dvg_tips_alcon_g").fadeIn(params.efectoTips):objTipTips.style.display="block";
		 
		 if(params.posiFlecha=="tl"){//Posicion de la flecha superior izquierdo
		    objTipTips.style.top=(yObj + altoObj + 5)+String(params.und_medida);//y
			objTipTips.style.left=xObj+String(params.und_medida);//x
		 }		 
		 if(params.posiFlecha=="tr"){//Posicion de la flecha superior derecho
		    objTipTips.style.top=(yObj + altoObj + 5)+String(params.und_medida);//y
			objTipTips.style.left=(xObj - getDimensionesObjeto(objTipTips).w + anchoObj)+String(params.und_medida);//x
			var objFlechaPosi=document.getElementById("dvl_Tips_G_t");
			objFlechaPosi.style.backgroundPosition="95%";//posi flecha
		 }		 
		 if(params.posiFlecha=="bl"){//Posicion de la flecha inferior izquierdo
			objTipTips.style.top=(yObj - getDimensionesObjeto(objTipTips).h - 5)+String(params.und_medida);//y
			objTipTips.style.left=xObj+String(params.und_medida);//x
		 }
		 if(params.posiFlecha=="br"){//Posicion de la flecha inferior izquierdo
			objTipTips.style.top=(yObj - getDimensionesObjeto(objTipTips).h)+String(params.und_medida);//y			
			objTipTips.style.left=(xObj - getDimensionesObjeto(objTipTips).w + anchoObj)+String(params.und_medida);//x
			var objFlechaPosi=document.getElementById("dvl_Tips_G_b");
			objFlechaPosi.style.backgroundPosition="95%";//posi flecha
		 }
	}
	/*********************************************
	FIN FUNCION PARA LA POSICION MANUAL DEL TIPS - ALCON 
	*********************************************/
	this.obj=obj;
	this.params=params;
  }
  //Funcion para cambiar la posicion del TIPS despues de cargar el contenido con AJAX,segun la cantidad del texto
  this.PosicionDespuesAjax=function(){
	  obj=this.obj;
	  params=this.params;
		//Posicion del TIPS
		var objTipTips=document.getElementById("dvg_tips_alcon_g");
		var yObj=getDimensionesObjeto(obj).y;     //Posicion Y del objeto
		var xObj=getDimensionesObjeto(obj).x;     //Posicion X del objeto
		var anchoObj=$(obj).width();//getDimensionesObjeto(obj).w; //Ancho del objeto
		var altoObj=$(obj).height();//getDimensionesObjeto(obj).h;  //Alto del objeto
		
	//Si exitte el efecto JQUERY para mostrar el TIPS		
	    if(!objTipTips) return false;
		  (params.efectoTips!=null)?$("#dvg_tips_alcon_g").fadeIn(params.efectoTips):objTipTips.style.display="block";
		
		var anchoWindowGt=getDimensionesObjeto("window").w;//Ancho de la Ventana
		var altoWindowGt=getDimensionesObjeto("window").h;//Alto de la Ventana		
		var anchoTipsT=getDimensionesObjeto(objTipTips).w;//Ancho del Tips
		var altoTipsT=getDimensionesObjeto(objTipTips).h;//Alto del Tips
		var flechaBottom=document.getElementById("dvl_Tips_G_b");
		var flechaTop=document.getElementById("dvl_Tips_G_t");
		var flechaBooleanTop=false;
		
		//Posicion TOP
		if((altoWindowGt - yObj)>altoTipsT){			
			if(yObj>altoTipsT){
			  if(flechaBottom){	
			   flechaBooleanTop=true;
			   flechaBottom.style.display="block";
			   objTipTips.style.top=(yObj - altoTipsT - 5)+String(params.und_medida);//y			   
			  }
			}else{
			  if(flechaTop){	
			   flechaTop.style.display="block";	
			   objTipTips.style.top=(yObj+20)+String(params.und_medida);//y		
			  }
			}
		}else{
			if(flechaTop){				
			flechaTop.style.display="block";
			objTipTips.style.top=(yObj+anchoObj+20)+String(params.und_medida);//y
			}
			 
		}
		//Posicion Left

		if((anchoWindowGt - xObj)>anchoTipsT){	
		   if(objTipTips){		
				objTipTips.style.left=xObj+String(params.und_medida);//x
				if(flechaBooleanTop){				
					var objFlechaPosi=document.getElementById("dvl_Tips_G_b");
					objFlechaPosi.style.backgroundPosition="5%";//posi flecha				
				}else{
					var objFlechaPosi=document.getElementById("dvl_Tips_G_t");
					objFlechaPosi.style.backgroundPosition="5%";//posi flecha
				}			
		   }
		}else{
		  if(objTipTips){	
			objTipTips.style.left=(xObj - anchoTipsT + anchoObj)+String(params.und_medida);//x			
			if(flechaBooleanTop){				
				var objFlechaPosi=document.getElementById("dvl_Tips_G_b");
				objFlechaPosi.style.backgroundPosition="95%";//posi flecha				
			}else{
				var objFlechaPosi=document.getElementById("dvl_Tips_G_t");
				objFlechaPosi.style.backgroundPosition="95%";//posi flecha
			}			
		  }
		}		  
  }
  
}
/*********************************************************
Captura el ANCHO Y ALTO de cualquier etiqueta HTML
*********************************************************/
var getDimensionesObjeto = function(oElement) {
	var x, y, w, h;
	x = y = w = h = 0;
	if(oElement=="window")
	{//Ancho y alto de la ventana
	     if (window.outerHeight) {
                w=window.outerWidth;
                h=window.outerHeight;				
            } else {					
					if (typeof (window.innerWidth) == 'number') {
						 w = window.innerWidth; 
						 h = window.innerHeight;
					} else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
						 w = document.documentElement.clientWidth; 
						 h = document.documentElement.clientHeight;
					} else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
						 w = document.body.clientWidth; 
						 h = document.body.clientHeight;
					}			
			
            }		
	}else
	{//ancho y alto del objeto
		try{		
			if (document.getBoxObjectFor) { // Mozilla
			  var oBox = document.getBoxObjectFor(oElement);
			  x = oBox.x-1;
			  w = oBox.width;
			  y = oBox.y-1;
			  h = oBox.height;
			}
			else if (oElement.getBoundingClientRect) { // IE
			  var oRect = oElement.getBoundingClientRect();
			  x = oRect.left-2;
			  w = oElement.clientWidth;
			  y = oRect.top-2;
			  h = oElement.clientHeight;
			}
		}catch (e){}
	}
    return {x: x, y: y, w: w, h: h};
}
/**********************************************
Ejemplos TIPS.ALCON:
**********************************************/
  //Usando JQUERY, para todas las etiquetas <a> . La posicion del TIPS es automatica		
		// $(document).ready(function() {    
		//	$("a").each(function (index){
		//		var ObjTip=new tipsALCON();
		//		ObjTip.iniTipsAlcon(this,{
		//		   textBody:"Contenido del texto, descripcion, contenido del texto, descripcion , contenido del texto N° "+index,	
		//		   textTitle:"Titulo N° "+index,
		//		   efectoTips:300			  
		//		 });
		//	});
		// }); 
		 
  //Usando JQUERY y AJAX. La posicion del TIPS es automatica
		// $(document).ready(function() {    
		//	$("a").each(function (index){
		//		var ObjTip=new tipsALCON();
		//		ObjTip.iniTipsAlcon(this,{
		//		   ajax:true,
		//		   ajax_parametro:{			   
		//			   url:'paginaContenido.php',//Cambiar por una pagina que exista
		//			   success:function(DivTipsAlconTitle,DivTipsAlconBody,data){
		//				   DivTipsAlconBody.innerHTML=data;
		//				   ObjTip.PosicionDespuesAjax();
		//			   }	
		//		   },
		//		   textTitle:"Titulo N° "+index,
		//		   efectoTips:300			  
		//		 });
		//	});
		// }); 
  
  //Usando una Funcion , la posicion del Tips de forma predeterminada (Cambiar la variable "posiFlecha")
  //posiFlecha=br(bottom right),bl(bottom left),tl(top left),tr(top right)
		// function Fnl_TipsEjemplo(){
		//	var ObjTip=new tipsALCON(); 
		//	ObjTip.iniTipsAlcon(obj,{
	    //         textBody:"Contenido del texto, descripcion, contenido del texto, descripcion , contenido del texto ",			   
		//		   textTitle:"Titulo del texto",
		//		   efectoTips:null,
		//		   evento:null,
		//		   posiFlecha:"br"//Posicion estatica - bottom right
		//		 });
		// }