//Js : TIPO_DESCRIPCION 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormTipodescripcion(){
	 	this.descripcion=document.getElementById('txtdescripcion');
	 	this.fecharegi=document.getElementById('txtfecharegi');
}
 
function jsTipodescripcionGuardar(){
	var form=new jsFormTipodescripcion();
	if(_trim(form.descripcion.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.descripcion.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.fecharegi.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.fecharegi.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
document.getElementById('formTipodescripcion').submit();
}

 
function jsTipodescripcionLimpiar(){
	var form=new jsFormTipodescripcion();
	 	form.descripcion.value='';
	 	form.fecharegi.value='';
}

 
function jsTipodescripcionEliminar(url){
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

 
function jsTipodescripcionBuscar(url){
	var txtb=document.getElementById("txtTipodescripcionb");
	var tipob=document.getElementById("lstTipoBusquedaTipodescripcion");
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

 
function jsTipodescripcionBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsTipodescripcionBuscar(url);	

	}
