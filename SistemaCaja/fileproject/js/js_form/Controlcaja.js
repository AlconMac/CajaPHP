//Js : CONTROL_CAJA 
 //Autor : ALCON 
 //fecha 2012-12-29 
 //Lima - Perú 
function jsFormControlcaja(){
	 	this.idcomp=document.getElementById('txtidcomp');
	 	this.idmone=document.getElementById('txtidmone');
	 	this.idoperacion=document.getElementById('txtidoperacion');
	 	this.dec=document.getElementById('txtdescripcion');
	 	this.idusu=document.getElementById('txtidusu');
	 	this.numcomprobante=document.getElementById('txtnumcomprobante');
	 	this.importe=document.getElementById('txtimporte');
	 	this.cantidad=document.getElementById('txtcantidad');
	 	this.observacion=document.getElementById('txtobservacion');
		this.fecha=document.getElementById('txtfecha');
	 	this.fecharegi=document.getElementById('txtfecharegi');
	 	this.fechamodi=document.getElementById('txtfechamodi');
	 	this.estado=document.getElementById('txtestado');
}
 
function jsControlcajaGuardar(){
	var form=new jsFormControlcaja();
	
	if(_trim(form.fecha.value)==""){
	 	AlertALCON({
	 	 	textBody:"Seleccione la Fecha",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.cantidad.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	 	
	if(_trim(form.idcomp.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.idcomp.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.idmone.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.idmone.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.idoperacion.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.idoperacion.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.dec.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.dec.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }

//	if(_trim(form.numcomprobante.value)==""){
//	 	AlertALCON({
//	 	 	textBody:"El campo no debe estar vacio",
//	 	 	botonPrincipal:{
//	 	 	visible:true,
//	 	 	eventoClick:function(){
//	 	 	form.numcomprobante.focus();
//	 	 	}
//	 	 	}
//	 	});
//	 	return false;
//	 }
	if(_trim(form.importe.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.importe.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
	if(_trim(form.cantidad.value)==""){
	 	AlertALCON({
	 	 	textBody:"El campo no debe estar vacio",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	 	eventoClick:function(){
	 	 	form.cantidad.focus();
	 	 	}
	 	 	}
	 	});
	 	return false;
	 }
		
document.getElementById('formControlcaja').submit();
}

 
function jsControlcajaLimpiar(){
	var form=new jsFormControlcaja();
	 	form.idcomp.value='';
	 	form.idmone.value='';
	 	form.idoperacion.value='';
	 	form.iddec.value='';
	 	form.idusu.value='';
	 	form.numcomprobante.value='';
	 	form.importe.value='';
	 	form.cantidad.value='';
	 	form.observacion.value='';
	 	form.fecharegi.value='';
	 	form.fechamodi.value='';
	 	form.estado.value='';
}

//Eliminar 
function jsControlcajaEliminar(url){
 var numCheckEl=0;
 var idElim=Array();
 var it=0;
	$('#bGrillaG input[type=checkbox]').each( function() {			
		if(this.checked==true){
			idElim[it]=this.value;
			numCheckEl++;
		}
		++it;
	});
	
	if(numCheckEl==0){
		 	AlertALCON({
	 	 	textBody:"Seleccione un elemento",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	    }
	 	});			
      return false;
   }


var pca=idElim.toString().substr(0,1);
if(pca==",")
	url=url+ idElim.slice(1, idElim.length);
else
	url=url+ idElim;

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

 
 //Modificar 
function jsControlcajaModificar(url){
 var numCheckEl=0;
 var idModi=0;
	$('#bGrillaG input[type=checkbox]').each( function() {			
		if(this.checked==true){
			idModi=this.value;
			numCheckEl++;
		}
	});
	
	if(numCheckEl==0 || numCheckEl>1){
		 	AlertALCON({
	 	 	textBody:"Seleccione solo un elemento",
	 	 	botonPrincipal:{
	 	 	visible:true,
	 	    }
	 	});			
      return false;
   }

	document.location.replace(url+idModi);
}


 
function jsControlcajaBuscar(url){
	var txtb=document.getElementById("txtControlcajab");
	//var tipob=document.getElementById("lstTipoBusquedaControlcaja");
	var tipob=$("#lstTipoBusquedaControlcaja");
	
	if(_trim(tipob.find("span").attr("id"))==""){
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


	document.location.replace(url+"&tipofind="+tipob.find("span").attr("id")+"&txtfind="+txtb.value);
	return false;	

	}

 
function jsControlcajaBuscarKey(e,url){
	 var EventoT=(window.event)?window.event.keyCode:e.which;
   		 if(EventoT==13)
				jsControlcajaBuscar(url);	

	}

/******
*******/
$(document).ready(function(e) {
	///Seleccionar los Checked
    $("input[name=ckg]").change(function(){
		$('#bGrillaG input[type=checkbox]').each( function() {			
			if($("input[name=ckg]:checked").length == 1){
				this.checked = true;
			} else {
				this.checked = false;
			}
		});
	});
	//
});
