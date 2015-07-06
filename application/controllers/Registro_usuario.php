<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registro_usuario
 *
 * @author cindy
 */
class Registro_usuario extends CI_Controller {
    
    function __construct() 
        {
        parent::__construct();
        
        /* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');

        /* Añadimos el helper al controlador */
		$this->load->helper('url');
	
                //$this->_init();
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
                         // $crud->set_theme('bootstrap');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('users');

			/* Le asignamos un nombre */
			$crud->set_subject('users');

                         $crud->set_primary_key('id','users');
                                //('codigoBPID','Proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                        //  $crud->set_rules('password','buy Price','numeric');
                       
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(	
                          	'username',
                               'password'                              
                              
                            );

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                              'username',
                               'password'
                            );
                        
                        $crud->display_as('username','Usuario');
                         $crud->display_as('password','Password');
                      // $crud->set_rules('username','Usuario','md5');
                        
                       /*esta linea permite convertir el campo en tipo password*/
                       $crud->field_type('password', 'password');
                       $crud -> change_field_type('password','password');
                  
                     $crud->callback_insert(array($this,'encrypt_password_and_insert_callback'));
                       /*esta linea permite ocultar el listar y el boton de listar*/
                       $crud->unset_list();
                       $crud->unset_back_to_list();
                      
			/* Generamos la tabla */
			$output = $crud->render();
			
                       
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('registro_view', $output);
			
		}catch(Exception $e){
                    
                        if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
                        {
                            redirect(strtolower(__CLASS__).'/'.strtolower(__FUNCTION__).'/add');
                        }
                        else
                        {
                           /* Si algo sale mal cachamos el error y lo mostramos */
                                 show_error($e->getMessage().' --- '.$e->getTraceAsString());
                        }                       
                        
                }
                
                 
	}
        
        function encrypt_password_and_insert_callback($post_array) {
  $this->load->library('encrypt');
  $key = 'super-secret-key';
  $post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
 
  return $this->db->insert('users',$post_array);
}        
                
}

?>
