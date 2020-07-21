<?php
class Chat_model extends CI_Model
{

    function send_chat($data){

        $input_data = array('id_web_user' => $data['id_web_user'],
            'message_web_chat' => $data['message_web_chat'],
            'id_ref_web_chat' => $data['id_ref_web_chat'],
            'img_web_chat' => $data['img_web_chat'],
            'ucode_product_web_chat' => $data['ucode_product_web_chat'],
            'id_admin' => $data['id_admin'],
            'timestamp_web_chat' => $data['timestamp_web_chat']
        );

        $this->db->insert('web_chat',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function get_all_messages($id_web_user){
        $sql = "SELECT * FROM web_chat a
                LEFT JOIN (
                    SELECT a.*, b.nama_web_catprod, b.active_web_catprod , c.nama_web_col, c.active_web_col, f.file_web_image
                    FROM web_product a
                    INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                    INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                    INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                )b ON a.ucode_product_web_chat = b.ucode_web_product
                WHERE a.id_web_user = '".$id_web_user."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function is_read($id_web_user){
        $this->db->where('id_web_user', $id_web_user);
        return $this->db->update('web_chat',array("is_read"=>'1'));
    }

    function get_order_summary($id_web_so_m){
        $sql = "SELECT *
                FROM web_so_m a
                INNER JOIN web_so_info b ON a.id_web_so_m = b.id_web_so_M
                WHERE a.id_web_so_m = '".$id_web_so_m."'";

        $query = $this->db->query($sql);
        return $query;
    }

}
?>