<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of panel
 *
 * @author cindy
 */
class panel extends CI_Controller {
    
   function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['usuario'] = $session_data['usuario'];
     $this->load->view('proyecto', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('home_view', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
 
?>