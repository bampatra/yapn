<?php
class Admin_model extends CI_Model
{

    function get_all_products(){
        $sql = "SELECT * FROM web_product a 
            INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
            INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
            LEFT JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_category(){
        $sql = "SELECT * FROM web_catprod a";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_color(){
        $sql = "SELECT * FROM web_color a";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_pricelist(){
        $sql = "SELECT a.*, b.nama_web_product
                FROM web_pricelist a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_user(){
        $sql = "SELECT * FROM web_user a";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_alamat(){
        $sql = "SELECT a.*, b.email_web_user
                FROM web_user_alamat a
                INNER JOIN web_user b ON a.id_web_user = b.id_web_user
                ORDER BY b.email_web_user";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_orders($status = 'all', $id_web_user = null, $with_product = false, $order = null){
        $sql = "SELECT * 
                FROM web_so_m a
                INNER JOIN web_so_info b ON a.id_web_so_m = b.id_web_so_m
                INNER JOIN web_user c ON a.id_user_web_so_m = c.id_web_user";

        if($with_product){
            $sql .= " INNER JOIN web_so_d d ON a.id_web_so_m = d.id_web_so_m
                      LEFT JOIN web_product e ON d.ucode_web_product = e.ucode_web_product
                      LEFT JOIN web_image f ON d.ucode_web_product = f.ref_web_image AND f.image_order = '1' ";
        }

        if($status != 'all'){
            $sql .= " WHERE a.status_web_so_m = '".$status."'";
        } else {
            $sql .= " WHERE a.status_web_so_m <> '0'";
        }

        if($id_web_user != null){
            $sql .= " AND a.id_user_web_so_m = '".$id_web_user."'";
        }

        if($order != null){
            $sql .= " AND a.bukti_web_so_m = '".$order."'";
        }

        $sql .= " ORDER BY a.tgl_web_so_m DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_promo(){
        $sql = "SELECT a.*, b.nama_web_product, c.nominal_web_pricelist
                FROM web_promosi a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                INNER JOIN web_pricelist c ON c.ucode_web_product = b.ucode_web_product";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_banner($type){
        $sql = "SELECT * FROM web_banner WHERE tipe_web_banner = '".$type."' ORDER BY order_web_banner";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_products_with_price(){
        $sql = "SELECT a.*, b.*, c.*, d.nominal_web_pricelist, e.nominal_web_promosi, e.persen_web_promosi, f.file_web_image
            FROM web_product a 
            INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
            INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
            INNER JOIN web_pricelist d ON d.ucode_web_product = a.ucode_web_product
            LEFT JOIN web_promosi e ON e.ucode_web_product = a.ucode_web_product AND (NOW() BETWEEN e.start_web_promosi AND e.end_web_promosi)
            INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_review(){
        $sql = "SELECT a.*, b.nama_web_product, b.art_number_web_product, c.nama_web_col, d.email_web_user, e.email_web_user AS admin
                FROM web_ulasan a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                INNER JOIN web_color c ON c.ucode_web_col = b.ucode_col
                INNER JOIN web_user d ON a.id_web_user = d.id_web_user
                LEFT JOIN web_user e ON e.id_web_user = a.id_admin";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_message_header($search = null, $message_filter = '1'){
        $sql = "SELECT b.email_web_user, a.*, IF(a.message_web_chat = '' OR a.message_web_chat LIKE '%product-link-chat%', '[attachment]', a.message_web_chat) AS header_message
                FROM (
                    SELECT m1.*
                    FROM web_chat m1 LEFT JOIN web_chat m2
                     ON (m1.id_web_user = m2.id_web_user AND m1.id_web_chat < m2.id_web_chat)
                    WHERE m2.id_web_chat IS NULL
                )a
                INNER JOIN web_user b ON a.id_web_user = b.id_web_user
                WHERE (a.id_admin = '".$message_filter."' || 1 = '".$message_filter."')";

        if($search != null){
            $sql .= " AND b.email_web_user LIKE '%".$search."%'";
        }

        $sql .= " ORDER BY a.timestamp_web_chat DESC";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_message_detail($id_web_user){
        $sql = "SELECT * FROM
                (
                    SELECT * FROM web_chat a
                    LEFT JOIN (
                        SELECT a.*, b.nama_web_catprod, b.active_web_catprod, c.nama_web_col, c.active_web_col, f.file_web_image
                        FROM web_product a
                        INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                        INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                        LEFT JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                    )b ON a.ucode_product_web_chat = b.ucode_web_product
                    WHERE a.id_web_user = '".$id_web_user."'
                    ORDER BY a.timestamp_web_chat DESC
                    -- LIMIT 10
                )a
                ORDER BY a.timestamp_web_chat";

        $query = $this->db->query($sql);
        return $query;
    }

    function mark_as_unread($id_web_user){
        $sql = "UPDATE web_chat m1 
                LEFT JOIN web_chat m2
                 ON (m1.id_web_user = m2.id_web_user AND m1.id_web_chat < m2.id_web_chat)
                SET m1.is_read = '0'
                WHERE m2.id_web_chat IS NULL 
                  AND m1.id_admin = '0'
                  AND m1.id_web_user = '".htmlentities($id_web_user)."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function is_read($id_web_user){
        $this->db->where('id_web_user', $id_web_user);
        $this->db->where('id_admin', 0);
        return $this->db->update('web_chat',array("is_read"=>'1'));
    }


    function get_gambar_produk($ucode_web_product){
        $sql = "SELECT *
                FROM web_image
                WHERE tipe_web_image = 'PRODUCT'
                    AND ref_web_image = '".$ucode_web_product."'
                ORDER BY image_order";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_web_image_by_id($id_web_image){
        $sql = "SELECT *
                FROM web_image
                WHERE id_web_image = '".$id_web_image."'
                ORDER BY image_order";

        $query = $this->db->query($sql);
        return $query;
    }


    function get_product_by_id($ucode_web_product){
        $sql = "SELECT *
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col";

        $sql .= " WHERE a.ucode_web_product = '".$ucode_web_product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_category_by_id($ucode_catprod){
        $sql = "SELECT * FROM web_catprod a";

        $sql .= " WHERE a.id_web_catprod = '".$ucode_catprod."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_category_by_name($nama_web_catprod){
        $sql = "SELECT * FROM web_catprod a";

        $sql .= " WHERE a.nama_web_catprod = '".$nama_web_catprod."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_color_by_id($ucode_web_col){
        $sql = "SELECT * FROM web_color a";

        $sql .= " WHERE a.ucode_web_col = '".$ucode_web_col."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_color_by_name($nama_web_col){
        $sql = "SELECT * FROM web_color a";

        $sql .= " WHERE a.nama_web_col = '".$nama_web_col."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_pricelist_by_id($id_web_pricelist){
        $sql = "SELECT a.*, b.nama_web_product
                FROM web_pricelist a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product";

        $sql .= " WHERE a.id_web_pricelist = '".$id_web_pricelist."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_product_not_in_pricelist(){
        $sql = "SELECT * FROM web_product 
                WHERE ucode_web_product NOT IN
                (
                    SELECT ucode_web_product 
                    FROM web_pricelist
                )";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_user_by_id($id_web_user){
        $sql = "SELECT * FROM web_user a";

        $sql .= " WHERE a.id_web_user = '".$id_web_user."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_alamat_by_id($id_web_user_alamat){
        $sql = "SELECT a.*, b.email_web_user
                FROM web_user_alamat a
                INNER JOIN web_user b ON a.id_web_user = b.id_web_user
                WHERE a.id_web_user_alamat = '".$id_web_user_alamat."'
                ORDER BY b.email_web_user";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_order_by_id($id){
        $sql = "SELECT * 
                FROM web_so_d a
                INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                INNER JOIN web_so_info c ON c.id_web_so_m = b.id_web_so_m
                INNER JOIN web_user d ON b.id_user_web_so_m = d.id_web_user
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                WHERE b.bukti_web_so_m = '".$id."'
                AND b.status_web_so_m <> '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_promo_by_id($id){
        $sql = "SELECT a.*, b.nama_web_product, c.nominal_web_pricelist, 
                        DATE_FORMAT(a.start_web_promosi, '%Y-%m-%dT%H:%i') AS custom_start_date,
                        DATE_FORMAT(a.end_web_promosi, '%Y-%m-%dT%H:%i') AS custom_end_date
                FROM web_promosi a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                INNER JOIN web_pricelist c ON c.ucode_web_product = b.ucode_web_product
                WHERE a.id_web_promosi = '".$id."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_promo_by_product($ucode_web_product){
        $sql = "SELECT a.*, b.nama_web_product, c.nominal_web_pricelist, 
                        DATE_FORMAT(a.start_web_promosi, '%Y-%m-%dT%H:%i') AS custom_start_date,
                        DATE_FORMAT(a.end_web_promosi, '%Y-%m-%dT%H:%i') AS custom_end_date
                FROM web_promosi a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                INNER JOIN web_pricelist c ON c.ucode_web_product = b.ucode_web_product
                WHERE a.ucode_web_product = '".$ucode_web_product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_review_by_id($id){
        $sql = "SELECT a.*, b.nama_web_product, b.art_number_web_product, c.nama_web_col, d.email_web_user, e.email_web_user AS admin
                FROM web_ulasan a
                INNER JOIN web_product b ON a.ucode_web_product = b.ucode_web_product
                INNER JOIN web_color c ON c.ucode_web_col = b.ucode_col
                INNER JOIN web_user d ON a.id_web_user = d.id_web_user
                LEFT JOIN web_user e ON e.id_web_user = a.id_admin
                WHERE a.id_web_ulasan = '".$id."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_banner_by_id($id_web_banner){
        $sql = "SELECT * FROM web_banner 
                WHERE id_web_banner = '".$id_web_banner."' ORDER BY active_web_banner, order_web_banner";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_product_not_in_promo(){
        $sql = "SELECT * 
                FROM web_product a
                INNER JOIN web_pricelist b ON a.ucode_web_product = b.ucode_web_product
                WHERE a.ucode_web_product NOT IN
                (
                    SELECT ucode_web_product 
                    FROM web_promosi
                )";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_users_except($except){
        $sql = "SELECT * FROM web_user 
                WHERE id_web_user <> '".$except."' 
                AND id_web_user NOT IN (SELECT id_web_user FROM web_chat)
                ORDER BY email_web_user";

        $query = $this->db->query($sql);
        return $query;
    }

    function add_product($data){

        $input_data = array(
            'date_web_product' => $data['date_web_product'],
            'nama_web_product' => $data['nama_web_product'],
            'art_number_web_product' => $data['art_number_web_product'],
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

    function update_product($updated_data, $ucode_web_product){
        $this->db->where('ucode_web_product', $ucode_web_product);
        return $this->db->update('web_product',$updated_data);
    }

    function add_category($data){
        $input_data = array(
            'nama_web_catprod' => $data['nama_web_catprod'],
            'img_web_catprod' => $data['img_web_catprod'],
            'icon_web_catprod' => $data['icon_web_catprod'],
            'active_web_catprod' => $data['active_web_catprod']
        );
        $this->db->insert('web_catprod',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    function update_category($updated_data, $ucode_catprod){
        $this->db->where('id_web_catprod', $ucode_catprod);
        return $this->db->update('web_catprod',$updated_data);
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

    function update_color($updated_data, $ucode_web_col){
        $this->db->where('ucode_web_col', $ucode_web_col);
        return $this->db->update('web_color',$updated_data);
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

    function update_pricelist($updated_data, $id_web_pricelist){
        $this->db->where('id_web_pricelist', $id_web_pricelist);
        return $this->db->update('web_pricelist',$updated_data);
    }

    function add_user($data){
        $input_data = array(
            'email_web_user' => $data['email_web_user'],
            'telp_web_user' => $data['telp_web_user'],
            'password_web_user' => $data['password_web_user'],
            'active_web_user' => $data['active_web_user'],
            'is_admin' => $data['is_admin']
        );

        $this->db->insert('web_user',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_user($updated_data, $id_web_user){
        $this->db->where('id_web_user', $id_web_user);
        return $this->db->update('web_user',$updated_data);
    }

    function update_status_so_m($status, $id_so_m){
        $this->db->where('id_web_so_m', $id_so_m);
        return $this->db->update('web_so_m',$status);
    }

    function update_info_so_m($updated_data, $id_so_m){
        $this->db->where('id_web_so_m', $id_so_m);
        return $this->db->update('web_so_info',$updated_data);
    }

    function add_promosi($data){
        $input_data = array(
            'ucode_web_product' => $data['ucode_web_product'],
            'nominal_web_promosi' => $data['nominal_web_promosi'],
            'persen_web_promosi' => $data['persen_web_promosi'],
            'start_web_promosi' => $data['start_web_promosi'],
            'end_web_promosi' => $data['end_web_promosi']
        );

        $this->db->insert('web_promosi',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_promosi($updated_data, $id_web_promosi){
        $this->db->where('id_web_promosi', $id_web_promosi);
        return $this->db->update('web_promosi',$updated_data);
    }

    function update_promosi_by_product($updated_data, $ucode_web_product){
        $this->db->where('ucode_web_product', $ucode_web_product);
        return $this->db->update('web_promosi',$updated_data);
    }

    function delete_promosi($id_web_promosi){
        $this->db->where('id_web_promosi', $id_web_promosi);
        return $this->db->delete('web_promosi');
    }

    function add_web_image($data){
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

    function get_image_order($ucode_web_product){
        $sql = "SELECT image_order FROM pira.web_image
                WHERE ref_web_image = '".$ucode_web_product."'
                ORDER BY image_order";

        $query = $this->db->query($sql);
        return $query;
    }

    function remove_gambar_produk($id_web_image){
        $this->db->where('id_web_image', $id_web_image);
        return $this->db->delete('web_image');
    }

    function update_gambar_produk($updated_data, $rand_temporary_code){
        $this->db->where('ref_web_image', $rand_temporary_code);
        return $this->db->update('web_image',$updated_data);
    }


    function update_image($updated_data, $id_web_image){
        $this->db->where('id_web_image', $id_web_image);
        return $this->db->update('web_image',$updated_data);
    }

    function penjualan_bulanan(){
        $sql = "SELECT IF(SUM(total_web_so_m) IS NULL, 0, SUM(total_web_so_m)) as monthly_sales
                FROM web_so_m
                WHERE MONTH(tgl_web_so_m) = MONTH(CURRENT_DATE())
                AND YEAR(tgl_web_so_m) = YEAR(CURRENT_DATE())
                AND status_web_so_m = '4'";

        $query = $this->db->query($sql);
        return $query;
    }

    // change with date_selesai
    function penjualan_harian($tgl){
        $sql = "SELECT IF(SUM(a.total_web_so_m) IS NULL, 0, SUM(a.total_web_so_m)) as daily_sales
                FROM web_so_m a
                INNER JOIN web_so_info b ON a.id_web_so_m = b.id_web_so_m
                WHERE b.selesai_date LIKE '%".$tgl."%'
                        AND a.status_web_so_m = '4'";

        $query = $this->db->query($sql);
        return $query;
    }

    function order_harian($tgl){
        $sql = "SELECT IF(COUNT(*) IS NULL, 0, COUNT(*)) as daily_sales
                FROM web_so_m a
                INNER JOIN web_so_info b ON a.id_web_so_m = b.id_web_so_m
                WHERE b.selesai_date LIKE '%".$tgl."%'
                        AND a.status_web_so_m <> '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    function ratarata_ulasan(){
        $sql = "select avg(rating_web_ulasan) as average_review from web_ulasan";
        $query = $this->db->query($sql);
        return $query;
    }

    function produk_terjual(){
        $sql = "SELECT COUNT(qty_so_d) as total_qty_sold
                FROM web_so_d a
                INNER JOIN web_so_m b ON a.id_web_so_m = b.id_web_so_m
                WHERE b.status_web_so_m = '4'";

        $query = $this->db->query($sql);
        return $query;
    }

    function all_orders_count(){
        $sql = "SELECT COUNT(*) as total_count
                FROM web_so_m 
                WHERE status_web_so_m <> '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_so_m_by_status($status){
        $sql = "SELECT COUNT(*) as status_count
                FROM web_so_m 
                WHERE status_web_so_m = '".$status."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function update_ulasan($updated_data, $id_web_ulasan){
        $this->db->where('id_web_ulasan', $id_web_ulasan);
        return $this->db->update('web_ulasan',$updated_data);
    }

    function add_banner($data){
        $input_data = array(
            'tipe_web_banner' => $data['tipe_web_banner'],
            'file_web_banner' => $data['file_web_banner'],
            'url_web_banner' => $data['url_web_banner'],
            'order_web_banner' => $data['order_web_banner'],
            'active_web_banner' => $data['active_web_banner']
        );

        $this->db->insert('web_banner',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_banner($updated_data, $id_web_banner){
        $this->db->where('id_web_banner', $id_web_banner);
        return $this->db->update('web_banner',$updated_data);
    }

    function product_name_check($product){
        $sql = "SELECT *
                FROM web_product
                WHERE nama_web_product = '".$product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function art_number_check($product){
        $sql = "SELECT *
                FROM web_product
                WHERE art_number_web_product = '".$product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function product_check($nama, $art){
        $sql = "SELECT *
                FROM web_product
                WHERE art_number_web_product = '".$art."' 
                AND nama_web_product = '".$nama."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function pricelist_check($ucode_web_product){
        $sql = "SELECT *
                FROM web_pricelist
                WHERE ucode_web_product = '".$ucode_web_product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function promosi_check($ucode_web_product){
        $sql = "SELECT *
                FROM web_promosi
                WHERE ucode_web_product = '".$ucode_web_product."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_order_summary($id_web_so_m){
        $sql = "SELECT *
                FROM web_so_m a
                INNER JOIN web_so_info b ON a.id_web_so_m = b.id_web_so_M
                WHERE a.id_web_so_m = '".$id_web_so_m."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_user_by_email($email_web_user){
        $sql = "SELECT *
                FROM web_user
                WHERE email_web_user = '".$email_web_user."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_variable($tipe_web_variable = null){
        $sql = "SELECT * FROM web_variable";

        if($tipe_web_variable){
            $sql .= " WHERE tipe_web_variable = '".$tipe_web_variable."'";
        }

        $query = $this->db->query($sql);
        return $query;
    }

    function get_variable_by_id($id){
        $sql = "SELECT * FROM web_variable WHERE id_web_variable = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function add_variable($data){
        $input_data = array(
            'tipe_web_variable' => $data['tipe_web_variable'],
            'nama_web_variable' => $data['nama_web_variable'],
            'isi_web_variable' => $data['isi_web_variable'],
            'timestamp_web_variable' => $data['timestamp_web_variable']
        );

        $this->db->insert('web_variable',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_variable($updated_data, $id_web_variable){
        $this->db->where('id_web_variable', $id_web_variable);
        return $this->db->update('web_variable',$updated_data);
    }

}
?>