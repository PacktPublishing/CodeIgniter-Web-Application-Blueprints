<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function get_tasks() {
    $query = "SELECT * FROM `tasks` ";

    $result = $this->db->query($query);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }   

  function change_task_status($task_id, $save_data) {
    $this->db->where('task_id', $task_id);
    if ($this->db->update('tasks', $save_data)) {
      return true;
    } else {
      return false;
    }
  }

  function save_task($save_data) {
    if ($this->db->insert('tasks', $save_data)) {
      return true;
    } else {
      return false;
    }
  }

  function get_task($id) {
    $this->db->where('task_id', $id);
    $result = $this->db->get('tasks');
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  function delete($id) {
    $this->db->where('task_id', $id);
    $result = $this->db->delete('tasks');
    if ($result) {
      return true;
    } else {
      return false;
    }

  }
}