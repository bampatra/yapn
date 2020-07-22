<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        if(!$this->session->userdata('id_web_user') || $_SESSION['is_admin'] == '0'){
            redirect(base_url('home/admin_login'));
        }

    }

    function index()
    {
        $this->load->view('template/admin_header');
        $this->load->view('index');
        $this->load->view('template/admin_footer');
    }

    function golongan()
    {
        $this->load->view('template/admin_header');
        $this->load->view('golongan');
        $this->load->view('template/admin_footer');
    }

    function rekening()
    {
        $data_golongan = $this->Admin_model->get_all_golongan()->result_object();

        $data['golongan_list'] = $data_golongan;
        $this->load->view('template/admin_header');
        $this->load->view('rekening', $data);
        $this->load->view('template/admin_footer');
    }

    function get_all_golongan(){
        $data = $this->Admin_model->get_all_golongan();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_rekening(){
        $data = $this->Admin_model->get_all_rekening();
        echo json_encode($data->result_object());
        return;
    }

    function get_golongan_by_id(){
        $id = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);
        $data = $this->Admin_model->get_golongan_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function get_rekening_by_id(){
        $id = htmlentities($_REQUEST['id_rekening'], ENT_QUOTES);
        $data = $this->Admin_model->get_rekening_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function add_golongan(){
        $no_golongan = strtoupper(trim(htmlentities($_REQUEST['no_golongan'], ENT_QUOTES)));
        $nama_golongan = htmlentities($_REQUEST['nama_golongan'], ENT_QUOTES);
        $neraca = htmlentities($_REQUEST['neraca'], ENT_QUOTES);
        $id_golongan = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);

        $data = compact('no_golongan', 'nama_golongan', 'neraca');

        //validation

        if($id_golongan == 0){
            if($this->Admin_model->add_golongan($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan golongan');
            }
        } else {
            if($this->Admin_model->update_golongan($data, $id_golongan)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate golongan');
            }
        }

        echo json_encode($return_arr);

    }

    function add_rekening(){
        $no_rekening = strtoupper(trim(htmlentities($_REQUEST['no_rekening'], ENT_QUOTES)));
        $nama_rekening= htmlentities($_REQUEST['nama_rekening'], ENT_QUOTES);
        $s_n_rekening = htmlentities($_REQUEST['s_n_rekening'], ENT_QUOTES);
        $id_golongan = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);
        $id_rekening = htmlentities($_REQUEST['id_rekening'], ENT_QUOTES);

        $data = compact('no_rekening', 'nama_rekening', 's_n_rekening', 'id_golongan');

        if($id_rekening == 0){
            if($this->Admin_model->add_rekening($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan rekening');
            }
        } else {
            if($this->Admin_model->update_rekening($data, $id_rekening)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate rekening');
            }
        }

        echo json_encode($return_arr);

    }

    function change_akhir_periode(){
        date_default_timezone_set('Asia/Singapore');

        $year = date('Y');
        $month = htmlentities($_REQUEST['month'], ENT_QUOTES);
        $date = "$year-$month-01";
        $new_date = date("t/m/Y", strtotime($date));

        $date_string = str_replace('/', '-', $new_date);
        $new_date_string = date("d-M-Y", strtotime($date_string));


        $_SESSION['akhir_periode'] = $new_date;
        $_SESSION['laporan_bulan'] = $month;
        echo json_encode(array("Status" => "OK", "Date" => $new_date, "DateString" => $new_date_string));
    }

    function logout(){
        unset(
            $_SESSION['id_web_user'],
            $_SESSION['email_web_user'],
            $_SESSION['is_admin'],
            $_SESSION['id_so_m']
        );

        $this->load->helper('url');
        redirect(base_url('home/admin_login'), 'refresh');
    }



}
?>