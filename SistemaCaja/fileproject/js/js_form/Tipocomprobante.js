//Js : TIPO_COMPROBANTE 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormTipocomprobante(){
	 	this.nombre=document.getElementById('txtnombre');
}
 
function jsTipocomprobanteGuardar(){
	var form=new jsFormTipocomprobante();
	if(_trim(form.nombre.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.nombre.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
document.getElementById('formTipocomprobante').submit();
}

 
function jsTipocomprobanteLimpiar(){
	var form=new jsFormTipocomprobante();
	 	form.nombre.value='';
}

 
function jsTipocomprobanteEliminar(url){
		 	AlertALCON({
	 	 	textBody:"Seguro de Eliminar",
			tipo:"pregunta",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	     document.location.replace(url);
	 	 	}
	 	  },
		  botonSecundario:{
	 	 	visible:true
	 	  }
	 	});	

	}

 
function jsTipocomprobanteBuscar(url){
	var txtb=document.getElementById("txtTipocomprobanteb");
	var tipob=document.getElementById("lstTipoBusquedaTipocomprobante");
	if(_trim(tipob.value)==""){
	 	AlertALCON({
	 	 	textBody:"Seleccione el tipo de búsqueda",
	 	 	botonPrincipal:{
	 	 	visible:true
	 	    }
	 	});	
		return false;		
	}

	if(_trim(txtb.value)==""){
	 	AlertALCON({
	 	 	textBody:"Escriba alguna palabra para la búsqueda",
	 	 	botonPrincipal:{
	 	 	visible:true
	 	    }
	 	});	
		return false;		
	}


	document.location.replace(url+"&tipofind="+tipob.value+"&txtfind="+txtb.value);
	return false;	

	}

 
function jsTipocomprobanteBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsTipocomprobanteBuscar(url);	

	}
