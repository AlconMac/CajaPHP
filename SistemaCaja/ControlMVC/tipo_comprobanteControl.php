<?php
//Controlodor - TIPO_COMPROBANTE
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 

include_once 'LibreriasMVC/_Form.php';
include_once 'LibreriasMVC/_Crifrado.php';
include_once 'ModelMVC/_QueryModel.php';
include_once 'EntidadMVC/Tipo_comprobante.php';
include_once 'ModelMVC/Tipo_comprobanteModel.php';			
	
class tipo_comprobanteControl extends _Form { 

 	
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
        $oTipo_comprobante=new Tipo_comprobante();
        $sql=  Tipo_comprobanteModel::Sql($oTipo_comprobante);
        $pag=(isset($_GET['pag']))?$_GET['pag']:1;
        $queryPg=new _QueryModel($pag);
        $queryPg->query($sql,10);//se mostrara de 10 en 10 registros           
        $listObjeto=$queryPg->ArrayListObjeto(new Tipo_comprobante);
        $data['lista']=$listObjeto;
        $data['paginacion']=$queryPg->getPageGroup('?ctr=tipo_comprobante&pag=',3, 'paginacion');
        //
		$this->view->ver('tipo_comprobanteListar.php',$data);	
	}
		
 	
	//Formulario
    public function form($textAlerta=null){
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        $data['updateix']=  self::idUpdateWrite();
        if(self::idUpdate()!=null){
        	$oTipo_comprobante=new Tipo_comprobante();
            $oTipo_comprobante->setIdcomp(self::idUpdate());
            $objForm= Tipo_comprobanteModel::Buscar($oTipo_comprobante);               
        }else{               
        	$objForm=new Tipo_comprobante(); 
        }
        
		$data['objForm']=$objForm;
	    $this->view->ver('form/tipo_comprobanteForm.php',$data);	               
     }
		
 	
	//Control Guardar 
 	public function guardar(){
		 
 	 	$nombre=(self::POST('txtnombre'))?self::ScapeString($_POST['txtnombre']):''; 
            //           
           if($nombre!="")
           {
              if(self::validaToken())
              {
                $oTipo_comprobante=new Tipo_comprobante();
 	 	 	 	$oTipo_comprobante->setNombre($nombre);

                
                $idUpdate=  _Form::validaIdUpdate();
                if($idUpdate!=null){
                   $id=$idUpdate; // _Crifrado::desencriptar($idUpdate, 'formTipo_comprobanteUpdate');
                   if(is_numeric($id)){
                       $oTipo_comprobante->setIdcomp($id);
                        if(Tipo_comprobanteModel::Actualizar($oTipo_comprobante)){
                            $textAlerta='Datos actualizados correctamente'; 
                        }else{
                            $textAlerta='Erro al intentar actualizar los datos'; 
                        }                       
                   }else{
                       $textAlerta='Erro al intentar actualizar los datos!';
                   }
                }else{
                    if(Tipo_comprobanteModel::Guardar($oTipo_comprobante)){
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
                $oTipo_comprobante=new Tipo_comprobante();
                $oTipo_comprobante->setIdcomp($id);
                if(Tipo_comprobanteModel::Eliminar($oTipo_comprobante))
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
            header("Content-Disposition: attachment; filename=Tipo_comprobante.xls" ); 
            header("Content-Description: PHP/INTERBASE Generated Data" ); 
            header("Expires: 0");        
            
            $oTipo_comprobante=new Tipo_comprobante();
            $sql=  Tipo_comprobanteModel::Sql($oTipo_comprobante);            
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