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
			$crud->set_table('revision');

			/* Le asignamos un nombre */
			$crud->set_subject('Revision');

                         $crud->set_primary_key('id_revision','revision');
                                //('codigoBPID','Proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                                'id_revision',
				'nombreDependenciaResponsable', 
				'nombre_listaChequeo',
                                'informacionGeneral',
                                'lista_legalizacion_id',
                                'obdervaciones',
                                'formato_id',
                                'Proyecto_id_proyecto'
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns( 
                                'id_revision',
				'nombreDependenciaResponsable', 
				'nombre_listaChequeo',
                                'informacionGeneral',
                                'lista_legalizacion_id',
                                'obdervaciones',
                                'formato_id',
                                'Proyecto_id_proyecto'
                            );
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/revision', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}



?>