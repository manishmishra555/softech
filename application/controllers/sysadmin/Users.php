<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message', 'You are not allowed to visit the Groups page');
            redirect('admin', 'refresh');
        }

        //$this->load->model('locations_model');
        $this->load->model('hospitals_model');
    }
    public function index($group_id = NULL)

    {

        $this->data['page_title'] = 'Users';

        $this->data['groups'] = $this->ion_auth->groups()->result();

        //$this->data['locations'] = $this->locations_model->selectdata("*",array('status'=>'active'),"ORDER BY branch_name ASC");
        //$this->data['total_record'] = $this->locations_model->selectdata("*",array(),"ORDER BY id DESC");
        $this->data['locations'] = $this->hospitals_model->selectdata("hid,hosp_name,location_id,sub_location_id", array('status' => 'active'), 'ORDER BY hid DESC');

        $this->data['total_record'] = $this->ion_auth->users($group_id)->result();

        $this->load->library('pagination');

        $config['base_url'] = MAINSITE_MADMIN_URL . 'users/page/';

        $config['total_rows'] = count($this->data['total_record']);

        $config['per_page'] = RECORD_PER_PAGE;

        $config["uri_segment"] = PAGINATION_URI_SEGMENT;

        $config['attributes'] = array('class' => 'page-link');

        //$config['use_page_numbers']=true;

        $config['full_tag_open'] = '<nav><ul class="pagination">';

        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = false;

        $config['last_link'] = false;

        $config['first_tag_open'] = '<li class="page-item pagination-first">';

        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '';

        $config['prev_tag_open'] = '<li class="page-item pagination-prev">';

        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '';

        $config['next_tag_open'] = '<li class="page-item pagination-next">';

        $config['next_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page-item pagination-last">';

        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';

        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(PAGINATION_URI_SEGMENT)) ? $this->uri->segment(PAGINATION_URI_SEGMENT) : 0;

        $this->data['total_pages']  = $page;

        $this->data['users'] = $this->ion_auth->users($group_id, NULL, $page, $config["per_page"])->result();

        $this->data['pageing_link'] = $this->pagination->create_links();

        $this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
        $this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';

        $this->render('sysadmin/users/list_users_view');
    }



    public function page()

    {

        $this->index();
    }
    public function create()

    {

        $response = array();

        $response['token'] = $this->security->get_csrf_token_name();

        $response['hash'] = $this->security->get_csrf_hash();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('salutation', 'Salutation', 'trim');

        $this->form_validation->set_rules('first_name', 'First name', 'trim');

        $this->form_validation->set_rules('last_name', 'Last name', 'trim');

        $this->form_validation->set_rules('company', 'Company', 'trim');

        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        $this->form_validation->set_rules('password_confirm', 'Password confirmation', 'required|matches[password]');

        $this->form_validation->set_rules('groups[]', 'Groups', 'required|integer');
        if ($this->form_validation->run() === FALSE) {

            $response['status'] = 'haserror';

            $response['error'] = validation_errors();
        } else {

            $username = $this->input->post('username');

            $email = $this->input->post('email');

            $password = $this->input->post('password');

            $group_ids = $this->input->post('groups');

            $locations = !empty($_POST['locations']) ? implode(',', $_POST['locations']) : '';

            $additional_data = array(
                'salutation' => $this->input->post('salutation'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'address'    => $this->input->post('address'),
                'locations'     => $locations
            );

            $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);

            $this->session->set_flashdata('message', $this->ion_auth->messages());

            $response['status'] = 'success';

            $response['msg'] = "User account created successfully.";
        }

        echo json_encode($response);

        exit;
    }
    public function edit($user_id = NULL)

    {
        //pr($_POST); die;
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;

        if ($this->data['current_user']->id == $user_id) {

            $this->session->set_flashdata('message', 'Use the profile page to change your own credentials.');

            redirect('sysadmin/users', 'refresh');
        }

        $this->data['page_title'] = 'Edit user';

        $this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';

        $this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';


        //pr($this->data['locations']); die;

        $this->load->library('form_validation');

        $this->form_validation->set_rules('salutation', 'Salutation', 'trim');

        $this->form_validation->set_rules('first_name', 'First name', 'trim');

        $this->form_validation->set_rules('last_name', 'Last name', 'trim');

        $this->form_validation->set_rules('company', 'Company', 'trim');

        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');

        $this->form_validation->set_rules('password_confirm', 'Password confirmation', 'matches[password]');

        $this->form_validation->set_rules('groups[]', 'Groups', 'required|integer');

        //$this->form_validation->set_rules('locations[]','Location','required');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|integer|required');
        if ($this->form_validation->run() === FALSE) {

            if ($user = $this->ion_auth->user((int) $user_id)->row()) {
                $this->data['user'] = $user;
                $this->data['locations'] = $this->hospitals_model->selectdata("hid,hosp_name,location_id,sub_location_id", array('status' => 'active'), 'ORDER BY hid DESC');
            } else {
                $this->session->set_flashdata('message', 'The user doesn\'t exist.');
                redirect('sysadmin/users', 'refresh');
            }

            $this->data['groups'] = $this->ion_auth->groups()->result();
            $this->data['usergroups'] = array();
            if ($usergroups = $this->ion_auth->get_users_groups($user->id)->result()) {
                foreach ($usergroups as $group) {
                    $this->data['usergroups'][] = $group->id;
                }
            }

            $this->load->helper('form');
            $this->render('sysadmin/users/edit_users_view');
        } else {

            $user_id = $this->input->post('user_id');

            $locations = !empty($_POST['locations']) ? implode(',', $_POST['locations']) : '';

            //$departments=!empty($_POST['departments'])?implode(',',$_POST['departments']):'';


            $new_data = array(
                'salutation' => $this->input->post('salutation'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'address'    => $this->input->post('address'),
                'locations'  => $locations
            );

            if (strlen($this->input->post('password')) >= 6) $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user_id, $new_data);
            //Update the groups user belongs to
            $groups = $this->input->post('groups');
            if (isset($groups) && !empty($groups)) {
                $this->ion_auth->remove_from_group('', $user_id);
                foreach ($groups as $group) {
                    $this->ion_auth->add_to_group($group, $user_id);
                }
            }
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('sysadmin/users', 'refresh');
        }
    }


    public function delete($user_id = NULL)
    {
        if (is_null($user_id)) {
            $this->session->set_flashdata('message', 'There\'s no user to delete');
        } else {
            $this->ion_auth->delete_user($user_id);
            $this->session->set_flashdata('message', $this->ion_auth->messages());
        }

        redirect('sysadmin/users', 'refresh');
    }



    public function status()

    {

        $response = array();
        $response['token'] = $this->security->get_csrf_token_name();
        $response['hash'] = $this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($id != '') {
            if ($status == '1') {
                $status = '0';
            } else if ($status == '0') {
                $status = '1';
            }
            $columns = array();
            $columns['active'] = $status;
            /*$conditions=array();

		$conditions['id']=$id;*/

            $this->db->where('id', $id);

            $this->db->update('users', $columns);

            //$msg = "Expense name Status Successfully Updated.";

            //$this->session->set_flashdata('msg', $msg);

            //redirect($this->input->get('url'));

            $response['status_changed'] = $status;

            $response['status'] = 'success';
        } else {

            $response['status'] = 'haserror';

            $response['error'] = "Invalid request.";
        }

        echo json_encode($response);

        exit;
    }



    public function search()

    {

        $response = array();
        $response['token'] = $this->security->get_csrf_token_name();
        $response['hash'] = $this->security->get_csrf_hash();
        $response['data'] = array();

        $searchkey = $this->input->post('searchkey');
        $this->db->select("*")->from("users");
        if (!empty($searchkey)) {
            $this->db->like('first_name', $searchkey);
            $this->db->or_like('last_name', $searchkey);
       }
        $query = $this->db->get();
        $list = $query->result();
        if (count($list) > 0) {
            foreach ($list as $l) {
                $col = array();
                $col['id'] = $l->id;
                $col['username'] = $l->username;
                $col['name'] = $l->salutation . ". " . $l->first_name . " " . $l->last_name;
                $col['email'] = $l->email;
                $col['last_login'] = date('Y-m-d H:i:s', $l->last_login);
                $col['status'] = $l->active;
                array_push($response['data'], $col);
            }
        }
        echo json_encode($response);
        exit;
    }
}
