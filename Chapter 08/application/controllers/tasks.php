<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends MY_Controller {
  function __construct() {
  parent::__construct();
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->model('Tasks_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  public function index() {
    $this->form_validation->set_rules('task_desc', $this->lang->line('tasks_task_desc'), 'required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('task_due_d', $this->lang->line('task_due_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('task_due_m', $this->lang->line('task_due_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('task_due_y', $this->lang->line('task_due_y'), 'min_length[4]|max_length[4]');

    if ($this->form_validation->run() == FALSE) {
      $page_data['job_title'] = array('name' => 'job_title', 'class' => 'form-control', 'id' => 'job_title', 'value' => set_value('job_title', ''), 'maxlength' => '100', 'size' => '35');
      $page_data['task_desc'] = array('name' => 'task_desc', 'class' => 'form-control', 'id' => 'task_desc', 'value' => set_value('task_desc', ''), 'maxlength' => '255', 'size' => '35');
      $page_data['task_due_d'] = array('name' => 'task_due_d', 'class' => 'form-control', 'id' => 'task_due_d', 'value' => set_value('task_due_d', ''), 'maxlength' => '100', 'size' => '35');
      $page_data['task_due_m'] = array('name' => 'task_due_m', 'class' => 'form-control', 'id' => 'task_due_m', 'value' => set_value('task_due_m', ''), 'maxlength' => '100', 'size' => '35');
      $page_data['task_due_y'] = array('name' => 'task_due_y', 'class' => 'form-control', 'id' => 'task_due_y', 'value' => set_value('task_due_y', ''), 'maxlength' => '100', 'size' => '35');
      
      $page_data['query'] = $this->Tasks_model->get_tasks();      
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('tasks/view', $page_data);
      $this->load->view('common/footer');      
    } else {

      if ($this->input->post('task_due_y') && $this->input->post('task_due_m') && $this->input->post('task_due_d')) {
        $task_due_date = $this->input->post('task_due_y') .'-'. $this->input->post('task_due_m') .'-'. $this->input->post('task_due_d');
      } else {
        $task_due_date = null;
      }

      $save_data = array(
        'task_desc' => $this->input->post('task_desc'),
        'task_due_date' => $task_due_date,
        'task_status' => 'todo'
      );

      if ($this->Tasks_model->save_task($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('create_success_okay'));
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('create_success_fail'));
      }
      redirect ('tasks'); 
    }    
  } 

  public function status() {
    $page_data['task_status'] = $this->uri->segment(3);
    $task_id = $this->uri->segment(4);
    if ($this->Tasks_model->change_task_status($task_id, $page_data)) {
      $this->session->set_flashdata('flash_message', $this->lang->line('status_change_success'));
      log_message('error',$this->lang->line('status_change_success'));
    } else {
      $this->session->set_flashdata('flash_message', $this->lang->line('status_change_fail'));
      log_message('error',$this->lang->line('status_change_fail'));
    }   


    redirect ('tasks');     
  }

  public function delete() {
    $this->form_validation->set_rules('id', $this->lang->line('task_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
        
    $data['page_heading'] = 'Confirm delete?';
    if ($this->form_validation->run() == FALSE) {
      $data['query'] = $this->Tasks_model->get_task($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('tasks/delete', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Tasks_model->delete($id)) {
        redirect('tasks');
      }
    }
  }
}

/* End of file tasks.php */
/* Location: ./application/controllers/tasks.php */