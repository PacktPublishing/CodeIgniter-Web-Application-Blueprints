<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
    }

    public function index() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('admin/login');
        } 

        redirect('admin/dashboard');
    }

    public function login() {
        $this->form_validation->set_rules('usr_email', $this->lang->line('admin_login_email'), 'required|min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_password', $this->lang->line('admin_login_password'), 'required|min_length[1]|max_length[25]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('common/login_header');
            $this->load->view('nav/top_nav');
            $this->load->view('admin/login');
            $this->load->view('common/footer');         
        } else {
            $usr_email = $this->input->post('usr_email');
            $usr_password = $this->input->post('usr_password');

            $query = $this->Admin_model->does_user_exist($usr_email);

            if ($query->num_rows() == 1) { // One matching row found
                foreach ($query->result() as $row) {
                    // Call Encrypt library
                    $this->load->library('encrypt');

                    // Generate hash from a their password
                    $hash = $this->encrypt->sha1($usr_password);

                    // Compare the generated hash with that in the database
                    if ($hash != $row->usr_hash) {
                        // Didn't match so send back to login
                        $page_data['login_fail'] = true;
                        $this->load->view('common/login_header');
                        $this->load->view('nav/top_nav');
                        $this->load->view('admin/login',$page_data);
                        $this->load->view('common/footer'); 
                    } else {
                        $data = array(
                            'usr_id' => $row->usr_id,
                            'usr_email' => $row->usr_email,
                            'logged_in' => TRUE
                        );

                        // Save data to session
                        $this->session->set_userdata($data);
                        redirect('admin/dashboard');
                    }
                }
            }
        }     
    }

    public function dashboard() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('admin/login');
        } 

        $page_data['comment_query'] = $this->Admin_model->dashboard_fetch_comments();
        $page_data['discussion_query'] = $this->Admin_model->dashboard_fetch_discussions();

        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('admin/dashboard',$page_data);
        $this->load->view('common/footer');         
    }

    public function update_item() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('admin/login');
        } 

        if ($this->uri->segment(4) == 'allow') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        if ($this->uri->segment(3) == 'ds') {
            $result = $this->Admin_model->update_discussions($is_active, $this->uri->segment(5));
        } else {
            $result = $this->Admin_model->update_comments($is_active, $this->uri->segment(5));
        }

        redirect('admin');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */