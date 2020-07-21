<?php
class Product_model extends CI_Model
{


    function get_product_from_url($art_no, $warna, $id_web_user)
    {

        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, e.id_web_user_favorite, f.file_web_image, g.nominal_web_promosi, g.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                LEFT JOIN web_user_favorite e ON e.ucode_web_product = a.ucode_web_product AND e.id_web_user = '".$id_web_user."'
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN web_promosi g ON g.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN g.start_web_promosi AND g.end_web_promosi)";

        $sql .= " WHERE a.art_number_web_product = '".$art_no."' 
                    AND c.nama_web_col = '".$warna."' 
                    AND a.active_web_product = '1'
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_product_by_id($ucode_web_product, $id_web_user){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, e.id_web_user_favorite, g.nominal_web_promosi, g.persen_web_promosi
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                LEFT JOIN web_user_favorite e ON e.ucode_web_product = a.ucode_web_product AND e.id_web_user = '".$id_web_user."'
                LEFT JOIN web_promosi g ON g.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN g.start_web_promosi AND g.end_web_promosi)";

        $sql .= " WHERE a.ucode_web_product = '".$ucode_web_product."' 
                    AND a.active_web_product = '1'
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_products($search = null, $all = false, $limit = null, $offset = null){
        $sql = "SELECT * FROM web_product a 
            INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
            INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
            INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'";

        if(!$all){
            $sql .=  " WHERE a.active_web_product = '1'
                        AND b.active_web_catprod = '1'
                        AND c.active_web_col = '1'";
        }

        if($search != null){
            $sql .= " AND CONCAT(a.nama_web_product, a.art_number_web_product) LIKE '%".$search."%'";
        }

        $sql .= " ORDER BY a.nama_web_product";

        if($limit != null && $offset != null){
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $query = $this->db->query($sql);
        return $query;
    }

    function get_average_review($ucode_web_product){
        $sql = "SELECT round(AVG(a.rating_web_ulasan),0) AS round_rating, round(AVG(rating_web_ulasan),1) AS rating
                FROM web_ulasan a
                WHERE a.ucode_web_product = '".$ucode_web_product."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_product_review($ucode_web_product){
        $sql = "SELECT *
                FROM web_ulasan a
                WHERE a.ucode_web_product = '".$ucode_web_product."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function add_product($data){

        $input_data = array(
            'nama_web_product' => $data['nama_web_product'],
            'art_number_web_product' => $data['art_number_web_product'],
            'date_web_product' => $data['date_web_product'],
            'length_web_product' => $data['length_web_product'],
            'width_web_product' => $data['width_web_product'],
            'height_web_product' => $data['height_web_product'],
            'wn_web_product' => $data['wn_web_product'],
            'wg_web_product' => $data['wg_web_product'],
            'vol_web_product' => $data['vol_web_product'],
            'ucode_catprod' => $data['ucode_catprod'],
            'ucode_col' => $data['ucode_col'],
            'desc_web_product' => $data['desc_web_product'],
            'maintenance_web_product' => $data['maintenance_web_product'],
            'stok_web_product' => $data['stok_web_product'],
            'active_web_product' => $data['active_web_product']
        );

        $this->db->insert('web_product',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_color($data){
        $input_data = array(
            'nama_web_col' => $data['nama_web_col'],
            'img_web_col' => $data['img_web_col'],
            'active_web_col' => $data['active_web_col']
        );

        $this->db->insert('web_color',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_pricelist($data){
        $input_data = array(
            'ucode_web_product' => $data['ucode_web_product'],
            'nominal_web_pricelist' => $data['nominal_web_pricelist'],
            'id_cabang_web_pricelist' => $data['id_cabang_web_pricelist']
        );

        $this->db->insert('web_pricelist',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_image($data){
        $input_data = array(
            'tipe_web_image' => $data['tipe_web_image'],
            'ref_web_image' => $data['ref_web_image'],
            'file_web_image' => $data['file_web_image'],
            'image_order' => $data['image_order']
        );

        $this->db->insert('web_image',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_to_favorite($data){
        $input_data = array(
            'id_web_user' => $data['id_web_user'],
            'ucode_web_product' => $data['ucode_web_product']
        );

        $this->db->insert('web_user_favorite',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function remove_from_favorite($id_web_user, $ucode_web_product){
        return $this->db->delete('web_user_favorite', array('id_web_user' => $id_web_user, 'ucode_web_product' => $ucode_web_product));
    }

    function get_product_images($ucode_web_product){
        $sql = "SELECT * 
                FROM web_image a 
                WHERE a.ref_web_image = '".$ucode_web_product."'
                ORDER BY a.image_order";

        $query = $this->db->query($sql);
        return $query;
    }




}
?>