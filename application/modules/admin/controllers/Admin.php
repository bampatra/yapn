<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('home/Home_model');
        $this->load->model('cart/Cart_model');
        if(!$this->session->userdata('id_web_user') || $_SESSION['is_admin'] == '0'){
            redirect(base_url('home/admin_login'));
        }


        $this->load->library('s3');

        $this->config->load('s3', TRUE);
        $s3_config = $this->config->item('s3');
        $this->bucket_name = $s3_config['bucket_name'];
        $this->s3_url = $s3_config['s3_url'];

    }

    function index()
    {
        $this->load->view('template/admin_header');
        $this->load->view('index');
        $this->load->view('template/admin_footer');
    }

    function product()
    {
        $this->load->view('template/admin_header');
        $this->load->view('product_v2');
        $this->load->view('template/admin_footer');
    }

    function catprod()
    {
        $this->load->view('template/admin_header');
        $this->load->view('catprod');
        $this->load->view('template/admin_footer');
    }

    function color()
    {
        $this->load->view('template/admin_header');
        $this->load->view('color');
        $this->load->view('template/admin_footer');
    }

    function pricelist()
    {
        $this->load->view('template/admin_header');
        $this->load->view('pricelist');
        $this->load->view('template/admin_footer');
    }

    function user(){
        $this->load->view('template/admin_header');
        $this->load->view('user');
        $this->load->view('template/admin_footer');
    }

    function alamat(){
        $this->load->view('template/admin_header');
        $this->load->view('alamat');
        $this->load->view('template/admin_footer');
    }

    function orders(){
        $this->load->view('template/admin_header');
        if (isset($_GET['no'])) {
            $this->load->view('order_detail');
        } else {
            $this->load->view('orders');
        }
        $this->load->view('template/admin_footer');
    }

    function promo(){
        $this->load->view('template/admin_header');
        $this->load->view('promo');
        $this->load->view('template/admin_footer');
    }

    function sales(){
        $this->load->view('template/admin_header');
        $this->load->view('sales');
        $this->load->view('template/admin_footer');
    }

    function chat(){
        $this->load->view('chat');
    }

    function review(){
        $this->load->view('template/admin_header');
        $this->load->view('review');
        $this->load->view('template/admin_footer');
    }

    function banner(){
        $this->load->view('template/admin_header');
        $this->load->view('banner');
        $this->load->view('template/admin_footer');
    }

    function banner_promosi(){
        $this->load->view('template/admin_header');
        $this->load->view('banner_promosi');
        $this->load->view('template/admin_footer');
    }

    function media_sosial(){
        $this->load->view('template/admin_header');
        $this->load->view('media_sosial');
        $this->load->view('template/admin_footer');
    }


    function get_all_products(){
        $data = $this->Admin_model->get_all_products();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_category(){
        $data = $this->Admin_model->get_all_category();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_color(){
        $data = $this->Admin_model->get_all_color();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_pricelist(){
        $data = $this->Admin_model->get_all_pricelist();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_user(){
        $data = $this->Admin_model->get_all_user();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_alamat(){
        $data = $this->Admin_model->get_all_alamat();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_orders(){

        if(isset($_REQUEST['user'])){
            $id_web_user = $_REQUEST['user'];
        } else {
            $id_web_user = null;
        }

        if(isset($_REQUEST['with_product'])){
            $with_product = true;
        } else {
            $with_product = false;
        }

        if(isset($_REQUEST['order']) && $_REQUEST['order'] != ''){
            $order = htmlentities($_REQUEST['order']);
        } else {
            $order = null;
        }

        $data = $this->Admin_model->get_all_orders($_REQUEST['status'], $id_web_user, $with_product, $order);
        echo json_encode($data->result_object());
        return;
    }

    function get_all_promo(){
        $data = $this->Admin_model->get_all_promo();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_review(){
        $data = $this->Admin_model->get_all_review();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_banner(){
        if(isset($_REQUEST['type'])){
            $type = $_REQUEST['type'];
        } else {
            $type = null;
        }

        $data = $this->Admin_model->get_all_banner($type);
        echo json_encode($data->result_object());
        return;
    }

    function get_all_products_with_price(){
        $data = $this->Admin_model->get_all_products_with_price();
        echo json_encode($data->result_object());
        return;
    }

    function get_message_header(){


        if(isset($_REQUEST['user_search'])){
            $user_search = trim($_REQUEST['user_search']);
            if($user_search == ''){
                $user_search == ' ';
            }
        } else {
            $user_search = null;
        }


        $data = $this->Admin_model->get_message_header($user_search, htmlentities(trim($_REQUEST['message_filter'])));
        echo json_encode($data->result_object());
        return;
    }

    function get_message_detail(){
        $id_web_user = $_REQUEST['id_web_user'];
        $read_all = $_REQUEST['read_all'];
        $data = $this->Admin_model->get_message_detail($id_web_user);
        if($read_all == 'true'){
            $this->Admin_model->is_read($id_web_user);
        }
        echo json_encode($data->result_object());
        return;
    }

    function mark_as_unread(){
        $id_web_user = $_REQUEST['id_web_user'];
        $this->Admin_model->mark_as_unread($id_web_user);
        echo json_encode(array('Status'=>"OK"));

    }

    function get_gambar_produk(){
        $ucode_web_product = $_REQUEST['ucode_web_product'];
        $data = $this->Admin_model->get_gambar_produk($ucode_web_product);
        echo json_encode($data->result_object());
        return;
    }

    function get_product_by_id(){
        $ucode_web_product = $_REQUEST['ucode_web_product'];
        $data = $this->Admin_model->get_product_by_id($ucode_web_product);
        echo json_encode($data->row());
        return;
    }

    function get_category_by_id(){
        $ucode_catprod = $_REQUEST['ucode_catprod'];
        $data = $this->Admin_model->get_category_by_id($ucode_catprod);
        echo json_encode($data->row());
        return;
    }

    function get_color_by_id(){
        $ucode_web_col = $_REQUEST['ucode_web_col'];
        $data = $this->Admin_model->get_color_by_id($ucode_web_col);
        echo json_encode($data->row());
        return;
    }

    function get_pricelist_by_id(){
        $id_web_pricelist = $_REQUEST['id_web_pricelist'];
        $data = $this->Admin_model->get_pricelist_by_id($id_web_pricelist);
        echo json_encode($data->row());
        return;
    }

    function get_product_not_in_pricelist(){
        $data = $this->Admin_model->get_product_not_in_pricelist();
        echo json_encode($data->result_object());
        return;
    }

    function get_user_by_id(){
        $id_web_user = $_REQUEST['id_web_user'];
        $data = $this->Admin_model->get_user_by_id($id_web_user);
        echo json_encode($data->row());
        return;
    }

    function get_alamat_by_id(){
        $id_web_user_alamat = $_REQUEST['id_web_user_alamat'];
        $data = $this->Admin_model->get_alamat_by_id($id_web_user_alamat);
        echo json_encode($data->row());
        return;
    }

    function get_order_by_id(){
        $id = $_REQUEST['id'];
        $data = $this->Admin_model->get_order_by_id($id);

        echo json_encode($data->result_object());
        return;
    }

    function get_promo_by_id(){
        $id = $_REQUEST['id'];
        $data = $this->Admin_model->get_promo_by_id($id);

        echo json_encode($data->row());
        return;

    }

    function get_review_by_id(){
        $id = $_REQUEST['id_web_ulasan'];
        $data = $this->Admin_model->get_review_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function get_banner_by_id(){
        $id_web_banner = $_REQUEST['id_web_banner'];
        $data = $this->Admin_model->get_banner_by_id($id_web_banner);
        echo json_encode($data->row());
        return;
    }

    function get_product_not_in_promo(){
        $data = $this->Admin_model->get_product_not_in_promo();
        echo json_encode($data->result_object());
        return;
    }

    function get_users_except(){
        $except = $_SESSION['id_web_user'];
        $data = $this->Admin_model->get_users_except($except);
        echo json_encode($data->result_object());
        return;

    }

    function get_user_by_email(){
        $email_web_user = htmlentities($_REQUEST['user'], ENT_QUOTES);
        $data = $this->Admin_model->get_user_by_email($email_web_user);
        echo json_encode($data->row());
        return;
    }

    function add_product(){

        date_default_timezone_set('Asia/Jakarta');

        $ucode_web_product = $_REQUEST['ucode_web_product'];
        $date_web_product = date('Y-m-d H:i:s');

        $nama_web_product = htmlentities(trim($_REQUEST['nama_web_product']));
        $art_number_web_product = htmlentities(trim($_REQUEST['art_number_web_product']));

        $length_web_product = htmlentities(str_replace(',', '.', $_REQUEST['length_web_product']));
        $width_web_product = htmlentities(str_replace(',', '.', $_REQUEST['width_web_product']));
        $height_web_product = htmlentities(str_replace(',', '.', $_REQUEST['height_web_product']));
        $wn_web_product = htmlentities(str_replace(',', '.', $_REQUEST['wn_web_product']));
        $wg_web_product = htmlentities(str_replace(',', '.', $_REQUEST['wg_web_product']));
        $vol_web_product = htmlentities(str_replace(',', '.', $_REQUEST['vol_web_product']));


        $ucode_catprod = htmlentities($_REQUEST['ucode_catprod']);
        $ucode_col = htmlentities($_REQUEST['ucode_col']);
        $desc_web_product = htmlentities($_REQUEST['desc_web_product']);
        $maintenance_web_product = htmlentities($_REQUEST['maintenance_web_product']);
        $stok_web_product = htmlentities($_REQUEST['stok_web_product']);

        // validation
        if($nama_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Nama produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($art_number_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Art Number produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($length_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Panjang produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($width_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Lebar produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($height_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Tinggi produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($wn_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Berat bersih produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($wg_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Berat kotor produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($vol_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Volume produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($ucode_catprod == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Kategori produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($ucode_col == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Warna produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($desc_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Deskripsi produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($maintenance_web_product == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Cara perawatan produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }


        $rand_temporary_code = $_REQUEST['rand_temporary_code'];

        if(isset($_REQUEST['active_web_product'])){
            $active_web_product = '1';
        } else if(!isset($_REQUEST['active_web_product'])){
            $active_web_product = '0';
        }

        if($ucode_web_product == 0){

            if($this->Admin_model->product_name_check($nama_web_product)->num_rows() > 0){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Nama produk sudah ada');
                echo json_encode($return_arr);
                return;
            }

            if($this->Admin_model->art_number_check($art_number_web_product)->num_rows() > 0){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Art number produk sudah ada');
                echo json_encode($return_arr);
                return;
            }


            $data = compact('date_web_product', 'nama_web_product', 'art_number_web_product', 'length_web_product',
                'width_web_product', 'height_web_product', 'wn_web_product', 'wg_web_product', 'vol_web_product', 'ucode_catprod',
                'ucode_col', 'desc_web_product', 'maintenance_web_product', 'stok_web_product', 'active_web_product');

            $insert_id = $this->Admin_model->add_product($data);

            if($insert_id){
                // update image
                $updated_data = array('ref_web_image' => $insert_id);
                if($this->Admin_model->update_gambar_produk($updated_data, $rand_temporary_code)){
                    $return_arr = array("Status" => 'OK', "Message" => '');
                } else {
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan gambar produk');
                }

            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan produk');
            }
        } else {
            $product = $this->Admin_model->get_product_by_id($ucode_web_product);
            if($product->num_rows() == 0){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate produk');
                echo json_encode($return_arr);
                return;
            }

            // if product name is not the same as the previous one
            if($nama_web_product != trim($product->row()->nama_web_product)){
                // check if product name exists
                if($this->Admin_model->product_name_check($nama_web_product)->num_rows() > 0){
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Nama produk sudah ada');
                    echo json_encode($return_arr);
                    return;
                }
            }

            // if art number is not the same as the previous one
            if($art_number_web_product != trim($product->row()->art_number_web_product)){
                // check if art number exists
                if($this->Admin_model->art_number_check($art_number_web_product)->num_rows() > 0){
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Art number produk sudah ada');
                    echo json_encode($return_arr);
                    return;
                }
            }

            $data = compact( 'nama_web_product', 'art_number_web_product', 'length_web_product',
                'width_web_product', 'height_web_product', 'wn_web_product', 'wg_web_product', 'vol_web_product', 'ucode_catprod',
                'ucode_col', 'desc_web_product', 'maintenance_web_product', 'stok_web_product', 'active_web_product');

            if($this->Admin_model->update_product($data, $ucode_web_product)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate produk');
            }
        }

        echo json_encode($return_arr);

    }

    function add_category(){
        $nama_web_catprod = strtoupper(trim(htmlentities($_REQUEST['nama_web_catprod'])));
        $img_web_catprod = htmlentities($_REQUEST['img_web_catprod']);
        $icon_web_catprod = htmlentities($_REQUEST['icon_web_catprod']);
        $ucode_catprod = htmlentities($_REQUEST['ucode_catprod']);

        if(isset($_REQUEST['active_web_catprod'])){
            $active_web_catprod = '1';
        } else if(!isset($_REQUEST['active_web_catprod'])){
            $active_web_catprod = '0';
        }

        if($nama_web_catprod == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Nama kategori tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }



        $data = compact('nama_web_catprod', 'img_web_catprod', 'icon_web_catprod', 'active_web_catprod');

        if($ucode_catprod == 0){
            if($this->Admin_model->add_category($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan kategori');
            }
        } else {
            if($this->Admin_model->update_category($data, $ucode_catprod)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate kategori');
            }
        }

        echo json_encode($return_arr);
    }

    function add_warna(){
        $nama_web_col = strtoupper(trim(htmlentities($_REQUEST['nama_web_col'])));
        $img_web_col = '';
        $ucode_web_col = htmlentities($_REQUEST['ucode_web_col']);

        if(isset($_REQUEST['active_web_col'])){
            $active_web_col = '1';
        } else if(!isset($_REQUEST['active_web_col'])){
            $active_web_col = '0';
        }

        if($nama_web_col == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Nama warna tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }


        $data = compact('nama_web_col', 'img_web_col', 'active_web_col');

        if($ucode_web_col == 0){
            if($this->Admin_model->add_color($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan warna');
            }
        } else {
            if($this->Admin_model->update_color($data, $ucode_web_col)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate warna');
            }
        }

        echo json_encode($return_arr);

    }

    function add_harga(){
        // add harga validation, if product exists then reject
        // validation: harga numbers only

        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product']);
        $nominal_web_pricelist = trim(htmlentities($_REQUEST['nominal_web_pricelist']));
        $id_cabang_web_pricelist = 18;

        $id_web_pricelist = $_REQUEST['id_web_pricelist'];

        $data = compact('ucode_web_product', 'nominal_web_pricelist', 'id_cabang_web_pricelist');

        if($ucode_web_product == '0'){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Produk tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($nominal_web_pricelist == '0'){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Nominal harga tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($id_web_pricelist == 0){

            if($this->Admin_model->pricelist_check($ucode_web_product)->num_rows() > 0){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Produk sudah memiliki harga jual');
                echo json_encode($return_arr);
                return;
            }

            if($this->Admin_model->add_pricelist($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan harga');
            }
        } else {
            if($this->Admin_model->update_pricelist($data, $id_web_pricelist)){

                $data_promo = $this->Admin_model->get_promo_by_product($ucode_web_product);
                if($data_promo->num_rows() > 0){
                    $data_promo_row = $data_promo->row();

                    if(isset($_REQUEST['update_promosi'])){
                        // update harga akhir based on percent
                        $persen_web_promosi = $data_promo_row->persen_web_promosi;

                        $calc = ($persen_web_promosi / 100) * $nominal_web_pricelist;
                        $new_harga_akhir = $nominal_web_pricelist - $calc;
                        $update_promo = array('nominal_web_promosi' => $new_harga_akhir);


                    } else {
                        // update percentage based on harga akhir
                        $nominal_web_promosi = $data_promo_row->nominal_web_promosi;

                        $calc = round((100 * $nominal_web_promosi) / $nominal_web_pricelist);
                        $new_persen = 100 - $calc;
                        $update_promo = array('persen_web_promosi' => $new_persen);
                    }


                    if($this->Admin_model->update_promosi_by_product($update_promo, $ucode_web_product)){
                        $return_arr = array("Status" => 'OK', "Message" => '');
                    } else {
                        $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate promosi');
                    }
                } else {
                    $return_arr = array("Status" => 'OK', "Message" => '');
                }

            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate harga');
            }
        }

        echo json_encode($return_arr);
    }

    function add_user(){

        $email_web_user = strtoupper(trim(htmlentities($_REQUEST['email_web_user'])));
        $telp_web_user = htmlentities($_REQUEST['telp_web_user']);


        if(isset($_REQUEST['active_web_user'])){
            $active_web_user = '1';
        } else if(!isset($_REQUEST['active_web_user'])){
            $active_web_user = '0';
        }

        if(isset($_REQUEST['is_admin'])){
            $is_admin = '1';
        } else if(!isset($_REQUEST['is_admin'])){
            $is_admin = '0';
        }

        $id_web_user = $_REQUEST['id_web_user'];

        $check_password = $this->Admin_model->get_user_by_id($id_web_user);

        if($check_password->row()->password_web_user != trim($_REQUEST['password_web_user'])){
            $password_web_user = md5($_REQUEST['password_web_user']);
        } else {
            $password_web_user = $_REQUEST['password_web_user'];
        }

        if($email_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Email user tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($telp_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'No. Telepon user tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($password_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Password tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        $data = compact('email_web_user', 'telp_web_user','password_web_user','active_web_user', 'is_admin');
        if($id_web_user == 0){

            if($this->Admin_model->add_user($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan user');
            }
        } else {
            if($this->Admin_model->update_user($data, $id_web_user)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate user');
            }
        }

        echo json_encode($return_arr);
    }

    function add_promo(){

        // validation: make sure the same product doesnt have two promo at the same time (check if time overlaps)

        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product']);
        $nominal_web_promosi = htmlentities($_REQUEST['nominal_web_promosi']);
        $persen_web_promosi = htmlentities($_REQUEST['persen_web_promosi']);
        $start_web_promosi = $_REQUEST['start_web_promosi'];
        $end_web_promosi = $_REQUEST['end_web_promosi'];
        $id_web_promosi = $_REQUEST['id_web_promosi'];

        if($ucode_web_product == '0'){
            $result_array = array("Status" => 'ERROR',"Message" => "Produk tidak boleh kosong");
            echo json_encode($result_array);
            return;
        }

        if($nominal_web_promosi == '' || $persen_web_promosi == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Nominal promosi tidak valid");
            echo json_encode($result_array);
            return;
        }

        if($start_web_promosi == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Silahkan isi tanggal awal dengan benar");
            echo json_encode($result_array);
            return;
        } else {
            $start_web_promosi = date("Y-m-d H:i:s",strtotime($_REQUEST['start_web_promosi']));
        }

        if($end_web_promosi == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Silahkan isi tanggal akhir dengan benar");
            echo json_encode($result_array);
            return;
        } else {
            $end_web_promosi = date("Y-m-d H:i:s",strtotime($_REQUEST['end_web_promosi']));
        }

        $data = compact('ucode_web_product', 'nominal_web_promosi', 'persen_web_promosi', 'start_web_promosi', 'end_web_promosi');
        if($id_web_promosi == 0){

            if($this->Admin_model->add_promosi($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan promosi');
            }
        } else {
            if($this->Admin_model->update_promosi($data, $id_web_promosi)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate promosi');
            }
        }

        echo json_encode($return_arr);
    }

    function add_banner(){
        $file_web_banner = $_REQUEST['file_web_banner'];
        $tipe_web_banner = $_REQUEST['type'];
        $url_web_banner = $_REQUEST['url_web_banner'];
        $id_web_banner =  $_REQUEST['id_web_banner'];
        $order_web_banner = 1;

        if(isset($_REQUEST['active_web_banner'])){
            $active_web_banner = '1';
        } else if(!isset($_REQUEST['active_web_banner'])){
            $active_web_banner = '0';
        }

        $data = $this->Admin_model->get_all_banner('MAIN');

        foreach($data->result_object() as $banner){
            $order_web_banner++;
        }


        if($id_web_banner == '0' || $id_web_banner == ''){
            // add
            $data = compact('file_web_banner', 'tipe_web_banner', 'url_web_banner','order_web_banner', 'active_web_banner');
            if($this->Admin_model->add_banner($data)){
                $result_array = array("Status" => 'OK',"Message" => "");
            } else {
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal Menyimpan Banner");
            }

        } else {
            $data = compact('file_web_banner', 'tipe_web_banner', 'url_web_banner', 'active_web_banner');
            if($this->Admin_model->update_banner($data, $id_web_banner)){
                $result_array = array("Status" => 'OK',"Message" => "");
            } else {
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal Menyimpan Banner");
            }
        }

        echo json_encode($result_array);
        return;


    }

    function upload_image_catprod()
    {
        $config['upload_path'] = './assets/images/real_category/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;


        /* UPLOAD FILE IN AWS S3*/
        $config['folder_name'] = 'upload/category/';
        $this->folder_name = $config['folder_name'];
        $file_path = $_FILES['img_web_catprod_input']['tmp_name'];
        $file = pathinfo($file_path);
        $s3_file = $file['filename'].'-'.rand(1000,1).'.jpg';
        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);

        $saved = $this->s3->putObjectFile(
            $file_path,
            $this->bucket_name,
            $this->folder_name.$s3_file,
            S3::ACL_PUBLIC_READ,
            array(),
            $mime_type
        );

        if ($saved) {
            $result_array = array("Status" => 'OK', "File" => $this->s3_url.$this->folder_name.$s3_file);
        } else {
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupload foto");
        }

        echo json_encode($result_array);
        return;

        /* UPLOAD FILE IN LOCAL STORAGE*/
//        $this->load->library('upload', $config);
//
//        if (!$this->upload->do_upload('img_web_catprod_input')) {
//            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
//        } else {
//            $file_data = $this->upload->data();
//            $result_array = array("Status" => 'OK', "File" => $file_data);
//            //upload to database
//
//        }
//
//        echo json_encode($result_array);
//        return;

    }

    function pembayaran_diterima(){
        $payment_date = $_REQUEST['tanggal-pembayaran'];
        $payment_notes = htmlentities($_REQUEST['catatan-pembayaran'], ENT_QUOTES);
        $id_so_m = $_REQUEST['id_so_m'];

        if($payment_date == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Silahkan isi tanggal pembayaran dengan benar");
            echo json_encode($result_array);
            return;
        } else {
            $payment_date = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal-pembayaran']));
        }

        $this->db->trans_begin();

        $data = compact('payment_date', 'payment_notes');
        if($this->Admin_model->update_info_so_m($data, $id_so_m)){

           $status = array("status_web_so_m" => '2');
           if($this->Admin_model->update_status_so_m($status, $id_so_m)){

               date_default_timezone_set('Asia/Jakarta');
               $date  = date('Y-m-d H:i:s');

               $cart_data = $this->Cart_model->get_so_m_summary($id_so_m)->row();
               $notifikasi = array(
                   'id_web_user' => $cart_data->id_user_web_so_m,
                   'isi_web_notifikasi' => "Pembayaran untuk pesanan $cart_data->bukti_web_so_m telah diterima pada $payment_date. Pesanan sedang diproses!",
                   'is_read' => '0',
                   'timestamp_web_notifikasi' => $date,
                   'url_web_notifikasi' => 'profile/purchase_detail?id='.$cart_data->bukti_web_so_m
               );

               $this->Home_model->add_notification($notifikasi);

               $this->db->trans_commit();
               $result_array = array("Status" => 'OK',"Message" => "Status pesanan berhasil diupdate");
           } else {
               $this->db->trans_rollback();
               $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate status pesanan (1)");
           }
        } else {
            $this->db->trans_rollback();
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate status pesanan (2)");
        }

        echo json_encode($result_array);
        return;
    }

    function pesanan_dikirim(){
        $delivery_date = $_REQUEST['tanggal-pengiriman'];
        $no_resi_web_so_info = htmlentities(trim($_REQUEST['resi-pengiriman']), ENT_QUOTES);
        $nama_ekspedisi_web_so_info = htmlentities(strtoupper(trim($_REQUEST['nama-ekspedisi'])), ENT_QUOTES);
        $id_so_m = $_REQUEST['id_so_m'];

        if($delivery_date == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Silahkan isi tanggal pengiriman dengan benar");
            echo json_encode($result_array);
            return;
        } else {
            $delivery_date = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal-pengiriman']));
        }

        if($no_resi_web_so_info == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "No Resi tidak boleh kosong!");
            echo json_encode($result_array);
            return;
        }

        if($nama_ekspedisi_web_so_info == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Nama Ekspedisi tidak boleh kosong!");
            echo json_encode($result_array);
            return;
        }

        $this->db->trans_begin();

        $data = compact('delivery_date', 'no_resi_web_so_info', 'nama_ekspedisi_web_so_info');
        if($this->Admin_model->update_info_so_m($data, $id_so_m)){

            $status = array("status_web_so_m" => '3');
            if($this->Admin_model->update_status_so_m($status, $id_so_m)){

                date_default_timezone_set('Asia/Jakarta');
                $date  = date('Y-m-d H:i:s');

                $cart_data = $this->Cart_model->get_so_m_summary($id_so_m)->row();
                $notifikasi = array(
                    'id_web_user' => $cart_data->id_user_web_so_m,
                    'isi_web_notifikasi' => "Pesanan $cart_data->bukti_web_so_m telah dikirim dengan resi $no_resi_web_so_info",
                    'is_read' => '0',
                    'timestamp_web_notifikasi' => $date,
                    'url_web_notifikasi' => 'profile/purchase_detail?id='.$cart_data->bukti_web_so_m
                );

                $this->Home_model->add_notification($notifikasi);

                $this->db->trans_commit();
                $result_array = array("Status" => 'OK',"Message" => "Status pesanan berhasil diupdate");
            } else {
                $this->db->trans_rollback();
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate status pesanan (1)");
            }
        } else {
            $this->db->trans_rollback();
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate status pesanan (2)");
        }

        echo json_encode($result_array);
        return;
    }

    function pesanan_selesai(){

        date_default_timezone_set('Asia/Jakarta');

        $id_so_m = $_REQUEST['id_so_m'];
        $status = array("status_web_so_m" => '4');
        $selesai_date = array("selesai_date" => date('Y-m-d H:i:s'));

        $this->db->trans_begin();

        if($this->Admin_model->update_status_so_m($status, $id_so_m)){
            if($this->Admin_model->update_info_so_m($selesai_date, $id_so_m)){

                date_default_timezone_set('Asia/Jakarta');
                $date  = date('Y-m-d H:i:s');

                $cart_data = $this->Cart_model->get_so_m_summary($id_so_m)->row();
                $notifikasi = array(
                    'id_web_user' => $cart_data->id_user_web_so_m,
                    'isi_web_notifikasi' => "Pesanan $cart_data->bukti_web_so_m telah selesai",
                    'is_read' => '0',
                    'timestamp_web_notifikasi' => $date,
                    'url_web_notifikasi' => 'profile/purchase_detail?id='.$cart_data->bukti_web_so_m
                );

                $this->Home_model->add_notification($notifikasi);

                $this->db->trans_commit();
                $result_array = array("Status" => 'OK',"Message" => "Status pesanan berhasil diupdate");
            } else {
                $this->db->trans_rollback();
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate tanggal selesai");
            }

        } else {
            $this->db->trans_rollback();
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate status pesanan");
        }

        echo json_encode($result_array);
        return;

    }

    function pesanan_dibatalkan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_so_m = $_REQUEST['id_so_m'];
        $pembatalan_notes_web_so_info = htmlentities(trim($_REQUEST['catatan-pembatalan']), ENT_QUOTES);
        $pembatalan_date = date('Y-m-d H:i:s');

        $this->db->trans_begin();
        $data = compact('pembatalan_notes_web_so_info', 'pembatalan_date');
        if($this->Admin_model->update_info_so_m($data, $id_so_m)){

            $status = array("status_web_so_m" => '5');
            if($this->Admin_model->update_status_so_m($status, $id_so_m)){

                date_default_timezone_set('Asia/Jakarta');
                $date  = date('Y-m-d H:i:s');

                $cart_data = $this->Cart_model->get_so_m_summary($id_so_m)->row();
                $notifikasi = array(
                    'id_web_user' => $cart_data->id_user_web_so_m,
                    'isi_web_notifikasi' => "Pesanan $cart_data->bukti_web_so_m telah dibatalkan [$pembatalan_notes_web_so_info]",
                    'is_read' => '0',
                    'timestamp_web_notifikasi' => $date,
                    'url_web_notifikasi' => 'profile/purchase_detail?id='.$cart_data->bukti_web_so_m
                );

                $this->Home_model->add_notification($notifikasi);

                $this->db->trans_commit();
                $result_array = array("Status" => 'OK',"Message" => "Pesanan dibatalkan");
            } else {
                $this->db->trans_rollback();
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal membatalkan pesanan (1)");
            }
        } else {
            $this->db->trans_rollback();
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal membatalkan pesanan (2)");
        }

        echo json_encode($result_array);
        return;
    }

    function delete_promosi(){
        $id_web_promosi = $_REQUEST['id_web_promosi'];
        if($this->Admin_model->delete_promosi($id_web_promosi)){
            $result_array = array("Status" => 'OK',"Message" => "Promosi dihapus!");
        } else {
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal menghapus promosi");
        }

        echo json_encode($result_array);
        return;
    }

    function pengembalian_dana(){
        $id_so_m = $_REQUEST['id_so_m'];
        $refund_date = $_REQUEST['tanggal-pengembalian'];
        $no_rek_refund = htmlentities($_REQUEST['no-rek-refund'], ENT_QUOTES);
        $nama_rek_refund = htmlentities($_REQUEST['nama-rek-refund'], ENT_QUOTES);
        $bank_rek_refund = htmlentities($_REQUEST['bank-rek-refund'], ENT_QUOTES);
        $is_refunded = '1';

        if($refund_date == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Silahkan isi tanggal pengembalian dana dengan benar");
            echo json_encode($result_array);
            return;
        } else {
            $refund_date = date("Y-m-d H:i:s",strtotime($_REQUEST['tanggal-pengembalian']));
        }

        if($no_rek_refund == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "No Rekening tujuan tidak boleh kosong!");
            echo json_encode($result_array);
            return;
        }

        if($nama_rek_refund == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Nama Rekening tujuan tidak boleh kosong!");
            echo json_encode($result_array);
            return;
        }

        if($bank_rek_refund == ''){
            $result_array = array("Status" => 'ERROR',"Message" => "Bank tujuan tidak boleh kosong!");
            echo json_encode($result_array);
            return;
        }

        $this->db->trans_begin();
        $data = compact('refund_date', 'no_rek_refund', 'nama_rek_refund', 'bank_rek_refund', 'is_refunded');
        if($this->Admin_model->update_info_so_m($data, $id_so_m)){
            date_default_timezone_set('Asia/Jakarta');
            $date  = date('Y-m-d H:i:s');

            $cart_data = $this->Cart_model->get_so_m_summary($id_so_m)->row();
            $notifikasi = array(
                'id_web_user' => $cart_data->id_user_web_so_m,
                'isi_web_notifikasi' => "Dana untuk pesanan $cart_data->bukti_web_so_m telah dikembalikan",
                'is_read' => '0',
                'timestamp_web_notifikasi' => $date,
                'url_web_notifikasi' => 'profile/purchase_detail?id='.$cart_data->bukti_web_so_m
            );

            $this->Home_model->add_notification($notifikasi);

            $this->db->trans_commit();
            $result_array = array("Status" => 'OK',"Message" => "Info pengembalian dana berhasil diupdate");
        } else {
            $this->db->trans_rollback();
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupdate info pengembalian dana");
        }

        echo json_encode($result_array);
        return;

    }

    function send_chat(){
        date_default_timezone_set('Asia/Jakarta');

        if(!isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Unauthorized');
            echo json_encode($return_arr);
            return;
        }


        $id_web_user = $_REQUEST['id_web_user_chat'];
        $message_web_chat = htmlentities($_REQUEST['message_chat'], ENT_QUOTES);
        $id_ref_web_chat = $_REQUEST['ref_chat'];
        $img_web_chat = '';
        $ucode_product_web_chat = $_REQUEST['product_chat'];
        $id_admin = $_SESSION['id_web_user'];
        $timestamp_web_chat = date('Y-m-d H:i:s');

        $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

        $insert_id = $this->Admin_model->send_chat($data);
        if($insert_id){
            $return_arr = array("Status" => 'OK', "Message" => '', "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
        }

        echo json_encode($return_arr);
        return;
    }

    function upload_image_chat()
    {

        if(!isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Unauthorized');
            echo json_encode($return_arr);
            return;
        }

        date_default_timezone_set('Asia/Jakarta');
        $timestamp_web_chat = date('Y-m-d H:i:s');

        $config['upload_path'] = './assets/upload/chat/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;


        /* UPLOAD FILE IN AWS S3*/
//        $config['folder_name'] = 'upload/chat/';
//        $this->folder_name = $config['folder_name'];
//        $file_path = $_FILES['img_chat']['tmp_name'];
//        $file = pathinfo($file_path);
//        $s3_file = $file['filename'].'-'.rand(1000,1).'.jpg';
//        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
//
//        $saved = $this->s3->putObjectFile(
//            $file_path,
//            $this->bucket_name,
//            $this->folder_name.$s3_file,
//            S3::ACL_PUBLIC_READ,
//            array(),
//            $mime_type
//        );
//
//        if (!$saved) {
//            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupload foto");
//        } else {
//
//            //upload to database
//            $id_web_user = $_REQUEST['id_web_user_chat'];
//            $message_web_chat = '';
//            $id_ref_web_chat = 0;
//            $img_web_chat = $this->s3_url.$this->folder_name.$s3_file;
//            $ucode_product_web_chat = 0;
//            $id_admin = $_SESSION['id_web_user'];
//
//            $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');
//
//            $insert_id = $this->Admin_model->send_chat($data);
//            if($insert_id){
//                $result_array = array("Status" => 'OK', "File" =>  $this->s3_url.$this->folder_name.$s3_file, "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
//            } else {
//                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
//            }
//        }
//
//        echo json_encode($result_array);
//        return;

        /* Upload to local storage */
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img_chat')) {
            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
        } else {
            $file_data = $this->upload->data();
            //upload to database

            $id_web_user = $_REQUEST['id_web_user_chat'];
            $message_web_chat = '';
            $id_ref_web_chat = 0;
            $img_web_chat = 'assets/upload/chat/'.$file_data['file_name'];
            $ucode_product_web_chat = 0;
            $id_admin = $_SESSION['id_web_user'];

            $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

            $insert_id = $this->Admin_model->send_chat($data);
            if($insert_id){
                $result_array = array("Status" => 'OK', "File" => 'assets/upload/chat/'.$file_data['file_name'], "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
            } else {
                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
            }
        }

        echo json_encode($result_array);
        return;
    }

    function upload_gambar_produk(){


        $final_filename = md5($_FILES['gambar_produk']['tmp_name']).'.png';

        $config['upload_path'] = './assets/upload/product/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $final_filename;

        /* UPLOAD FILE IN AWS S3*/
//        $config['folder_name'] = 'upload/product/';
//        $this->folder_name = $config['folder_name'];
//        $file_path = $_FILES['gambar_produk']['tmp_name'];
//        $file = pathinfo($file_path);
//        $s3_file = $file['filename'].'-'.rand(1000,1).'.jpg';
//        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
//
//        $saved = $this->s3->putObjectFile(
//            $file_path,
//            $this->bucket_name,
//            $this->folder_name.$s3_file,
//            S3::ACL_PUBLIC_READ,
//            array(),
//            $mime_type
//        );
//
//        if (!$saved) {
//            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupload foto");
//        } else {
//
//            //upload to database
//            $tipe_web_image = 'PRODUCT';
//            $ref_web_image = $_REQUEST['ucode_web_product'];
//            $file_web_image = $this->s3_url.$this->folder_name.$s3_file;
//
//            // current algorithm will put image in an empty slot
//            $data = $this->Admin_model->get_image_order($_REQUEST['ucode_web_product']);
//            $image_order = 1;
//            foreach($data->result_object() as $order){
//                $image_order++;
//            }
//            // ===========================
//
//            $data = compact('tipe_web_image', 'ref_web_image', 'file_web_image', 'image_order');
//
//            $insert_id = $this->Admin_model->add_web_image($data);
//            if($insert_id){
//                $result_array = array("Status" => 'OK', "File" => $this->s3_url.$this->folder_name.$s3_file);
//            } else {
//                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan gambar');
//            }
//        }
//
//        echo json_encode($result_array);
//        return;

        /* UPLOAD FILE IN LOCAL STORAGE*/
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar_produk')) {
            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
        } else {
            $file_data = $this->upload->data();

            //upload to database
            $tipe_web_image = 'PRODUCT';
            $ref_web_image = $_REQUEST['ucode_web_product'];
            $file_web_image = 'assets/upload/product/'.$final_filename;

            // current algorithm will put image in an empty slot
            $data = $this->Admin_model->get_image_order($_REQUEST['ucode_web_product']);
            $image_order = 1;
            foreach($data->result_object() as $order){
                $image_order++;
            }
            // ===========================

            $data = compact('tipe_web_image', 'ref_web_image', 'file_web_image', 'image_order');

            $insert_id = $this->Admin_model->add_web_image($data);
            if($insert_id){
                $result_array = array("Status" => 'OK', "File" => $file_data);
            } else {
                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan gambar');
            }

        }

        echo json_encode($result_array);
        return;
    }

    function upload_gambar_produk_v2(){
        $countfiles = count($_FILES['files']['name']);

        // Looping all files
        for($i = 0; $i < $countfiles; $i++){

            if(!empty($_FILES['files']['name'][$i])){

                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];


                // Set preference
                $final_filename = md5($_FILES['files']['tmp_name'][$i]).'.png';

                $config['upload_path'] = './assets/upload/product/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $final_filename;


                //Load upload library
                $this->load->library('upload',$config);

                // File upload
                if(!$this->upload->do_upload('file')){
                    $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
                } else {
                    $file_data = $this->upload->data();

                    //upload to database
                    $tipe_web_image = 'PRODUCT';
                    $ref_web_image = $_REQUEST['ucode_web_product'];
                    $file_web_image = 'assets/upload/product/'.$file_data['file_name'];

                    // current algorithm will put image in an empty slot
                    $data = $this->Admin_model->get_image_order($_REQUEST['ucode_web_product']);
                    $image_order = 1;
                    foreach($data->result_object() as $order){
                        $image_order++;
                    }
                    // ===========================

                    $data = compact('tipe_web_image', 'ref_web_image', 'file_web_image', 'image_order');

                    $insert_id = $this->Admin_model->add_web_image($data);
                    if($insert_id){
                        $result_array = array("Status" => 'OK', "File" => $file_data);
                    } else {
                        $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan gambar');
                    }
                }


            }
        }

        echo json_encode($result_array);
        return;

    }

    function upload_gambar_banner(){

        $final_filename = md5($_FILES['gambar_banner']['tmp_name']).'.png';

        $config['upload_path'] = './assets/upload/banner/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $final_filename;


        /* UPLOAD FILE IN AWS S3*/
//        $config['folder_name'] = 'upload/banner/';
//        $this->folder_name = $config['folder_name'];
//        $file_path = $_FILES['gambar_banner']['tmp_name'];
//        $file = pathinfo($file_path);
//        $s3_file = $file['filename'].'-'.rand(1000,1).'.jpg';
//        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
//
//        $saved = $this->s3->putObjectFile(
//            $file_path,
//            $this->bucket_name,
//            $this->folder_name.$s3_file,
//            S3::ACL_PUBLIC_READ,
//            array(),
//            $mime_type
//        );
//
//        if ($saved) {
//            $result_array = array("Status" => 'OK', "File" => $this->s3_url.$this->folder_name.$s3_file);
//        } else {
//            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengupload foto");
//        }
//
//        echo json_encode($result_array);
//        return;

        /* UPLOAD FILE IN LOCAL STORAGE*/
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar_banner')) {
            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
        } else {
            $file_data = $this->upload->data();
            $result_array = array("Status" => 'OK', "File" => 'assets/upload/banner/'.$file_data['file_name']);
        }

        echo json_encode($result_array);
        return;
    }

    function remove_gambar_produk(){
        $id_web_image = $_REQUEST['remove_product'];

        //check if image is main image
        $check = $this->Admin_model->get_web_image_by_id($id_web_image);

        if($check->row()->image_order == '1'){
            $result_array = array("Status" => 'ERROR', "Message" => 'Gambar produk utama tidak boleh dihapus!');
            echo json_encode($result_array);
            return;
        }


        if($this->Admin_model->remove_gambar_produk($id_web_image)){
            $result_array = array("Status" => 'OK', "Message" => 'Gambar dihapus');
        } else {
            $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menghapus gambar');
        }

        echo json_encode($result_array);
        return;

    }

    function dashboard_card(){
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $penjualan_bulan_ini = $this->Admin_model->penjualan_bulanan()->row()->monthly_sales;
        $penjualan_hari_ini = $this->Admin_model->penjualan_harian($today)->row()->daily_sales;
        $ratarata_ulasan = number_format((float)$this->Admin_model->ratarata_ulasan()->row()->average_review, 1);
        $produk_terjual = $this->Admin_model->produk_terjual()->row()->total_qty_sold;

        $data = compact('penjualan_bulan_ini', 'penjualan_hari_ini', 'ratarata_ulasan', 'produk_terjual');
        echo json_encode($data);
        return;
    }

    function status_pesanan_dashboard(){

        $total_count =  (int) $this->Admin_model->all_orders_count()->row()->total_count;
        $diterima_count = (int) $this->Admin_model->get_so_m_by_status('1')->row()->status_count;
        $diproses_count = (int) $this->Admin_model->get_so_m_by_status('2')->row()->status_count;
        $dikirim_count = (int) $this->Admin_model->get_so_m_by_status('3')->row()->status_count;
        $selesai_count = (int) $this->Admin_model->get_so_m_by_status('4')->row()->status_count;
        $dibatalkan_count = (int) $this->Admin_model->get_so_m_by_status('5')->row()->status_count;

//        $data_count = compact('total_count', 'diterima_count', 'diproses_count', 'dikirim_count', 'selesai_count', 'dibatalkan_count');
//        echo json_encode($data_count);
//        return;

        if($total_count > 0){
            $diterima_percent =  round(($diterima_count / $total_count) * 100, 2);
            $diproses_percent = round(($diproses_count / $total_count) * 100, 2);
            $dikirim_percent = round(($dikirim_count / $total_count) * 100, 2);
            $selesai_percent = round(($selesai_count / $total_count) * 100, 2);
            $dibatalkan_percent = round(($dibatalkan_count / $total_count) * 100, 2);
        } else {
            $diterima_percent = $diproses_percent = $dikirim_percent = $selesai_percent = $dibatalkan_percent = 0;
        }


        $data = compact('diterima_percent', 'diproses_percent', 'dikirim_percent', 'selesai_percent', 'dibatalkan_percent');
        echo json_encode($data);
        return;
    }

    function get_grouped_daily_sales(){
        $days_num = (int) $_REQUEST['days_num'];
        $sales_array = array();
        $timestamp = time();
        for ($i = 0 ; $i < $days_num ; $i++) {
            $date = date('Y-m-d', $timestamp);
            $today_sales = $this->Admin_model->penjualan_harian($date)->row()->daily_sales;
            array_push($sales_array, $today_sales);
            $timestamp -= 24 * 3600;
        }

        echo json_encode(array_reverse($sales_array));
        return;
    }

    function get_grouped_daily_order(){
        $days_num = (int) $_REQUEST['days_num'];
        $sales_array = array();
        $timestamp = time();
        for ($i = 0 ; $i < $days_num ; $i++) {
            $date = date('Y-m-d', $timestamp);
            $today_sales = $this->Admin_model->order_harian($date)->row()->daily_sales;
            array_push($sales_array, $today_sales);
            $timestamp -= 24 * 3600;
        }

        echo json_encode(array_reverse($sales_array));
        return;
    }

    function logout(){
        unset(
            $_SESSION['id_web_user'],
            $_SESSION['email_web_user'],
            $_SESSION['is_admin'],
            $_SESSION['id_so_m']
        );

        $this->load->helper('url');
        redirect(base_url('home'), 'refresh');
    }

    function add_review_reply(){
        date_default_timezone_set('Asia/Jakarta');

        $id_web_ulasan = $_REQUEST['id_web_ulasan'];
        $reply_web_ulasan = $_REQUEST['reply_web_ulasan'];
        $id_admin = $_SESSION['id_web_user'];
        $tgl_reply_web_ulasan = date('Y-m-d H:i:s');

        $data = compact('reply_web_ulasan', 'id_admin', 'tgl_reply_web_ulasan');

        if($this->Admin_model->update_ulasan($data, $id_web_ulasan)){
            $result_array = array("Status" => 'OK',"Message" => "Pesanan dibatalkan");
        } else {
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal membatalkan pesanan (1)");
        }

        echo json_encode($result_array);
        return;

    }

    function swap_banner_order(){
        $current_id = $_REQUEST['current_id'];
        $move_id = $_REQUEST['move_id'];

        $current_data = $this->Admin_model->get_banner_by_id($current_id);
        $move_data = $this->Admin_model->get_banner_by_id($move_id);

        $current_position = $current_data->row()->order_web_banner;
        $move_position = $move_data->row()->order_web_banner;

        if($this->Admin_model->update_banner(array("order_web_banner" => $move_position), $current_id)){
            if($this->Admin_model->update_banner(array("order_web_banner" => $current_position), $move_id)){
                $result_array = array("Status" => 'OK',"Message" => "");
            } else {
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengubah order (1)");
            }
        } else {
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengubah order (2)");
        }

        echo json_encode($result_array);
        return;
    }

    function swap_product_image_order(){
        $current_id = $_REQUEST['current_id'];
        $move_id = $_REQUEST['move_id'];

        $current_data = $this->Admin_model->get_web_image_by_id($current_id);
        $move_data = $this->Admin_model->get_web_image_by_id($move_id);

        $current_position = $current_data->row()->image_order;
        $move_position = $move_data->row()->image_order;


        if($this->Admin_model->update_image(array("image_order" => $move_position), $current_id)){
            if($this->Admin_model->update_image(array("image_order" => $current_position), $move_id)){
                $result_array = array("Status" => 'OK',"Message" => "");
            } else {
                $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengubah order (1)");
            }
        } else {
            $result_array = array("Status" => 'ERROR',"Message" => "Gagal mengubah order (2)");
        }

        echo json_encode($result_array);
        return;
    }

    function upload_excel_product(){

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $tipe = $_REQUEST['tipe'];

        $final_filename = time()."MasterProduct";
        $config['upload_path'] = './assets/upload/excel/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = $final_filename;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('excel_file')){
            $media = $this->upload->data();
            $inputFileName = 'assets/upload/excel/'.$media['file_name'];
            $isheet = 0;
            $irow = 3;
            $icol = 'A';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(intval($isheet));
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = intval($irow); $row <= $highestRow; $row++){
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $rec_tbl[] = $rowData[0];
            }

            $startRow = 3;
            $error_message = array();
            $this->db->trans_begin();

            foreach($rec_tbl as $product){
                $error = false;
                set_time_limit(0);

                date_default_timezone_set('Asia/Jakarta');
                $date_web_product = date('Y-m-d H:i:s');

                $art_number_web_product = htmlentities(trim($product[0]));
                if($art_number_web_product == ''){
                    array_push($error_message, "ART NUMBER kosong pada baris ke-$startRow");
                    $error = true;
                }

                $nama_web_product = htmlentities(trim($product[1]));
                if($nama_web_product == ''){
                    array_push($error_message, "NAMA PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                }

                $nama_web_catprod = htmlentities(trim($product[2]));
                $catprod = $this->Admin_model->get_category_by_name($nama_web_catprod);

                if($catprod->num_rows() == 0){
                    array_push($error_message, "KATEGORI tidak valid pada baris ke-$startRow");
                    $error = true;
                } else {
                    $ucode_catprod = $catprod->row()->id_web_catprod;
                }

                $nama_web_col = htmlentities(trim($product[3]));
                $col = $this->Admin_model->get_color_by_name($nama_web_col);

                if($col->num_rows() == 0){
                    array_push($error_message, "WARNA tidak valid pada baris ke-$startRow");
                    $error = true;
                } else {
                    $ucode_col = $col->row()->ucode_web_col;
                }

                $length_web_product = htmlentities(trim(str_replace(',', '.', $product[4])));
                if($length_web_product == ''){
                    array_push($error_message, "PANJANG PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($length_web_product)){
                    array_push($error_message, "PANJANG PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $width_web_product = htmlentities(trim(str_replace(',', '.', $product[5])));
                if($width_web_product == ''){
                    array_push($error_message, "LEBAR PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($width_web_product)){
                    array_push($error_message, "LEBAR PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $height_web_product = htmlentities(trim(str_replace(',', '.', $product[6])));
                if($height_web_product == ''){
                    array_push($error_message, "TINGGI PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($height_web_product)){
                    array_push($error_message, "TINGGI PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $wn_web_product = htmlentities(trim(str_replace(',', '.', $product[7])));
                if($wn_web_product == ''){
                    array_push($error_message, "BERAT BERSIH PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($wn_web_product)){
                    array_push($error_message, "BERAT BERSIH PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $wg_web_product = htmlentities(trim(str_replace(',', '.', $product[8])));
                if($wg_web_product == ''){
                    array_push($error_message, "BERAT KOTOR PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($wg_web_product)){
                    array_push($error_message, "BERAT KOTOR PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $vol_web_product = htmlentities(trim(str_replace(',', '.', $product[9])));
                if($vol_web_product == ''){
                    array_push($error_message, "VOLUME PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($vol_web_product)){
                    array_push($error_message, "VOLUME PRODUK bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                $desc_web_product = htmlentities(trim($product[10]));
                if($desc_web_product == ''){
                    array_push($error_message, "DESKRIPSI PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                }

                $maintenance_web_product = htmlentities(trim($product[11]));
                if($maintenance_web_product == ''){
                    array_push($error_message, "CARA PERAWATAN PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                }

                $stok_web_product = htmlentities(trim($product[12]));
                if($stok_web_product == ''){
                    array_push($error_message, "STOK PRODUK kosong pada baris ke-$startRow");
                    $error = true;
                }

                $status_aktif = htmlentities(trim($product[13]));

                if($status_aktif == "AKTIF"){
                    $active_web_product = '1';
                } else if($status_aktif == "NONAKTIF") {
                    $active_web_product = '0';
                } else {
                    array_push($error_message, "STATUS PRODUK tidak valid pada baris ke-$startRow");
                    $error = true;
                }


                if(!$error){

                    if($tipe == "tambah"){
                        $data = compact('date_web_product', 'nama_web_product', 'art_number_web_product', 'length_web_product',
                            'width_web_product', 'height_web_product', 'wn_web_product', 'wg_web_product', 'vol_web_product', 'ucode_catprod',
                            'ucode_col', 'desc_web_product', 'maintenance_web_product', 'stok_web_product', 'active_web_product');

                        if($this->Admin_model->product_name_check($nama_web_product)->num_rows() > 0){
                            array_push($error_message, "NAMA PRODUK sudah ada pada baris ke-$startRow");
                            $error = true;
                        }

                        if($this->Admin_model->art_number_check($art_number_web_product)->num_rows() > 0){
                            array_push($error_message, "ART NUMBER PRODUK sudah ada pada baris ke-$startRow");
                            $error = true;
                        }


                        if(!$error){
                            // upload
                            $insert_id = $this->Admin_model->add_product($data);
                            if(!$insert_id){
                                array_push($error_message, "GAGAL upload data baris ke-$startRow");
                            }
                        }

                    } else if($tipe == "tambah_update") {

                        $data = compact( 'nama_web_product', 'art_number_web_product', 'length_web_product',
                            'width_web_product', 'height_web_product', 'wn_web_product', 'wg_web_product', 'vol_web_product', 'ucode_catprod',
                            'ucode_col', 'desc_web_product', 'maintenance_web_product', 'stok_web_product', 'active_web_product');


                        // search product name and art no
                        $product_search = $this->Admin_model->art_number_check($art_number_web_product);


                        // if art number is registered
                        if($product_search->num_rows() > 0){

                            // if product name is not the same as the previous one
                            if($nama_web_product != trim($product_search->row()->nama_web_product)){
                                // check if product name exists
                                if($this->Admin_model->product_name_check($nama_web_product)->num_rows() > 0){
                                    array_push($error_message, "NAMA PRODUK sudah ada pada baris ke-$startRow");
                                    $error = true;
                                }
                            }

                            if(!$error){
                                if(!$this->Admin_model->update_product($data, $product_search->row()->ucode_web_product)){
                                    array_push($error_message, "GAGAL upload data baris ke-$startRow");
                                }
                            }
                        }
                        // else if art number is not registered
                        else if($product_search->num_rows() == 0){
                            $data = compact('date_web_product', 'nama_web_product', 'art_number_web_product', 'length_web_product',
                                'width_web_product', 'height_web_product', 'wn_web_product', 'wg_web_product', 'vol_web_product', 'ucode_catprod',
                                'ucode_col', 'desc_web_product', 'maintenance_web_product', 'stok_web_product', 'active_web_product');

                            if($this->Admin_model->product_name_check($nama_web_product)->num_rows() > 0){
                                array_push($error_message, "NAMA PRODUK sudah ada pada baris ke-$startRow");
                                $error = true;
                            }


                            if(!$error){
                                // upload
                                $insert_id = $this->Admin_model->add_product($data);
                                if(!$insert_id){
                                    array_push($error_message, "GAGAL upload data baris ke-$startRow");
                                }
                            }
                        }

                    } else {
                        array_push($error_message, "Tipe Upload tidak valid");
                    }


                }
                $startRow++;
            }

            if(!empty($error_message)){
                $this->db->trans_rollback();
                $result_array = array("Status" => "ERRORS", "Errors" => $error_message);
            } else {
                $this->db->trans_commit();
                $result_array = array("Status" => "OK", "Message" => "Excel berhasil diupload");
            }

        } else {
            $result_array = array("Status" => 'ERROR',"Errors" => array($this->upload->display_errors()));
        }

        echo json_encode($result_array);
    }

    function upload_excel_pricelist(){

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $tipe = $_REQUEST['tipe'];

        $final_filename = time()."MasterPricelist";
        $config['upload_path'] = './assets/upload/excel/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = $final_filename;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('excel_file')){
            $media = $this->upload->data();
            $inputFileName = 'assets/upload/excel/'.$media['file_name'];
            $isheet = 0;
            $irow = 3;
            $icol = 'A';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(intval($isheet));
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = intval($irow); $row <= $highestRow; $row++){
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $rec_tbl[] = $rowData[0];
            }

            $startRow = 3;
            $error_message = array();
            $this->db->trans_begin();

            foreach($rec_tbl as $product){
                $error = false;
                $id_cabang_web_pricelist = 18;
                set_time_limit(0);

                $nama_web_product = htmlentities(trim($product[0]));

                $prod = $this->Admin_model->product_name_check($nama_web_product);

                if($prod->num_rows() > 0){
                    $ucode_web_product = $prod->row()->ucode_web_product;
                } else {
                    array_push($error_message, "NAMA PRODUK tidak ditemukan pada baris ke-$startRow");
                    $error = true;
                }
                $nominal_web_pricelist = htmlentities(trim($product[1]));
                if($nominal_web_pricelist == '' || $nominal_web_pricelist == 0){
                    array_push($error_message, "NOMINAL PRICELIST tidak valid pada baris ke-$startRow");
                    $error = true;
                } else if(!is_numeric($nominal_web_pricelist)){
                    array_push($error_message, "NOMINAL PRICELIST bukan numerik pada baris ke-$startRow");
                    $error = true;
                }

                if(!$error){
                    $data = compact('ucode_web_product', 'nominal_web_pricelist', 'id_cabang_web_pricelist');
                    if($tipe == "tambah"){
                        // check if ucode_web_product exists in web_pricelist
                        if($this->Admin_model->pricelist_check($ucode_web_product)->num_rows() > 0){
                            array_push($error_message, "Harga produk sudah ada pada baris ke-$startRow");
                            $error = true;
                        }

                        if(!$error){
                            if(!$this->Admin_model->add_pricelist($data)){
                                array_push($error_message, "Gagal menambahkan harga pada baris ke-$startRow");
                            }
                        }

                    } else if($tipe == "tambah_update") {
                        $update_diskon = htmlentities(trim($product[2]));
                        $pricelist_search = $this->Admin_model->pricelist_check($ucode_web_product);
                        
                        if($pricelist_search->num_rows() > 0){
                            // update
                            if($this->Admin_model->update_pricelist($data, $pricelist_search->row()->id_web_pricelist)){
                                // cek promosi

                                $data_promo = $this->Admin_model->get_promo_by_product($ucode_web_product);
                                $data_promo_row = $data_promo->row();
                                if($data_promo->num_rows() > 0){
                                    if($update_diskon == "YA"){
                                        // update harga akhir based on percent
                                        $persen_web_promosi = $data_promo_row->persen_web_promosi;

                                        $calc = ($persen_web_promosi / 100) * $nominal_web_pricelist;
                                        $new_harga_akhir = $nominal_web_pricelist - $calc;
                                        $update_promo = array('nominal_web_promosi' => $new_harga_akhir);


                                    } else if ($update_diskon == "TIDAK"){
                                        // update percentage based on harga akhir
                                        $nominal_web_promosi = $data_promo_row->nominal_web_promosi;

                                        $calc = round((100 * $nominal_web_promosi) / $nominal_web_pricelist);
                                        $new_persen = 100 - $calc;
                                        $update_promo = array('persen_web_promosi' => $new_persen);



                                    } else {
                                        array_push($error_message, "TIPE UPDATE PROMO invalid pada baris ke-$startRow");
                                        $error = true;
                                    }

                                    if(!$error){
                                        if(!$this->Admin_model->update_promosi_by_product($update_promo, $ucode_web_product)){
                                            array_push($error_message, "Gagal mengupdate promosi pada baris ke-$startRow");
                                        }
                                    }

                                }
                            } else {
                                array_push($error_message, "Gagal mengupdate harga pada baris ke-$startRow");
                            }
                        } else {
                            // tambah
                            if(!$this->Admin_model->add_pricelist($data)){
                                array_push($error_message, "Gagal menambahkan harga pada baris ke-$startRow");
                            }
                        }


                    } else {
                        array_push($error_message, "Tipe Upload tidak valid");
                    }


                }
                $startRow++;
            }

            if(!empty($error_message)){
                $this->db->trans_rollback();
                $result_array = array("Status" => "ERRORS", "Errors" => $error_message);
            } else {
                $this->db->trans_commit();
                $result_array = array("Status" => "OK", "Message" => "Excel berhasil diupload");
            }

        } else {
            $result_array = array("Status" => 'ERROR',"Errors" => array($this->upload->display_errors()));
        }

        echo json_encode($result_array);

    }

    function upload_excel_promosi(){

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $tipe = $_REQUEST['tipe'];
        $tipe_promo = $_REQUEST['tipe_promo'];

        $final_filename = time()."MasterPricelist";
        $config['upload_path'] = './assets/upload/excel/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = $final_filename;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('excel_file')){
            $media = $this->upload->data();
            $inputFileName = 'assets/upload/excel/'.$media['file_name'];
            $isheet = 0;
            $irow = 4;
            $icol = 'A';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(intval($isheet));
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = intval($irow); $row <= $highestRow; $row++){
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $rec_tbl[] = $rowData[0];
            }

            $startRow = 4;
            $error_message = array();
            $this->db->trans_begin();

            foreach($rec_tbl as $product){
                set_time_limit(0);

                $error = false;
                $nama_web_product = htmlentities(trim($product[0]));
                $prod = $this->Admin_model->product_name_check($nama_web_product);

                if($prod->num_rows() > 0){
                    $ucode_web_product = $prod->row()->ucode_web_product;
                } else {
                    array_push($error_message, "NAMA PRODUK tidak ditemukan pada baris ke-$startRow");
                    $error = true;
                }

                $persen_web_promosi = htmlentities(trim($product[1]));
                $nominal_web_promosi = htmlentities(trim($product[2]));

                if($tipe_promo == "persen"){
                    if($persen_web_promosi == "" || $persen_web_promosi == "0"){
                        array_push($error_message, "PERSENTASE PROMOSI kosong pada baris ke-$startRow");
                        $error = true;
                    } else if(!is_numeric($persen_web_promosi)){
                        array_push($error_message, "PERSENTASE PROMOSI bukan numerik pada baris ke-$startRow");
                        $error = true;
                    }
                } else if($tipe_promo == "harga_akhir") {
                    if($nominal_web_promosi == "" || $nominal_web_promosi == "0"){
                        array_push($error_message, "HARGA AKHIR PROMOSI kosong pada baris ke-$startRow");
                        $error = true;
                    } else if(!is_numeric($persen_web_promosi)){
                        array_push($error_message, "HARGA AKHIR PROMOSI bukan numerik pada baris ke-$startRow");
                        $error = true;
                    }
                }

                $mysql_date_regex = "/^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|1‌​1)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468]‌​[048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(0‌​2)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02‌​)(-)(29)))(\s([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))$/";

                $start_web_promosi = trim($product[3]);
                if(!preg_match($mysql_date_regex, $start_web_promosi)){
                    array_push($error_message, "FORMAT TANGGAL AWAL tidak valid pada baris ke-$startRow");
                    $error = true;
                }

                $end_web_promosi = trim($product[4]);
                if(!preg_match($mysql_date_regex, $end_web_promosi)){
                    array_push($error_message, "FORMAT TANGGAL AKHIR tidak valid pada baris ke-$startRow");
                    $error = true;
                }


                if(!$error){
                    // calculation
                    $pricelist = $this->Admin_model->pricelist_check($ucode_web_product);
                    if($pricelist->num_rows() == 0){
                        array_push($error_message, "HARGA JUAL produk tidak ditemukan pada baris ke-$startRow");
                        break;
                    }

                    if($tipe_promo == "persen"){
                        $nominal = ((int) $persen_web_promosi / 100) * (int) $pricelist->row()->nominal_web_pricelist;
                        $nominal_web_promosi = (int) $pricelist->row()->nominal_web_pricelist - $nominal;
                    } else if($tipe_promo == "harga_akhir") {
                        $persen = (100 * (int) $nominal_web_promosi) / (int) $pricelist->row()->nominal_web_pricelist;
                        $persen_web_promosi =  ceil(100 - $persen);
                    }

                    $data = compact('ucode_web_product', 'nominal_web_promosi', 'persen_web_promosi', 'start_web_promosi', 'end_web_promosi');
                    if($tipe == "tambah"){

                        // check if ucode_web_product exists in web_promosi
                        if($this->Admin_model->promosi_check($ucode_web_product)->num_rows() > 0){
                            array_push($error_message, "PRODUK sudah memiliki promosi pada baris ke-$startRow");
                            $error = true;
                        }

                        if(!$error){
                            if(!$this->Admin_model->add_promosi($data)){
                                array_push($error_message, "Gagal menambahkan promosi pada baris ke-$startRow");
                            }
                        }

                    } else if($tipe == "tambah_update") {
                        $promosi_check = $this->Admin_model->promosi_check($ucode_web_product);
                        if($promosi_check->num_rows() > 0){
                            // update
                            if(!$this->Admin_model->update_promosi($data, $promosi_check->row()->id_web_promosi)){
                                array_push($error_message, "Gagal mengupdate promosi pada baris ke-$startRow");
                            }
                        } else if($promosi_check->num_rows() == 0){
                            // tambah
                            if(!$this->Admin_model->add_promosi($data)){
                                array_push($error_message, "Gagal menambahkan promosi pada baris ke-$startRow");
                            }
                        }
                    } else {
                        array_push($error_message, "Tipe Upload tidak valid");
                    }


                }
                $startRow++;
            }

            if(!empty($error_message)){
                $this->db->trans_rollback();
                $result_array = array("Status" => "ERRORS", "Errors" => $error_message);
            } else {
                $this->db->trans_commit();
                $result_array = array("Status" => "OK", "Message" => "Excel berhasil diupload");
            }

        } else {
            $result_array = array("Status" => 'ERROR',"Errors" => array($this->upload->display_errors()));
        }

        echo json_encode($result_array);
    }

    function upload_excel_resi(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $final_filename = time()."ResiBulky";
        $config['upload_path'] = './assets/upload/excel/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = $final_filename;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('excel_file')){
            $media = $this->upload->data();
            $inputFileName = 'assets/upload/excel/'.$media['file_name'];

            $isheet = 0;
            $irow = 3;
            $icol = 'A';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(intval($isheet));
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();


            for ($row = intval($irow); $row <= $highestRow; $row++){
                // Read a row of data into an array
                $rowData = $sheet->rangeToArray($icol . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);


                if($rowData[0][0] != ''){
                    $rec_tbl[] = $rowData[0];
                } else {
                    $input = true;

                    // if No. Pesanan is empty and the cell is not merged with anything
                    foreach ($sheet->getMergeCells() as $cells) {
                        if ($sheet->getCell($icol . $row)->isInRange($cells)) {
                            $input = false;
                        }
                    }

                    // ignore merge cell unless it's the top-left cell in the merge range
                    if (!$objPHPExcel->getActiveSheet()->getCellByColumnAndRow( 0, $row )->isInMergeRange() ||
                        $objPHPExcel->getActiveSheet()->getCellByColumnAndRow( 0, $row )->isMergeRangeValueCell()) {
                        // Cell is one that we're interested in reading
                        $input = true;
                    } else {
                        // Cell is part of a merge-range that we're not interested in reading
                        $input = false;
                    }

                    if($input){
                        $rec_tbl[] = $rowData[0];
                    }
                }
            }



            $startRow = 3;
            $error_message = array();
            $this->db->trans_begin();

            foreach($rec_tbl as $pesanan){
                $error = false;
                $bukti_web_so_m = htmlentities(trim($pesanan[0]));
                $nama_ekspedisi_web_so_info = htmlentities(trim($pesanan[13]));
                $no_resi_web_so_info = htmlentities(trim($pesanan[14]));
                $status_web_so_m = '3';

                $order = $this->Admin_model->get_order_by_id($bukti_web_so_m);

                if($order->num_rows() == 0){
                    array_push($error_message, "NO. PESANAN tidak ditemukan pada baris ke-$startRow");
                } else {

                    if($order->row()->status_web_so_m == '1'){
                        array_push($error_message, "STATUS PESANAN: Belum Bayar pada baris ke-$startRow");
                        $error = true;
                    }

                    if($order->row()->status_web_so_m == '4'){
                        array_push($error_message, "STATUS PESANAN: Selesai pada baris ke-$startRow");
                        $error = true;
                    }

                    if($order->row()->status_web_so_m == '5'){
                        array_push($error_message, "STATUS PESANAN: Dibatalkan pada baris ke-$startRow");
                        $error = true;
                    }

                    $updated_data = compact('nama_ekspedisi_web_so_info', 'no_resi_web_so_info');
                    $id_web_so_m = $order->row()->id_web_so_m;

                    if(!$error){
                        if(!$this->Admin_model->update_info_so_m($updated_data, $id_web_so_m)){
                            array_push($error_message, "Gagal mengupdate resi pada baris ke-$startRow [1]");
                        } else {
                            if(!$this->Admin_model->update_status_so_m(compact('status_web_so_m'), $id_web_so_m)){
                                array_push($error_message, "Gagal mengupdate resi pada baris ke-$startRow [2]");
                            }
                        }
                    }
                }

                $startRow++;
            }

            if(!empty($error_message)){
                $this->db->trans_rollback();
                $result_array = array("Status" => "ERRORS", "Errors" => $error_message);
            } else {
                $this->db->trans_commit();
                $result_array = array("Status" => "OK", "Message" => "Excel berhasil diupload");
            }


        } else {
            $result_array = array("Status" => 'ERROR',"Errors" => array($this->upload->display_errors()));
        }

        echo json_encode($result_array);

    }

    function download_excel_product(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();
        $data           = $this->Admin_model->get_all_products();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Art Number");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Nama Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Kategori');
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, 'Warna Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, 'Panjang Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("F".$startRow, 'Lebar Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("G".$startRow, 'Tinggi Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("H".$startRow, 'Berat Bersih');
        $objPHPExcel->getActiveSheet()->SetCellValue("I".$startRow, 'Berat Kotor');
        $objPHPExcel->getActiveSheet()->SetCellValue("J".$startRow, 'Volume Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("K".$startRow, 'Deskripsi Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("L".$startRow, 'Cara Perawatan');
        $objPHPExcel->getActiveSheet()->SetCellValue("M".$startRow, 'Stok');
        $objPHPExcel->getActiveSheet()->SetCellValue("N".$startRow, 'Status Aktif');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:N$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:N$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(88);

        $startDataRow = $startRow++;

        foreach($data->result_object() as $product){
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, $product->art_number_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, $product->nama_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, $product->nama_web_catprod);
            $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, $product->nama_web_col);
            $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, $product->length_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("F".$startRow, $product->width_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("G".$startRow, $product->height_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("H".$startRow, $product->wn_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("I".$startRow, $product->wg_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("J".$startRow, $product->vol_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("K".$startRow, html_entity_decode($product->desc_web_product, ENT_QUOTES,'UTF-8'));
            $objPHPExcel->getActiveSheet()->SetCellValue("L".$startRow, html_entity_decode($product->maintenance_web_product, ENT_QUOTES,'UTF-8'));
            $objPHPExcel->getActiveSheet()->SetCellValue("M".$startRow, $product->stok_web_product);

            if(trim($product->length_web_product) == "0"){
                $status_aktif = "NONAKTIF";
            } else {
                $status_aktif = "AKTIF";
            }
            $objPHPExcel->getActiveSheet()->SetCellValue("N".$startRow, $status_aktif);
            $startRow++;

        }
        $startRow--;
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $objPHPExcel->getActiveSheet()
            ->getComment('E2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("E2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("E2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('F2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("F2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("F2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('G2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("G2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("G2")->setHeight("50px");


        $objPHPExcel->getActiveSheet()
            ->getComment('H2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("H2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("H2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('I2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("I2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("I2")->setHeight("50px");


        $objPHPExcel->getActiveSheet()
            ->getComment('J2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("J2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("J2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('N2')
            ->getText()->createTextRun("NONAKTIF atau AKTIF ");
        $objPHPExcel->getActiveSheet()->getComment("N2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("N2")->setHeight("50px");


        $filename = "MasterProduct ($date)";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    function download_excel_pricelist(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();
        $data           = $this->Admin_model->get_all_pricelist();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Nama Produk");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Pricelist');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Update Harga Akhir Diskon?');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:C$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:C$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'C0BEBF'
            )
        ));
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);

        $startDataRow = $startRow++;

        foreach($data->result_object() as $product){
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, $product->nama_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, $product->nominal_web_pricelist);
            $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, "TIDAK");

            $startRow++;

        }
        $startRow--;
//        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFont()->setBold(true);
//        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFill()->applyFromArray(array(
//            'type' => PHPExcel_Style_Fill::FILL_SOLID,
//            'startcolor' => array(
//                'rgb' => 'DCDCDC'
//            )
//        ));

        $objPHPExcel->getActiveSheet()
            ->getStyle("B$startDataRow:B$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $objPHPExcel->getActiveSheet()
            ->getComment('C2')
            ->getText()->createTextRun("YA: Harga akhir promosi yang terdaftar di master promosi akan diupdate berdasarkan persentase promosi
            \n TIDAK: Harga akhir promosi yang terdaftar di master promosi akan tetap");
        $objPHPExcel->getActiveSheet()->getComment("C2")->setWidth("400px");
        $objPHPExcel->getActiveSheet()->getComment("C2")->setHeight("250px");

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');


        $filename = "MasterPricelist ($date)";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    function download_excel_promosi(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();
        $data           = $this->Admin_model->get_all_promo();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->mergeCells("A2:A3");
        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Nama Produk");


        $objPHPExcel->getActiveSheet()->mergeCells("B$startRow:C$startRow");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, "Promo (Pilih salah satu)");
        $objPHPExcel->getActiveSheet()->mergeCells("D$startRow:E$startRow");
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, "Durasi Promosi");

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        $startRow++;

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);


        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Persen');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, 'Tanggal Awal');
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, 'Tanggal Akhir');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        $objPHPExcel->getActiveSheet()->getStyle("A2:E3")->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $startRow++;
        $startDataRow = $startRow;

        foreach($data->result_object() as $product){
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, $product->nama_web_product);
            $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, $product->persen_web_promosi);
            $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, $product->nominal_web_promosi);
            $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, $product->start_web_promosi);
            $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, $product->end_web_promosi);

            $startRow++;

        }
        $startRow--;
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'DCDCDC'
            )
        ));

        $objPHPExcel->getActiveSheet()
            ->getComment('B3')
            ->getText()->createTextRun("Hanya angka tanpa % ");
        $objPHPExcel->getActiveSheet()->getComment("B3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("B3")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('D3')
            ->getText()->createTextRun("Format YYYY-MM-DD hh:MM:SS (2020-01-31 21:30:00) ");
        $objPHPExcel->getActiveSheet()->getComment("D3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("D3")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('E3')
            ->getText()->createTextRun("Format YYYY-MM-DD hh:MM:SS (2020-01-31 21:30:00) ");
        $objPHPExcel->getActiveSheet()->getComment("E3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("E3")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getStyle("A2:D2")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getStyle("C$startDataRow:C$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');


        $filename = "MasterPromosi ($date)";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    function download_excel_transaksi(){

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();

        $status = htmlspecialchars($_GET["status"]);
        $data = $this->Admin_model->get_all_orders($status, null, true);

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "No. Pesanan");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Tgl Pesanan');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Tgl Pelunasan');
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, 'Nama Penerima');
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, 'No. Telp Penerima');
        $objPHPExcel->getActiveSheet()->SetCellValue("F".$startRow, 'Alamat Penerima');
        $objPHPExcel->getActiveSheet()->SetCellValue("G".$startRow, 'Status Pesanan');
        $objPHPExcel->getActiveSheet()->SetCellValue("H".$startRow, 'Art Number');
        $objPHPExcel->getActiveSheet()->SetCellValue("I".$startRow, 'Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("J".$startRow, 'Harga');
        $objPHPExcel->getActiveSheet()->SetCellValue("K".$startRow, 'Qty');
        $objPHPExcel->getActiveSheet()->SetCellValue("L".$startRow, 'Total Harga');
        $objPHPExcel->getActiveSheet()->SetCellValue("M".$startRow, 'Grand Total Pesanan');
        $objPHPExcel->getActiveSheet()->SetCellValue("N".$startRow, 'Nama Ekspedisi');
        $objPHPExcel->getActiveSheet()->SetCellValue("O".$startRow, 'No. Resi');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:O$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:O$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);


        $startRow++;
        $startDataRow = $startRow;
        $prev = 0;
        $startMerge = 0;
        $first = true;

        foreach($data->result_object() as $trans){

           if($prev != $trans->bukti_web_so_m){

               if($first == false){
                   $objPHPExcel->getActiveSheet()->mergeCells("A$startMerge:A".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("B$startMerge:B".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("C$startMerge:C".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("D$startMerge:D".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("E$startMerge:E".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("F$startMerge:F".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("G$startMerge:G".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("M$startMerge:M".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("N$startMerge:N".($startRow-1));
                   $objPHPExcel->getActiveSheet()->mergeCells("O$startMerge:O".($startRow-1));

               }

               $startMerge = $startRow;

               $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, $trans->bukti_web_so_m);
               $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, $trans->tgl_web_so_m);
               if($trans->payment_date == '0000-00-00 00:00:00'){
                   $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, "-");
               } else {
                   $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, $trans->payment_date);
               }

               $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, $trans->nama_web_user_alamat);
               $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, $trans->telp_web_user_alamat);
               $objPHPExcel->getActiveSheet()->SetCellValue("F".$startRow,
                   $trans->alamat_web_user_alamat."\n".
                   $trans->kecamatan_web_user_alamat.", ".$trans->kota_web_user_alamat."\n".
                   $trans->provinsi_web_user_alamat
               );


               $objPHPExcel->getActiveSheet()->SetCellValue("G".$startRow,
                   $this->status_pesanan($trans->status_web_so_m, $trans->paid_by_user)
               );

               $objPHPExcel->getActiveSheet()->SetCellValue("M".$startRow, $trans->total_web_so_m);
               $objPHPExcel->getActiveSheet()->SetCellValue("N".$startRow, $trans->nama_ekspedisi_web_so_info);
               $objPHPExcel->getActiveSheet()->SetCellValue("O".$startRow, $trans->no_resi_web_so_info);


           }


           $objPHPExcel->getActiveSheet()->SetCellValue("H".$startRow, $trans->art_number_web_product);
           $objPHPExcel->getActiveSheet()->SetCellValue("I".$startRow,
               $trans->nama_product_so_d."\n".
               $trans->warna_product_so_d
           );
           $objPHPExcel->getActiveSheet()->SetCellValue("J".$startRow, $trans->unit_price_so_d);
           $objPHPExcel->getActiveSheet()->SetCellValue("K".$startRow, $trans->qty_so_d);
           $objPHPExcel->getActiveSheet()->SetCellValue("L".$startRow, $trans->total_price_so_d);


           $prev = $trans->bukti_web_so_m;
           $first = false;
           $startRow++;
       }

        $startRow--;
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startDataRow:A$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'DCDCDC'
            )
        ));

        $objPHPExcel->getActiveSheet()
            ->getStyle("A$startDataRow:E$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getStyle("G$startDataRow:G$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getStyle("M$startDataRow:M$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getStyle("N$startDataRow:N$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getStyle("O$startDataRow:O$startRow")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');


        $filename = "Transaksi ($date)";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    function download_template_product(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Art Number");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Nama Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Kategori');
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, 'Warna Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, 'Panjang Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("F".$startRow, 'Lebar Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("G".$startRow, 'Tinggi Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("H".$startRow, 'Berat Bersih');
        $objPHPExcel->getActiveSheet()->SetCellValue("I".$startRow, 'Berat Kotor');
        $objPHPExcel->getActiveSheet()->SetCellValue("J".$startRow, 'Volume Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("K".$startRow, 'Deskripsi Produk');
        $objPHPExcel->getActiveSheet()->SetCellValue("L".$startRow, 'Cara Perawatan');
        $objPHPExcel->getActiveSheet()->SetCellValue("M".$startRow, 'Stok');
        $objPHPExcel->getActiveSheet()->SetCellValue("N".$startRow, 'Status Aktif');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:N$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:N$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(88);

        $objPHPExcel->getActiveSheet()
            ->getComment('E2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("E2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("E2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('F2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("F2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("F2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('G2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("G2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("G2")->setHeight("50px");


        $objPHPExcel->getActiveSheet()
            ->getComment('H2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("H2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("H2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('I2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("I2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("I2")->setHeight("50px");


        $objPHPExcel->getActiveSheet()
            ->getComment('J2')
            ->getText()->createTextRun("Hanya angka tanpa huruf ");
        $objPHPExcel->getActiveSheet()->getComment("J2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("J2")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('N2')
            ->getText()->createTextRun("NONAKTIF atau AKTIF ");
        $objPHPExcel->getActiveSheet()->getComment("N2")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("N2")->setHeight("50px");

        $filename = "[Template] MasterProduct";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    function download_template_promosi(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->mergeCells("A2:A3");
        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Nama Produk");


        $objPHPExcel->getActiveSheet()->mergeCells("B$startRow:C$startRow");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, "Promo (Pilih salah satu)");
        $objPHPExcel->getActiveSheet()->mergeCells("D$startRow:E$startRow");
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, "Durasi Promosi");

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        $startRow++;

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);


        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Persen');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Nominal');
        $objPHPExcel->getActiveSheet()->SetCellValue("D".$startRow, 'Tanggal Awal');
        $objPHPExcel->getActiveSheet()->SetCellValue("E".$startRow, 'Tanggal Akhir');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:E$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'BDC0BF'
            )
        ));

        $objPHPExcel->getActiveSheet()->getStyle("A2:E3")->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $objPHPExcel->getActiveSheet()
            ->getStyle("A2:D2")
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getActiveSheet()
            ->getComment('B3')
            ->getText()->createTextRun("Hanya angka tanpa % ");
        $objPHPExcel->getActiveSheet()->getComment("B3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("B3")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('D3')
            ->getText()->createTextRun("Format YYYY-MM-DD hh:MM:SS (2020-01-31 21:30:00) ");
        $objPHPExcel->getActiveSheet()->getComment("D3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("D3")->setHeight("50px");

        $objPHPExcel->getActiveSheet()
            ->getComment('E3')
            ->getText()->createTextRun("Format YYYY-MM-DD hh:MM:SS (2020-01-31 21:30:00) ");
        $objPHPExcel->getActiveSheet()->getComment("E3")->setWidth("200px");
        $objPHPExcel->getActiveSheet()->getComment("E3")->setHeight("50px");

        $filename = "[Template] MasterPromosi";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    function download_template_pricelist(){
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $startRow = "2";

        $objPHPExcel    = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->SetCellValue("A".$startRow, "Nama Produk");
        $objPHPExcel->getActiveSheet()->SetCellValue("B".$startRow, 'Pricelist');
        $objPHPExcel->getActiveSheet()->SetCellValue("C".$startRow, 'Update Harga Akhir Diskon?');

        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:C$startRow")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A$startRow:C$startRow")->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'C0BEBF'
            )
        ));
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(88);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);

        $objPHPExcel->getActiveSheet()
            ->getComment('C2')
            ->getText()->createTextRun("YA: Harga akhir promosi yang terdaftar di master promosi akan diupdate berdasarkan persentase promosi
            \n TIDAK: Harga akhir promosi yang terdaftar di master promosi akan tetap");
        $objPHPExcel->getActiveSheet()->getComment("C2")->setWidth("400px");
        $objPHPExcel->getActiveSheet()->getComment("C2")->setHeight("250px");

        $filename = "[Template] MasterPricelist";
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    function send_order_via_chat(){

        date_default_timezone_set('Asia/Jakarta');

        $id_web_user = $_REQUEST['id_web_user_chat'];
        $id_ref_web_chat = $_REQUEST['ref_chat'];
        $img_web_chat = '';
        $ucode_product_web_chat = $_REQUEST['product_chat'];
        $id_admin = $_SESSION['id_web_user'];
        $timestamp_web_chat = date('Y-m-d H:i:s');

        // get so_m
        $id_web_so_m = $_REQUEST['id_web_so_m'];
        $data_so = $this->Admin_model->get_order_summary($id_web_so_m)->row();

        $message_web_chat = "<span class='product-link-chat' style='font-weight: bold; font-size: 15px;'> Pesanan No: $data_so->bukti_web_so_m  </span><br>
                            Status: ".$this->status_pesanan($data_so->status_web_so_m, $data_so->paid_by_user).
                            "<br> Total: ".$this->rupiah($data_so->grand_total_web_so_m).
                            "<br><a style='font-size: 11px; text-decoration: underline; cursor: pointer;' href='".base_url('home/view_order_details/')."$data_so->bukti_web_so_m' target='_blank'> Lihat Pesanan</a>";

        $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

        $insert_id = $this->Admin_model->send_chat($data);
        if($insert_id){
            $return_arr = array("Status" => 'OK', "Message" => '', "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
        }

        echo json_encode($return_arr);
        return;

    }

    function get_variable(){
        if(isset($_REQUEST['tipe_web_variable'])){
            $tipe_web_variable = htmlentities($_REQUEST['tipe_web_variable'], ENT_QUOTES);
        } else {
            $tipe_web_variable = null;
        }

        $data = $this->Admin_model->get_all_variable($tipe_web_variable);
        echo json_encode($data->result_object());
        return;
    }

    function get_variable_by_id(){
        $id = htmlentities($_REQUEST['id_web_variable'], ENT_QUOTES);
        $data = $this->Admin_model->get_variable_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function add_variable(){
        date_default_timezone_set('Asia/Jakarta');

        $tipe_web_variable = strtoupper(htmlentities($_REQUEST['tipe_web_variable'], ENT_QUOTES));
        $nama_web_variable = strtoupper(htmlentities($_REQUEST['nama_web_variable'], ENT_QUOTES));
        $isi_web_variable = htmlentities($_REQUEST['isi_web_variable'], ENT_QUOTES);
        $timestamp_web_variable = date('Y-m-d H:i:s');

        if(isset($_REQUEST['id_web_variable'])){
            $id_web_variable = $_REQUEST['id_web_variable'];
        } else {
            $id_web_variable = null;
        }

        // validation

        $data = compact('tipe_web_variable','nama_web_variable', 'isi_web_variable', 'timestamp_web_variable');

        if($id_web_variable){
            if($this->Admin_model->update_variable($data, $id_web_variable)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan data');
            }
        } else {
            if($this->Admin_model->add_variable($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambah data');
            }
        }


        echo json_encode($return_arr);
        return;
    }

    private function status_pesanan($status, $confirm_payment){
        switch($status) {
            case '1':
                if($confirm_payment == 0){
                    return "Diterima - Belum Bayar";
                } else {
                    return "Diterima - Menunggu Pengecekan";
                }

                break;
            case '2':
                return "Diproses";
                break;
            case '3':
                return "Dikirim";
                break;
            case '4':
                return "Selesai";
                break;
            case '5':
                return "Dibatalkan";
                break;
        }
    }

    private function rupiah($angka){

        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;

    }

}
?>