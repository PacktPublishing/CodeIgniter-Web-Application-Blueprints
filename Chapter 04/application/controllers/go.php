<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Go extends MY_Controller {
  function __construct() {
  parent::__construct();
    $this->load->helper('string');
  }

  public function index() {
    if (!$this->uri->segment(1)) {
      redirect (base_url());
    } else {
      $image_code = $this->uri->segment(1);
      $this->load->model('Image_model');
      $query = $this->Image_model->fetch_image($image_code);

      if ($query->num_rows() == 1) {
        foreach ($query->result() as $row) {
          $img_image_name = $row->img_image_name;
          $img_dir_name = $row->img_dir_name;
        }

        $url_address = base_url() . 'upload/' . $img_dir_name .'/' . $img_image_name;
        redirect (prep_url($url_address));
      } else {
        redirect('create');       
      }
    }
  }
}

/* End of file go.php */
/* Location: ./application/controllers/go.php */