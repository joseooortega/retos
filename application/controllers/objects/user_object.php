<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class
 */

class User_object //extends MY_Controller
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
    //$this->load->model('user', 'user_model');
    if (gettype($atributes) == 'array')
    foreach ($atributes as $key => $value) {
      $this->$key = $value;
    }
  }


  // FUNCTIONS //

  public function login(){
    //$user = $this->user_model->get_userByUsername($this->username);
    die(var_dump('pepe'));
    return true;
  }
  public function lvl_update($num){
    //$this->$nivel = $this->$nivel + $num;
    $this->actualizar();
  }
  public function actualizar(){
    $usr = get_object_vars($this);
    //$this->user->update($usr);
  }


  // Setters and Getters //

  public function set_id($atr){
    $this->u_id = $atr;
  }public function set_password($atr){
    $this->password = $atr;
  }public function set_username($atr){
    $this->username = $atr;
  }public function set_nombre($atr){
    $this->nombre = $atr;
  }public function set_apellidos($atr){
    $this->apellidos = $atr;
  }public function set_nivel($atr){
    $this->nivel = $atr;
  }public function set_siguiente_nivel($atr){
    $this->siguiente_nivel = $atr;
  }public function set_role($atr){
    $this->role = $atr;
  }

  public function get_id(){
    return $this->u_id;
  }public function get_username(){
    return $this->username;
  }public function get_password(){
    return $this->password;
  }public function get_nombre(){
    return $this->nombre;
  }public function get_apellidos(){
    return $this->apellidos;
  }public function get_nivel(){
    return $this->nivel;
  }public function get_siguiente_nivel(){
    return $this->siguiente_nivel;
  }public function get_role(){
    return $this->role;
  }
}
