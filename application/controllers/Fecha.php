<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Fecha extends CI_Controller {
    function __construct() 
	{		
		parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');

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
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('fecha');

			/* Le asignamos un nombre */
			$crud->set_subject('Detalle Revisión');

                         $crud->set_primary_key('idFecha','fecha');
                                //('codigoBPID','Proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                        //-------------------------------------------------------------------                       
                           /* aqui indicamos la llave primaria de la tabla relacion  */
                            $crud->set_primary_key('id_revision','revision');
                        
                        /* aqui indicamos las relaciones de la tabla formato lista*/
                       $crud -> set_relation ('revision_id_revision' , 'revision' , 'nombre_revision' ) ;
                       $crud->fields(
				'estado', 
				'fecha',
                                'nombreResponsable',
                                'dependenciaResponsable',
                                'revision_id_revision');
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                            'idFecha',
				'estado', 
				'fecha',
                                'nombreResponsable',
                                'dependenciaResponsable',
                                'revision_id_revision'
                              
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                               'idFecha',
				'estado', 
				'fecha',
                                'nombreResponsable',
                                'dependenciaResponsable',
                                'revision_id_revision'
                            );
                        $crud->display_as('idFecha','Identificador')
                               ->display_as('estado','Estado')
                               ->display_as('nombreResponsable','Nombre Responsable')
                               ->display_as('dependenciaResponsable','Dependencia Responsable')
                               ->display_as('revision_id_revision','Revisión');
                        
			$crud->field_type('estado','dropdown',
                        array('1' => 'Recibido', '2' => 'Devolucion', '3'=>'Aprobado') );
                        
                        /*
                         * colorear estado de un registro
                         */
                        $crud ->callback_column ( 'estado' , array ( $this ,  '_callback_status' ));
                        
                        
                        
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/fechas', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
        
        public function _callback_status($value, $fila) {

        if( $value == 1 ) {
            return'<div style = "color: blue;"> Recibido </ div>';
        }
        else if($value==2){
            return'<div style = "color: red;"> Devolucion </ div>';
        }
        else if($value==3){
            return'<div style = "color: black;"> Aprobado </ div>';
        }
    }
    private $colDetalle = array();
    public function detalle(Revision $detalle){
        $this->colDetalle[]=$detalle;
    }

}


?>
