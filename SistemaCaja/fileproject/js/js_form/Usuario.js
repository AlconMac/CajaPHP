//Js : USUARIO 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormUsuario(){
	 	this.nombres=document.getElementById('txtnombres');
	 	this.apellidos=document.getElementById('txtapellidos');
	 	this.usu=document.getElementById('txtusu');
	 	this.clave=document.getElementById('txtclave');
	 	this.estado=document.getElementById('txtestado');
}
 
function jsUsuarioGuardar(){
	var form=new jsFormUsuario();
	if(_trim(form.nombres.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.nombres.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.apellidos.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.apellidos.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.usu.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.usu.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.clave.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.clave.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.estado.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.estado.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
document.getElementById('formUsuario').submit();
}

 
function jsUsuarioLimpiar(){
	var form=new jsFormUsuario();
	 	form.nombres.value='';
	 	form.apellidos.value='';
	 	form.usu.value='';
	 	form.clave.value='';
	 	form.estado.value='';
}

 
function jsUsuarioEliminar(url){
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

 
function jsUsuarioBuscar(url){
	var txtb=document.getElementById("txtUsuariob");
	var tipob=document.getElementById("lstTipoBusquedaUsuario");
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

 
function jsUsuarioBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsUsuarioBuscar(url);	

	}
