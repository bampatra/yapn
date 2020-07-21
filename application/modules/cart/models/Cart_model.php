<?php
class Cart_model extends CI_Model
{

    function get_cart($id_web_so_m)
    {
        date_default_timezone_set('Asia/Jakarta');
        $sql = "SELECT a.*, b.*, c.*, d.*, e.*, f.file_web_image, g.nominal_web_promosi, g.persen_web_promosi 
                FROM web_so_d e
                INNER JOIN web_product a ON e.ucode_web_product = a.ucode_web_product
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN web_promosi g ON g.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN g.start_web_promosi AND g.end_web_promosi)
                WHERE e.id_web_so_m = '".$id_web_so_m."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_so_m_summary($id_web_so_m){
        $sql = "SELECT * FROM web_so_m WHERE id_web_so_m = '".$id_web_so_m."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_main_address($id_web_user){
        $sql = "SELECT * FROM pira.web_user_alamat WHERE id_web_user = '".$id_web_user."' AND is_primary = '1'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_so_d($id_web_so_d){
        $sql = "SELECT * FROM web_so_d WHERE id_web_so_d = '".$id_web_so_d."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_pricelist($id){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.nominal_web_promosi, b.persen_web_promosi
                FROM web_pricelist a 
                LEFT JOIN web_promosi b ON b.ucode_web_product = a.ucode_web_product 
                                               AND ('".date('Y-m-d H:i:s')."' BETWEEN b.start_web_promosi AND b.end_web_promosi)
                WHERE a.ucode_web_product = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_stock($ucode_web_product){
        $sql = "SELECT stok_web_product FROM web_product
                WHERE ucode_web_product = '".$ucode_web_product."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_address($id_web_user, $except = null){
        $sql = "SELECT * FROM pira.web_user_alamat WHERE id_web_user = '".$id_web_user."'";
        if(!is_null($except)){
            $sql .= " AND id_web_user_alamat <> '".$except."'";
        }
        $query = $this->db->query($sql);
        return $query;
    }


    function create_so_m($data)
    {
        $input_data = array('bukti_web_so_m' => $data['bukti_web_so_m'],
                            'id_user_web_so_m' => $data['id_user_web_so_m'],
                            'tgl_web_so_m' => $data['tgl_web_so_m'],
                            'total_web_so_m' => $data['total_web_so_m'],
                            'perc_disc_web_so_m' => $data['perc_disc_web_so_m'],
                            'nominal_disc_web_so_m' => $data['nominal_disc_web_so_m'],
                            'ongkir_web_so_m' => $data['ongkir_web_so_m'],
                            'ppn_web_so_m' => $data['ppn_web_so_m'],
                            'grand_total_web_so_m' => $data['grand_total_web_so_m'],
                            'status_web_so_m' => $data['status_web_so_m']);

        $this->db->insert('web_so_m',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_to_cart($data)
    {
        $input_data = array('id_web_so_m' => $data['id_web_so_m'],
                            'ucode_web_product' => $data['ucode_web_product'],
                            'nama_product_so_d' => $data['nama_product_so_d'],
                            'warna_product_so_d' => $data['warna_product_so_d'],
                            'qty_so_d' => $data['qty_so_d'],
                            'unit_price_so_d' => $data['unit_price_so_d'],
                            'nominal_disc_so_d' => $data['nominal_disc_so_d'],
                            'percent_disc_so_d' => $data['percent_disc_so_d'],
                            'total_price_so_d' => $data['total_price_so_d']);

        $this->db->insert('web_so_d',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }

    function update_cart($updated_data, $id_web_so_m){
        $this->db->where('id_web_so_m', $id_web_so_m);
        return $this->db->update('web_so_m',$updated_data);
    }

    function update_cart_item($updated_data, $id_web_so_d){
        $this->db->where('id_web_so_d', $id_web_so_d);
        return $this->db->update('web_so_d',$updated_data);
    }

    function delete_cart($id_web_so_m){
        $this->db->delete('web_so_m', array('id_web_so_m' => $id_web_so_m));
        $this->db->delete('web_so_d', array('id_web_so_m' => $id_web_so_m));
    }

    function remove_from_cart($id_web_so_d, $id_web_so_m){
       $this->db->delete('web_so_d', array('id_web_so_d' => $id_web_so_d, 'id_web_so_m' => $id_web_so_m));
       return $this->db->affected_rows();
    }

    function create_so_info($data){
        $input_data = array(
            'id_web_so_m' => $data['id_web_so_m'],
            'nama_web_user_alamat' => $data['nama_web_user_alamat'],
            'telp_web_user_alamat' => $data['telp_web_user_alamat'],
            'provinsi_web_user_alamat' => $data['provinsi_web_user_alamat'],
            'kota_web_user_alamat' => $data['kota_web_user_alamat'],
            'kecamatan_web_user_alamat' => $data['kecamatan_web_user_alamat'],
            'alamat_web_user_alamat' => $data['alamat_web_user_alamat'],
            'payment_date' => $data['payment_date'],
            'payment_ref' => $data['payment_ref'],
            'payment_notes' => $data['payment_notes'],
            'delivery_notes_web_so_info' => $data['delivery_notes_web_so_info']

        );

        $this->db->insert('web_so_info',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function decrease_stock($ucode_web_product, $qty_so_d){
        $sql = "UPDATE web_product
                SET stok_web_product = stok_web_product - ".$qty_so_d."
                WHERE ucode_web_product = '".$ucode_web_product."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function exists_in_cart($id_web_so_m, $ucode_web_product){
        $sql = "SELECT * FROM web_so_d WHERE id_web_so_m = '".$id_web_so_m."' AND ucode_web_product = '".$ucode_web_product."'";
        $query = $this->db->query($sql);
        return $query;
    }



}
?>