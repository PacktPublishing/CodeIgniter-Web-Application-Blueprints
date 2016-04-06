<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('file'); // for html emails
    $this->load->model('Users_model');
    $this->load->model('Password_model');

    if ( ($this->session->userdata('logged_in') == FALSE) || 
       ($this->session->userdata('usr_access_level') != 1) ) {
        redirect('signin');
    }  
  }
  
  public function index() {
    $data['page_heading'] = 'Viewing users';  
    $data['query'] = $this->Users_model->get_all_users();
    $this->load->view('common/header', $data);
    $this->load->view('nav/top_nav', $data);        
    $this->load->view('users/view_all_users', $data);
    $this->load->view('common/footer', $data);
  } 

  public function new_user() {
    // Set validation rules
    $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
    $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
    $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_add2', $this->lang->line('usr_add2'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_add3', $this->lang->line('usr_add3'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_access_level'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[1]|integer|is_natural');

    $data['page_heading'] = 'New user';
    // Begin validation
    if ($this->form_validation->run() == FALSE) { // First load, or problem with form
      $data['usr_fname'] = array('name' => 'usr_fname', 'class' => 'form-control', 'id' => 'usr_fname', 'value' => set_value('usr_fname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_lname'] = array('name' => 'usr_lname', 'class' => 'form-control', 'id' => 'usr_lname', 'value' => set_value('usr_lname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_uname'] = array('name' => 'usr_uname', 'class' => 'form-control', 'id' => 'usr_uname', 'value' => set_value('usr_uname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_email'] = array('name' => 'usr_email', 'class' => 'form-control', 'id' => 'usr_email', 'value' => set_value('usr_email', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_confirm_email'] = array('name' => 'usr_confirm_email', 'class' => 'form-control', 'id' => 'usr_confirm_email', 'value' => set_value('usr_confirm_email', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add1'] = array('name' => 'usr_add1', 'class' => 'form-control', 'id' => 'usr_add1', 'value' => set_value('usr_add1', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add2'] = array('name' => 'usr_add2', 'class' => 'form-control', 'id' => 'usr_add2', 'value' => set_value('usr_add2', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add3'] = array('name' => 'usr_add3', 'class' => 'form-control', 'id' => 'usr_add3', 'value' => set_value('usr_add3', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_town_city'] = array('name' => 'usr_town_city', 'class' => 'form-control', 'id' => 'usr_town_city', 'value' => set_value('usr_town_city', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_zip_pcode'] = array('name' => 'usr_zip_pcode', 'class' => 'form-control', 'id' => 'usr_zip_pcode', 'value' => set_value('usr_zip_pcode', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_access_level'] = array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5);

      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/new_user',$data);
      $this->load->view('common/footer', $data);
    } else { // Validation passed, now escape the data
      $password = random_string('alnum', 8);
      $hash = $this->encrypt->sha1($password);  

      $data = array(
        'usr_fname' => $this->input->post('usr_fname'),
        'usr_lname' => $this->input->post('usr_lname'),
        'usr_uname' => $this->input->post('usr_uname'),
        'usr_email' => $this->input->post('usr_email'),
        'usr_hash' => $hash,
        'usr_add1' => $this->input->post('usr_add1'),
        'usr_add2' => $this->input->post('usr_add2'),
        'usr_add3' => $this->input->post('usr_add3'),
        'usr_town_city' => $this->input->post('usr_town_city'),
        'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
        'usr_access_level' => $this->input->post('usr_access_level'),
        'usr_is_active' => $this->input->post('usr_is_active')
      );

      if ($this->Users_model->process_create_user($data)) {
        $file = read_file('../views/email_scripts/welcome.txt');
        $file = str_replace('%usr_fname%', $data['usr_fname'], $file);
        $file = str_replace('%usr_lname%', $data['usr_lname'], $file);
        $file = str_replace('%password%', $password, $file);
        redirect('users');
      } else {

      }
    }        
  }

  public function edit_user() {
    // Set validation rules
    $this->form_validation->set_rules('usr_id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email');
    $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
    $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_add2', $this->lang->line('usr_add2'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_add3', $this->lang->line('usr_add3'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_access_level'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[1]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('usr_id');
    } else {
      $id = $this->uri->segment(3); 
    }
           
    $data['page_heading'] = 'Edit user';                
    // Begin validation
    if ($this->form_validation->run() == FALSE) { // First load, or problem with form           
      $query = $this->Users_model->get_user_details($id);
      foreach ($query->result() as $row) {
        $usr_id = $row->usr_id;
        $usr_fname = $row->usr_fname;
        $usr_lname = $row->usr_lname;
        $usr_uname = $row->usr_uname;
        $usr_email = $row->usr_email;
        $usr_add1 = $row->usr_add1;
        $usr_add2 = $row->usr_add2;
        $usr_add3 = $row->usr_add3;
        $usr_town_city = $row->usr_town_city;
        $usr_zip_pcode = $row->usr_zip_pcode;
        $usr_access_level = $row->usr_access_level;
        $usr_is_active = $row->usr_is_active;
      }

      $data['usr_fname'] = array('name' => 'usr_fname', 'class' => 'form-control', 'id' => 'usr_fname', 'value' => set_value('usr_fname', $usr_fname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_lname'] = array('name' => 'usr_lname', 'class' => 'form-control', 'id' => 'usr_lname', 'value' => set_value('usr_lname', $usr_lname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_uname'] = array('name' => 'usr_uname', 'class' => 'form-control', 'id' => 'usr_uname', 'value' => set_value('usr_uname', $usr_uname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_email'] = array('name' => 'usr_email', 'class' => 'form-control', 'id' => 'usr_email', 'value' => set_value('usr_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_confirm_email'] = array('name' => 'usr_confirm_email', 'class' => 'form-control', 'id' => 'usr_confirm_email', 'value' => set_value('usr_confirm_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add1'] = array('name' => 'usr_add1', 'class' => 'form-control', 'id' => 'usr_add1', 'value' => set_value('usr_add1', $usr_add1), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add2'] = array('name' => 'usr_add2', 'class' => 'form-control', 'id' => 'usr_add2', 'value' => set_value('usr_add2', $usr_add2), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add3'] = array('name' => 'usr_add3', 'class' => 'form-control', 'id' => 'usr_add3', 'value' => set_value('usr_add3', $usr_add3), 'maxlength'   => '100', 'size' => '35');
      $data['usr_town_city'] = array('name' => 'usr_town_city', 'class' => 'form-control', 'id' => 'usr_town_city', 'value' => set_value('usr_town_city', $usr_town_city), 'maxlength'   => '100', 'size' => '35');
      $data['usr_zip_pcode'] = array('name' => 'usr_zip_pcode', 'class' => 'form-control', 'id' => 'usr_zip_pcode', 'value' => set_value('usr_zip_pcode', $usr_zip_pcode), 'maxlength'   => '100', 'size' => '35');
      $data['usr_access_level_options'] = array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5);
      $data['usr_access_level'] = array('value' => set_value('usr_access_level', ''));
      $data['usr_is_active'] = $usr_is_active;
      $data['id'] = array('usr_id' => set_value('usr_id', $usr_id));

      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/edit_user', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation passed, now escape the data
      $data = array(
        'usr_fname' => $this->input->post('usr_fname'),
        'usr_lname' => $this->input->post('usr_lname'),
        'usr_uname' => $this->input->post('usr_uname'),
        'usr_email' => $this->input->post('usr_email'),
        'usr_add1' => $this->input->post('usr_add1'),
        'usr_add2' => $this->input->post('usr_add2'),
        'usr_add3' => $this->input->post('usr_add3'),
        'usr_town_city' => $this->input->post('usr_town_city'),
        'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
        'usr_access_level' => $this->input->post('usr_access_level'),
        'usr_is_active' => $this->input->post('usr_is_active')
      );

      if ($this->Users_model->process_update_user($id, $data)) {
        redirect('users');
      }
    }
  }   

  public function delete_user() {
    // Set validation rules
    $this->form_validation->set_rules('id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
        
    $data['page_heading'] = 'Confirm delete?';
    if ($this->form_validation->run() == FALSE) { // First load, or problem with form
      $data['query'] = $this->Users_model->get_user_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/delete_user', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Users_model->delete_user($id)) {
        redirect('users');
      }
    }
  }

  public function pwd_email() {
    $id = $this->uri->segment(3);
    send_email($data, 'reset');                
    redirect('users');
  }
}
