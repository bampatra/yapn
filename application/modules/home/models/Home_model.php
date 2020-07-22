<?php
class Home_model extends CI_Model
{

    function get_category()
    {
        $query = $this->db->query("SELECT * FROM web_catprod WHERE active_web_catprod = '1'");
        return $query->result_object();
    }

    function is_registered($creds, $password){
        $query = $this->db->query("SELECT * FROM web_user 
                                    WHERE password_web_user = '{$password}'
                                    AND (email_web_user = '{$creds}' OR telp_web_user = '{$creds}')
                                    AND active_web_user = '1'");

        return $query;
    }

    function get_user_cart($id_web_user){
        $sql = "SELECT * FROM web_so_m WHERE id_user_web_so_m = '".$id_web_user."' AND status_web_so_m = '0' ORDER BY tgl_web_so_M DESC LIMIT 1";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_banner($tipe){
        $sql = "SELECT * FROM web_banner a WHERE a.tipe_web_banner = '".$tipe."' AND a.active_web_banner = '1' ORDER BY order_web_banner ASC";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_tren(){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT g.product_view, a.*, b.*, c.*, d.*, f.file_web_image, h.nominal_web_promosi, h.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                LEFT JOIN (
						SELECT detail_web_user_activity as ucode_web_product, SUM(count_web_user_activity) as product_view
						FROM web_user_activity
						WHERE tipe_web_user_activity = 'PRODUCT'
						GROUP BY detail_web_user_activity
						ORDER BY SUM(count_web_user_activity) desc
                )g ON g.ucode_web_product = a.ucode_web_product
                WHERE a.active_web_product = '1' 
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
				LIMIT 4" ;

        $query = $this->db->query($sql);
        return $query;
    }

    function get_terlaris(){
        date_default_timezone_set('Asia/Jakarta');
        $sql = "SELECT g.total_sold,a.*, b.*, c.*, d.*, f.file_web_image, h.nominal_web_promosi, h.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                LEFT JOIN (
						SELECT a.ucode_web_product, SUM(a.qty_so_d) as total_sold
                        FROM web_so_d a
                        INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                        WHERE b.status_web_so_m = '4'
                        GROUP BY a.ucode_web_product
                        ORDER BY SUM(a.qty_so_d) desc, a.ucode_web_product
                )g ON g.ucode_web_product = a.ucode_web_product
                WHERE a.active_web_product = '1' 
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
                ORDER BY g.total_sold desc, a.nama_web_product
				LIMIT 10" ;

        $query = $this->db->query($sql);
        return $query;
    }

    function get_promosi(){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, f.file_web_image, h.nominal_web_promosi, h.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                INNER JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                WHERE a.active_web_product = '1' 
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_promosi_banner(){
        $sql = "SELECT * FROM web_banner a WHERE a.tipe_web_banner = 'PROMOSI' AND a.active_web_banner = '1' ORDER BY order_web_banner ASC";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_suggest_product($search){
        date_default_timezone_set('Asia/Jakarta');
        $sql = "SELECT a.*, b.*, c.*, d.nominal_web_pricelist, f.file_web_image, h.nominal_web_promosi, h.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE a.active_web_product = '1' 
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
                    AND CONCAT(a.nama_web_product, b.nama_web_catprod, c.nama_web_col) LIKE '%".$search."%'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_notification($id_web_user){
        $sql = "SELECT * FROM web_notifikasi a WHERE a.id_web_user = '".$id_web_user."' ORDER BY a.timestamp_web_notifikasi DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    function add_notification($data){
        $input_data = array(
            'id_web_user' => $data['id_web_user'],
            'isi_web_notifikasi' => $data['isi_web_notifikasi'],
            'is_read' => $data['is_read'],
            'timestamp_web_notifikasi' => $data['timestamp_web_notifikasi'],
            'url_web_notifikasi' => $data['url_web_notifikasi']);

        $this->db->insert('web_notifikasi',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_notification($updated_data, $id_web_notifikasi){
        $this->db->where('id_web_notifikasi', $id_web_notifikasi);
        return $this->db->update('web_notifikasi',$updated_data);
    }

    function get_media_sosial($media_sosial){
        $sql = "SELECT * FROM web_variable WHERE tipe_web_variable = 'MEDIA_SOSIAL' AND nama_web_variable = '".$media_sosial."'";
        $query = $this->db->query($sql);
        return $query;
    }
}
?>