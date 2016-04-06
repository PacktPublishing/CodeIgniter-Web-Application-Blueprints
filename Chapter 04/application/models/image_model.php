<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function save_image($data) {
    do {
      $img_url_code = random_string('alnum', 8); 

      $this->db->where('img_url_code = ', $img_url_code);
      $this->db->from('images');
      $num = $this->db->count_all_results();
    } while ($num >= 1);

    $query = "INSERT INTO `images` (`img_url_code`, `img_image_name`, `img_dir_name`) VALUES (?,?,?) ";
    $result = $this->db->query($query, array($img_url_code, $data['image_name'], $data['img_dir_name']));

    if ($result) {
      return $img_url_code;
    } else {
      return false;
    }
  }

function fetch_image($img_url_code) {
    $query = "SELECT * FROM `images` WHERE `img_url_code` = ? ";
    $result = $this->db->query($query, array($img_url_code));

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }    
}
