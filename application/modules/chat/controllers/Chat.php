<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Chat extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');

        $this->load->library('s3');

        $this->config->load('s3', TRUE);
        $s3_config = $this->config->item('s3');
        $this->bucket_name = $s3_config['bucket_name'];
        $this->s3_url = $s3_config['s3_url'];
    }

    function index(){
//        $this->output->enable_profiler(TRUE);
        $this->load->view('template/header');
    }

    function mobile(){
        $this->load->view('mobile');
    }

    function send_chat(){
        date_default_timezone_set('Asia/Jakarta');

        if(!isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Unauthorized');
            echo json_encode($return_arr);
            return;
        }


        $id_web_user = $_SESSION['id_web_user'];
        $message_web_chat = htmlentities($_REQUEST['message_chat'], ENT_QUOTES);
        $id_ref_web_chat = htmlentities($_REQUEST['ref_chat'], ENT_QUOTES);
        $img_web_chat = '';
        $ucode_product_web_chat = htmlentities($_REQUEST['product_chat'], ENT_QUOTES);
        $id_admin = '0';
        $timestamp_web_chat = date('Y-m-d H:i:s');

        $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

        $insert_id = $this->Chat_model->send_chat($data);
        if($insert_id){
            $return_arr = array("Status" => 'OK', "Message" => '', "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
        }

        echo json_encode($return_arr);
        return;
    }

    function get_all_messages(){

        if(isset($_SESSION['id_web_user'])){
            $data = $this->Chat_model->get_all_messages($_SESSION['id_web_user']);
            echo json_encode($data->result_object());
            return;
        }

    }

    function upload_image()
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
//            $id_web_user = $_SESSION['id_web_user'];
//            $message_web_chat = '';
//            $id_ref_web_chat = 0;
//            $img_web_chat = $this->s3_url.$this->folder_name.$s3_file;
//            $ucode_product_web_chat = 0;
//            $id_admin = '0';
//
//            $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');
//
//            $insert_id = $this->Chat_model->send_chat($data);
//            if($insert_id){
//                $result_array = array("Status" => 'OK', "File" =>  $this->s3_url.$this->folder_name.$s3_file, "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
//            } else {
//                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
//            }
//        }
//
//        echo json_encode($result_array);
//        return;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img_chat')) {
            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
        } else {
            $file_data = $this->upload->data();
            //upload to database

            $id_web_user = $_SESSION['id_web_user'];
            $message_web_chat = '';
            $id_ref_web_chat = 0;
            $img_web_chat = 'assets/upload/chat/'.$file_data['file_name'];
            $ucode_product_web_chat = 0;
            $id_admin = '0';

            $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

            $insert_id = $this->Chat_model->send_chat($data);
            if($insert_id){
                $result_array = array("Status" => 'OK', "File" => 'assets/upload/chat/'.$file_data['file_name'], "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
            } else {
                $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
            }
        }

        echo json_encode($result_array);
        return;

    }

    function is_read(){
        $this->Chat_model->is_read($_SESSION['id_web_user']);
        echo json_encode(array("Status" => "OK"));
    }

    function send_order_via_chat(){

        date_default_timezone_set('Asia/Jakarta');

        $id_web_user = $_SESSION['id_web_user'];
        $id_ref_web_chat = htmlentities($_REQUEST['ref_chat'], ENT_QUOTES);
        $img_web_chat = '';
        $ucode_product_web_chat = htmlentities($_REQUEST['product_chat'], ENT_QUOTES);
        $id_admin = 0;
        $timestamp_web_chat = date('Y-m-d H:i:s');

        // get so_m
        $id_web_so_m = htmlentities($_REQUEST['id_web_so_m'], ENT_QUOTES);
        $data_so = $this->Chat_model->get_order_summary($id_web_so_m);

        if($data_so->num_rows() == 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Pesanan tidak ditemukan');
            echo json_encode($return_arr);
            return;
        }

        $data_so = $data_so->row();

        $message_web_chat = "<span class='product-link-chat' style='font-weight: bold; font-size: 15px;'> Pesanan No: ".htmlentities($data_so->bukti_web_so_m, ENT_QUOTES)."  </span><br>
                            Status: ".htmlentities($this->status_pesanan($data_so->status_web_so_m, $data_so->paid_by_user), ENT_QUOTES).
            "<br> Total: ".htmlentities($this->rupiah($data_so->grand_total_web_so_m), ENT_QUOTES).
            "<br><a style='font-size: 11px; text-decoration: underline; cursor: pointer;' href='".base_url('home/view_order_details/').htmlentities($data_so->bukti_web_so_m, ENT_QUOTES)."' target='_blank'> Lihat Pesanan</a>";


        $data = compact('id_web_user','message_web_chat', 'id_ref_web_chat', 'img_web_chat', 'ucode_product_web_chat', 'id_admin', 'timestamp_web_chat');

        $insert_id = $this->Chat_model->send_chat($data);
        if($insert_id){
            $return_arr = array("Status" => 'OK', "Message" => '', "Timestamp" => $timestamp_web_chat, "ID" => $insert_id);
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
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