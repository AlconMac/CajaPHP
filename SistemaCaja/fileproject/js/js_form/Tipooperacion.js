//Js : TIPO_OPERACION 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormTipooperacion(){
	 	this.nombre=document.getElementById('txtnombre');
}
 
function jsTipooperacionGuardar(){
	var form=new jsFormTipooperacion();
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
document.getElementById('formTipooperacion').submit();
}

 
function jsTipooperacionLimpiar(){
	var form=new jsFormTipooperacion();
	 	form.nombre.value='';
}

 
function jsTipooperacionEliminar(url){
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

 
function jsTipooperacionBuscar(url){
	var txtb=document.getElementById("txtTipooperacionb");
	var tipob=document.getElementById("lstTipoBusquedaTipooperacion");
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

 
function jsTipooperacionBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsTipooperacionBuscar(url);	

	}
