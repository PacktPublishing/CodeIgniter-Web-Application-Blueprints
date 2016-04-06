<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function get_jobs($search_string) {
    if ($search_string == null) {
      $query = "SELECT * FROM `jobs` WHERE DATE(NOW()) < DATE(`job_sunset_date`) ";
    } else {
      $query = "SELECT * FROM `jobs` WHERE `job_title` LIKE ? 
                OR `job_desc` LIKE ? AND DATE(NOW()) < DATE(`job_sunset_date`)";
    }

    $result = $this->db->query($query, array($search_string, $search_string));
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }   

  function get_job($job_id) {
    $query = "SELECT * FROM `jobs`, `categories`, `types`, `locations` WHERE 
              `categories`.`cat_id` = `jobs`.`cat_id` AND
              `types`.`type_id` = `jobs`.`type_id` AND
              `locations`.`loc_id` = `jobs`.`loc_id` AND
              `job_id` = ? AND
              DATE(NOW()) < DATE(`job_sunset_date`) ";
    
    $result = $this->db->query($query, array($job_id));
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  } 

  function save_job($save_data) {
    if ($this->db->insert('jobs', $save_data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  function get_categories() {
    return $this->db->get('categories');
  }
  
  function get_types() {
    return $this->db->get('types');
  }
  
  function get_locations() {
    return $this->db->get('locations');
  }
}
