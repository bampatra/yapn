<?php
class Profile_model extends CI_Model
{

    function add_new_address($data){
        $input_data = array('id_web_user' => $data['id_web_user'],
            'nama_web_user_alamat' => $data['nama_web_user_alamat'],
            'telp_web_user_alamat' => $data['telp_web_user_alamat'],
            'provinsi_web_user_alamat' => $data['provinsi_web_user_alamat'],
            'kota_web_user_alamat' => $data['kota_web_user_alamat'],
            'kecamatan_web_user_alamat' => $data['kecamatan_web_user_alamat'],
            'alamat_web_user_alamat' => $data['alamat_web_user_alamat'],
            'notes_web_user_alamat' => $data['notes_web_user_alamat'],
            'is_primary' => $data['is_primary']);

        $this->db->insert('web_user_alamat',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_address($updated_data, $id_web_user_alamat){
        $this->db->where('id_web_user_alamat', $id_web_user_alamat);
        return $this->db->update('web_user_alamat',$updated_data);
    }

    function add_review($data){
        $input_data = array('id_web_user' => $data['id_web_user'],
            'id_so_d' => $data['id_so_d'],
            'ucode_web_product' => $data['ucode_web_product'],
            'detail_web_ulasan' => $data['detail_web_ulasan'],
            'rating_web_ulasan' => $data['rating_web_ulasan'],
            'img1_web_ulasan' => $data['img1_web_ulasan'],
            'img2_web_ulasan' => $data['img2_web_ulasan'],
            'img3_web_ulasan' => $data['img3_web_ulasan'],
            'img4_web_ulasan' => $data['img4_web_ulasan'],
            'img5_web_ulasan' => $data['img5_web_ulasan'],
            'tgl_web_ulasan' => $data['tgl_web_ulasan']);

        $this->db->insert('web_ulasan',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    function update_review($updated_data, $id_web_ulasan){
        $this->db->where('id_web_ulasan', $id_web_ulasan);
        return $this->db->update('web_ulasan',$updated_data);
    }

    function get_row_review($id_web_review){
        $sql = "SELECT * FROM web_ulasan a WHERE a.id_web_ulasan = '".$id_web_review."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_riwayat_pesanan($id_web_user, $filters = null){
        $sql = "SELECT a.*, b.*, 
                    c.id_web_ulasan, c.detail_web_ulasan, c.rating_web_ulasan, c.img1_web_ulasan, c.img2_web_ulasan, c.img3_web_ulasan,
                    c.img4_web_ulasan, c.img5_web_ulasan, c.tgl_web_ulasan, d.paid_by_user,
                    f.file_web_image
                FROM web_so_d a
                INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                LEFT JOIN web_ulasan c ON a.id_web_so_d = c.id_so_d AND c.id_web_user = '".$id_web_user."'
                INNER JOIN web_so_info d ON d.id_web_so_m = b.id_web_so_m
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE b.id_user_web_so_m = '".$id_web_user."'
                AND b.status_web_so_m <> '0'";

        if($filters != null){
            foreach($filters as $filter){
                $sql .= " AND $filter";
            }
        }

        $sql .= " ORDER BY b.tgl_web_so_m DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_riwayat_pesanan_chat($id_web_user, $search){
        $sql = "SELECT a.*, b.*, d.paid_by_user, f.file_web_image
                FROM web_so_d a
                INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                INNER JOIN web_so_info d ON d.id_web_so_m = b.id_web_so_m
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE b.id_user_web_so_m = '".$id_web_user."'
                AND b.status_web_so_m <> '0'";

        if($search != null){
            $sql .= " AND CONCAT(a.nama_product_so_d, ' ', b.bukti_web_so_m) LIKE '%".$search."%'";
        }

        $sql .= " ORDER BY b.tgl_web_so_m DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_row_ulasan($id_web_ulasan){
        $sql = "SELECT *
                FROM web_ulasan a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                LEFT JOIN web_image f ON b.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE a.id_web_ulasan = '".$id_web_ulasan."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_detail_pesanan($id){
        $sql = "SELECT * 
                FROM web_so_d a
                INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                INNER JOIN web_so_info c ON c.id_web_so_m = b.id_web_so_m
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE b.bukti_web_so_m = '".$id."'
                AND b.status_web_so_m <> '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_alamat($filter = null){
        $sql = "SELECT * FROM web_user_alamat";

        if($filter != null){
            $sql .= " WHERE $filter";
        }

        $query = $this->db->query($sql);
        return $query;
    }

    function get_favorites($id_web_user, $ucode_web_product = null){

        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, f.file_web_image, g.round_rating, g.rating, h.nominal_web_promosi, h.persen_web_promosi
                FROM web_user_favorite a 
                INNER JOIN web_product b ON b.ucode_web_product = a.ucode_web_product
                INNER JOIN web_color c ON c.ucode_web_col = b.ucode_col 
                INNER JOIN web_pricelist d ON d.ucode_web_product = b.ucode_web_product
                LEFT JOIN web_user_favorite e ON e.ucode_web_product = a.ucode_web_product AND e.id_web_user = '".$id_web_user."'
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN (
                    SELECT a.ucode_web_product, round(AVG(a.rating_web_ulasan),0) AS round_rating, round(AVG(rating_web_ulasan),1) AS rating
                    FROM web_ulasan a
                    GROUP BY a.ucode_web_product
                )g ON a.ucode_web_product = g.ucode_web_product
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                INNER JOIN web_catprod i ON i.id_web_catprod = b.ucode_catprod
                WHERE a.id_web_user = '".$id_web_user."'
                AND c.active_web_col = '1'
                AND b.active_web_product = '1'
                AND i.active_web_catprod = '1'
                ";

        if($ucode_web_product != null){
            $sql .= " AND a.ucode_web_product = '".$ucode_web_product."'";
        }

        $sql .= " ORDER BY a.id_web_user_favorite DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_main_address($id_web_user){
        $sql = "SELECT * FROM pira.web_user_alamat WHERE id_web_user = '".$id_web_user."' AND is_primary = '1'";
        $query = $this->db->query($sql);
        return $query;
    }

    function reset_address($id_web_user){
        $sql = "UPDATE web_user_alamat SET is_primary = '0' WHERE id_web_user = '".$id_web_user."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function set_main_address($id_web_user_alamat){
        $sql = "UPDATE web_user_alamat SET is_primary = '1' WHERE id_web_user_alamat = '".$id_web_user_alamat."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function add_user_activity($data){
        $input_data = array('id_web_user' => $data['id_web_user'],
            'tipe_web_user_activity' => $data['tipe_web_user_activity'],
            'detail_web_user_activity' => $data['detail_web_user_activity'],
            'count_web_user_activity' => $data['count_web_user_activity'],
            'timestamp_web_user_activity' => $data['timestamp_web_user_activity']);

        $this->db->insert('web_user_activity',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function get_activity($id_web_user, $tipe_activity, $detail_activity = null){

        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT *
                FROM web_user_activity a
                INNER JOIN (
                    SELECT a.*, b.nama_web_catprod, c.nama_web_col, d.nominal_web_pricelist, f.file_web_image, g.round_rating, g.rating, h.nominal_web_promosi, h.persen_web_promosi
                    FROM web_product a
                    INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                    INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                    INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                    INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                    LEFT JOIN (
                        SELECT a.ucode_web_product, round(AVG(a.rating_web_ulasan),0) AS round_rating, round(AVG(rating_web_ulasan),1) AS rating
                        FROM web_ulasan a
                        GROUP BY a.ucode_web_product
                    )g ON a.ucode_web_product = g.ucode_web_product
                    LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                    WHERE c.active_web_col = '1'
                        AND a.active_web_product = '1'
                        AND b.active_web_catprod = '1'
                    
                )b ON b.ucode_web_product = a.detail_web_user_activity
                WHERE a.id_web_user = '".$id_web_user."'
                AND a.tipe_web_user_activity = '".$tipe_activity."'";

        if($detail_activity != null){
            $sql .= " AND a.detail_web_user_activity = '".$detail_activity."'";
        }

        $sql .= " ORDER BY a.timestamp_web_user_activity";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_activity_plain($id_web_user, $tipe_activity, $detail_activity = null){
        $sql = "SELECT *
                FROM web_user_activity a
                WHERE a.id_web_user = '".$id_web_user."'
                AND a.tipe_web_user_activity = '".$tipe_activity."'";

        if($detail_activity != null){
            $sql .= " AND a.detail_web_user_activity = '".$detail_activity."'";
        }

        $sql .= " ORDER BY a.timestamp_web_user_activity";

        $query = $this->db->query($sql);
        return $query;
    }

    function update_user_activity($id_web_user_activity, $updated_data){
        $this->db->where('id_web_user_activity', $id_web_user_activity);
        return $this->db->update('web_user_activity',$updated_data);
    }

    function update_web_so_info($id_web_so_m, $updated_data){
        $this->db->where('id_web_so_m', $id_web_so_m);
        return $this->db->update('web_so_info',$updated_data);
    }

    function get_detail_user($id_web_user){
        $sql = "SELECT * FROM web_user a WHERE a.id_web_user = '".$id_web_user."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function update_detail_user($id_web_user, $updated_data){
        $this->db->where('id_web_user', $id_web_user);
        return $this->db->update('web_user',$updated_data);
    }

    function delete_address($id_web_user_alamat){
        $this->db->where('id_web_user_alamat', $id_web_user_alamat);
        return $this->db->delete('web_user_alamat');
    }

    function update_status_so_m($status, $id_so_m){
        $this->db->where('id_web_so_m', $id_so_m);
        return $this->db->update('web_so_m',$status);
    }

    function get_suggest_provinsi($search){
        $sql = "SELECT * FROM web_region WHERE LEVEL = '1' AND NAMA LIKE '%".$search."%'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_suggest_kota($search, $provinsi){
        $sql = "SELECT a.*, b.NAMA as PROVINSI, b.KODE_WILAYAH as KODE_PROVINSI
                FROM web_region a
                INNER JOIN web_region b ON b.KODE_WILAYAH = a.MST_KODE_WILAYAH
                WHERE a.LEVEL = '2' AND a.NAMA LIKE '%".$search."%' AND (a.MST_KODE_WILAYAH = '".$provinsi."' OR 0 = '".$provinsi."')";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_suggest_kecamatan($search, $kota){
        $sql = "SELECT a.*, b.NAMA as KOTA, b.KODE_WILAYAH as KODE_KOTA, c.NAMA as PROVINSI, c.KODE_WILAYAH as KODE_PROVINSI
                FROM web_region a
                INNER JOIN web_region b ON b.KODE_WILAYAH = a.MST_KODE_WILAYAH
                INNER JOIN web_region c ON c.KODE_WILAYAH = b.MST_KODE_WILAYAH
                WHERE a.LEVEL = '3' AND a.NAMA LIKE '%".$search."%' AND (a.MST_KODE_WILAYAH = '".$kota."' OR 0 = '".$kota."')";
        $query = $this->db->query($sql);
        return $query;
    }

    function email_check($email_web_user){
        $sql = "SELECT * FROM web_user WHERE email_web_user = '".$email_web_user."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function phone_check($telp_web_user){
        $sql = "SELECT * FROM web_user WHERE telp_web_user = '".$telp_web_user."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>


















