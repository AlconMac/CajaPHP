<?php
//Controlodor - TIPO_MONEDA
 //Fecha: 2012-12-29 
 //Autor: ALCON 
 //Lima - Perú 

include_once 'LibreriasMVC/_Form.php';
include_once 'LibreriasMVC/_Crifrado.php';
include_once 'ModelMVC/_QueryModel.php';
include_once 'EntidadMVC/Tipo_moneda.php';
include_once 'ModelMVC/Tipo_monedaModel.php';			
	
class tipo_monedaControl extends _Form { 

 	
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
        $oTipo_moneda=new Tipo_moneda();
        $sql=  Tipo_monedaModel::Sql($oTipo_moneda);
        $pag=(isset($_GET['pag']))?$_GET['pag']:1;
        $queryPg=new _QueryModel($pag);
        $queryPg->query($sql,10);//se mostrara de 10 en 10 registros           
        $listObjeto=$queryPg->ArrayListObjeto(new Tipo_moneda);
        $data['lista']=$listObjeto;
        $data['paginacion']=$queryPg->getPageGroup('?ctr=tipo_moneda&pag=',3, 'paginacion');
        //
		$this->view->ver('tipo_monedaListar.php',$data);	
	}
		
 	
	//Formulario
    public function form($textAlerta=null){
    	$data=array();
        $data['textAlerta']=$textAlerta;
        $data['token']=  self::TokenWrite();
        $data['updateix']=  self::idUpdateWrite();
        if(self::idUpdate()!=null){
        	$oTipo_moneda=new Tipo_moneda();
            $oTipo_moneda->setIdmone(self::idUpdate());
            $objForm= Tipo_monedaModel::Buscar($oTipo_moneda);               
        }else{               
        	$objForm=new Tipo_moneda(); 
        }
        
		$data['objForm']=$objForm;
	    $this->view->ver('form/tipo_monedaForm.php',$data);	               
     }
		
 	
	//Control Guardar 
 	public function guardar(){
		 
 	 	$nombre=(self::POST('txtnombre'))?self::ScapeString($_POST['txtnombre']):'';
 	 	$iniciales=(self::POST('txtiniciales'))?self::ScapeString($_POST['txtiniciales']):''; 
            //           
           if($nombre!="")
           {
              if(self::validaToken())
              {
                $oTipo_moneda=new Tipo_moneda();
 	 	 	 	$oTipo_moneda->setNombre($nombre);
 	 	 	 	$oTipo_moneda->setIniciales($iniciales);

                
                $idUpdate=  _Form::validaIdUpdate();
                if($idUpdate!=null){
                   $id=$idUpdate; // _Crifrado::desencriptar($idUpdate, 'formTipo_monedaUpdate');
                   if(is_numeric($id)){
                       $oTipo_moneda->setIdmone($id);
                        if(Tipo_monedaModel::Actualizar($oTipo_moneda)){
                            $textAlerta='Datos actualizados correctamente'; 
                        }else{
                            $textAlerta='Erro al intentar actualizar los datos'; 
                        }                       
                   }else{
                       $textAlerta='Erro al intentar actualizar los datos!';
                   }
                }else{
                    if(Tipo_monedaModel::Guardar($oTipo_moneda)){
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
                $oTipo_moneda=new Tipo_moneda();
                $oTipo_moneda->setIdmone($id);
                if(Tipo_monedaModel::Eliminar($oTipo_moneda))
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
            header("Content-Disposition: attachment; filename=Tipo_moneda.xls" ); 
            header("Content-Description: PHP/INTERBASE Generated Data" ); 
            header("Expires: 0");        
            
            $oTipo_moneda=new Tipo_moneda();
            $sql=  Tipo_monedaModel::Sql($oTipo_moneda);            
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