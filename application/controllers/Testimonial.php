<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Testimonial extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('testimonial_model'); 
        $this->load->library('pagination');
    }

   public function index()
   {
 		    $this->data['extracss']='';
		    $this->data['extrajs']='';    
        $this->data['page_title'] = 'Testimonial';
  
        $this->data['total_record'] = $this->testimonial_model->selectdata("COUNT(*) as total_rows",array('status'=>'active'),"ORDER BY testimonial_id DESC");
        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;

        $config['base_url'] = MAINSITE_URL.'testimonial';
        $config['total_rows'] = $this->data['total_record'][0]->total_rows;
        $config['per_page'] = FRONT_RECORD_PER_PAGE;
        $config["uri_segment"] = FRONT_PAGINATION_URI_SEGMENT;
        $config['attributes'] = array('class' => 'page-numbers');
        //$config['use_page_numbers']=true;
        $config['full_tag_open'] = '<ul class="page-numbers sp-top60">';
            $config['full_tag_close'] = '</ul>';

            $config['first_link'] = 'First Page';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] ='</li>';

            $config['first_link'] = 'Last Page';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] ='</li>';

            $config['last_link'] = 'Last Page';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['next_link'] = '<i class="fa fa-angle-right"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li><span class="page-numbers current">';
            $config['cur_tag_close'] = '</span></li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            /*$config['num_links'] = 3; */

        $this->pagination->initialize($config);
        //$page = ($this->uri->segment(FRONT_PAGINATION_URI_SEGMENT)) ? $this->uri->segment(FRONT_PAGINATION_URI_SEGMENT) : 0;
        $page = isset($_GET['per_page']) ? $_GET['per_page'] : 0;
        $this->data['total_pages']  = $page;
        $this->data['testimonials'] = $this->testimonial_model->selectdata("testimonial_title,testimonial_desc,image_fids,hid,address",array('status'=>'active'),'ORDER BY testimonial_id DESC',$page,$config["per_page"]);
        $this->data['pageing_link'] = $this->pagination->create_links();
          
 		    $this->render('public/pages/testimonial');
	}

    

}

