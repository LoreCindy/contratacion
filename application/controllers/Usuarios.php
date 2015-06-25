<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuarios extends CI_Controller {
    
    function __construct() 
        {
        parent::__construct();
        
        }
        function index()
        {
            $this->load->view('usuario_view');
            
        }
        
}
?>
