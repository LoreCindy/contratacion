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
                   //------------------------------------------------------------------------------                           
                           /* aqui indicamos la llave primaria de la tabla relacion  */
                          $crud->set_primary_key('id_formato','formatolista');
                        
                        /* aqui indicamos las relaciones de la tabla formato lista*/
                       $crud -> set_relation ('formato_id' , 'formatolista' , 'nombre_formato' ) ;
                    //----------------------------------------------------------------------------------    
                      
                       //------------------------------------------------------------------------------                           
                           /* aqui indicamos la llave primaria de la tabla relacion  */
                           $crud->set_primary_key('id_proyecto','proyecto');
                        
                        /* aqui indicamos las relaciones de la tabla formato lista*/
                       $crud -> set_relation ('Proyecto_id_proyecto' , 'proyecto' , 'nombre_proyecto' ) ;
                    //----------------------------------------------------------------------------------    
                         $crud->set_primary_key('id_lista_legalizacion','listalegalizacion');
                        
                         $crud -> set_relation ('lista_legalizacion_id' , 'listalegalizacion' , 'supervisor') ;
                         
                       
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                                'id_revision',
                                'nombre_revision',
				'dependencia_responsable', 
				'informacionGeneral',
                                'lista_legalizacion_id',
                                'obdervaciones',
                                'formato_id',
                                'Proyecto_id_proyecto'
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns( 
                                 'id_revision',
                                'nombre_revision',
				'dependencia_responsable', 
				'informacionGeneral',
                                'lista_legalizacion_id',
                                'obdervaciones',
                                'formato_id',
                                'Proyecto_id_proyecto'
                            );
                        
                        $crud->display_as('id_revision','identificador')
                             ->display_as('Proyecto_id_proyecto','Proyecto')
                             ->display_as('lista_legalizacion_id','legalizacion');
			
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
