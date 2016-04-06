<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function fetch_comments($ds_id) {
        $query = "SELECT * FROM `comments`, `discussions`, `users` 
                  WHERE `discussions`.`ds_id` = ?
                   AND `comments`.`ds_id` = `discussions`.`ds_id` 
                   AND `comments`.`usr_id` = `users`.`usr_id` 
                   AND `comments`.`cm_is_active` = '1' 
                   ORDER BY `comments`.`cm_created_at` DESC " ;

        $result = $this->db->query($query, array($ds_id));

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }  

    function new_comment($data) {
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
            }
        }

        $comment_data = array('cm_body' => $data['cm_body'],
                              'ds_id' => $data['ds_id'],
                              'cm_is_active' => '1',
                              'usr_id' => $data['usr_id']);

        if ($this->db->insert('comments',$comment_data) ) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function flag($cm_id) {
        $query = "UPDATE `comments` 
                  SET `cm_is_active` = '0' 
                  WHERE `cm_id` = ? ";
        if ($this->db->query($query,array($cm_id))) {
            return true;
        } else {
            return false;
        }
    }
}