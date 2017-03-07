<?php

/**
 * User class
 */
class User_object extends MY_Controller
{
  private $u_id;
  private $username;
  private $password;
  private $nombre;
  private $apellidos;
  private $nivel;
  private $siguiente_nivel;
  private $role;


  function __construct($atributes = array())
  {

    if (gettype($atributes) == 'array')
    foreach ($atributes as $key => $value) {

      $this->$key = $value;
    }
  }

  private function log_in($hash){
    $this->load->model('user_model');
    $this->user_model->log_in($hash);
  }

  public function set_password($atr){
    $this->password = $atr;
  }
  public function set_username($atr){
    $this->username = $atr;
  }

  public function get_id(){
    return $this->u_id;
  }
  public function get_username(){
    return $this->username;
  }
  public function get_password(){
    return $this->password;
  }
  public function get_role(){
    return $this->role;
  }
}
