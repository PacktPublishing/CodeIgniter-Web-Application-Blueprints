<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Signup extends MY_Controller {
  function __construct() { 
    parent::__construct(); 
    $this->load->helper('form'); 
    $this->load->helper('url'); 
    $this->load->model('Signup_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');    
  } 

  public function index() {
    // Set validation rules 
    $this->form_validation->set_rules('signup_email', $this->lang->line('signup_emailemail'), 'required|valid_email|min_length[1]|max_length[125]|is_unique[signups.signup_email]');
    $this->form_validation->set_rules('signup_emailopt1', $this->lang->line('signup_emailopt1'), 'min_length[1]|max_length[1]'); 
    $this->form_validation->set_rules('signup_emailopt2', $this->lang->line('signup_emailopt2'), 'min_length[1]|max_length[1]'); 
            
    // Begin validation 
    if ($this->form_validation->run() == FALSE) { 
      $data['signup_email'] = array('name' => 'signup_email', 'class' => 'form-control', 'id' => 'signup_email', 'value' => set_value('signup_email', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('signup_email'));
      $data['signup_opt1'] = array('name' => 'signup_opt1', 'id' => 'signup_opt1', 'value' => '1', 'checked' => FALSE, 'style' => 'margin:10px');
      $data['signup_opt2'] = array('name' => 'signup_opt2', 'id' => 'signup_opt2', 'value' => '1', 'checked' => FALSE, 'style' => 'margin:10px');

      $this->load->view('common/header');
      $this->load->view('nav/top_nav', $data);
      $this->load->view('signup/signup', $data); 
      $this->load->view('common/footer');
    } else { 
      $data = array('signup_email' => $this->input->post('signup_email'),
                    'signup_opt1' => $this->input->post('signup_opt1'),
                    'signup_opt2' => $this->input->post('signup_opt2'),
                    'signup_active' => 1);

      if ($this->Signup_model->add($data)) {
        echo $this->lang->line('signup_success');
      } else {
        echo $this->lang->line('signup_error');
      }
    }
  } 

public function settings() { 
    // Set validation rules 
    $this->form_validation->set_rules('signup_email', $this->lang->line('signup_email'), 'required|valid_email|min_length[1]|max_length[125]'); 
    $this->form_validation->set_rules('signup_opt1', $this->lang->line('signup_opt1'), 'min_length[1]|max_length[1]'); 
    $this->form_validation->set_rules('signup_opt2', $this->lang->line('signup_opt2'), 'min_length[1]|max_length[1]');
    $this->form_validation->set_rules('signup_unsub', $this->lang->line('signup_unsub'), 'min_length[1]|max_length[1]'); 

    // Begin validation 
    if ($this->form_validation->run() == FALSE) { 
      $query = $this->Signup_model->get_settings($this->uri->segment(3) . '@' . $this->uri->segment(4));
      if ($query->num_rows() == 1) {
        foreach ($query->result() as $row) {
          $signup_opt1 = $row->signup_opt1;
          $signup_opt2 = $row->signup_opt2;
        }
      } else {
        redirect('signup');    
      }

      $data['signup_email'] = array('name' => 'signup_email', 'class' => 'form-control', 'id' => 'signup_email', 'value' => set_value('signup_email', $this->uri->segment(3) . '@' . $this->uri->segment(4)), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('signup_email'));
      $data['signup_opt1'] = array('name' => 'signup_opt1', 'id' => 'signup_opt1', 'value' => '1', 'checked' => ($signup_opt1 == 1) ? TRUE : FALSE, 'style' => 'margin:10px');
      $data['signup_opt2'] = array('name' => 'signup_opt2', 'id' => 'signup_opt2', 'value' => '1', 'checked' => ($signup_opt2 == 1) ? TRUE : FALSE, 'style' => 'margin:10px');
      $data['signup_unsub'] = array('name' => 'signup_unsub', 'id' => 'signup_unsub', 'value' => '1', 'checked' => FALSE, 'style' => 'margin:10px');

      $this->load->view('common/header');
      $this->load->view('nav/top_nav', $data);
      $this->load->view('signup/settings', $data); 
      $this->load->view('common/footer');
    } else {
      
      if ($this->input->post('signup_unsub') == 1) {
        $data = array('signup_email' => $this->input->post('signup_email')); 
        if ($this->Signup_model->delete($data)) {
          echo $this->lang->line('unsub_success');
        } else {
          echo $this->lang->line('unsub_error');
        }
      } else {
        $data = array('signup_email' => $this->input->post('signup_email'),
                      'signup_opt1' => $this->input->post('signup_opt1'),
                      'signup_opt2' => $this->input->post('signup_opt2')); 
        if ($this->Signup_model->edit($data)) {
          echo $this->lang->line('setting_success');
        } else {
          echo $this->lang->line('setting_error');
        }
      }
    }
  } 
}