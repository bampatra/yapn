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
        $data_year = $this->Admin_model->get_record_year()->result_object();
        $data['years'] = $data_year;

        $this->load->view('template/admin_header');
        $this->load->view('index', $data);
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

    function aruskas()
    {
        $this->load->view('template/admin_header');
        $this->load->view('aruskas');
        $this->load->view('template/admin_footer');
    }

    function neraca()
    {
        $this->load->view('template/admin_header');
        $this->load->view('neraca');
        $this->load->view('template/admin_footer');
    }

    function neraca_saldo()
    {
        $this->load->view('template/admin_header');
        $this->load->view('neraca_saldo');
        $this->load->view('template/admin_footer');
    }

    function nsaldo_mtm()
    {
        $this->load->view('template/admin_header');
        $this->load->view('nsaldo_mtm');
        $this->load->view('template/admin_footer');
    }

    function bukubesar()
    {
        $data_rekening = $this->Admin_model->get_all_rekening()->result_object();
        $data['rekening_list'] = $data_rekening;

        $this->load->view('template/admin_header');
        $this->load->view('bukubesar', $data);
        $this->load->view('template/admin_footer');
    }

    function mutasi()
    {
        $data_rekening = $this->Admin_model->get_all_rekening()->result_object();
        $data_year = $this->Admin_model->get_record_year()->result_object();

        $data['rekening_list'] = $data_rekening;
        $data['years'] = $data_year;


        $this->load->view('template/admin_header');
        $this->load->view('mutasi', $data);
        $this->load->view('template/admin_footer');
    }

    function saldo_golongan()
    {
        $this->load->view('template/admin_header');
        $this->load->view('saldo_golongan');
        $this->load->view('template/admin_footer');
    }

    function labarugi()
    {
        $this->load->view('template/admin_header');
        $this->load->view('labarugi');
        $this->load->view('template/admin_footer');
    }

    function laporan_aruskas()
    {

        $this->load->view('template/admin_header');
        $this->load->view('laporan_aruskas');
        $this->load->view('template/admin_footer');
    }

    function transaksi()
    {
        $data_rekening = $this->Admin_model->get_all_rekening()->result_object();
        $data_arus_kas = $this->Admin_model->get_all_arus_kas()->result_object();

        $start_date = DateTime::createFromFormat('d/m/Y', $_SESSION['awal_periode'])->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $_SESSION['akhir_periode'])->format('Y-m-d');

//        $start_date = date('Y-m-d', strtotime($_SESSION['awal_periode']));
//        $end_date = date('Y-m-d', strtotime($_SESSION['akhir_periode']));



        $subtotal = $this->Admin_model->get_subtotal($start_date, $end_date)->row()->subtotal;

        $data['rekening_list'] = $data_rekening;
        $data['arus_kas_list'] = $data_arus_kas;
        $data['subtotal'] = $subtotal;

        $this->load->view('template/admin_header');
        $this->load->view('transaksi', $data);
        $this->load->view('template/admin_footer');
    }

    function delete_transaksi(){
        $id = htmlentities($_REQUEST['id_transaksi'], ENT_QUOTES);
        if($this->Admin_model->delete_transaksi($id)){
            $return_arr = array("Status" => 'OK', "Message" => '');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal Mengahapus Data');
        }

        echo json_encode($return_arr);
    }

    function delete_rekening(){
        $id = htmlentities($_REQUEST['id_rekening'], ENT_QUOTES);
        if($this->Admin_model->delete_rekening($id)){
            $return_arr = array("Status" => 'OK', "Message" => '');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal Mengahapus Data');
        }

        echo json_encode($return_arr);
    }

    function delete_golongan(){
        $id = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);
        if($this->Admin_model->delete_golongan($id)){
            $return_arr = array("Status" => 'OK', "Message" => '');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal Mengahapus Data');
        }

        echo json_encode($return_arr);
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

    function get_all_arus_kas(){
        $data = $this->Admin_model->get_all_arus_kas();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_transaksi(){
        $data = $this->Admin_model->get_all_transaksi();
        echo json_encode($data->result_object());
        return;
    }

    function get_nsaldo_mtm(){
        $data = $this->Admin_model->get_nsaldo_mtm(2020);
        echo json_encode($data->result_object());
        return;
    }

    function get_bukubesar(){
        $no_rek = htmlentities(trim($_REQUEST['no_rek']), ENT_QUOTES);
        $s_n = htmlentities(trim($_REQUEST['s_n']), ENT_QUOTES);

        $data = $this->Admin_model->get_bukubesar($no_rek, $s_n);
        echo json_encode($data->result_object());
        return;
    }

    function get_mutasi(){
        $no_rek = htmlentities(trim($_REQUEST['no_rek']), ENT_QUOTES);
        $s_n = htmlentities(trim($_REQUEST['s_n']), ENT_QUOTES);
        $year = htmlentities(trim($_REQUEST['year']), ENT_QUOTES);

        $data = $this->Admin_model->get_mutasi($no_rek, $s_n, $year);
        echo json_encode($data->result_object());
        return;
    }

    function get_neraca(){
        $data = $this->Admin_model->get_neraca();
        echo json_encode($data->result_object());
        return;
    }

    function get_saldo_golongan(){
        $data = $this->Admin_model->get_saldo_golongan((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun']);
        echo json_encode($data->result_object());
        return;
    }

    function get_saldo_rekening(){
        $filter = "WHERE b.no_golongan = '40' OR b.no_golongan = '50'";
        $data = $this->Admin_model->get_saldo_rekening((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun'], $filter);
        echo json_encode($data->result_object());
        return;
    }

    function get_laba_rugi(){
        $filter = "WHERE b.no_golongan = '40' OR b.no_golongan = '50'";
        $data = $this->Admin_model->get_laba_rugi((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun'], $filter);
        echo json_encode($data->result_object());
        return;
    }

    function get_laporan_arus_kas(){
        $data = $this->Admin_model->get_laporan_arus_kas((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun']);
        echo json_encode($data->result_object());
        return;
    }

    function get_kas_bank(){
        $filter = "WHERE b.no_golongan = '10'";
        $data = $this->Admin_model->get_laba_rugi((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun'], $filter);
        echo json_encode($data->result_object());
        return;
    }

    function get_neraca_saldo(){
        $data = $this->Admin_model->get_laba_rugi((int) $_SESSION['laporan_bulan'], (int) $_SESSION['laporan_tahun']);
        echo json_encode($data->result_object());
        return;
    }

    function get_saldo_summary(){
        $no_rek = htmlentities($_REQUEST['no_rek'], ENT_QUOTES);

        $data = $this->Admin_model->get_saldo_summary($no_rek);
        echo json_encode($data->row());
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

    function get_arus_kas_by_id(){
        $id = htmlentities($_REQUEST['id_arus_kas'], ENT_QUOTES);
        $data = $this->Admin_model->get_arus_kas_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function get_transaksi_by_id(){
        $id = htmlentities($_REQUEST['id_transaksi'], ENT_QUOTES);
        $data = $this->Admin_model->get_transaksi_by_id($id);
        echo json_encode($data->row());
        return;
    }

    function add_golongan(){
        $no_golongan = strtoupper(trim(htmlentities($_REQUEST['no_golongan'], ENT_QUOTES)));
        $nama_golongan = htmlentities($_REQUEST['nama_golongan'], ENT_QUOTES);
        $s_n_golongan = htmlentities($_REQUEST['s_n_golongan'], ENT_QUOTES);
        $neraca = htmlentities($_REQUEST['neraca'], ENT_QUOTES);
        $id_golongan = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);

        //validation
        $error = array();

        if(empty($no_golongan)){
            array_push($error, "invalid-nogolongan");
        }

        if(empty($nama_golongan)){
            array_push($error, "invalid-namagolongan");
        }

        if(!empty($error)){
            $return_arr = array("Status" => 'ERROR', "Error" => $error);
            echo json_encode($return_arr);
            return;
        }

        if($this->Admin_model->golongan_check($no_golongan, $nama_golongan)->num_rows() > 0){
            $return_arr = array("Status" => 'EXIST');
            echo json_encode($return_arr);
            return;
        }

        $data = compact('no_golongan', 'nama_golongan','s_n_golongan', 'neraca');

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
        $nama_rekening= htmlentities(trim($_REQUEST['nama_rekening']), ENT_QUOTES);
        $id_golongan = htmlentities($_REQUEST['id_golongan'], ENT_QUOTES);
        $id_rekening = htmlentities($_REQUEST['id_rekening'], ENT_QUOTES);

        //validation
        $error = array();

        if(empty($no_rekening)){
            array_push($error, "invalid-norek");
        }

        if(empty($nama_rekening)){
            array_push($error, "invalid-namarekening");
        }

        if($id_golongan == "0"){
            array_push($error, "invalid-golongan");
        }

        if(!empty($error)){
            $return_arr = array("Status" => 'ERROR', "Error" => $error);
            echo json_encode($return_arr);
            return;
        }

        if($this->Admin_model->rekening_check($no_rekening, $nama_rekening)->num_rows() > 0){
            $return_arr = array("Status" => 'EXIST');
            echo json_encode($return_arr);
            return;
        }

        $data = compact('no_rekening', 'nama_rekening', 'id_golongan');

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

    function add_arus_kas(){
        $id_arus_kas = htmlentities($_REQUEST['id_arus_kas'], ENT_QUOTES);
        $nama_arus_kas = htmlentities($_REQUEST['nama_arus_kas'], ENT_QUOTES);

        $data = compact('nama_arus_kas');

        //validation

        if($id_arus_kas == 0){
            if($this->Admin_model->add_arus_kas($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan golongan');
            }
        } else {
            if($this->Admin_model->update_arus_kas($data, $id_arus_kas)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate golongan');
            }
        }

        echo json_encode($return_arr);

    }

    function add_transaksi(){

        $id_transaksi = htmlentities($_REQUEST['id_transaksi'], ENT_QUOTES);
        $tgl_transaksi = htmlentities($_REQUEST['tgl_transaksi'], ENT_QUOTES);
        $keterangan_transaksi = htmlentities($_REQUEST['keterangan_transaksi'], ENT_QUOTES);
        $rekening_debet_transaksi = htmlentities($_REQUEST['rekening_debet_transaksi'], ENT_QUOTES);
        $rekening_kredit_transaksi = htmlentities($_REQUEST['rekening_kredit_transaksi'], ENT_QUOTES);
        $nominal_transaksi = htmlentities($_REQUEST['nominal_transaksi'], ENT_QUOTES);
        $arus_kas_transaksi = htmlentities($_REQUEST['arus_kas_transaksi'], ENT_QUOTES);
        $date_radio = htmlentities(trim($_REQUEST['date_radio']), ENT_QUOTES);

        $error = array();


        //validation

        if($date_radio == 'default'){

            if(empty($tgl_transaksi)){
                array_push($error, "invalid-tanggal");
            }

            $month_transaksi = date("n",strtotime($tgl_transaksi));
            $year_transaksi = date("Y",strtotime($tgl_transaksi));
        } else if($date_radio == 'saldo_awal'){
            $month_transaksi = '0';
            $year_transaksi = $tgl_transaksi;
        } else if($date_radio == 'penyesuaian'){
            $month_transaksi = '13';
            $year_transaksi = $tgl_transaksi;
        }

        if(empty($keterangan_transaksi)){
            array_push($error, "invalid-keterangan");
        }

        if($rekening_debet_transaksi == "none"){
            array_push($error, "invalid-debet");
        }

        if($rekening_kredit_transaksi == "none"){
            array_push($error, "invalid-kredit");
        }

        if(empty($nominal_transaksi) || ((int)$nominal_transaksi == 0)){
            array_push($error, "invalid-nominal");
        }

        if($arus_kas_transaksi == "none"){
            array_push($error, "invalid-aruskas");
        }

        if(!empty($error)){
            $return_arr = array("Status" => 'ERROR', "Error" => $error);
            echo json_encode($return_arr);
            return;
        }

        $data = compact('tgl_transaksi', 'keterangan_transaksi', 'rekening_debet_transaksi', 'rekening_kredit_transaksi',
                            'nominal_transaksi', 'arus_kas_transaksi', 'month_transaksi', 'year_transaksi');

        if($id_transaksi == 0){
            if($this->Admin_model->add_transaksi($data)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambahkan golongan');
            }
        } else {
            if($this->Admin_model->update_transaksi($data, $id_transaksi)){
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate golongan');
            }
        }

        echo json_encode($return_arr);

    }

    function change_akhir_periode(){

        $year = htmlentities($_REQUEST['year'], ENT_QUOTES);
        $month = htmlentities($_REQUEST['month'], ENT_QUOTES);
        $date = "$year-$month-01";
        $new_date = date("t/m/Y", strtotime($date));

        $date_string = str_replace('/', '-', $new_date);
        $new_date_string = date("d-M-Y", strtotime($date_string));


        $_SESSION['akhir_periode'] = $new_date;
        $_SESSION['laporan_bulan'] = $month;
        $_SESSION['laporan_tahun'] = $year;
        echo json_encode(array("Status" => "OK", "Date" => $new_date, "DateString" => $new_date_string));
    }

    function change_lembaga(){
        $lembaga = htmlentities($_REQUEST['lembaga'], ENT_QUOTES);
        $_SESSION['default_lembaga'] = $lembaga;
        echo json_encode(array("Status" => "OK", "Value" => $lembaga));
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