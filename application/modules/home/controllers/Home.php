<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('cart/Cart_model');
    }

    function index()
    {
        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');
    }

    function get_category(){
        $data = $this->Home_model->get_category();
        echo json_encode($data);
    }

    function get_tren(){
        $data = $this->Home_model->get_tren();
        echo json_encode($data->result_object());
    }

    function get_terlaris(){
        $data = $this->Home_model->get_terlaris();
        echo json_encode($data->result_object());
    }

    function get_promosi(){
        $data = $this->Home_model->get_promosi();
        echo json_encode($data->result_object());
    }

    function get_promosi_banner(){
        $data = $this->Home_model->get_promosi_banner();
        echo json_encode($data->result_object());
    }

    function get_banner(){
        $tipe = htmlentities($_REQUEST['tipe'], ENT_QUOTES);
        $data = $this->Home_model->get_banner($tipe);
        echo json_encode($data->result_object());
    }

    function login(){

        if(isset($_SESSION['id_web_user'])){
            redirect(base_url(), 'refresh');
        }

        $creds = htmlentities($_REQUEST['creds'], ENT_QUOTES);
        $password_web_user = htmlentities($_REQUEST['password'], ENT_QUOTES);

        $password = md5($password_web_user);

        $result = $this->Home_model->is_registered($creds, $password);
        if($result->num_rows() > 0){
            $data_row = $result->row();
            $user_data = array('id_web_user' => $data_row->id_web_user,
                               'email_web_user' => $data_row->email_web_user,
                               'is_admin' => $data_row->is_admin
                            );



            // check if there are products in the cart when the user is not logged in
            if(isset($_SESSION['id_so_m'])){

                // get this user's previous cart
                $unapproved_cart = $this->Home_model->get_user_cart($data_row->id_web_user);

                // if the user's cart is currently empty
                if($unapproved_cart->num_rows() == 0){

                    // update id_so_m
                    $updated_data = array("id_user_web_so_m" => $data_row->id_web_user);
                    $this->Cart_model->update_cart($updated_data, $_SESSION['id_so_m']);

                } else {
                    // join product with the previous cart

                    $current_cart = $this->Cart_model->get_cart($_SESSION['id_so_m']);
                    $current_cart_total = 0;
                    $unapproved_cart_id = $unapproved_cart->row()->id_web_so_m;
                    $unapproved_cart_total = (int) $unapproved_cart->row()->total_web_so_m;
                    $unapproved_cart_grand_total = (int) $unapproved_cart->row()->grand_total_web_so_m;


                    foreach($current_cart->result_object() as $prod){
                       $updated_data = array("id_web_so_m" => $unapproved_cart_id);
                       $this->Cart_model->update_cart_item($updated_data, $prod->id_web_so_d);
                       $current_cart_total += (int) $prod->total_price_so_d;
                    }

                    $new_total = $unapproved_cart_total + $current_cart_total;
                    $new_grand_total = $unapproved_cart_grand_total + $current_cart_total;

                    $updated_data = array("total_web_so_m" => $new_total, 'grand_total_web_so_m' => $new_grand_total);
                    $this->Cart_model->update_cart($updated_data, $unapproved_cart_id);

                    $this->Cart_model->delete_cart($_SESSION['id_so_m']);

                }

                unset($_SESSION['id_so_m']);


            }

            $this->session->set_userdata($user_data);
            $return_arr = array("Status" => 'OK', "Message" => '');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'User tidak ditemukan! Pastikan email dan password sudah benar.');
        }

        echo json_encode($return_arr);
        return;
    }

    function session_check(){
        print_r($_SESSION);
        return;
    }

    function error_page_check(){
        $this->load->view('template/header');
        $this->load->view('template/404_page');
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

    function admin_login(){
        if(isset($_SESSION['id_web_user'])){
            if($_SESSION['is_admin'] == '1'){
                redirect(base_url('admin'));
            } else {
                redirect(base_url('home'));
            }
        } else {
            $this->load->view('admin_login');
        }

    }

    function admin_final_login(){
        $creds = htmlentities($_REQUEST['creds'], ENT_QUOTES);
        $password_web_user = htmlentities($_REQUEST['password'], ENT_QUOTES);

        $password = md5($password_web_user);

        $result = $this->Home_model->is_registered($creds, $password);
        if($result->num_rows() > 0){
            $data_row = $result->row();

            if($data_row->is_admin == '1'){
                $user_data = array('id_web_user' => $data_row->id_web_user,
                    'email_web_user' => $data_row->email_web_user,
                    'is_admin' => $data_row->is_admin
                );

                $this->session->set_userdata($user_data);
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Unauthorized!');
            }

        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'User tidak ditemukan! Pastikan email dan password sudah benar.');
        }

        echo json_encode($return_arr);
        return;
    }

    function get_suggest_product(){
        $search = htmlentities($_REQUEST['search'], ENT_QUOTES);
        $suggest_data = $this->Home_model->get_suggest_product($search);
        $row = array();

        foreach($suggest_data->result_array() as $suggest) {
            $data = array(
                "value" => $suggest['nama_web_product'],
                "url" => base_url('product?prod=').$suggest['art_number_web_product']."&color=".$suggest['nama_web_col'],
                "image" => $suggest['file_web_image'],
                "nominal_web_pricelist" => $suggest['nominal_web_pricelist'],
                "nominal_web_promosi" => $suggest['nominal_web_promosi'],
                "persen_web_promosi" => $suggest['persen_web_promosi']
            );
            array_push($row, $data);
        }

        echo json_encode($row);
    }

    function get_notification(){

        if(isset($_SESSION['id_web_user'])){
            $id_web_user = $_SESSION['id_web_user'];
        } else {
            $id_web_user = 0;
        }

        $data = $this->Home_model->get_notification($id_web_user);
        echo json_encode($data->result_object());
        return;
    }

    function read_notification(){
        $data = $_REQUEST['data'];
        foreach($data as $notif){
            $updated_data = array("is_read" => '1');
            $this->Home_model->update_notification($updated_data, htmlentities($notif, ENT_QUOTES));
        }

        $return_arr = array("Status" => 'OK', "Message" => '');
        echo json_encode($return_arr);
        return;
    }

    function view_order_details($args){
        $bukti_web_so_m = htmlentities($args, ENT_QUOTES);
        $this->load->helper('url');
        if(isset($_SESSION['id_web_user'])){
            if($_SESSION['is_admin'] == '1'){
                redirect(base_url('admin/orders?no=').$bukti_web_so_m, 'refresh');
            } else {
                redirect(base_url('profile/purchase_detail?id=').$bukti_web_so_m, 'refresh');
            }
        }
//        redirect(base_url('home'), 'refresh');
    }

    function get_media_sosial(){
        $media_sosial = htmlentities($_REQUEST['nama_media_sosial'], ENT_QUOTES);
        $data = $this->Home_model->get_media_sosial($media_sosial);
        echo json_encode($data->row());
    }

    function phpinfo_print(){
        phpinfo();
    }

}
?>