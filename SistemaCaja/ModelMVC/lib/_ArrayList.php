<?php
/**
 CLASE ArrayList
 * @name    ArrayList
 * @author  Michael Scribellito
 * @version 1.0 (10/12/2011)
 */
class _ArrayList {

    /**
     * The array into which the elements of the ArrayList are stored.
     *
     * @var array 
     */
    private $data;
    
    /**
     * The size of the ArrayList (the number of elements it contains).
     *
     * @var integer 
     */
    private $size;

    /**
     * Constructs an empty list.
     */
    public function __construct() {

        $this->initialize();

    }

    /**
     * Appends the specified element to the end of this list.
     *
     * @param   mixed $element  element to be appended to this list
     * 
     * @return  boolean  true
     */
    public function add($element) {

        $this->data[] = $element;
        
        $this->size++;
        
        return true;

    }

    /**
     * Checks if the given index is in range. If not, throws an exception.
     * 
     * @param   integer $index  index to check
     * 
     * @throws  Exception
     */
    private function rangeCheck($index) {

        if (is_int($index) == false) {
            
            throw new Exception("Index must be numeric");   
            
        }

        if ($index < 0 || $index >= $this->size) {
            
            throw new Exception(sprintf("Index out of bounds: Index: %d, Size: %s", $this->size(), $index));
                    
        }

    }

    /**
     * Removes all of the elements from this list. The list will be empty after
     * this call returns.
     * 
     * @return  void
     */
    public function clear() {
        unset($this->data);
        $this->initialize();

    }

    /**
     * Returns the element at the specified position in this list.
     *
     * @param   integer $index  index of the element to return
     * 
     * @return  mixed  the element at the specified position in this list
     * 
     * @throws  Exception
     */
    public function get($index) {

        $this->rangeCheck($index);
        
        return $this->data[$index];

    }

    /**
     * Initializes this list.
     * 
     * @return  void
     */
    private function initialize() {


        $this->data = array();
        
        $this->size = 0;

    }

    /**
     * Returns true if this list contains no elements
     * 
     * @return boolean  true if this list contains no elements
     */
    public function isEmpty() {

        return $this->size == 0;

    }
    
    /**
     *
     * @return ArrayIterator 
     */
    public function iterator() {
        
        return new ArrayIterator($this->data);
        
    }
    
    /**
     * Removes the element at the specified position in this list. Shifts any
     * subsequent elements to the left (subtracts one from their indices).
     *
     * @param   integer $index  the index of the element to be removed
     * 
     * @return  mixed  the element that was removed from the list
     * 
     * @throws  Exception
     */
    public function remove($index) {
        
        $temp = null;

        $this->rangeCheck($index);
        
        $old = $this->get($index);
        
        for ($i = $index; $i < $this->size() - 1; $i++) {
            
            $this->set($i, $this->get($i + 1));
            
        }
        
        unset($this->data[$i]);
        
        $this->size--;
        
        return $old;
        
    }

    /**
     * Replaces the element at the specified position in this list with the specified element.
     * 
     * @param   integer $index  index of the element to replace
     * @param   mixed $element  element to be stored at the specified position
     * 
     * @return  mixed  the element previously at the specified position
     * 
     * @throws  Exception
     */
    public function set($index, $element) {

        $this->rangeCheck($index);
        
        $old = $this->get($index);

        $this->data[$index] = $element;
        
        return $old;

    }

    /**
     * Returns the number of elements in this list.
     * 
     * @return  int  the number of elements in this list
     */
    public function size() {

        return $this->size;

    }

    /**
     * Returns an array of this list.
     *
     * @return  array  an array of this list
     */
    public function toArray() {

        return $this->data;

    }
    
    /**
     * Returns a string representation of this list.
     *
     * @return  string  string representation of this list
     */
    public function toString() {
        
        return "[ " . implode(", ", $this->data) . " ]";
        
    }

}
/**********************************************
EJEMPLO 
**********************************************/
/*		
		class Perso{
			private $nom;
			private $apell;
			private $sexo;
			
			function setSexo($sexo){
				$this->sexo=$sexo;
			}
			function getSexo(){
				return $this->sexo;
			}
			//	
			function setNom($nom){
				$this->nom=$nom;
			}
			function getNom(){
				return $this->nom;
			}
			//
			function setApell($apell){
				$this->apell=$apell;
			}
			function getApell(){
				return $this->apell;
			}
			
				
		}
		//Data
		$lisUsuario=array(
					1=>array("nom"=>"Luis","apell"=>"Alcantara","sexo"=>"m"),
					2=>array("nom"=>"Juana","apell"=>"Torres","sexo"=>null),
					3=>array("nom"=>"Maria","apell"=>"Morales","sexo"=>null),
					4=>array("nom"=>"Lizet","apell"=>"Conteras","sexo"=>"f")
				 );
		//Almacenamos los datos en el ArrayList
		$arraLis=new ArrayList;
		foreach($lisUsuario as $dat)
		{
			$Perso=new Perso;
			  $Perso->setNom($dat["nom"]);
			  $Perso->setApell($dat["apell"]);
			  $Perso->setSexo($dat["sexo"]);
			  $arraLis->add($Perso);
		}
		//Recorremos los datos
		 foreach($arraLis->iterator() as $rod)
		 {
			echo "Nombre : ".$rod->getNom()." ".$rod->getApell().' Sexo : '.$rod->getSexo().'<br/>';	
		 }
*/		 

?>