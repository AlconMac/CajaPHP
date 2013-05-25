<?php
//Controlodor - USUARIO
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 

include_once 'LibreriasMVC/_Form.php';
include_once 'LibreriasMVC/_Crifrado.php';
include_once 'ModelMVC/_QueryModel.php';
include_once 'EntidadMVC/Usuario.php';
include_once 'ModelMVC/UsuarioModel.php';			
	
class usuarioControl extends _Form { 

 	
	public function __construct()
    {
    	$this->view = new Vista();
    }		
	   
 	
	//Control Index
	public function index($textAlerta=null){ 
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        //
        $oUsuario=new Usuario();
        $sql=  UsuarioModel::Sql($oUsuario);
        $pag=(isset($_GET['pag']))?$_GET['pag']:1;
        $queryPg=new _QueryModel($pag);
        $queryPg->query($sql,10);//se mostrara de 10 en 10 registros           
        $listObjeto=$queryPg->ArrayListObjeto(new Usuario);
        $data['lista']=$listObjeto;
        $data['paginacion']=$queryPg->getPageGroup('?ctr=usuario&pag=',3, 'paginacion');
        //
		$this->view->ver('usuarioListar.php',$data);	
	}
		
 	
	//Formulario
    public function form($textAlerta=null){
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        $data['updateix']=  self::idUpdateWrite();
        if(self::idUpdate()!=null){
        	$oUsuario=new Usuario();
            $oUsuario->setIdusu(self::idUpdate());
            $objForm= UsuarioModel::Buscar($oUsuario);               
        }else{               
        	$objForm=new Usuario(); 
        }
        
		$data['objForm']=$objForm;
	    $this->view->ver('form/usuarioForm.php',$data);	               
     }
		
 	
	//Control Guardar 
 	public function guardar(){
		 
 	 	$nombres=(self::POST('txtnombres'))?self::ScapeString($_POST['txtnombres']):'';
 	 	$apellidos=(self::POST('txtapellidos'))?self::ScapeString($_POST['txtapellidos']):'';
 	 	$usu=(self::POST('txtusu'))?self::ScapeString($_POST['txtusu']):'';
 	 	$clave=(self::POST('txtclave'))?self::ScapeString($_POST['txtclave']):'';
 	 	$estado=(self::POST('txtestado'))?self::ScapeString($_POST['txtestado']):''; 
            //           
           if($nombres!="")
           {
              if(self::validaToken())
              {
                $oUsuario=new Usuario();
 	 	 	 	$oUsuario->setNombres($nombres);
 	 	 	 	$oUsuario->setApellidos($apellidos);
 	 	 	 	$oUsuario->setUsu($usu);
 	 	 	 	$oUsuario->setClave($clave);
 	 	 	 	$oUsuario->setEstado($estado);

                
                $idUpdate=  _Form::validaIdUpdate();
                if($idUpdate!=null){
                   $id=$idUpdate; // _Crifrado::desencriptar($idUpdate, 'formUsuarioUpdate');
                   if(is_numeric($id)){
                       $oUsuario->setIdusu($id);
                        if(UsuarioModel::Actualizar($oUsuario)){
                            $textAlerta='Datos actualizados correctamente'; 
                        }else{
                            $textAlerta='Erro al intentar actualizar los datos'; 
                        }                       
                   }else{
                       $textAlerta='Erro al intentar actualizar los datos!';
                   }
                }else{
                    if(UsuarioModel::Guardar($oUsuario)){
                        $textAlerta='Datos guardados correctamente'; 
                    }else{
                        $textAlerta='Erro al guardar los datos'; 
                    }
                }
                
                $this->form($textAlerta);
              }else{
                $this->form();  
              }
           }else{
               $this->form();
           }
	}
		
 	
        //Control Eliminar 
 	 public function eliminar(){
            $id=  self::idDelete();
            if($id!=null)
            {
                $oUsuario=new Usuario();
                $oUsuario->setIdusu($id);
                if(UsuarioModel::Eliminar($oUsuario))
                    $textAlerta='Datos borrados correctamente';
                else
                    $textAlerta='Erro al intentar borrar los datos';
                
                $this->index($textAlerta);
            }else{
                $this->index();
            }
            
	}
		
 	
	//Control Buscar 
 	 public function buscar()
        {
		$this->index();   
	}
		
 	
       //Exportar
        public function exportar() {
            header("Expires: Mon, 12 Oct 2012 05:00:00 GMT"); 
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT"); 
            header("Cache-Control: no-cache, must-revalidate"); 
            header("Pragma: no-cache"); 
            header("Content-type: application/x-msexcel"); 
            header("Content-Disposition: attachment; filename=Usuario.xls" ); 
            header("Content-Description: PHP/INTERBASE Generated Data" ); 
            header("Expires: 0");        
            
            $oUsuario=new Usuario();
            $sql=  UsuarioModel::Sql($oUsuario);            
            $queryPg=new _QueryModel();
            $queryPg->query($sql);    
            $listObjeto=$queryPg->fetchEach();
            
            $columnas=$queryPg->fetchFields();
            $columnasExport='';
            foreach($columnas as $cam){
                $columnasExport.=$cam->name."\t ";
            }
            $columnasExport.="\n";
            echo $columnasExport;//Nombre de las Columnas
            
            $data="";           
            foreach($listObjeto as $roU){                
                foreach($columnas as $cam)
                    $data.="".$roU[$cam->name]."\t ";
                $data.="\n ";                
                echo $data;//Fila de los datos
                $data="";
            }
            
        }
		
 } 
?>