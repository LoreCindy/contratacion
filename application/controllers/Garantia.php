<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Garantia
 *
 * @author cindy
 */
class Garantia extends CI_Controller {
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
			/*$crud->set_theme('flexigrid');*/
                        
                       $crud->set_theme('bootstrap');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('garantia');

			/* Le asignamos un nombre */
			$crud->set_subject('Garantia');

                         $crud->set_primary_key('idGarantia','garantia');
                                //('codigoBPID','Proyecto');
                        
                         //-------------------------------------------------------------------------------    
                         $crud->set_primary_key('id_formato_legalizacion','formato_legalizacion');
                        
                         $crud -> set_relation ('formato_legalizacion_id_formato_legalizacion' , 'formato_legalizacion' , 'documentos_legalizacion') ;
                         
                     //---------------------------------------------------------------------------      
                         
                      //-------------------------------------------------------------
                          $crud->set_primary_key('idDocumento','documento');
                          $crud -> set_relation ('Documento_idDocumento' , 'documento' , 'nombre_Documento') ;
                         
                          $crud->set_primary_key('id_revision','revision');
                          $crud -> set_relation ('revision_id_revision' , 'revision' , 'nombre_revision') ;
                         
                         
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                                'idGarantia',
				'descripcion_documento', 
				'TipoGarantia',
                                'Documento_idDocumento',
                                'aseguradora',
                                'numero_garantia',
                                'porcentaje',
                                'tiempo_año',
                                'valor',
                                'vigencia',
                                'Aplica',
                                'revision_id_revision',
                                'formato_legalizacion_id_formato_legalizacion'
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                                'idGarantia',
				'descripcion_documento', 
				'TipoGarantia',
                                'Documento_idDocumento',
                                'aseguradora',
                                'numero_garantia',
                                'porcentaje',
                                'tiempo_año',
                                'valor',
                                'vigencia',
                                'Aplica',
                                'revision_id_revision',
                                'formato_legalizacion_id_formato_legalizacion'
                            );
			$crud->display_as('idGarantia','Identificador')
                                ->display_as('descripcion_documento','Descripcion del documento')
                                ->display_as('TipoGarantia','Tipo Garantia')
                                ->display_as('Documento_idDocumento','Documento')
                                ->display_as('numero_garantia','N° Garantia')
                                ->display_as('tiempo_año','Año')
                                ->display_as('revision_id_revision','Nombre revisión')
                                ->display_as('formato_legalizacion_id_formato_legalizacion','Formato Legalización');
                             
                              
                        $crud->field_type('TipoGarantia','dropdown',
                        array('1' => 'Concomitante de la garantia', '2' => 'seguridad social','3' => 'certificado de salud' , '4' => 'parafiscales', '5' => 'cuentas bancarias', '6' => 'otros') );
			
                        $crud->field_type('Aplica','dropdown',
                        array('1' => 'Si', '2' => 'No') );
                        $crud->set_rules('numero_garantia','N° Garantia','numeric');
                        $crud->set_rules('porcentaje','Porcentaje','numeric');
                        $crud->set_rules('tiempo_año','Año','numeric');
                        $crud->set_rules('valor','Valor','numeric');
                     
                        /* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/formato_legalizacion', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}



?>

