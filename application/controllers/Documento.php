<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documento
 *
 * @author cindy
 */
class Documento extends CI_Controller {
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
			$crud->set_table('documento');

			/* Le asignamos un nombre */
			$crud->set_subject('Documento');

                         $crud->set_primary_key('idDocumento','documento');
                                //('codigoBPID','Proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
                        
                        //-----------------------------------------------------------
                         $crud->set_primary_key('id_formato_legalizacion','formato_legalizacion');
                         $crud -> set_relation ('formato_legalizacion_id' , 'formato_legalizacion' , 'documentos_legalizacion') ;
                        
                        //---------------------------------------------------------
                         
                         /* aqui indicamos el buscador de un archivo en pdf */
                         $crud->set_field_upload('archivo', 'assets/uploads/files');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                                'idDocumento',
				'nombre_Documento', 
				'archivo',
                                'fecha',
                                'formato_legalizacion_id'
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                                'idDocumento',
				'nombre_Documento', 
				'archivo',
                                'fecha',
                                'formato_legalizacion_id'
                            );
			
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
