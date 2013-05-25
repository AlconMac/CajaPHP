function _trim(cadena)
{
  if(cadena){
	for(i=0; i<cadena.length; )
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(i+1, cadena.length);
		else
			break;
	}

	for(i=cadena.length-1; i>=0; i=cadena.length-1){
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(0,i);
		else
			break;
	}
	
	return cadena;
  }else{
	  return '';
	}
}

/***********************
Nombre de la pagina y los parametros
************************/
 function fng_pagina_url()
 {//Nombre de la PAGINA PRINCIPAL 
   var url = String(window.location.href);
   var ArrayURL=url.split("?");
   var urlP=ArrayURL[0].split("/");
   return urlP[urlP.length - 1];
 }
 //
 //reemplazar: para que no se repita el parametro "&"
 //eliminar: eliminar los parametro requeridos, viene como tipo de variable JSON
 function fng_parametros_url(reemplazar,eliminar)
 {//Parametros de la pagina 

   var params = String(window.location.search); //Capturamos los parametros de la URL
   var paramsResul="";//Variable para el resultado de los parametros   
   if (params.length > 0)
   {//Si existen parametros
	   paramsResul=params.substr(1);//Elimina el primer caractar "?"
	   if(reemplazar){//"eliminar", es el nombre de la variable que se reemplazara en la Url
		   reemplazar=paramsResul.split(reemplazar);//Separamos el parametor a partir del parametro que se reemplazara
		   paramsResul=reemplazar[0];		   
		   if(reemplazar[0].substr(-1)=="&")//Eliminamos el ultimo caracter
		        paramsResul=reemplazar[0].substr(0,(reemplazar[0].length - 1));
		   
	   }
	   
	   //Para eliminar los parametros requeridos
	   if(eliminar && eliminar.length){		   
		  for(var itg=0;itg<eliminar.length;itg++)
		  {//Recorremos los parametros que se eliminaran			 
			 var paramsResulLis=paramsResul.split("&");
			 var newParm="";
			 if(paramsResul.indexOf(eliminar[itg])!=-1)
			 {//Primeramente se busca el parametro, si existe se elimina
			   for(var r=0;r<paramsResulLis.length;r++)
			   {//Recorremos a los parametros del URL orifinal
				   var gparamsResulLis=paramsResulLis[r].split("=");//Separamos el parametro y su valor				   
				   if(gparamsResulLis[0]!=eliminar[itg])
						newParm+=paramsResulLis[r]+"&";//Nombramos la nueva URL, sin añadir los que deseamos eliminar
					
			   }
			    paramsResul=newParm.substr(0,(newParm.length - 1));//Eliminamos el Ultimo caracter			  
			 }
		  }

	   }	
	      
	   return paramsResul;
	   
   }else
   {//Por defecto todo normal
	   return paramsResul;
   }
 }
 
 //PARA ABRIR POPUP
 function getPopUp(el_url,mi_nombre, w, h,scroll,posicion) {//
	   if((posicion) && posicion!=""){
		   var pos=posicion.split(":");
			var winl = (screen.width - w) / Number(pos[0]); 
			var wint = (screen.height - h) / Number(pos[1]); 
	   }else{
		var winl = (screen.width - w) / 2; 
		var wint = (screen.height - h) / 2; 
	   }		
			ancho_alto = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+'';
			ventan = window.open(el_url, mi_nombre ,ancho_alto);
			if (parseInt(navigator.appVersion) >= 4) {ventan.window.focus();} 
	}/**/
	
function ShowHide(id,efectoJquery,verNover){/**/
	  var efect=efectoJquery||false;
		if (document.getElementById(''+id+'')){
		  var el = document.getElementById(''+id+'');	
		   if(Number(verNover)){
				if(Number(verNover)==0){
					if(efect==true){				
						$('#'+id).animate({height:"hide",opacity:"hide"},"hide");		
					}else{				
						el.style.display ='none';
					}
		        }else{
					if(efect==true){				
						$('#'+id).animate({height:"show",opacity:"show"},"show");		
					}else{				
						el.style.display ='block';
					}
				}
		   }else{
				if(efect==true){				
					if(el.style.display=='none' || el.style.display==""){
						$('#'+id).animate({height:"show",opacity:"show"},"show");
					}else{
						$('#'+id).animate({height:"hide",opacity:"hide"},"hide");		
					}
				}else{				
					el.style.display = (el.style.display == 'block') ? 'none' : 'block';
				}
		   }
		}
	}/**/	


///
function _Url(ctr,met,objvar){
	var url=document.location.href;
	url=url.split('?');
	url=url[0];
	if(ctr && ctr!="")
	{
		var urlnew='?ctr='+ctr;
		   if(met && met!="")
			  urlnew+='&met='+met;
		   
		   if(objvar && objvar!=""){
			 for (dc in objvar)
			{
			   urlnew='&'+dc+'='+objvar[dc];//
			 }
		   }
		   //
		   return url+urlnew;	
	}else{
		return url;
	}
}	


function fgForm(){
	this.numeros=function(e){
		 var key = e.keyCode || e.which;
		 var tecla = String.fromCharCode(key).toLowerCase();
		 var letras = "1234567890";
		 var especiales = [8,37,39,46,96,97,98,99,100,101,102,103,104,105];		
		 var tecla_especial = false
		 for(var i in especiales){
			 if(key == especiales[i]){
		        tecla_especial = true;
		        break;
			} 
		 }
		
		if(letras.indexOf(tecla)==-1 && !tecla_especial)
		return false;
	}
	
	this.letras=function(e){
		 key = e.keyCode || e.which;
		 tecla = String.fromCharCode(key).toLowerCase();
		 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
		 especiales = [8,37,39,46];
		
		 tecla_especial = false
		 for(var i in especiales){
			 if(key == especiales[i]){
		  tecla_especial = true;
		  break;
					} 
		 }
		 
				if(letras.indexOf(tecla)==-1 && !tecla_especial)
			 return false;
	}
	
	this.email=function(txt){
		  if (/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(txt)){		    
		     return true;
		  } else {
			  return false;				
		  }		
	}
	
	//
	this.tipoarchivo=function(txt,tipo){
		var tipoar;
		if(tipo=='imagen')
		  tipoar=/.(jpg)|(gif)|(png)|(bmp)$/;
		else if(tipo=='archivo')
		  tipoar=/.(xls)|(xxls)|(xdoc)|(doc)|(pdf)$/;
		else
		  tipoar=/.(jpg)|(gif)|(png)|(bmp)|(xls)|(xxls)|(xdoc)|(doc)|(pdf)$/;
		if(txt.match(tipoar))
		  return true
		else
		  return false;	
	}
	//
	this.float=function(numero){
		if (!/^([0-9])*[.]?[0-9]*$/.test(numero))
	      return false;
		 else
		  return true;
	}
}

/***********
Select "COMBO"-alcon
************/
$(document).ready(function(e) {
    $(".cbtp_sub_menu").each(function(index, element) {
          $(this).click(function(e) {$(this).find(".cbtp_sub_menu_cont").toggle();});
  //
				 		  
       var objSelect=$(this);
		  $(this).find(".cbtp_sub_menu_cont").find("a").each(function(index, element) {
				var hrefg=$(this).attr("href");
				var onclikg=$(this).attr("href");
				if(hrefg=="javascript:void(0);" || hrefg=="javascript:;")
				{
					$(this).click(function(e) {
				        var idx=$(this).attr("id");
				        var valx=$(this).html();
						objSelect.find("span").attr("id",idx);
						objSelect.find("span").html(valx);						
					});
				}
		  });
		  
		
		
    });
});

function fngListSelectActivo(idCont,id,val){
	$("#"+idCont).find("span").attr("id",id);
	$("#"+idCont).find("span").html(val);	
}