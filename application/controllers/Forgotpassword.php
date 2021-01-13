<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->common->set_timezone();
          $this->load->model('user/m_forgotpassword', 'objforgotpassword');
    }

    public function index() {
        $this->load->view('header-no-menu-bar');
        $this->load->view('forgotpassword');
        $this->load->view('footer');
    }

    public function checkEmail() {
        $email = $this->input->post('email');
        $this->db->where('email', trim($email));
        $customer = $this->db->get('customer_master');
        if ($customer->num_rows() > 0) { //Check Email or Phone exist with new Use
            $result['msg'] = 'exist';
            echo json_encode($result);
        } else {
            $result['msg'] = 'notexist';
            echo json_encode($result);
        }
    }

    public function sendEmail() {
        $email = $this->input->post('email');
        $this->db->where('email', trim($email));
        $customer = $this->db->get('customer_master');

        if ($customer->num_rows() > 0) { //Check Email or Phone exist with new Use
            $cust_data = $customer->row();

            $this->load->config('email_config', TRUE);

            if (!$this->config->item('smtp_user', 'email_config'))
            {
                $response = array(
                    'status' => 'no_email_config',
                    'msg' => "Send email option is not configured, please contact developer or system administrator."
                );

                echo json_encode($response);

                return;
            }

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

            $link = base_url() . 'forgotpassword/changePassword?id=' . base64_encode($cust_data->cust_id);

            $this->email->from('fauxsko21@yourconference.live', 'FauxSKO21');
            $this->email->to($email);
            //$this->email->cc('athullive@gmail.com');
            //$this->email->bcc('them@their-example.com');

            $this->email->subject('Recover your password');

            $email_body = file_get_contents(base_url().'front_assets/email_templates/recover_password.php?link='.$link);

            $this->email->message($email_body);

            $result = $this->email->send();

            if ($result)
            {
                $response = array(
                    'status' => 'success',
                    'msg' => "Password recovery email was sent!"
                );
                echo json_encode($response);
            }else{

                $response = array(
                    'status' => 'failed',
                    'msg' => "Unable to send email."
                );

                echo json_encode($response);
            }

            return;

        } else {

            $response = array(
                'status' => 'email_does_not_exist',
                'msg' => "Email does not exist in our database."
            );

            echo json_encode($response);

            return;
        }
    }

    public function changePassword() {
        $data['customer_id'] = $this->input->get('id');

        //$this->load->view('header');
        $this->load->view('changeforgotpassword', $data);
        //$this->load->view('footer');
    }

    public function passwordChange() {
        $post = $this->input->post();
        if (!empty($post)) {
            if($this->objforgotpassword->setnewpassword($post))
                echo json_encode(array('status'=>'success'));
            else
                echo json_encode(array('status'=>'failed'));
        } else {
            echo json_encode(array('status'=>'failed'));
        }

        return;
    }

}
