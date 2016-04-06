<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function get_all_users() {
    return $this->db->get('users');
  } 

  function process_create_user($data) {
    if ($this->db->insert('users', $data)) {
    	return $this->db->insert_id();
    } else {
    	return false;
    }
  }    
  
  function process_update_user($id, $data) {
    $this->db->where('usr_id', $id);
    if ($this->db->update('users', $data)) {
      return true;
    } else {
      return false;
    }
  }

  function get_user_details($id) {
    $this->db->where('usr_id', $id);
    $result = $this->db->get('users');

    if ($result) {
    	return $result;
    } else {
    	return false;
    }
  }

  function get_user_details_by_email($email) {
    $this->db->where('usr_email', $email);
    $result = $this->db->get('users');

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  function delete_user($id) {
    if($this->db->delete('users', array('usr_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }

  function make_code() {
    do {
      $url_code = random_string('alnum', 8); 

      $this->db->where('usr_pwd_change_code = ', $url_code);
      $this->db->from('users');
      $num = $this->db->count_all_results();
    } while ($num >= 1);

    return $url_code;
  }

  function count_results($email) {
    $this->db->where('usr_email', $email);
    $this->db->from('users');
    return $this->db->count_all_results();
  } 

  function update_user_password($data) {
    $this->db->where('usr_id', $data['usr_id']);  
    if ($this->db->update('users', $data)) {
        return true;
    } else {
        return false;
    }
  }

  function does_code_match($data, $email) {
    $query = "SELECT COUNT(*) AS `count` 
                    FROM `users` 
                    WHERE `usr_pwd_change_code` = ?
                    AND `usr_email` = ? ";

    $res = $this->db->query($query, array($data['code'], $email));

    foreach ($res->result() as $row) {
      $count = $row->count;
    }

    if ($count == 1) {
        return true;
    } else {
        return false;
    }
  }  

  function update_user_code($data) {
    $this->db->where('usr_email', $data['usr_email']);  
    if ($this->db->update('users', $data)) {
        return true;
    } else {
        return false;
    }
  }
}
