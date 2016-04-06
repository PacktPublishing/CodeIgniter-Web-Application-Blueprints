<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends MY_Controller {
  function __construct() {
  parent::__construct();
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->model('Jobs_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  public function index() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Jobs_model->get_jobs($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

      $page_data['query'] = $this->Jobs_model->get_jobs($this->input->post('search_string'));
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('jobs/view', $page_data);
      $this->load->view('common/footer');
    } else {
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('jobs/view', $page_data);
      $this->load->view('common/footer');      
    }    
  }

  public function create() {
    $this->form_validation->set_rules('job_title', $this->lang->line('job_title'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('job_desc', $this->lang->line('job_desc'), 'required|min_length[1]|max_length[3000]');
    $this->form_validation->set_rules('cat_id', $this->lang->line('cat_id'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('type_id', $this->lang->line('type_id'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('loc_id', $this->lang->line('loc_id'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('start_d', $this->lang->line('start_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_m', $this->lang->line('start_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_y', $this->lang->line('start_y'), 'min_length[1]|max_length[4]');
    $this->form_validation->set_rules('job_rate', $this->lang->line('job_rate'), 'required|min_length[1]|max_length[6]');
    $this->form_validation->set_rules('job_advertiser_name', $this->lang->line('job_advertiser_name'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('job_advertiser_email', $this->lang->line('job_advertiser_email'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('job_advertiser_phone', $this->lang->line('job_advertiser_phone'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('sunset_d', $this->lang->line('sunset_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('sunset_m', $this->lang->line('sunset_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('sunset_y', $this->lang->line('sunset_y'), 'min_length[1]|max_length[4]');

    $page_data['categories'] = $this->Jobs_model->get_categories();
    $page_data['types'] = $this->Jobs_model->get_types();
    $page_data['locations'] = $this->Jobs_model->get_locations();

    if ($this->form_validation->run() == FALSE) {
      $page_data['job_title']            = array('name' => 'job_title', 'class' => 'form-control', 'id' => 'job_title', 'value' => set_value('job_title', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['job_desc']             = array('name' => 'job_desc', 'class' => 'form-control', 'id' => 'job_desc', 'value' => set_value('job_desc', ''), 'maxlength'   => '3000', 'rows' => '6', 'cols' => '35');
      $page_data['start_d']              = array('name' => 'start_d', 'class' => 'form-control', 'id' => 'start_d', 'value' => set_value('start_d', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['start_m']              = array('name' => 'start_m', 'class' => 'form-control', 'id' => 'start_m', 'value' => set_value('start_m', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['start_y']              = array('name' => 'start_y', 'class' => 'form-control', 'id' => 'start_y', 'value' => set_value('start_y', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['job_rate']             = array('name' => 'job_rate', 'class' => 'form-control', 'id' => 'job_rate', 'value' => set_value('job_rate', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['job_advertiser_name']  = array('name' => 'job_advertiser_name', 'class' => 'form-control', 'id' => 'job_advertiser_name', 'value' => set_value('job_advertiser_name', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['job_advertiser_email'] = array('name' => 'job_advertiser_email', 'class' => 'form-control', 'id' => 'job_advertiser_email', 'value' => set_value('job_advertiser_email', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['job_advertiser_phone'] = array('name' => 'job_advertiser_phone', 'class' => 'form-control', 'id' => 'job_advertiser_phone', 'value' => set_value('job_advertiser_phone', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['sunset_d']             = array('name' => 'sunset_d', 'class' => 'form-control', 'id' => 'sunset_d', 'value' => set_value('sunset_d', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['sunset_m']             = array('name' => 'sunset_m', 'class' => 'form-control', 'id' => 'sunset_m', 'value' => set_value('sunset_m', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['sunset_y']             = array('name' => 'sunset_y', 'class' => 'form-control', 'id' => 'sunset_y', 'value' => set_value('sunset_y', ''), 'maxlength'   => '100', 'size' => '35');
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('jobs/create', $page_data);
      $this->load->view('common/footer');      
    } else {
      $save_data = array(
        'job_title' => $this->input->post('job_title'),
        'job_desc' => $this->input->post('job_desc'),
        'cat_id' => $this->input->post('cat_id'),
        'type_id' => $this->input->post('type_id'),
        'loc_id' => $this->input->post('loc_id'),
        'job_start_date' => $this->input->post('start_y') .'-'.$this->input->post('start_m').'-'.$this->input->post('start_d'),
        'job_rate' => $this->input->post('job_rate'),
        'job_advertiser_name' => $this->input->post('job_advertiser_name'),
        'job_advertiser_email' => $this->input->post('job_advertiser_email'),
        'job_advertiser_phone' => $this->input->post('job_advertiser_phone'),
        'job_sunset_date' => $this->input->post('sunset_y') .'-'.$this->input->post('sunset_m').'-'.$this->input->post('sunset_d'),
        );

      if ($this->Jobs_model->save_job($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('jobs/create/'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('jobs'); 
      }
    }    
  } 

  public function apply() {
    $this->form_validation->set_rules('job_id', $this->lang->line('job_title'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('app_name', $this->lang->line('app_name'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('app_email', $this->lang->line('app_email'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('app_phone', $this->lang->line('app_phone'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('app_cover_note', $this->lang->line('app_cover_note'), 'required|min_length[1]|max_length[3000]');

    if ($this->input->post()) {
      $page_data['job_id'] = $this->input->post('job_id');
    } else {
      $page_data['job_id'] = $this->uri->segment(3);
    }

    $page_data['query'] = $this->Jobs_model->get_job($page_data['job_id']);

    if ($page_data['query']->num_rows() == 1) {
      foreach ($page_data['query']->result() as $row) {
        $page_data['job_title'] = $row->job_title;
        $page_data['job_id'] = $row->job_id;
        $job_advertiser_name = $row->job_advertiser_name;
        $job_advertiser_email = $row->job_advertiser_email;
      }
    } else {
      $this->session->set_flashdata('flash_message', $this->lang->line('app_job_no_longer_exists'));  
      redirect('jobs');    
    }

    if ($this->form_validation->run() == FALSE) {
      $page_data['job_id']         = array('name' => 'job_id', 'class' => 'form-control', 'id' => 'job_id', 'value' => set_value('job_id', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['app_name']       = array('name' => 'app_name', 'class' => 'form-control', 'id' => 'app_name', 'value' => set_value('app_name', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['app_email']      = array('name' => 'app_email', 'class' => 'form-control', 'id' => 'app_email', 'value' => set_value('app_email', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['app_phone']      = array('name' => 'app_phone', 'class' => 'form-control', 'id' => 'app_phone', 'value' => set_value('app_phone', ''), 'maxlength'   => '100', 'size' => '35');
      $page_data['app_cover_note'] = array('name' => 'app_cover_note', 'class' => 'form-control', 'id' => 'app_cover_note', 'value' => set_value('app_cover_note', ''), 'maxlength'   => '3000', 'rows' => '6', 'cols' => '35');

      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('jobs/apply', $page_data);
      $this->load->view('common/footer');      
    } else {
      $body = "Dear %job_advertiser_name%,\n\n";
      $body .= "%app_name% is applying for the position of %job_title%,\n\n";
      $body .= "The details of the application are:\n\n";
      $body .= "Applicant:  %app_name%,\n\n";
      $body .= "Job Title:  %job_title%,\n\n";
      $body .= "Applicant Email:  %app_email%,\n\n";
      $body .= "Applicant Phone:  %app_phone%,\n\n";
      $body .= "Cover Note:  %app_cover_note%,\n\n";

      $body = str_replace('%job_advertiser_name%', $job_advertiser_name, $body);
      $body = str_replace('%app_name%', $this->input->post('app_name'), $body);
      $body = str_replace('%job_title%', $page_data['job_title'], $body);
      $body = str_replace('%app_email%', $this->input->post('app_email'), $body);
      $body = str_replace('%app_phone%', $this->input->post('app_phone'), $body);
      $body = str_replace('%app_cover_note%', $this->input->post('app_cover_note'), $body);

      if (mail($job_advertiser_email, 'Application for ' . $page_data['job_title'], $body)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('app_success_okay'));
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('app_success_fail'));
      }

      redirect ('jobs/apply/'.$page_data['job_id']);
    }    
  }
}

/* End of file jobs.php */
/* Location: ./application/controllers/jobs.php */