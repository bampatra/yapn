<?php

use Faker\Factory;

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('profile/Profile_model');
    }

    function index()
    {
        $this->load->view('template/header');
        if($this->session->userdata('email_web_user')){
           $id_web_user = $this->session->userdata('id_web_user');
        } else {
            $id_web_user = 0;
        }

        if(isset($_GET['prod']) && isset($_GET['color'])) {
            // get product from database
            $get_prod = htmlentities(addslashes($_GET['prod']), ENT_QUOTES);
            $get_color = htmlentities(addslashes($_GET['color']), ENT_QUOTES);

            $prod = $this->Product_model->get_product_from_url($get_prod, $get_color, $id_web_user);

            if ($prod->num_rows() > 0) {

                $data_row = $prod->row();
                $this->add_to_activity($id_web_user, $data_row->ucode_web_product);

                $data = array(
                    'ucode_web_product' => $data_row->ucode_web_product,
                    'nama_web_product' => $data_row->nama_web_product,
                    'nama_web_catprod' => $data_row->nama_web_catprod,
                    'ucode_catprod' => $data_row->ucode_catprod,
                    'art_number_web_product' => $data_row->art_number_web_product,
                    'nama_web_warna' => $data_row->nama_web_col,
                    'pricelist' =>$data_row->nominal_web_pricelist,
                    'img_web_warna' => $data_row->file_web_image,
                    'img_web_product' =>  $data_row->file_web_image,
                    'stok_web_product' => $data_row->stok_web_product,
                    'desc_web_product' => nl2br($data_row->desc_web_product),
                    'maintenance_web_product' => nl2br($data_row->maintenance_web_product),
                    'id_web_user_favorite' => $data_row->id_web_user_favorite,
                    'length_web_product' => $data_row->length_web_product,
                    'width_web_product' => $data_row->width_web_product,
                    'height_web_product' => $data_row->height_web_product,
                    'wn_web_product' => $data_row->wn_web_product,
                    'wg_web_product' => $data_row->wg_web_product,
                    'vol_web_product' => $data_row->vol_web_product,
                    'nominal_web_promosi' => $data_row->nominal_web_promosi,
                    'persen_web_promosi' =>  $data_row->persen_web_promosi
                );

                $this->load->view('main', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->view('template/404_page');
            }
        } else {
            // error page
        }

        return;
    }

    function add_to_favorite(){
        if(!isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'UNAUTHORIZED', "Message" => '');
            echo json_encode($return_arr);
            return;
        }
        $ucode_web_product = htmlentities($_REQUEST['product'], ENT_QUOTES);
        $data = array(
            'id_web_user' => $_SESSION['id_web_user'],
            'ucode_web_product' => $ucode_web_product
        );

        // if product exist in favorite
        $fav_data = $this->Profile_model->get_favorites($_SESSION['id_web_user'], $ucode_web_product);

        if($fav_data->num_rows() > 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Produk ini sudah ada di daftar favorit');
            echo json_encode($return_arr);
            return;
        }

        if($this->Product_model->add_to_favorite($data)){
            $return_arr = array("Status" => 'OK', "Message" => 'Produk berhasil dimasukkan ke daftar favorit');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan ke favorite');
        }

        echo json_encode($return_arr);
        return;

    }

    function remove_from_favorite(){
        $ucode_web_product = htmlentities($_REQUEST['product'], ENT_QUOTES);
        if($this->Product_model->remove_from_favorite($_SESSION['id_web_user'], $ucode_web_product)){
            $return_arr = array("Status" => 'OK', "Message" => 'Produk berhasil dihapus dari daftar favorit');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menghapus dari favorite');
        }
        echo json_encode($return_arr);
        return;
    }

    function get_all_products(){
        $search = null;
        $limit = null;
        $offset = null;
        $all = false;

        if(isset($_REQUEST['search'])){
            $search = htmlentities($_REQUEST['search'], ENT_QUOTES);
        }

        if(isset($_REQUEST['limit'])){
            if($_REQUEST['limit'] == 'false'){
                $limit = false;
            }
        }

        if(isset($_REQUEST['all'])){
            if($_REQUEST['all'] == 'true'){
                $all = true;
            }
        }

        if(isset($_REQUEST['limit']) && isset($_REQUEST['offset'])) {
            $limit = htmlentities($_REQUEST['limit'], ENT_QUOTES);
            $offset = htmlentities($_REQUEST['offset'], ENT_QUOTES);
        }

        $data = $this->Product_model->get_all_products($search, $all, $limit, $offset);
        echo json_encode($data->result_object());
        return;
    }

    function get_product_images(){
        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES);
        $data = $this->Product_model->get_product_images($ucode_web_product);
        echo json_encode($data->result_object());
        return;
    }

    function get_product_by_id(){
        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES);
        $data = $this->Product_model->get_product_by_id($ucode_web_product, 0);
        echo json_encode($data->row());
        return;
    }

    function get_average_review(){
        $data = $this->Product_model->get_average_review(htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES));
        echo json_encode($data->row());
        return;
    }

    function get_all_review(){
        $data = $this->Product_model->get_all_product_review(htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES));
        echo json_encode($data->result_object());
        return;
    }

    function faker_product(){
        include APPPATH.'/third_party/faker/autoload.php';
        $faker = Faker\Factory::create();
        date_default_timezone_set('Asia/Jakarta');

        for ($i = 0; $i < 100; $i++){
            $data = array(
                'nama_web_product' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'art_number_web_product' => $faker->ean13,
                'date_web_product' => date('Y-m-d H:i:s'),
                'length_web_product' => $faker->numberBetween($min = 10, $max = 200),
                'width_web_product' => $faker->numberBetween($min = 10, $max = 200),
                'height_web_product' => $faker->numberBetween($min = 10, $max = 200),
                'wn_web_product' => $faker->numberBetween($min = 10, $max = 99),
                'wg_web_product' => $faker->numberBetween($min = 10, $max = 99),
                'vol_web_product' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1),
                'ucode_catprod' => $faker->numberBetween($min = 1, $max = 18),
                'ucode_col' => $faker->numberBetween($min = 1, $max = 31),
                'desc_web_product' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'maintenance_web_product' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'stok_web_product' => $faker->numberBetween($min = 1, $max = 200),
                'active_web_product' => '1'
            );

            $this->Product_model->add_product($data);
        }
    }

    function faker_color(){
        include APPPATH.'/third_party/faker/autoload.php';
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 30; $i++){
            $data = array(
                'nama_web_col' => $faker->unique()->colorName,
                'img_web_col' => '',
                'active_web_col' => '1'
            );

            $this->Product_model->add_color($data);
        }
    }

    function faker_pricelist(){
        include APPPATH.'/third_party/faker/autoload.php';
        $faker = Faker\Factory::create();
        for ($i = 161; $i <= 201; $i++){
            $data = array(
                'ucode_web_product' => $i,
                'nominal_web_pricelist' => $faker->numerify('####000'),
                'id_cabang_web_pricelist' => '18'
            );

            $this->Product_model->add_pricelist($data);
        }
    }

    function faker_product_image(){
        include APPPATH.'/third_party/faker/autoload.php';
        $faker = Faker\Factory::create();
        for ($i = 101; $i <= 201; $i++){
            $data = array(
                'tipe_web_image' => 'PRODUCT',
                'ref_web_image' => $i,
                'file_web_image' => $faker->randomElement(['prod1.jpeg', 'prod2.jpeg', 'prod3.jpeg', 'prod4.jpeg', 'prod5.jpeg']),
                'image_order' => '3'
            );

            $this->Product_model->add_image($data);
        }
    }

    private function add_to_activity($id_web_user, $ucode_web_product){

        date_default_timezone_set('Asia/Jakarta');

        // check if activity exists in database
        $check = $this->Profile_model->get_activity($id_web_user, 'PRODUCT', $ucode_web_product);

        if($check->num_rows() > 0){
            //update
            $id_web_user_activity = $check->row()->id_web_user_activity;
            $new_count = (int) $check->row()->count_web_user_activity + 1;
            $updated_data = array(
                'count_web_user_activity' => $new_count,
                'timestamp_web_user_activity' => date('Y-m-d H:i:s')
            );

            $this->Profile_model->update_user_activity($id_web_user_activity, $updated_data);
        } else {
            $activity_data = array(
                'id_web_user' => $id_web_user,
                'tipe_web_user_activity' => 'PRODUCT',
                'detail_web_user_activity' => $ucode_web_product,
                'count_web_user_activity' => 1,
                'timestamp_web_user_activity' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->Profile_model->add_user_activity($activity_data);
            if(!$insert_id){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Error User Activity');
                echo json_encode($return_arr);
            }


            return;
        }


    }

}
?>