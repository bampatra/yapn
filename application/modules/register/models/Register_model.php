<?php
class Register_model extends CI_Model
{

    function get_category()
    {
        $query = $this->db->query("SELECT * FROM web_catprod");
        return $query->result_object();
    }

    function register_to_db($data){
        $input_data = array('email_web_user' => $data['email_web_user'],
                            'telp_web_user' => $data['telp_web_user'],
                            'password_web_user' => $data['password_web_user'],
                            'active_web_user' => '0',
                            'is_admin' => '0');
        $this->db->insert('web_user',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function check_email_phone($email, $phone){
        $sql = "SELECT * FROM web_user WHERE email_web_user = '".$email."' OR telp_web_user = '".$phone."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function add_token($data){
        $input_data = array('token_web_token' => $data['token_web_token'],
                            'id_web_user' => $data['id_web_user'],
                            'duration_web_token' => $data['duration_web_token'],
                            'timestamp_web_token' => $data['timestamp_web_token']);
        $this->db->insert('web_token',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function get_token($token){
        $sql = "SELECT * FROM web_token WHERE BINARY token_web_token = '".htmlentities($token)."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function activate_user($id_web_user){
        $this->db->where('id_web_user', htmlentities($id_web_user));
        return $this->db->update('web_user',array('active_web_user'=>'1'));
    }

    function deactivate_token($token){
        $this->db->where('token_web_token', htmlentities($token));
        return $this->db->update('web_token',array('is_valid'=>'0'));
    }

}
?>