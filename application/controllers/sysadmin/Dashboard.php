<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
  }
 
  public function index()
  {
	  $this->data['page_title'] = 'Dashboard'; 
    $this->data['extracss']='';
    $this->data['extrajs']='';
    //$this->render('sysadmin/dashboard/dashboard_view');
    $menu_items = $this->session->userdata('menu_items');
    //pr($menu_items); die;

    $this->load->view('sysadmin/dashboard/dashboard_view',$this->data);
   }
}