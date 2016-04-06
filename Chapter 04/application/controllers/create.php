<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Create extends MY_Controller {
  function __construct() {
    parent::__construct();
      $this->load->helper(array('string'));
      $this->load->library('form_validation');
      $this->load->library('image_lib');
      $this->load->model('Image_model');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

  public function index() {
    $page_data = array('fail' => false,
                       'success' => false); 
    $this->load->view('common/header');
    $this->load->view('nav/top_nav');
    $this->load->view('create/create', $page_data);
    $this->load->view('common/footer');
  }

  public function do_upload() {
    $upload_dir = '/path/to/codeigniter/upload/';    
    do {
      // Make code
      $code = random_string('alnum', 8); 
      
      // Scan uplaod dir for subdir with same name
      // name as the code
      $dirs = scandir($upload_dir);

      // Look to see if there is already a 
      // directory with the name which we 
      // store in $code 
      if (in_array($code, $dirs)) { // Yes there is
        $img_dir_name = false; // Set to false to begin again
      } else { // No there isn't
        $img_dir_name = $code; // This is a new name
      }

    } while ($img_dir_name == false);

    if (!mkdir($upload_dir.$img_dir_name)) {
      $page_data = array('fail' => $this->lang->line('encode_upload_mkdir_error'),
                         'success' => false);      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('create/create', $page_data);
      $this->load->view('common/footer');      
    }

    $config['upload_path'] = $upload_dir.$img_dir_name;
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '10000';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';  

    $this->load->library('upload', $config);    

    if ( ! $this->upload->do_upload()) {
      $page_data = array('fail' => $this->upload->display_errors(),
                         'success' => false);
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('create/create', $page_data);
      $this->load->view('common/footer');
    } else {
      $image_data = $this->upload->data();
      $page_data['result'] = $this->Image_model->save_image(array('image_name' => $image_data['file_name'], 'img_dir_name' => $img_dir_name));
      $page_data['file_name'] = $image_data['file_name'];
      $page_data['img_dir_name'] = $img_dir_name;
      
      if ($page_data['result'] == false) {
        // success - display image and link
        $page_data = array('fail' => $this->lang->line('encode_upload_general_error'));
        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('create/create', $page_data);
        $this->load->view('common/footer');        
      } else {
        // success - display image and link
        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('create/result', $page_data);
        $this->load->view('common/footer');
      }
    }
  } 
}
/* End of file create.php */
/* Location: ./application/controllers/create.php */