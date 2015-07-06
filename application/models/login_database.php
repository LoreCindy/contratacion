<?php

Class Login_Database extends CI_Model {
    
public function __construct() {
            parent::__construct();
    }

// Insert registration data in database
public function registration_insert($username, $hash) {
$data = array(
			'username'		=>		$username,
			'password'		=>		$hash
		);
// Query to check whether username already exist or not
$condition = "username =" . "'" . $username  . "'";
$this->db->select('*');
$this->db->from('users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('users', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($username,$hash) {

/*$condition = "username =" . "'" . $username . "' AND " . "password =" . "'" . $hash . "'";
$this->db->select('*');
$this->db->from('users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();*/
    
    $this->db->where('username',$username);
    $query = $this->db->get('users');
 
if ($query->num_rows() == 1) {
     
   $user = $query->row();
           //en pass guardamos el hash del usuario que tenemos en la base
           //de datos para comprobarlo con el método check_password de Bcrypt
			$pass = $user->password;
 
          //esta es la forma de comprobar si el password del 
          //formulario coincide con el codificado de la base de datos
			if($this->bcrypt->check_password($hash, $pass))
			{
				return $query->row();
			}else{
                            return false;
			//$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			//redirect(base_url().'index.php/user_authentication/user_login_process','refresh'); 
} 
}}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "username =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

}

?>