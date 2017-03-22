<?php

class User extends CI_Model {

  public function __construct() {
          parent::__construct();
  }

  private $table = 'user';

  public function new($data){
    $this->db->insert($this->table, $data);
  }

  public function update($data) {
    $this->db->update($this->table, $data, array('id' => $data['id']));
  }

  public function delete($id, $permanent = false) {
    if ($permanent == true) {
      $this->db->delete($this->table, array('id' => $id));
    } else {
      $this->db->update($this->table, array('status' => 'disabled'), array('id' =>$id));
    }
  }

  public function get_userByUsername($username){
    $this->db->where(array('username' => $username));
    $query = $this->db->get();
    return $query->result_array();
  }
}
