<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Signup_model extends CI_Model { 
  function __construct() { 
    parent::__construct(); 
  } 

  public function add($data) { 
    if ($this->db->insert('signups', $data)) {
      return true;
    } else {
      return false;
    }
  } 

  public function edit($data) {
    $this->db->where('signup_email', $data['signup_email']);
    if ($this->db->update('signups', $data)) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($data) {
    $this->db->where('signup_email', $data['signup_email']);
    if ($this->db->delete('signups')) {
      return true;
    } else {
      return false;
    }
  }

  public function get_settings($email) {
    $this->db->where('signup_email', $email);
    $query = $this->db->get('signups');
    if ($query) {
      return $query;
    } else {
      return false;
    }
  }
} 