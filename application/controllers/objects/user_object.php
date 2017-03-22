<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
    $this->load->model('user', 'user_model');
    if (gettype($atributes) == 'array')
    foreach ($atributes as $key => $value) {
      $this->$key = $value;
    }
  }


  // FUNCTIONS //

  private function login(){
    $user = $this->user_model->get_userByUsername($this->username);
    die(var_dump($user));
    return true;
  }
  private function lvl_update($num){
    $this->$nivel = $this->$nivel + $num;
    $this->actualizar();
  }
  private function actualizar(){
    $usr = get_object_vars($this);
    $this->user->update($usr);
  }


  // Setters and Getters //

  private function set_id($atr){
    $this->u_id = $atr;
  }private function set_password($atr){
    $this->password = $atr;
  }private function set_username($atr){
    $this->username = $atr;
  }private function set_nombre($atr){
    $this->nombre = $atr;
  }private function set_apellidos($atr){
    $this->apellidos = $atr;
  }private function set_nivel($atr){
    $this->nivel = $atr;
  }private function set_siguiente_nivel($atr){
    $this->siguiente_nivel = $atr;
  }private function set_role($atr){
    $this->role = $atr;
  }

  private function get_id(){
    return $this->u_id;
  }private function get_username(){
    return $this->username;
  }private function get_password(){
    return $this->password;
  }private function get_nombre(){
    return $this->nombre;
  }private function get_apellidos(){
    return $this->apellidos;
  }private function get_nivel(){
    return $this->nivel;
  }private function get_siguiente_nivel(){
    return $this->siguiente_nivel;
  }private function get_role(){
    return $this->role;
  }
}
