<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  
  public function register_user($data) {
    if ($this->db->insert('users', $data)) {
      return true;
    } else {
      return false;
    }
  }
}