<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('Discussions_model');
        $this->load->model('Comments_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');        
    }

    public function index() {
        if ($this->input->post()) {
            $ds_id = $this->input->post('ds_id');        
        } else {
            $ds_id = $this->uri->segment(3);
        }

        $page_data['discussion_query'] = $this->Discussions_model->fetch_discussion($ds_id);
        $page_data['comment_query'] = $this->Comments_model->fetch_comments($ds_id);
        $page_data['ds_id'] = $ds_id;

        $this->form_validation->set_rules('ds_id', $this->lang->line('comments_comment_hidden_id'), 'required|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('comment_name', $this->lang->line('comments_comment_name'), 'required|min_length[1]|max_length[25]');
        $this->form_validation->set_rules('comment_email', $this->lang->line('comments_comment_email'), 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('comment_body', $this->lang->line('comments_comment_body'), 'required|min_length[1]|max_length[5000]');

        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('common/header');
            $this->load->view('nav/top_nav');
            $this->load->view('comments/view', $page_data);
            $this->load->view('common/footer');
        } else {
            $data = array('cm_body' => $this->input->post('comment_body'),
                          'usr_email' => $this->input->post('comment_email'),
                          'usr_name' => $this->input->post('comment_name'),
                          'ds_id' =>  $this->input->post('ds_id')
                          );

            if ($this->Comments_model->new_comment($data)) {
                redirect('comments/index/'.$ds_id);
            } else {
                // error
                // load view and flash sess error
            }
        }
    }

    public function flag() {
        $cm_id = $this->uri->segment(4);
        if ($this->Comments_model->flag($cm_id)) {
            redirect('comments/index/'.$this->uri->segment(3));
        } else {
            // error
            // load view and flash sess error
        }        
    }
}

/* End of file comments.php */
/* Location: ./application/controllers/comments.php */