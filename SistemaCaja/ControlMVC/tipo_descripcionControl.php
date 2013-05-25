<?php
//Controlodor - TIPO_DESCRIPCION
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 

include_once 'LibreriasMVC/_Form.php';
include_once 'LibreriasMVC/_Crifrado.php';
include_once 'ModelMVC/_QueryModel.php';
include_once 'EntidadMVC/Tipo_descripcion.php';
include_once 'ModelMVC/Tipo_descripcionModel.php';			
	
class tipo_descripcionControl extends _Form { 

 	
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
        $oTipo_descripcion=new Tipo_descripcion();
        $sql=  Tipo_descripcionModel::Sql($oTipo_descripcion);
        $pag=(isset($_GET['pag']))?$_GET['pag']:1;
        $queryPg=new _QueryModel($pag);
        $queryPg->query($sql,10);//se mostrara de 10 en 10 registros           
        $listObjeto=$queryPg->ArrayListObjeto(new Tipo_descripcion);
        $data['lista']=$listObjeto;
        $data['paginacion']=$queryPg->getPageGroup('?ctr=tipo_descripcion&pag=',3, 'paginacion');
        //
		$this->view->ver('tipo_descripcionListar.php',$data);	
	}
		
 	
	//Formulario
    public function form($textAlerta=null){
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        $data['updateix']=  self::idUpdateWrite();
        if(self::idUpdate()!=null){
        	$oTipo_descripcion=new Tipo_descripcion();
            $oTipo_descripcion->setIddec(self::idUpdate());
            $objForm= Tipo_descripcionModel::Buscar($oTipo_descripcion);               
        }else{               
        	$objForm=new Tipo_descripcion(); 
        }
        
		$data['objForm']=$objForm;
	    $this->view->ver('form/tipo_descripcionForm.php',$data);	               
     }
		
 	
	//Control Guardar 
 	public function guardar(){
		 
 	 	$descripcion=(self::POST('txtdescripcion'))?self::ScapeString($_POST['txtdescripcion']):'';
 	 	$fecharegi=(self::POST('txtfecharegi'))?self::ScapeString($_POST['txtfecharegi']):''; 
            //           
           if($descripcion!="")
           {
              if(self::validaToken())
              {
                $oTipo_descripcion=new Tipo_descripcion();
 	 	 	 	$oTipo_descripcion->setDescripcion($descripcion);
 	 	 	 	$oTipo_descripcion->setFecha_regi($fecharegi);

                
                $idUpdate=  _Form::validaIdUpdate();
                if($idUpdate!=null){
                   $id=$idUpdate; // _Crifrado::desencriptar($idUpdate, 'formTipo_descripcionUpdate');
                   if(is_numeric($id)){
                       $oTipo_descripcion->setIddec($id);
                        if(Tipo_descripcionModel::Actualizar($oTipo_descripcion)){
                            $textAlerta='Datos actualizados correctamente'; 
                        }else{
                            $textAlerta='Erro al intentar actualizar los datos'; 
                        }                       
                   }else{
                       $textAlerta='Erro al intentar actualizar los datos!';
                   }
                }else{
                    if(Tipo_descripcionModel::Guardar($oTipo_descripcion)){
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
                $oTipo_descripcion=new Tipo_descripcion();
                $oTipo_descripcion->setIddec($id);
                if(Tipo_descripcionModel::Eliminar($oTipo_descripcion))
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
            header("Content-Disposition: attachment; filename=Tipo_descripcion.xls" ); 
            header("Content-Description: PHP/INTERBASE Generated Data" ); 
            header("Expires: 0");        
            
            $oTipo_descripcion=new Tipo_descripcion();
            $sql=  Tipo_descripcionModel::Sql($oTipo_descripcion);            
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