<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Urls_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function save_url($data) {
    /*
    Let's see if the unique code already exists in 
    the database.  If it does exist then make a new 
    one and we'll check if that exists too.  
    Keep making new ones until it's unique.  
    When we make one that's unique, use it for our url 
    */
    do {
      $url_code = random_string('alnum', 8); 

      $this->db->where('url_code = ', $url_code);
      $this->db->from('urls');
      $num = $this->db->count_all_results();
    } while ($num >= 1);

    $query = "INSERT INTO `urls` (`url_code`, `url_address`) VALUES (?,?) ";
    $result = $this->db->query($query, array($url_code, $data['url_address']));

    if ($result) {
      return $url_code;
    } else {
      return false;
    }
  }

  function fetch_url($url_code) {
    $query = "SELECT * FROM `urls` WHERE `url_code` = ? ";
    $result = $this->db->query($query, array($url_code));
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }    
}
