//Js : TIPO_MONEDA 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormTipomoneda(){
	 	this.nombre=document.getElementById('txtnombre');
	 	this.iniciales=document.getElementById('txtiniciales');
}
 
function jsTipomonedaGuardar(){
	var form=new jsFormTipomoneda();
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
	if(_trim(form.iniciales.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.iniciales.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
document.getElementById('formTipomoneda').submit();
}

 
function jsTipomonedaLimpiar(){
	var form=new jsFormTipomoneda();
	 	form.nombre.value='';
	 	form.iniciales.value='';
}

 
function jsTipomonedaEliminar(url){
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

 
function jsTipomonedaBuscar(url){
	var txtb=document.getElementById("txtTipomonedab");
	var tipob=document.getElementById("lstTipoBusquedaTipomoneda");
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

 
function jsTipomonedaBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsTipomonedaBuscar(url);	

	}
