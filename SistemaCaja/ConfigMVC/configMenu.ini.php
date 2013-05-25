<?php header("Content-type: text/xml; charset=utf-8"); ?>
<optionsMenu>

 <!--###########################################
       MENU PRINCIPAL
     #############################################-->
  <menu>
        <option>
           <id>idminicio</id>
           <name>Inicio</name>
           <url></url>
	   <target></target>	   
	   <icono>imgInicio.gif</icono>
	   <title></title>
	</option>
        <option>
           <id>idmmaestros</id>  
           <name>Maestros</name>
           <url>ctr=mmaestros</url>
	   <target></target>	   
	   <icono>imgHerramientas.gif</icono>
	   <title></title>
	</option>        
        <option>
           <id>idmusuario</id>   
           <name>Usuario</name>
           <url>ctr=musuarios</url>
	   <target></target>	   
	   <icono>usuarios.gif</icono>
	   <title></title>
	</option>
        <option>
           <id>idmafectados</id>      
           <name>Afectados</name>
           <url>ctr=mafectados</url>
	   <target></target>	   
	   <icono>mafectados.gif</icono>
	   <title></title>
	</option>         
        <option>
           <id>idmpredio</id>     
           <name>Predios</name>
           <url>ctr=mpredios</url>
	   <target></target>	   
	   <icono>mpredios.gif</icono>
	   <title></title>
	</option>
        <!--
        <option>
           <id>idmincidencias</id>        
           <name>Incidencias</name>
           <url>ctr=mincidencias</url>
	   <target></target>	   
	   <icono>mincidencias.gif</icono>
	   <title></title>
	</option>   
        <option>
          <id>idmvalorizaciones</id>          
           <name>Valorizaciones</name>
           <url>ctr=mvalorizaciones</url>
	   <target></target>	   
	   <icono>mvalorizaciones.gif</icono>
	   <title></title>
	</option>    
        <option>
            <id>idmestructuras</id>          
           <name>Estructuras</name>
           <url>ctr=mestructuras</url>
	   <target></target>	   
	   <icono>mestructuras.gif</icono>
	   <title></title>
	</option>
        <option>
           <id>idmpagos</id>           
           <name>Pagos</name>
           <url>ctr=mpagos</url>
	   <target></target>	   
	   <icono>mpagos.gif</icono>
	   <title></title>
	</option>
        <option>
           <id>idmperfil</id>           
           <name>Perfil</name>
           <url>ctr=mperfil</url>
	   <target></target>	   
	   <icono>Perfil.gif</icono>
	   <title></title>
	</option> 
        -->
  </menu>
  
  
    
    
    
 <!--###########################################
       SUB MENU - MAESTRO
     #############################################-->    
    
    <submenus>
        <subm_idmmaestros>
            <option group='1' text='Sistema'>                
                <name>Gestor de Empresa</name>
                <ctr>empresa</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbempresa.gif</icono>
                <title>Gestionar de Empresa</title>
            </option>                                        
            <option group='0'>
                <name>Gestión Tipo Moneda</name>
                <ctr>moneda</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipomoneda.png</icono>
                <title>Gestión Tipo Moneda</title>
            </option>                                                   
            
            <option group='1' text='Segmentos'>
                <name>Segmentos</name>
                <ctr>segmento</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtorres.png</icono>
                <title>Segmentos</title>
            </option> 
            
            <option>               
                <name>Estados de Torres</name>
                <ctr>torreestado</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbestadotorres.png</icono>
                <title>Estados de Torres</title>
            </option>   
            
            <option>               
                <name>Segmento Agrupados</name>
                <ctr>segmentoagrupado</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbplanillapredio.png</icono>
                <title>Segmento Agrupados</title>
            </option> 
            
            <option group='0'>
                <name>Tipo de Torre</name>
                <ctr>gtipotorre</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipotorres.png</icono>
                <title>Tipo de Torre</title>
            </option>  
            
            <option group='1' text='Predio'>                
                <name>Gestión Tipo Objeto</name>
                <ctr>tipoobjeto</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipoobjeto.png</icono>
                <title>Gestión Tipo Objeto</title>
            </option>
            
            <option>
                <name>Estado Predio Inscritos</name>
                <ctr>predioinscrip</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbestadopredioinscritos.png</icono>
                <title>Estado Predio Inscritos</title>
            </option>                                                                                        

            <option>
                <name>Tipo Predio Condición</name>
                <ctr>prediocondicion</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbprediocondicion.png</icono>
                <title>Tipo Predio Condición</title>
            </option>                                                                                        

            <option group='0'>
                <name>Gestión Tipo de Propiedad</name>
                <ctr>tipoprop</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipodepropiedad.png</icono>
                <title>Gestión Tipo de Propiedad</title>
            </option>   
                       
                                                                                      
  
            
            
           <!--
            <option>               
                <name>Gestión de Sustancia</name>
                <ctr>sustancia</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbsustancia.png</icono>
                <title>Gestión de Sustancia</title>
            </option>                                                                                        
           -->
           <!--
            <option>
                <name>Tipo Documento de Pago</name>
                <ctr>tipodocpago</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipodocpago.png</icono>
                <title>Tipo Documento de Pago</title>
            </option>                                                                                        
            -->

            <!--
            <option>
                <name>Estados de Incidente</name>
                <ctr>estadoincidente</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbestadoincidente.png</icono>
                <title>Estados de Incidente</title>
            </option>   
            -->                                                         
            
            <!--
            <option>
                <name>Gestión Tipo Documento</name>
                <ctr>gtipodoc</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbtipodocumento.png</icono>
                <title>Gestión Tipo Documento</title>
            </option>                                                                            
            -->    
            
        </subm_idmmaestros>
        
        
        
 <!--###########################################
       SUB MENU - USUARIOS
     #############################################-->            
        
        <subm_idmusuario>
            <option>                
                <name>Gestor de    Cargos</name>
                <ctr>cargo</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbcargos.png</icono>
                <title>Gestionar los Cargos</title>
            </option>                                        
            <option>
               <grupo></grupo> 
                <name>Gestor de  Empleados</name>
                <ctr>empleado</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbempleados.gif</icono>
                <title>Gestor de Empleados</title>
            </option>                                                    
            <option>
                <grupo></grupo> 
                <name>Gestor de Roles</name>
                <ctr>rol</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbroles.gif</icono>
                <title>Gestor de Roles</title>
            </option>                                                                
            
            <option>
                <grupo></grupo> 
                <name>Gestor de  Usuarios</name>
                <ctr>usuario</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbusuarios.png</icono>
                <title>Gestor de Usuarios</title>
            </option>                                                                            

            <option>
                <grupo></grupo> 
                <name>Gestor de Reglas</name>
                <ctr>regla</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbreglas.png</icono>
                <title>Gestor de Reglas</title>
            </option>                                                                                        
            <option>
                <grupo></grupo> 
                <name>Gestor de  Reglas por Rol</name>
                <ctr>reglaxrol</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbreglasroles.png</icono>
                <title>Gestor de Reglas por Rol</title>
            </option>                                                                                                    
            <option>
                <name>Gestor de  Auditoria</name>
                <ctr>auditoria</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbauditoria.png</icono>
                <title>Gestor de Auditoria</title>
            </option>                                                                                                                
        </subm_idmusuario>
        
 
  <!--###########################################
       SUB MENU - PREDIO
     #############################################-->    
        <subm_idmpredio>
            <option>
                <name>Gestión de Predios</name>
                <ctr>predio</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbpredio.png</icono>
                <title>Gestión de Predios</title>
            </option>  
            <option>
                <name>Planilla de Predio</name>
                <ctr>predioplanilla</ctr>
                <met>planilla</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbplanillapredio.png</icono>
                <title>Planilla de Predio</title>
            </option>
            <option>
                <name>Planilla de Inposición</name>
                <ctr>predioplanillainposicion</ctr>
                <met>planilla</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbauditoria.png</icono>
                <title>Planilla de Inposición</title>
            </option>            
            <option>
                <name>Gestión de Archivos</name>
                <ctr>archivo</ctr>
                <met>listag</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbprediocondicion.png</icono>
                <title>Planilla de Predio</title>
            </option>             
            
            
            <option group='1' text='Reportes'>
                <name>Reporte Servidumbre</name>
                <ctr>predioreportes</ctr>
                <met></met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor8.png</icono>
                <title>Reporte Servidumbre</title>
            </option> 
            
            <option>
                <name>Reporte Por Tramo </name>
                <ctr>predioreportes2</ctr>
                <met>tramo</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor7.png</icono>
                <title>Reporte Por Tramo</title>
            </option> 
            
            <option>
                <name>Reporte Tipo Inscripción</name>
                <ctr>predioreportes2</ctr>
                <met>inscripcion</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor6.png</icono>
                <title>Reporte Por Tipo Inscripción</title>
            </option> 
            
            <option>
                <name>Reporte Condición del Predio</name>
                <ctr>predioreportes2</ctr>
                <met>condicionpredio</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor1.png</icono>
                <title>Reporte Condición del Predio</title>
            </option> 
            
            <option>
                <name>Reporte Tipo de Propiedad</name>
                <ctr>predioreportes2</ctr>
                <met>tipopropiedad</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor2.png</icono>
                <title>Reporte Tipo de Propiedad</title>
            </option> 

            <option>
                <name>Reporte Tipo de Predio</name>
                <ctr>predioreportes2</ctr>
                <met>tipopredio</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor3.png</icono>
                <title>Reporte Tipo de Predio</title>
            </option> 
            
            <option>
                <name>Reporte Franja</name>
                <ctr>predioreportes2</ctr>
                <met>franja</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor4.png</icono>
                <title>Reporte si esta dentro fuera de franja</title>
            </option> 
            
            <option group='0'>
                <name>Reporte Afectados Con mas Predios</name>
                <ctr>predioreportes2</ctr>
                <met>afectadosmaspredios</met>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icorepor5.png</icono>
                <title>Conteo de afectados con más predios </title>
            </option> 
            
        </subm_idmpredio>

  
    <!--###########################################
       SUB MENU - AFECTADOS
     #############################################-->    
        <subm_idmafectados>
            <option>
                <name>Gestión de Afectados</name>
                <ctr>afectado</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbafectados.png</icono>
                <title>Gestión de Afectados</title>
            </option>  
            <option>
                <name>Afectados por Predios</name>
                <ctr>afectadoxpredio</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/sbestadoincidente.png</icono>
                <title>Afectados por Predios</title>
            </option>
            <!--
            <option>
                <name>Reporte - Tipo Juridico</name>
                <ctr>afectadoreporte</ctr>
                <varurl></varurl>
                <target></target>	   
                <icono>fileproject/img/sistema/administrador/icoreport1.png</icono>
                <title>Reporte - Tipo Juridico</title>
            </option>              
            -->
        </subm_idmafectados>

  
    </submenus>
    
    
</optionsMenu>