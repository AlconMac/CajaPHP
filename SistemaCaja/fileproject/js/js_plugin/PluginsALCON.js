/**********************************************************************
Nombre         : PluginALCON
Versión        : 1.0
Autor          : Luis ALCON 
Fecha Creacion : 10-07-2012 Lima - Perú
Fecha Modific. : 10-07-2012 , Lima - Perú
Descripcion    : Se encarga de incluir los diferentes plugins, desde un mismo archivo
**********************************************************************/
PluginsALCON=function(params){
    function param_default(pname, def){ if(params){ if (typeof params[pname] == "undefined") {params[pname] = def;}}};
	param_default("PluginsDefecto","AlertALCON,PopupALCON,TinyTipsALCON");//Si estara activo el fondo general
	param_default("AddPlugins","");//Si estara activo el fondo general
	param_default("rutaPlugins","");//Si estara activo el fondo general
	param_default("rutaPluginsCss","");//Si estara activo el fondo general

	//Adicionamos PLUGIN
		var ArrayAddPubling=params.AddPlugins.split(",");
		for(var ap=0;ap<ArrayAddPubling.length;ap++)
		{
			CargarJsALCON(params.rutaPlugins+ArrayAddPubling[ap]+".js");
		}		


    //Plugin por defecto
    if(params.PluginsDefecto!=""){
		var ArrayPubling=params.PluginsDefecto.split(",");
		for(var p=0;p<ArrayPubling.length;p++)
		{
			if(ArrayPubling[p]=="TinyTipsALCON")
			{
				CargarCssALCON(params.rutaPluginsCss+"TinyTipsALCON.css");
			}			
			CargarJsALCON(params.rutaPlugins+ArrayPubling[p]+".js");			 
		}		
	}else{
		alert("Defina el Plugin a cargar");
		return false;
	}

    /**************************************
	  FUNCIONES
	***************************************/
	//
	function CargarCssALCON(urlCss,target)
	{//CARGA ARCHIVOS CSS
	    var t_target=target||'';
		var idCss_='myCss';
		var $_al = eval(t_target+'document;');
		var cssId = idCss_;
		if (!$_al.getElementById(cssId))
		{
			var head  = $_al.getElementsByTagName('head')[0];
			var link_  = $_al.createElement('link');
			link_.id   = cssId;
			link_.rel  = 'stylesheet';
			link_.type = 'text/css';
			link_.href = urlCss;
			link_.media = 'all';
			head.appendChild(link_);
		}
	   return true;		
	}
	
	function CargarJsALCON(urlJs,target)
	{//CARGA ARCHIVOS JS       
            var d = new Date();// se crea un objeto tipo fecha
            var t_target=target||'';
            if(t_target=='undefined') t_target='';        
            var $_document = eval(t_target+'document;');
                    var sc = $_document.getElementsByTagName("script");		
                    for (var x in sc)//AGREGAR SOLO SI NO EXITE include_once();
                            if (sc[x].src != null && sc[x].src.indexOf(urlJs) != -1) return false;
                           var $_al = $_document;
                    var head  = $_al.getElementsByTagName('head')[0];
                    	head|| (head=$_al.body.parentNode.appendChild($_al.createElement(" head")));
                    var js_  = $_al.createElement('script');			
                    	js_.charset  = 'UTF-8';
                        js_.type = 'text/javascript';
                        js_.src = urlJs+"?nCache_="+d.getTime();
                        head.appendChild(js_);                        
             return true;
		}


}

//Objeto AJAX para usar en los diferentes PLUGINS
function objetoAjaxALCON()
{
	 var http_request = false; 
        if (window.XMLHttpRequest) { // Mozilla, Safari,...
           
            try {
                  http_request = new XMLHttpRequest();
				
            } catch (e) {
                try {
                    http_request = new window.ActiveXObject("Microsoft.XMLHTTP");
				
                } catch (e) {}
            }

            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        } 
        if (!http_request) {
            alert('Falla :( No es posible crear una instancia XMLHTTP');
            return false;
        }else
   return http_request;
}