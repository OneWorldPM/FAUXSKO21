<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $this->load->model('user/m_register', 'objregister');
		$this->load->model('user/m_login', 'objlogin');
    }

    public function index() {
        $login_type = $this->session->userdata('userType');
        if ($login_type == 'user') {
            redirect('home');
        }
        $this->load->view('register-new');
        //$this->load->view('header');
        //$this->load->view('register');
        //$this->load->view('footer');
    }

    public function add_customer() {

        $this->load->config('email_config', TRUE);

        if (!$this->config->item('smtp_user', 'email_config'))
        {
            header('location:' . base_url() . 'register?msg=E'); //Some Error
        }

        $result = $this->objregister->add_customer();
        if ($result == "exist") {
            header('location:' . base_url() . 'register?msg=A'); //email or phone already Exist
        } else if ($result == "error") {
            header('location:' . base_url() . 'register?msg=E'); //Some Error
        } else {
			$cust_id = $result;
            $user_details = $this->db->get_where("customer_master", array("cust_id" => $cust_id))->row();
            $token = $this->objlogin->update_user_token($cust_id);


            //Send email to registered users
            $config = Array(
                'protocol' => $this->config->item('protocol', 'email_config'),
                'smtp_host' => $this->config->item('smtp_host', 'email_config'),
                'smtp_port' => $this->config->item('smtp_port', 'email_config'),
                'smtp_user' => $this->config->item('smtp_user', 'email_config'),
                'smtp_pass' => $this->config->item('smtp_pass', 'email_config'),
                'mailtype'  => $this->config->item('mailtype', 'email_config'),
                'charset'   => $this->config->item('charset', 'email_config')
            );
            $this->load->library('email', $config);

            $this->email->from('fauxsko21@yourconference.live', 'FauxSKO21');
            $this->email->to($user_details->email);
            //$this->email->cc('athullive@gmail.com');
            //$this->email->bcc('them@their-example.com');

            $this->email->subject('FAUXSKO 2021 Registration Confirmation');

            $email_body = file_get_contents(base_url().'front_assets/email_templates/register.php');

            $this->email->message($email_body);

            $result = $this->email->send();


//            $session = array(
//                'cid' => $user_details->cust_id,
//                'cname' => $user_details->first_name,
//                'fullname' => $user_details->first_name . ' ' . $user_details->last_name,
//                'email' => $user_details->email,
//                'token' => $token,
//                'userType' => 'user'
//            );
//            $this->session->set_userdata($session);
            header('location:' . base_url() . 'register?msg=Done'); //Done
        }
    }

    public function user_profile($reg_id) {
        if ($reg_id != $this->session->userdata('cid'))
            header('location:' . base_url() . 'login');

        $data["myprofile"] = $this->objregister->get_user_profile_details($reg_id);
        $data["cms_details"] = $this->objregister->get_cms_details(1);
        $this->load->view('header');
        $this->load->view('update_user', $data);
        $this->load->view('footer');
    }

    public function update_user() {

        if ($this->input->post()['cust_id'] != $this->session->userdata('cid'))
            header('location:' . base_url() . 'login');

        $cust_id = $this->objregister->update_user();
        header('location:' . base_url() . 'register/user_profile/' . $cust_id."?status=success");
    }

    public function plan_pricing($cust_id) {
        $data["plan_pricing"] = $this->objregister->get_plan_pricing();
        $data["myprofile"] = $this->objregister->get_user_profile_details($cust_id);
        $data["cms_details"] = $this->objregister->get_cms_details(2);
        $this->load->view('header');
        $this->load->view('plan_pricing', $data);
        $this->load->view('footer');
    }

    public function update_registration_type() {
        $cust_id = $this->objregister->update_registration_type();
        header('location:' . base_url() . 'register/payment/' . $cust_id);
    }

    public function payment($cust_id) {
        $data["myprofile"] = $this->objregister->get_user_payment_details($cust_id);
        $data["cancellation_policy"] = $this->objregister->get_cms_details(3);
        $data["cms_details"] = $this->objregister->get_cms_details(3);
        $this->load->view('header');
        $this->load->view('payment', $data);
        $this->load->view('footer');
    }

    public function pay_payment() {
        $cust_id = $this->objregister->pay_payment();
        header('location:' . base_url() . 'register/payment_confirmed/' . $cust_id);
    }

    public function payment_confirmed($cust_id) {
        $data["cms_details"] = $this->objregister->get_cms_details(5);
        $data["cust_id"] = $cust_id;
        $this->load->view('header');
        $this->load->view('payment_confirmed', $data);
        $this->load->view('footer');
    }

    public function get_promo_code_details() {
        $promo_code_details = $this->objregister->get_promo_code_details();
        if (!empty($promo_code_details)) {
            echo json_encode(array("status" => "success", "promo_code_details" => $promo_code_details));
        } else {
            echo json_encode(array("status" => "error"));
        }
    }

}
