<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuarios extends CI_Controller {
    
    function __construct() 
        {
        parent::__construct();
        
        /* Añadimos el helper al controlador */
        /* Cargamos la libreria*/
		$this->load->library('grocery_crud');
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

        function index()
        {
       $this->load->view('usuario_view');
           
                   
        }
        
        public  function  registro(){
          
         $this->load->view('registro_view');
        }
}
?>
