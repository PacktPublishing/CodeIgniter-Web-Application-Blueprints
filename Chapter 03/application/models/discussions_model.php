<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussions_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }

  function fetch_discussions($filter = null, $direction = null) {
    $query = "SELECT * FROM `discussions`, `users` 
              WHERE `discussions`.`usr_id` = `users`.`usr_id`
              AND `discussions`.`ds_is_active` != '0' ";

    if ($filter != null) {
      if ($filter == 'age') {
        $filter = 'ds_created_at';
        switch ($direction) {
          case 'ASC':
            $dir = 'ASC';
            break;
          case 'DESC':
            $dir = 'DESC';
            break;
          default:
            $dir = 'ASC';
        }
      } 
    } else {
      $dir = 'ASC';
    }
      
    $query .= "ORDER BY `ds_created_at` " . $dir;
    $result = $this->db->query($query, array($dir));

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }    

  function fetch_discussion($ds_id) {
    $query = "SELECT * FROM `discussions`, `users` WHERE `ds_id` = ?
              AND `discussions`.`usr_id` = `users`.`usr_id`";
    return $result = $this->db->query($query, array($ds_id));
  }

  function create($data) {
    // Look and see if the email address already exists in the users 
    // table, if it does return the primary key, if not create them 
    // a user account and return the primary key.
    $usr_email = $data['usr_email'];
    $query = "SELECT * FROM `users` WHERE `usr_email` = ? ";
    $result = $this->db->query($query,array($usr_email));

    if ($result->num_rows() > 0) {
      foreach ($result->result() as $rows) {
        $data['usr_id'] = $rows->usr_id;
      }
    } else {
      $password = random_string('alnum', 16);
      $hash = $this->encrypt->sha1($password);

      $user_data = array('usr_email' => $data['usr_email'],
                         'usr_name' => $data['usr_name'],
                         'usr_is_active' => '1',
                         'usr_level' => '1',
                         'usr_hash' => $hash);

      if ($this->db->insert('users',$user_data)) {
        $data['usr_id'] = $this->db->insert_id();
        // Send email with password???
      }
    }

    $discussion_data = array('ds_title' => $data['ds_title'],
                             'ds_body' => $data['ds_body'],
                             'usr_id' => $data['usr_id'],
                             'ds_is_active' => '1');

    if ($this->db->insert('discussions',$discussion_data) ) {
      return $this->db->insert_id();
    } else {
      return false;
    }              
  }

  function flag($ds_id) {
    $this->db->where('ds_id', $ds_id);
    if ($this->db->update('discussions', array('ds_is_active' => '0'))) {
      return true;
    } else {
      return false;
    }
  }
}
