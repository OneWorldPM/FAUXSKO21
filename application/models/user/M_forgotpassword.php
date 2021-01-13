<?php
class M_forgotpassword extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function setnewpassword($post){
        $data = array(
            'password' => base64_encode(trim($post['password']))
        );
        $this->db->update('customer_master', $data, array('cust_id' => base64_decode($post['cust_id'])));

        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }
   
}
