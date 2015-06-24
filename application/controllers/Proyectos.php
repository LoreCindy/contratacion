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

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');

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
				'nombre_proyecto', 
				'codigoBPID',
                                'nombre_modalidad',
                                'nombre_tipocontratacion'
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns('id_proyecto',
				'nombre_proyecto', 
				'codigoBPID',
                                'nombre_modalidad',
                                'nombre_tipocontratacion'
                            );
                        
			$crud->display_as('nombre_proyecto','Nombre del proyecto')
                             ->display_as('codigoBPID','Codigo BPID')
                             ->display_as('nombre_modalidad','Nombre de la modalidad')
                             ->display_as('nombre_tipocontratacion','Tipo Contratacion');
                        
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/administracion', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}



?>
