<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Shop extends MY_Controller {
  function __construct() { 
    parent::__construct(); 
    $this->load->library('cart'); 
    $this->load->helper('form'); 
    $this->load->helper('url'); 
    $this->load->helper('security'); 
    $this->load->model('Shop_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');    
  } 

  public function index() {
    if (!$this->uri->segment(3)) {
      $data['query'] = $this->Shop_model->get_all_products();
    } else {
      $data['query'] = $this->Shop_model->get_all_products_by_category_name($this->uri->segment(3));
    }
    
    $data['cat_query'] = $this->Shop_model->get_all_categories();
    $cart_contents = $this->session->userdata('cart_contents');
    $data['items'] = $cart_contents['total_items'];
    
    $this->load->view('common/header');
    $this->load->view('nav/top_nav', $data);
    $this->load->view('shop/display_products', $data); 
    $this->load->view('common/footer');
  }

  public function add() { 
    $product_id = $this->uri->segment(3);
    $query = $this->Shop_model->get_product_details($product_id); 
    foreach($query->result() as $row) { 
      $data = array( 
        'id'   => $row->product_id, 
        'qty' => 1, 
        'price'  => $row->product_price, 
        'name' => $row->product_name, 
       ); 
    } 

    $this->cart->insert($data); 
    $data['cat_query'] = $this->Shop_model->get_all_categories();
    $cart_contents = $this->session->userdata('cart_contents');
    $data['items'] = $cart_contents['total_items'];

    $this->load->view('common/header');
    $this->load->view('nav/top_nav', $data);
    $this->load->view('shop/display_cart', $data); 
    $this->load->view('common/footer');  
  }

  public function update_cart() { 
    $data = array(); 
    $i = 0;        

    foreach($this->input->post() as $item) { 
      $data[$i]['rowid']  = $item['rowid']; 
      $data[$i]['qty']    = $item['qty'];            
      $i++;  
    } 

    $this->cart->update($data); 
    redirect('shop/display_cart'); 
  } 

  public function display_cart() { 
    $data['cat_query'] = $this->Shop_model->get_all_categories();        
    $cart_contents = $this->session->userdata('cart_contents');
    $data['items'] = $cart_contents['total_items'];    
    $this->load->view('common/header');
    $this->load->view('nav/top_nav', $data);
    $this->load->view('shop/display_cart', $data); 
    $this->load->view('common/footer');    
  }

  public function clear_cart() { 
    $this->cart->destroy(); 
    redirect('index');
  } 

public function user_details() { 
    // Set validation rules 
    $this->form_validation->set_rules('first_name', $this->lang->line('user_details_placeholder_first_name'), 'required|min_length[1]|max_length[125]'); 
    $this->form_validation->set_rules('last_name', $this->lang->line('user_details_placeholder_last_name'), 'required|min_length[1]|max_length[125]'); 
    $this->form_validation->set_rules('email', $this->lang->line('user_details_placeholder_email'), 'required|min_length[1]|max_length[255]|valid_email'); 
    $this->form_validation->set_rules('email_confirm', $this->lang->line('user_details_placeholder_email_confirm'), 'required|min_length[1]|max_length[255]|valid_email|matches[email]'); 
    $this->form_validation->set_rules('payment_address', $this->lang->line('user_details_placeholder_payment_address'), 'required|min_length[1]|max_length[1000]'); 
    $this->form_validation->set_rules('delivery_address', $this->lang->line('user_details_placeholder_delivery_address'), 'min_length[1]|max_length[1000]'); 
        
    // Begin validation 
    if ($this->form_validation->run() == FALSE) { 
      $data['first_name'] = array('name' => 'first_name', 'class' => 'form-control', 'id' => 'first_name', 'value' => set_value('first_name', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_first_name'));
      $data['last_name'] = array('name' => 'last_name', 'class' => 'form-control', 'id' => 'last_name', 'value' => set_value('last_name', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_last_name'));
      $data['email'] = array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email', ''), 'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_email'));
      $data['email_confirm'] = array('name' => 'email_confirm', 'class' => 'form-control', 'id' => 'email_confirm', 'value' => set_value('email_confirm', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_email_confirm'));
      $data['payment_address'] = array('name' => 'payment_address', 'class' => 'form-control', 'id' => 'payment_address', 'value' => set_value('payment_address', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_payment_address'));
      $data['delivery_address'] = array('name' => 'delivery_address', 'class' => 'form-control', 'id' => 'delivery_address', 'value' => set_value('delivery_address', ''), 'maxlength' => '100', 'size' => '35', 'placeholder' => $this->lang->line('user_details_placeholder_delivery_address'));

      $cart_contents = $this->session->userdata('cart_contents');
      $data['items'] = $cart_contents['total_items'];
      $this->load->view('common/header');
      $this->load->view('nav/top_nav', $data);
      $this->load->view('shop/user_details', $data); 
      $this->load->view('common/footer');             
    } else { 
      $cust_data = array( 
      'cust_first_name' => $this->input->post('cust_first_name'), 
      'cust_last_name' => $this->input->post('cust_last_name'), 
      'cust_email'=> $this->input->post('cust_email'), 
      'cust_address'  => $this->input->post('payment_address')); 
              
      $payment_code = mt_rand(); 
              
      $order_data = array( 
      'order_details' => serialize($this->cart->contents()), 
      'order_delivery_address' => $this->input->post('delivery_address'), 
      'order_closed' => '0', 
      'order_fulfilment_code' => $payment_code,
      'order_delivery_address' => $this->input->post('payment_address')); 
              
      if ($this->Shop_model->save_cart_to_database($cust_data, $order_data)) {
        echo $this->lang->line('user_details_save_success');
      } else {
        echo $this->lang->line('user_details_save_error');
      }
    }        
  }   
} 
