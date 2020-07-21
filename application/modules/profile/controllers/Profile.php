<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email_web_user')){
            redirect(base_url('home'));
        }
        $this->load->model('Profile_model');
        $this->load->model('home/Home_model');
        $this->load->model('cart/Cart_model');

        $this->load->library('s3');
        $this->config->load('s3', TRUE);
        $s3_config = $this->config->item('s3');
        $this->bucket_name = $s3_config['bucket_name'];
        $this->s3_url = $s3_config['s3_url'];
    }

    function index(){
        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');
    }

    function purchase(){
        $this->load->view('template/header');
        $this->load->view('purchase');
        $this->load->view('template/footer');
    }

    function purchase_detail(){
        $this->load->view('template/header');
        $this->load->view('purchase_detail');
        $this->load->view('template/footer');
    }

    function edit_akun(){
        $this->load->view('template/header');
        $this->load->view('edit_akun');
        $this->load->view('template/footer');
    }

    function favorite(){
        $this->load->view('template/header');
        $this->load->view('favorite');
        $this->load->view('template/footer');
    }

    function daftar_alamat(){
        $this->load->view('template/header');
        $this->load->view('daftar_alamat');
        $this->load->view('template/footer');
    }

    function review(){
        $this->load->view('template/header');
        $this->load->view('review');
        $this->load->view('template/footer');
    }

    function terakhir_dilihat(){
        $this->load->view('template/header');
        $this->load->view('terakhir_dilihat');
        $this->load->view('template/footer');
    }

    function track_order(){
        $this->load->view('template/header');
        $this->load->view('terakhir_dilihat');
        $this->load->view('template/footer');
    }


    function add_new_address(){

        $error = array();

        $nama_web_user_alamat = strtoupper(htmlentities($_REQUEST['nama_penerima'],ENT_QUOTES));
        $telp_web_user_alamat = strtoupper(htmlentities($_REQUEST['telp_penerima'], ENT_QUOTES));
        $provinsi_web_user_alamat = strtoupper(htmlentities($_REQUEST['provinsi_penerima'], ENT_QUOTES));
        $id_provinsi = strtoupper(htmlentities($_REQUEST['id_provinsi'], ENT_QUOTES));
        $kota_web_user_alamat = strtoupper(htmlentities($_REQUEST['kota_penerima'], ENT_QUOTES));
        $id_kota = strtoupper(htmlentities($_REQUEST['id_kota'], ENT_QUOTES));
        $kecamatan_web_user_alamat = strtoupper(htmlentities($_REQUEST['kecamatan_penerima'], ENT_QUOTES));
        $id_kecamatan = strtoupper(htmlentities($_REQUEST['id_kecamatan'], ENT_QUOTES));
        $alamat_web_user_alamat = strtoupper(htmlentities($_REQUEST['alamat_penerima'], ENT_QUOTES));
        $notes_web_user_alamat = strtoupper(htmlentities($_REQUEST['notes_penerima']));
        $id_web_user = $this->session->userdata('id_web_user');

        // if the user has primary address
        $main_addr = $this->Profile_model->get_main_address($_SESSION['id_web_user']);

        //validation
        if($nama_web_user_alamat == ''){
           array_push($error, "invalid-nama-penerima");

        }

        if($telp_web_user_alamat == ''){
            array_push($error, "invalid-telp-penerima");
        }

        if($provinsi_web_user_alamat == '' || $id_provinsi == '0'){
            array_push($error, "invalid-provinsi");
        }

        if($kota_web_user_alamat == '' || $id_kota == '0'){
            array_push($error, "invalid-kota");
        }

        if($kecamatan_web_user_alamat == '' || $id_kecamatan == '0'){
            array_push($error, "invalid-kecamatan");
        }

        if($alamat_web_user_alamat == ''){
            array_push($error, "invalid-alamat");
        }

        if(!empty($error)){
            $return_arr = array("Status" => 'ERROR', "Error" => $error);
            echo json_encode($return_arr);
            return;
        }

        if($_REQUEST['id_web_user_alamat'] != 0){
            $data = compact('nama_web_user_alamat', 'telp_web_user_alamat', 'provinsi_web_user_alamat', 'kota_web_user_alamat', 'kecamatan_web_user_alamat',
                'alamat_web_user_alamat', 'notes_web_user_alamat', 'id_web_user');

            if($this->Profile_model->update_address($data, htmlentities($_REQUEST['id_web_user_alamat'], ENT_QUOTES))){
                $return_arr = array("Status" => 'OK', "Message" => '', "ID" => htmlentities($_REQUEST['id_web_user_alamat'], ENT_QUOTES));
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal update alamat', "ID" => 0);
            }

        } else {
            if($main_addr->num_rows() > 0){
                $is_primary = '0';
            } else {
                $is_primary = '1';
            }

            $data = compact('nama_web_user_alamat', 'telp_web_user_alamat', 'provinsi_web_user_alamat', 'kota_web_user_alamat', 'kecamatan_web_user_alamat',
                'alamat_web_user_alamat', 'notes_web_user_alamat', 'id_web_user','is_primary');


            $insert_id = $this->Profile_model->add_new_address($data);
            if($insert_id){
                $return_arr = array("Status" => 'OK', "Message" => '', "ID" => $insert_id);
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menambah alamat', "ID" => 0);
            }
        }

        echo json_encode($return_arr);
        return;
    }

    function change_main_address(){
        $address = htmlentities($_REQUEST['address'], ENT_QUOTES);
        $this->db->trans_begin();
        if($this->Profile_model->reset_address($_SESSION['id_web_user'])){
            if($this->Profile_model->set_main_address($address)){
                $this->db->trans_commit();
                $return_arr = array("Status" => 'OK', "Message" => 'Alamat utama berhasil diganti');
            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengganti alamat utama');
            }
        } else {
            $this->db->trans_rollback();
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal reset alamat');
        }

        echo json_encode($return_arr);
        return;
    }


    function add_review(){

        date_default_timezone_set('Asia/Jakarta');

        $id_web_user = $_SESSION['id_web_user'];
        $id_so_d = htmlentities($_REQUEST['id_so_d'], ENT_QUOTES);
        $id_web_ulasan = htmlentities($_REQUEST['id_web_ulasan'], ENT_QUOTES);
        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES);
        $detail_web_ulasan = trim(htmlentities($_REQUEST['detail_web_ulasan'], ENT_QUOTES));
        $rating_web_ulasan = htmlentities($_REQUEST['rating'], ENT_QUOTES);

        $img1_web_ulasan = '';
        $img2_web_ulasan = '';
        $img3_web_ulasan = '';
        $img4_web_ulasan = '';
        $img5_web_ulasan = '';

        $tgl_web_ulasan = date('Y-m-d H:i:s');


        // validation
        if($detail_web_ulasan == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Ulasan tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }

        if($rating_web_ulasan == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Rating ulasan tidak boleh kosong');
            echo json_encode($return_arr);
            return;
        }


        // save images in database
        for ($x = 1; $x <= 5; $x++) {
            if(!empty($_REQUEST['img_ulasan']["$x"])){
                ${"img" . $x . "_web_ulasan"} = htmlentities($_REQUEST['img_ulasan']["$x"], ENT_QUOTES);
            }

        }

        $data = compact('id_web_user', 'id_so_d', 'ucode_web_product', 'detail_web_ulasan', 'rating_web_ulasan',
                        'img1_web_ulasan', 'img2_web_ulasan', 'img3_web_ulasan', 'img4_web_ulasan', 'img5_web_ulasan', 'tgl_web_ulasan');

        if($id_web_ulasan == '0'){
            $insert_id = $this->Profile_model->add_review($data);
            if($insert_id){
                $return_arr = array("Status" => 'OK', "Message" => 'Ulasan tersimpan', "ID" => $insert_id);
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan ulasan');
            }
        } else {
            if($this->Profile_model->update_review($data, $id_web_ulasan)){
                $return_arr = array("Status" => 'OK', "Message" => 'Ulasan tersimpan');
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan ulasan');
            }
        }



        echo json_encode($return_arr);
        return;

    }

    function get_row_ulasan(){

        $id_web_ulasan = htmlentities($_REQUEST['ulasan'], ENT_QUOTES);
        $data = $this->Profile_model->get_row_ulasan($id_web_ulasan);

        if($data->row()->id_web_user == $_SESSION['id_web_user']){
            echo json_encode($data->row());
            return;
        } else {
            echo json_encode(array("Status" => 'UNAUTHORIZED', "Message" => 'Access Denied'));
        }

    }

    function update_user_info(){
        $email_baru = htmlentities(trim($_REQUEST['email_baru']), ENT_QUOTES);
        $konfirmasi_email_baru = htmlentities(trim($_REQUEST['konfirmasi_email_baru'], ENT_QUOTES));
        $telp_baru = htmlentities(trim($_REQUEST['telp_baru'], ENT_QUOTES));
        $password_lama = htmlentities(trim($_REQUEST['password_lama']), ENT_QUOTES);
        $password_baru = htmlentities(trim($_REQUEST['password_baru']), ENT_QUOTES);
        $konfirmasi_password_baru = htmlentities(trim($_REQUEST['konfirmasi_password_baru']), ENT_QUOTES);

        $password = false;
        $email = false;
        $phone = false;

        $this->db->trans_begin();

        if($email_baru != '' || $konfirmasi_email_baru != ''){
            if(!filter_var($email_baru, FILTER_VALIDATE_EMAIL)) {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Format email tidak valid');
                echo json_encode($return_arr);
                return;
            }

            if(!filter_var($konfirmasi_email_baru, FILTER_VALIDATE_EMAIL)) {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Format email tidak valid');
                echo json_encode($return_arr);
                return;
            }

            //check if email is registered
            $email_check = $this->Profile_model->email_check($email_baru);
            if($email_check->num_rows() > 0){
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Email sudah terdaftar. Silahkan gunakan email lain yang belum terdaftar.');
                echo json_encode($return_arr);
                return;
            }

            if($email_baru == $konfirmasi_email_baru){
                // change email
                $updated_data = array("email_web_user" => $email_baru);
                if($this->Profile_model->update_detail_user($_SESSION['id_web_user'], $updated_data)){
                    $email = true;
                    $_SESSION['email_web_user'] = $email_baru;
                } else {
                    $this->db->trans_rollback();
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal update email');
                    echo json_encode($return_arr);
                    return;
                }

            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Pastikan email sudah diketik dengan benar');
                echo json_encode($return_arr);
                return;
            }
        }

        if($telp_baru != ''){
            //check if phone number is registered
            $phone_check = $this->Profile_model->phone_check($telp_baru);
            if($phone_check->num_rows() > 0){
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'No. Telepon sudah terdaftar. Silahkan gunakan nomor lain yang belum terdaftar.');
                echo json_encode($return_arr);
                return;
            }
            $updated_data = array("telp_web_user" => $telp_baru);
            if($this->Profile_model->update_detail_user($_SESSION['id_web_user'], $updated_data)){
                $phone = true;
            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal update no. telepon');
                echo json_encode($return_arr);
                return;
            }

        }

        if($password_lama != '' || $password_baru != '' || $konfirmasi_password_baru != ''){
            //get password
            $user = $this->Profile_model->get_detail_user($_SESSION['id_web_user']);
            if($user->num_rows() > 0){
                $user_data = $user->row();
                $password_lama_db = $user_data->password_web_user;
                $password_lama_hash = md5($password_lama);
                $password_baru_hash = md5($password_baru);
                $konfirmasi_password_baru_hash = md5($konfirmasi_password_baru);

                if($password_lama_db != $password_lama_hash){
                    $this->db->trans_rollback();
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Password lama anda salah');
                    echo json_encode($return_arr);
                    return;
                } else if($password_baru_hash != $konfirmasi_password_baru_hash){
                    $this->db->trans_rollback();
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Pastikan password sudah diketik dengan benar');
                    echo json_encode($return_arr);
                    return;
                } else {
                    // change password
                    if($password_lama != '' && $password_baru != '' && $konfirmasi_password_baru != ''){
                        $updated_data = array("password_web_user" => $password_baru_hash);
                        if($this->Profile_model->update_detail_user($_SESSION['id_web_user'], $updated_data)){
                            $password = true;
                        } else {
                            $this->db->trans_rollback();
                            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal update password');
                            echo json_encode($return_arr);
                            return;
                        }
                    }

                }

            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'User tidak ditemukan');
                echo json_encode($return_arr);
                return;
            }
        }

        if($email && $password && $phone){
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'Email, password dan No. telepon berhasil diupdate');
        } else if($email && $password){
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'Email dan password berhasil diupdate');
        } else if($email && $phone){
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'Email dan No. Telepon berhasil diupdate');
        } else if($phone && $password){
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'No. Telepon dan password berhasil diupdate');
        } else if($email) {
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'Email berhasil diupdate');
        } else if($password){
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'Password berhasil diupdate');
        } else if($phone) {
            $this->db->trans_commit();
            $return_arr = array("Status" => 'OK', "Message" => 'No. Telepon berhasil diupdate');
        }

        echo json_encode($return_arr);
        return;
    }


    function get_riwayat_pesanan(){

        $filters = array();


        if(isset($_REQUEST['tipe']) && $_REQUEST['tipe'] == 'PURCHASE'){
            if(isset($_REQUEST['status']) && $_REQUEST['status'] != 'all'){
                array_push($filters, "b.status_web_so_m = '".htmlentities($_REQUEST['status'], ENT_QUOTES)."'");
            }
        } else if(isset($_REQUEST['tipe']) && $_REQUEST['tipe'] == 'REVIEW') {
            if(isset($_REQUEST['status'])){


                array_push($filters, "b.status_web_so_m = '4'");


                if($_REQUEST['status'] == '1'){
                    // menunggu diulas
                    array_push($filters, "a.id_web_so_d NOT IN (SELECT id_so_d FROM web_ulasan)");
                } else if($_REQUEST['status'] == '2'){
                    //diulas
                    array_push($filters, "a.id_web_so_d IN (SELECT id_so_d FROM web_ulasan)");
                }
            }
        }

        if(isset($_REQUEST['search']) && $_REQUEST['search'] != ''){
            // dont allow special characters
            array_push($filters, "CONCAT(b.bukti_web_so_m, a.nama_product_so_d) LIKE '%".htmlentities($_REQUEST['search'], ENT_QUOTES)."%'");
        }

        $data = $this->Profile_model->get_riwayat_pesanan($_SESSION['id_web_user'], $filters);

        echo json_encode($data->result_object());
        return;
    }

    function get_riwayat_pesanan_chat(){
        $search = htmlentities(trim($_REQUEST['search']), ENT_QUOTES);
        if($search == ''){
            $search = null;
        }
        $data = $this->Profile_model->get_riwayat_pesanan_chat($_SESSION['id_web_user'], $search);

        echo json_encode($data->result_object());
        return;
    }

    function get_detail_pesanan(){
        $id = htmlentities($_REQUEST['id'], ENT_QUOTES);
        $data = $this->Profile_model->get_detail_pesanan($id);

        if($data->num_rows() == 0){
            echo json_encode(array("Status" => 'UNAUTHORIZED', "Message" => 'Pesanan Tidak Valid'));
        } else {
            if($data->row()->id_user_web_so_m == $_SESSION['id_web_user']){
                echo json_encode($data->result_object());
                return;
            } else {
                echo json_encode(array("Status" => 'UNAUTHORIZED', "Message" => 'Access Denied'));
            }
        }

    }

    function get_favorites(){
        if(isset($_SESSION['id_web_user'])) {
            $id_web_user = $_SESSION['id_web_user'];
        } else {
            $id_web_user = 0;
        }
        $data = $this->Profile_model->get_favorites($id_web_user);
        echo json_encode($data->result_object());
        return;
    }

    function get_alamat(){
        $data = $this->Profile_model->get_alamat("id_web_user = '".$_SESSION['id_web_user']."'");
        echo json_encode($data->result_object());
        return;
    }

    function get_terakhir_dilihat(){
        $tipe = htmlentities($_REQUEST['tipe'], ENT_QUOTES);
        $data = $this->Profile_model->get_activity($_SESSION['id_web_user'], $tipe);
        echo json_encode($data->result_object());
        return;
    }

    function upload_image()
    {

        $config['upload_path'] = './assets/upload/review/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        /* UPLOAD FILE IN AWS S3*/
//        $config['folder_name'] = 'upload/review/';
//        $this->folder_name = $config['folder_name'];
//        $file_path = $_FILES['img_ulasan']['tmp_name'];
//        $file = pathinfo($file_path);
//        $s3_file = $file['filename'].'-'.rand(1000,1).'.jpg';
//        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
//
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
//            $result_array = array("Status" => 'OK', "File" => $this->s3_url.$this->folder_name.$s3_file);
//        }

        /* UPLOAD FILE IN LOCAL STORAGE */
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img_ulasan')) {
            $result_array = array("Status" => 'ERROR',"Message" => $this->upload->display_errors());
        } else {
            $file_data = $this->upload->data();
            $result_array = array("Status" => 'OK', "File" => 'assets/upload/review/'.$file_data['file_name']);

        }

        echo json_encode($result_array);
        return;

    }

    function sudah_bayar(){
        $payment_ref = htmlentities($_REQUEST['payment_ref'], ENT_QUOTES);
        $payment_ref_name = htmlentities($_REQUEST['payment_ref_name'], ENT_QUOTES);
        $id_so_m = htmlentities($_REQUEST['id_so_m'], ENT_QUOTES);

        date_default_timezone_set('Asia/Jakarta');
        $date  = date('Y-m-d H:i:s');

        if($payment_ref == ''){
            $result_array = array("Status" => 'ERROR', "Message" => 'Gagal konfirmasi pembayaran');
            echo json_encode($result_array);
            return;
        }

        $updated_data = array(
            "payment_ref" => strtoupper($payment_ref),
            "payment_ref_name" => strtoupper($payment_ref_name),
            "paid_by_user" => '1'
        );

        if($this->Profile_model->update_web_so_info($id_so_m, $updated_data)){

            $bukti_web_so_m = $this->Cart_model->get_so_m_summary($id_so_m)->row()->bukti_web_so_m;
            $notifikasi = array(
                'id_web_user' => $_SESSION['id_web_user'],
                'isi_web_notifikasi' => "Pesanan $bukti_web_so_m telah dibayar. Silahkan tunggu konfirmasi admin",
                'is_read' => '0',
                'timestamp_web_notifikasi' => $date,
                'url_web_notifikasi' => 'profile/purchase_detail?id='.$bukti_web_so_m
            );

            $this->Home_model->add_notification($notifikasi);

            $result_array = array("Status" => 'OK');
        } else {
            $result_array = array("Status" => 'ERROR', "Message" => 'Gagal konfirmasi pembayaran');
        }

        echo json_encode($result_array);
        return;
    }

    function delete_address(){
        $id_web_user_alamat = htmlentities($_REQUEST['id_web_user_alamat'], ENT_QUOTES);

        $data = $this->Profile_model->get_alamat("id_web_user_alamat = '$id_web_user_alamat'");

        if($data->num_rows() > 0){
            //check if this address belongs to this user
            if($_SESSION['id_web_user'] != $data->row()->id_web_user){
                $result_array = array("Status" => 'ERROR', "Message" => 'Unauthorized User');
            } else if($data->row()->is_primary == '1'){
                $result_array = array("Status" => 'ERROR', "Message" => 'Alamat utama tidak boleh dihapus!');
            } else {
                if($this->Profile_model->delete_address($id_web_user_alamat)){
                    $result_array = array("Status" => 'OK', "Message" => 'Alamat dihapus');
                } else {
                    $result_array = array("Status" => 'ERROR', "Message" => 'Gagal menghapus alamat');
                }
            }
        } else {
            $result_array = array("Status" => 'ERROR', "Message" => 'Alamat tidak ditemukan');
        }

        echo json_encode($result_array);
        return;

    }

    function get_virtual_account(){
        $data = $this->Profile_model->get_detail_user($_SESSION['id_web_user'])->row();
        $va = "12345".$data->telp_web_user;
        echo json_encode($va);

    }

    function pesanan_selesai(){

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');

        $id_so_m = htmlentities($_REQUEST['id_so_m'], ENT_QUOTES);
        $status = array("status_web_so_m" => '4');
        $selesai_date = array("selesai_date" => $date);

        $this->db->trans_begin();
        if($this->Profile_model->update_status_so_m($status, $id_so_m)){
            if($this->Profile_model->update_web_so_info($id_so_m, $selesai_date)){

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

    function get_suggest_provinsi(){
        $search = htmlentities($_REQUEST['search'], ENT_QUOTES);
        $suggest_data = $this->Profile_model->get_suggest_provinsi($search);
        $row = array();

        foreach($suggest_data->result_array() as $suggest) {
            $data = array("value" => $suggest['NAMA'], "id" => $suggest['KODE_WILAYAH']);
            array_push($row, $data);
        }

        echo json_encode($row);
    }

    function get_suggest_kota(){
        $search = htmlentities($_REQUEST['search'], ENT_QUOTES);
        $provinsi = htmlentities($_REQUEST['provinsi'], ENT_QUOTES);

        $suggest_data = $this->Profile_model->get_suggest_kota($search, $provinsi);
        $row = array();

        foreach($suggest_data->result_array() as $suggest) {
            $data = array(
                "value" => $suggest['NAMA'],
                "id" => $suggest['KODE_WILAYAH'],
                "provinsi" => $suggest['PROVINSI'],
                "kode_provinsi" => $suggest['KODE_PROVINSI']
            );
            array_push($row, $data);
        }

        echo json_encode($row);
    }

    function get_suggest_kecamatan(){
        $search = htmlentities($_REQUEST['search'], ENT_QUOTES);
        $kota = htmlentities($_REQUEST['kota'], ENT_QUOTES);

        $suggest_data = $this->Profile_model->get_suggest_kecamatan($search, $kota);
        $row = array();

        foreach($suggest_data->result_array() as $suggest) {
            $data = array(
                "value" => $suggest['NAMA'],
                "id" => $suggest['KODE_WILAYAH'],
                "provinsi" => $suggest['PROVINSI'],
                "kode_provinsi" => $suggest['KODE_PROVINSI'],
                "kota" => $suggest['KOTA'],
                "kode_kota" => $suggest['KODE_KOTA']
            );
            array_push($row, $data);
        }

        echo json_encode($row);
    }

    function get_detail_user(){
        $user = $this->Profile_model->get_detail_user($_SESSION['id_web_user']);
        $user_row = $user->row();
        echo json_encode(array('email_web_user' => $user_row->email_web_user, 'telp_web_user' => $user_row->telp_web_user));
        return;
    }

}
?>