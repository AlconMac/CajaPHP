// JavaScript Document
 $(document).ready(function(e) {
	function fnl_frmlogin(){
		this.clave=document.getElementById('txtclave');
		this.user=document.getElementById('txtuser');		
	}
	//
	function fnl_ingresar(){
		var formLogin=new fnl_frmlogin();
		if(_trim(formLogin.user.value)=="")
		{
			AlertALCON({
				textBody:"Escriba el nombre de usuario",
				botonPrincipal:{
					visible:true,
					eventoClick:function(){
					  formLogin.user.focus();		    	   
					}
				}
			});			
			return false;
		}
		//
		if(_trim(formLogin.clave.value)=="")
		{
			AlertALCON({
				textBody:"Escriba su clave de acceso",
				botonPrincipal:{
					visible:true,
					eventoClick:function(){
					   formLogin.clave.focus();		    	   
					}
				}
			});			
			return false;
		}
		
		///
		document.getElementById('frmlogin').submit();		
	}
    $("#cmdlimpiar").click(function(){
		var formLogin=new fnl_frmlogin();
		formLogin.clave.value="";
		formLogin.user.value="";
		formLogin.user.focus();		
	});
	//
	$("#txtclave").keydown(function(e) {
        var EventoT=(window.event)?window.event.keyCode:e.which;
   		if(EventoT==13)
			fnl_ingresar();	
    });
	//
    $("#cmdingresar").click(function(){
		fnl_ingresar();		
	});	
 });
 
 
function fnl_login_error()
{
	    AlertALCON({
			textBody:'Usuario o Contraseña incorrectos',
			tipo:"error",
			botonPrincipal:{
				visible:true	
			}
		});		
		return false;	
} 