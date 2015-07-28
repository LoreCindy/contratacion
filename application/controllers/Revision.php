<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Revision
 *
 * @author cindy
 */
class Revision extends CI_Controller{
    
  
    function __construct() 
	{
		
		parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');
                
               //$this -> load -> library ( 'dependent_dropdown' );


		/* Añadimos el helper al controlador */
		$this->load->helper('url');
                
                $this->_init();
                
                
                
                
             
	}
        
        private function _init()
	{
		$this->output->set_template('default');
                $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');

		
	}

	/*
	 * 
 	 **/
	function index()
	{
		

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('revision');

			/* Le asignamos un nombre */
			$crud->set_subject('Revision');
                        $crud->set_primary_key('id_revision','revision');
                        //------------------------------------------------------------------------------                           
                        /* aqui indicamos la llave primaria de la tabla relacion  */
                        $crud->set_primary_key('id_proyecto', 'proyecto');
                         /* aqui indicamos las relaciones de la tabla formato lista */
                        $crud->set_relation('Proyecto_id_proyecto', 'proyecto', 'nombre_proyecto');
                         //----------------------------------------------------------------------------------    
                         //$crud->set_primary_key('id_formato','formatolista');
                         $crud -> set_relation ('formatoLista_id_formato' , 'formatolista' , 'nombre_formato') ;
                     	/* Asignamos el idioma español */
			$crud->set_language('spanish');
                        $crud->fields('nombre_revision', 'obdervaciones', 'Proyecto_id_proyecto', 'formatoLista_id_formato', 'datos_generales_id_datos_generales', 'formato_legalizacion_id_formato_legalizacion');
                 	/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('formatoLista_id_formato', 'datos_generales_id_datos_generales', 'formato_legalizacion_id_formato_legalizacion');
                        $crud->edit_fields('nombre_revision', 'obdervaciones', 'Proyecto_id_proyecto', 'formatoLista_id_formato');
                        
                        /* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns( 'id_revision', 'nombre_revision','obdervaciones','Proyecto_id_proyecto','formatoLista_id_formato', 'datos_generales_id_datos_generales', 'formato_legalizacion_id_formato_legalizacion');
                        $crud->display_as('id_revision','identificador')
                             ->display_as('nombre_revision','Nombre revision')
                             ->display_as('obdervaciones','Observaciones')
                             ->display_as('Proyecto_id_proyecto','Proyecto')
                             ->display_as('formatoLista_id_formato','Formato Lista')
                             ->display_as('datos_generales_id_datos_generales','Datos Generales')
                            ->display_as('formato_legalizacion_id_formato_legalizacion','Formato Legalizaciòn');
                         // $crud->set_primary_key('id_datos_generales', 'datos_generales');
                        $crud->set_relation('datos_generales_id_datos_generales','datos_generales','nombre_dato');
			//$crud->set_relation('id_formato','formatoLista','nombre_formato');
                        // $crud->set_primary_key('id_formato_legalizacion', 'formato_legalizacion');
			$crud->set_relation('formato_legalizacion_id_formato_legalizacion','formato_legalizacion','documentos_legalizacion');
                        
                        
                        //IF YOU HAVE A LARGE AMOUNT OF DATA, ENABLE THE CALLBACKS BELOW - FOR EXAMPLE ONE USER HAD 36000 CITIES AND SLOWERD UP THE LOADING PROCESS. THESE CALLBACKS WILL LOAD EMPTY SELECT FIELDS THEN POPULATE THEM AFTERWARDS
			$crud->callback_edit_field('datos_generales_id_datos_generales', array($this, 'empty_state_dropdown_select'));
			//$crud->callback_add_field('formato_legalizacion_id_formato_legalizacion', array($this, 'empty_city_dropdown_select'));
			$crud->callback_edit_field('formato_legalizacion_id_formato_legalizacion', array($this, 'empty_city_dropdown_select'));
                //---------------------------------------------------------
                //
                
			/* Generamos la tabla */
			$output = $crud->render();
                        //favoritos link
            
            
               $dd_data = array(
    //GET THE STATE OF THE CURRENT PAGE - E.G LIST | ADD
    'dd_state' =>  $crud->getState(),
    //SETUP YOUR DROPDOWNS
    //Parent field item always listed first in array, in this case countryID
    //Child field items need to follow in order, e.g stateID then cityID
    'dd_dropdowns' => array('formatoLista_id_formato','datos_generales_id_datos_generales'),
    'dd_dropdown' => array('formatoLista_id_formato','formato_legalizacion_id_formato_legalizacion'),
    //SETUP URL POST FOR EACH CHILD
    //List in order as per above
    'dd_url' => array('', site_url().'/revision/get_states/', site_url().'/revision/get_cities/'),
    //LOADER THAT GETS DISPLAYED NEXT TO THE PARENT DROPDOWN WHILE THE CHILD LOADS
    'dd_ajax_loader' => base_url().'ajax-loader.gif'
);
$output->dropdown_setup = $dd_data;

//-------------------------------------------------------------
       $this->load->view('proyectos/revision', $output);
                    
	}
      //CALLBACK FUNCTIONS
	function empty_state_dropdown_select()
	{
		//CREATE THE EMPTY SELECT STRING
		$empty_select = '<select name="datos_generales_id_datos_generales" class="chosen-select" data-placeholder="Select Datos Generales" style="width: 300px; display: none;">';
		$empty_select_closed = '</select>';
		//GET THE ID OF THE LISTING USING URI
		$listingID = $this->uri->segment(4);
		
		//LOAD GCRUD AND GET THE STATE
		$crud = new grocery_CRUD();
		$state = $crud->getState();
		
		//CHECK FOR A URI VALUE AND MAKE SURE ITS ON THE EDIT STATE
		if(isset($listingID) && $state == "edit") {
			//GET THE STORED STATE ID
			$this->db->select('formatoLista_id_formato','datos_generales_id_datos_generales')
					 ->from('revision')
					 ->where('id_revision', $listingID);
			$db = $this->db->get();
			$row = $db->row(0);
			$countryID = $row->formatoLista_id_formato;
			$stateID = $row->datos_generales_id_datos_generales;
			
			//GET THE STATES PER COUNTRY ID
			$this->db->select('*')
					 ->from('datos_generales')
					 ->where('formatoLista_id_formato', $countryID);
			$db = $this->db->get();
			
			//APPEND THE OPTION FIELDS WITH VALUES FROM THE STATES PER THE COUNTRY ID
			foreach($db->result() as $row):
				if($row->id_datos_generales == $stateID) {
					$empty_select .= '<option value="'.$row->id_datos_generales.'" selected="selected">'.$row->nombre_dato.'</option>';
				} else {
					$empty_select .= '<option value="'.$row->id_datos_generales.'">'.$row->nombre_dato.'</option>';
				}
			endforeach;
			
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;
		} else {
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;	
		}
	}
	function empty_city_dropdown_select()
	{
		//CREATE THE EMPTY SELECT STRING
		$empty_select = '<select name="formato_legalizacion_id_formato_legalizacion" class="chosen-select" data-placeholder="Select Formato Legalizaciòn" style="width: 300px; display: none;">';
		$empty_select_closed = '</select>';
		//GET THE ID OF THE LISTING USING URI
		$listingID = $this->uri->segment(4);
		
		//LOAD GCRUD AND GET THE STATE
		$crud = new grocery_CRUD();
		$state = $crud->getState();
		
		//CHECK FOR A URI VALUE AND MAKE SURE ITS ON THE EDIT STATE
		if(isset($listingID) && $state == "edit") {
			//GET THE STORED STATE ID
			$this->db->select('formatoLista_id_formato', 'formato_legalizacion_id_formato_legalizacion')
					 ->from('revision')
					 ->where('id_revision', $listingID);
			$db = $this->db->get();
			$row = $db->row(0);
			$stateID = $row->formatoLista_id_formato;
			$cityID = $row->formato_legalizacion_id_formato_legalizacion;
			
                        //GET THE CITIES PER STATE ID
			$this->db->select('*')
					 ->from('formato_legalizacion')
					 ->where('formatoLista_id_formato', $stateID);
			$db = $this->db->get();
			
			//APPEND THE OPTION FIELDS WITH VALUES FROM THE STATES PER THE COUNTRY ID
			foreach($db->result() as $row):
				if($row->id_formato_legalizacion == $cityID) {
					$empty_select .= '<option value="'.$row->id_formato_legalizacion.'" selected="selected">'.$row->documentos_legalizacion.'</option>';
				} else {
					$empty_select .= '<option value="'.$row->id_formato_legalizacion.'">'.$row->documentos_legalizacion.'</option>';
				}
			endforeach;
			
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;
		} else {
			//RETURN SELECTION COMBO
			return $empty_select.$empty_select_closed;	
		}
	}		
	//GET JSON OF STATES
	function get_states()
	{
		$countryID = $this->uri->segment(3);
		
		$this->db->select("*")
				 ->from('datos_generales')
				 ->where('formatoLista_id_formato', $countryID);
		$db = $this->db->get();
                    
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("value" => $row->id_datos_generales, "property" => $row->nombre_dato);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
	
	
//GET JSON OF CITIES
	function get_cities()
	{
		$stateID = $this->uri->segment(4);
		
		$this->db->select("*")
				 ->from('formato_legalizacion')
				 ->where('formatoLista_id_formato', $stateID);
		$db = $this->db->get();
		
		$array = array();
		foreach($db->result() as $row):
			$array[] = array("value" => $row->id_formato_legalizacion, "property" => $row->documentos_legalizacion);
		endforeach;
		
		echo json_encode($array);
		exit;
	}
        
   
   

    
        
}

?>
