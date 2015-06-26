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
    
    public function _construct(){
        parent::_construct();
        $this->very_sesion();
    }
    public function index()
    {
        echo "hola mundisimo:".$this->session->userdata('usuario');
        
    }
    
    public function very_sesion()
    {
        if($this->session->userdata('usuario'))
        {
            redirect(base_url().'usuarios');
        }
    }
    //put your code here
}

?>
