<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   
                 $this->load->library('grocery_crud');

		/* Añadimos el helper al controlador */
		$this->load->helper('url');
              //  $this->_init();
 }
 /*private function _init()
	{
		$this->output->set_template('default');
                $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');

		
	}*/
 function index()
 {
   $this->load->helper(array('form'));
   $this->load->view('login_view');
 }
 
}
 
?>
