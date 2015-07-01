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
		$this->load->library('form_validation');
		$this->load->helper('url');
                // Biblioteca sesión de Carga
              //  $This ->load ->library('sesión') ;
                $this->load->model('usuarios_model');
	
              //  $this->_init();
	}
        
      /* private function _init()
	{
		$this->output->set_template('default');
                $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');

		
	}*/

        function index()
        {
       $this->load->view('usuario_view');
           
                   
        }
      
        function very_user($user)
        {
            $variable=  $this->usuarios_model->very($user, 'usuario');
            if($variable==true){
                return FALSE; 
            }
            else{
                return TRUE;
            }
        }
        
        function very_contraseña($contrasena)
        {
            $variable=  $this->usuarios_model->very($contrasena, 'contraseña');
            if($variable==true){
                return FALSE; 
            }
            else{
                return TRUE;
            }
        }
        
        public function very_sesion()
        {
            if($this->input->post('submit'))
            {
                $variable= $this->usuarios_model->very_sesion();
                if($variable==true)
                {
                    $varibales=  array('usuario'=>  $this->input->post('user'));
                    $this->session->set_userdata($variable);
                    redirect(base_url('panel'));
                   
                }
                else
                {
                    $data= array('mensaje'=>'El usuario /contraseña no son correctos');
                    $this->load->view('usuario_view', $data);
                }
            }
            else
            {
                redirect(base_url().'Usuarios');
            }
        }
                
       //-------------------------------------------------------
        
        // Check for user login process
        public function user_login_process() {

        $this->form_validation->set_rules('usuario', 'usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['proyecto'])) {
                $this->load->view('proyecto');
            } else {
                $this->load->view('usuario_view');
            }
        } else {
            $data = array(
                'usuario' => $this->input->post('usuario'),
                'password' => $this->input->post('password')
            );
            $result = $this->usuarios_model->login($data);
            if ($result == TRUE) {

                $usuario = $this->input->post('usuario');
                $result = $this->usuarios_model->read_user_information($usuario);
                if ($result != false) {
                    $session_data = array(
                        'usuario' => $result[0]->usuario,
                        'password' => $result[0]->password,
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('proyecto');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('Registro_usuario', $data);
            }
        }
    }

// Logout from admin page
    public function logout() {

// Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('usuario_view', $data);
    }

}

        

?>
