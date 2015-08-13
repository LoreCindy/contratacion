<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proyectos
 *
 * @author cindy
 */
class Proyectos extends CI_Controller {
    function __construct() 
	{
		
		parent::__construct();
                $this->session->userdata['logged_in'];


		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');
                
                // Load database
                $this->load->model('login_database');

		/* Añadimos el helper al controlador */
		$this->load->helper('url');
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
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('proyecto');

			/* Le asignamos un nombre */
			$crud->set_subject('Proyecto');

                         $crud->set_primary_key('id_proyecto','proyecto');
                                //('codigoBPID','Proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                                'id_proyecto',
				'fecha_radicacion', 
				'nombre_contratista',
                                'nombre_modalidad',
                                'nombre_tipoContratacion'
                            );
			$crud->columns('id_proyecto',
				'fecha_radicacion', 
				'nombre_contratista',
                                'nombre_modalidad',
                                'nombre_tipoContratacion'
                            );
                        
			$crud->display_as('id_proyecto','radicación')
                             ->display_as('fecha_radicacion','Fecha radicación')
                                 ->display_as('nombre_contratista','Nombre contratista o Contrato')
                             ->display_as('nombre_modalidad','Nombre de la modalidad')
                             ->display_as('nombre_tipoContratacion','Tipo Contratacion');
                        
                        $crud->field_type('nombre_modalidad','dropdown',
                        array('1' => 'Seleccion abreviada', '2' => 'Concurso de meritos','3' => 'Licitacion publica' , '4' => 'Contratacion minima cuantia', '5' => 'Regimen especial', '6' => 'Contratacion directa') );
			
                         $crud->field_type('nombre_tipoContratacion','dropdown',
                        array('1' => 'Convenio', '2' => 'Contrato') );
			
			/* Generamos la tabla */
			$output = $crud->render();
			//$this->proyectos();
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/administracion', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
        
         public function proyectos()
        {
           
            $insert_password= $this->login_database->get_list_proyectos();
            if($insert_password== true)
          {
           $data['display'] = 'true';
           $this->load->view('themes/default', $data);   
          
          }
        else
        {
            $data['display'] = 'false';
            $this->load->view('themes/default', $data);  
            
        }
        }
        
        
        
      /*  
// FancyBox PRUEBA 
public function _callback_phone ( $value , $fila ) 
{ 
  return  "<a href='http://www.grocerycrud.com/assets/themes/default/images/logo.png' class='fancybox'> $ valor </a> " ; 
}*/
}



?>
