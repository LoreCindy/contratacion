<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class usuarios_model  extends CI_Model {
    // Insertar los datos de registro en la base de datos
 function login($usuario, $password)
 {
   $this -> db -> select('id_usuario,nombres_usuario, apellidos_usuario, usuario, password, email');
   $this -> db -> from('usuario');
   $this -> db -> where('usuario', $usuario);
   $this -> db -> where('password',$password);
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>