<?php
//session_start(); //we need to start session in order to access it through CI
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_authentication
 *
 * @author Paula
 */
class User_authentication extends CI_Controller {
    

    public function __construct() {
   parent::__construct();

//Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');
// Load database
$this->load->model('login_database');

$this->load->library('bcrypt');//cargamos la librería

}

// Show login page
public function index() {
    $data['titulo'] = 'login seguro en codeigniter con Bcrypt';
    $data['token'] = $this->token();
    $this->load->view('login_form', $data);
}

public function exito() {
    $data['message_display'] = 'Se ha registrado el usuario con exito!';
    $data['titulo'] = 'login seguro en codeigniter con Bcrypt';
    $data['token'] = $this->token();
    $this->load->view('login_form', $data);
}



public function error_message() {
    $data ['error_message']= 'Invalido Usuario o Password';
    $data['titulo'] = 'login seguro en codeigniter con Bcrypt';
    $data['token'] = $this->token();
    $this->load->view('login_form', $data);
}

//creamos la clave aleatoria para agregar seguridad a nuestro formulario
  public function token()
  {
    $token = md5(uniqid(rand(),true));
    $this->session->set_userdata('token',$token);
    return $token;
  }
  
// Show registration page
public function user_registration_show() {
  
    $data['titulo'] = 'registro seguro en codeigniter con Bcrypt';
    $data['token'] = $this->token();
$this->load->view('registration_form',$data);
}
public function user_registration() {
    $data['message_display'] = 'usuario ya existe!';
    $data['titulo'] = 'registro seguro en codeigniter con Bcrypt';
    $data['token'] = $this->token();
$this->load->view('registration_form',$data);
}

// Validate and store registration data in database
public function new_user_registration() {
 if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
    {
// Check validation for user input in SignUp form
//$this->form_validation->set_rules('username', 'Username', 'trim|required');
$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
$this->form_validation->set_rules('passconf', 'Confirmar contraseña', 'trim|required');

 //lanzamos mensajes de error si es que los hay
//$this->form_validation->set_message('required','El campo es requerido');
//$this->form_validation->set_message('min_length', 'El campo debe tener al menos 6 carácteres');
$this->form_validation->set_message('matches', 'Las contraseñas no coinciden. ¿Quieres volver a intentarlo?');

if ($this->form_validation->run() == FALSE) {
$this->user_registration_show();  
} else {
$data = array(
'username' => $this->input->post('username'),
'password' => $this->input->post('password')
);
$username = $data['username'] ;
$password = $data['password'] ;
$hash = $this->bcrypt->hash_password($password);

 //comprobamos si el password se ha encriptado
        if ($this->bcrypt->check_password($password, $hash))
        {
            $insert_password = $this->login_database->registration_insert($username,$hash);
          if($insert_password)
          {
          
            $this->exito();
//$this->load->view('login_form', $data);
          }
        
        else
        {
            
            $this->user_registration();
            //$this->load->view('registration_form', $data);   
        }
}
    }
}
}

// Check for user login process
public function user_login_process() {
if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
    {
$this->form_validation->set_rules('username', 'Username', 'trim|required');
$this->form_validation->set_rules('password', 'Password', 'trim|required');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
    $this->load->view('themes/default');
    //$this->load->view('themes/default', $output);
  
}else{
$this->index(); 
}
} else {
$username = $this->input->post('username');
$password = $this->input->post('password');

$result = $this->login_database->login($username,$password);
if ($result == TRUE) {
$username = $this->input->post('username');
$result = $this->login_database->read_user_information($username);
if ($result != false) {
$session_data = array(
'username' => $result[0]->username,
);
// Add user data in session
$this->session->set_userdata('logged_in', $session_data);
$this->load->view('themes/default');
redirect('welcome/index');

}
} else {

$this->error_message();
}
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
$data['message_display'] = '';
$this->index($data);
//$this->load->view('login_form');
}
}

?>
